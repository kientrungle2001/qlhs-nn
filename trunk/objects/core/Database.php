<?php
class PzkCoreDatabase extends PzkObjectLightWeight {

    public $connId;
    public $options;

    /**
     * Hàm khởi tạo và clear
     * @param string $attrs các thuộc tính
     */
    public function __construct($attrs = array()) {
        parent::__construct($attrs);
        $this->clear();
    }
	
    /**
     * Join với table với điều kiện join, và kiểu join
     * @param string $table bảng cần join
     * @param mixed $conds điều kiện join
     * @param string $type kiểu join: inner, left, right, mặc định là inner
     * @return PzkCoreDatabase
     */
	public function join($table, $conds, $type = 'inner') {
		if(!isset($this->options['joins'])) {
			$this->options['joins'] = array();
		}
		$this->options['joins'][$table] = array('conds' => $this->buildCondition($conds), 'type' => $type);
		return $this;
	}

	/**
	 * Kết nối tới cơ sở dữ liệu
	 */
    public function connect() {
        if (!@$this->connId) {
            $this->connId = @mysql_connect(@$this->host, @$this->user, @$this->password, true) or die('Cant connect');
			//mysql_query("SET character_set_results=utf8", $this->connId);
            mysql_select_db(@$this->dbName, $this->connId) or die('Cant select db: ' . @$this->dbName);
            mysql_query('set names utf-8', $this->connId);
        }
    }

    public function insert($table) {
        $this->options['action'] = 'insert';
        $this->options['table'] = "`$table`";
        return $this;
    }

    public function values($values) {
        $this->options['values'] = $values;
        return $this;
    }

    public function fields($fields) {
        $this->options['fields'] = $fields;
        return $this;
    }

    public function delete() {
        $this->options['action'] = 'delete';
        return $this;
    }

    public function update($table) {
        $this->options['action'] = 'update';
        $this->options['table'] = $table;
        return $this;
    }

    public function set($values) {
        $this->options['values'] = $values;
        return $this;
    }

    public function select($fields) {
        $this->options['action'] = 'select';
        $this->options['fields'] = $fields;
        return $this;
    }

    public function count() {
        $this->options['action'] = 'count';
        return $this;
    }

    public function from($table) {
        if (strpos($table, '`') !== false || preg_match('/^[\w\d_]/', $table) !== false) {
            $this->options['table'] = $table;
        } else {
            $this->options['table'] = '`' . $table . '`';
        }
        return $this;
    }

    public function where($conds) {
		$condsStr = $this->buildCondition($conds);
        $this->options['conds'] = pzk_or(@$this->options['conds'], 1) . ' AND ' . $condsStr;
        return $this;
    }
	public function useCB() {
		$this->options['useConditionBuilder'] = true;
		return $this;
	}
	public function useCache($timeout = null) {
		$this->options['useCache'] = true;
		$this->options['cacheTimeout'] = $timeout;
		return $this;
	}
	public function buildCondition($conds) {
		$builder = pzk_element('conditionBuilder');
		if($builder) {
			if(@$this->options['useConditionBuilder'])
				return $builder->build($conds);
		}
		$condsStr = '';
        $condsArr = array();
        if (is_array($conds)) {
            if (!isset($conds[0])) {
                $conds = array($conds);
            }
            foreach ($conds as $cond) {
                // xet moi dieu kien key la truong can loc
                if (is_array($cond)) {
                    foreach ($cond as $key => $val) {
                        // neu val la mang
                        if (is_array($val)) {
                            // neu la mang co chi so
                            if (isset($val[0])) {
                                $condsArr[] = '`' . $key . '` in (\'' . implode('\',\'', $val) . '\')';
                            } else if (isset($val['comparator']) || isset($val['cp'])) {
                                // neu la mang co comparator dang {cp: '=', value: ''}
                                $cp = isset($val['comparator']) ? $val['comparator'] : $val['cp'];
                                if (@$val['value'] !== '') {
                                    if (@$val['value'] == 'NULL') {
                                        $condsArr[] = '`' . $key . '` ' . $cp
                                                . ' ' . @mysql_real_escape_string($val['value']);
                                    } else {
										if($cp == 'is null' || $cp == 'is not null') {
											$condsArr[] = '`' . $key . '` ' . $cp;
										} else {
											$likeComp = ($cp == 'like' || $cp == 'not like' ? '%' : '');
											$condsArr[] = '`' . $key . '` ' . $cp
													. ' \'' . $likeComp . @mysql_real_escape_string($val['value']) . $likeComp . '\'';
										}
									}
                                }
                            }
                        } else {
                            // neu khong thi la so sanh bang
                            if ($val !== '') {
								$condsArr[] = '`' . $key . '`=\'' . @mysql_real_escape_string($val) . '\'';
							}
						}
                    }
                } else {
                    $condsArr[] = $cond;
                }
            }
            $condsStr = implode(' AND ', $condsArr);
        } else {
            $condsStr = $conds;
        }
        if (!$condsStr)
            $condsStr = 1;
		return $condsStr;
	}

    public function filters($filters) {
        if ($filters && is_array($filters)) {
            $this->where($filters);
        }
        return $this;
    }

    public function orderBy($orderBy) {
        $this->options['orderBy'] = $orderBy;
        return $this;
    }

    public function groupBy($groupBy) {
		if(!$groupBy) return $this;
        $this->options['groupBy'] = $groupBy;
        return $this;
    }

    public function having($conds) {
		if(!$conds) return $this;
        if (isset($this->options['groupBy'])) {
			$condsStr = $this->buildCondition($conds);
            $this->options['having'] =  pzk_or(@$this->options['having'], 1) . ' AND ' . $condsStr;;
        }
		return $this;
    }

    /**
     * Thực thi query
     * @param string $entity trả về mảng dạng entity hay dạng mảng thông thường
     * @return NULL|array|array<PzkEntityModel>
     */
    public function result($entity = false) {
        $this->connect();
        //mysql_query('set names utf-8', $this->connId);
        $rslt = array();
        if (@$this->options['action'] == 'select') {
            $query = 'select ' . $this->options['fields']
                    . ' from ' . $this->options['table'];
			if(isset($this->options['joins'])) {
				$joins = $this->options['joins'];
				foreach($joins as $table => $join) {
					$query.= ' ' . $join['type'] . ' join ' . $table . ' on ' . $join['conds'];
				}
			}
            $query .= ((@$this->options['conds']) ? ' where ' . $this->options['conds'] : '')
                    . (@$this->options['groupBy'] ? ' group by ' . $this->options['groupBy'] : '')
                    . (@$this->options['having'] ? ' having ' . $this->options['having'] : '')
                    . (@$this->options['orderBy'] ? ' order by ' . $this->options['orderBy'] : '')
                    . (@$this->options['pagination'] ?
                            ' limit ' . $this->options['start'] . ', '
                            . $this->options['pagination'] : '');
			if(@$this->options['useCache']) {
				$data = pzk_filevar(md5($query . $entity) , null, isset($this->options['cacheTimeout'])? $this->options['cacheTimeout']: null);
				if($data !== NULL) {
					return $data;
				}
			}
            if (@$_REQUEST['showSQL'])
                echo $query . '<br />';
            $result = mysql_query($query, $this->connId);
            if (mysql_errno()) {
                $message = 'Invalid query: ' . mysql_error() . "\n";
                $message .= 'Whole query: ' . $query;
                die($message);
            }
            while ($row = mysql_fetch_assoc($result)) {
				if(@$row['params']) {
					$params = json_decode($row['params'], true);
					$row = array_merge($row, $params);
				}
				if($entity) {
					$entityObj = pzk_loader()->createModel('entity.' . $entity);
					$entityObj->setData($row);
					$rslt[] = $entityObj;
				} else {
					$rslt[] = $row;
				}
            }
			if(@$this->options['useCache']) {
				pzk_filevar(md5($query . $entity), $rslt);
			}
            return $rslt;
        } else if (@$this->options['action'] == 'insert') {
			if(!@$this->options['fields']) {
				$this->options['fields'] = implode(',', $this->getFields($this->options['table']));
			}
            $vals = array();
            $columns = explode(',', $this->options['fields']);
            foreach ($this->options['values'] as $value) {

                $colVals = array();
                foreach ($columns as $col) {
					$col = trim($col);
                    $col = str_replace('`', '', $col);
                    $colVals[] = "'" . @mysql_real_escape_string(@$value[$col]) . "'";
                }
                $vals[] = '(' . implode(',', $colVals) . ')';
            }
            $table = $this->options['table'];
            $fields = $this->options['fields'];
            $values = implode(',', $vals);
            $query = "insert into $table($fields) values $values";
            if (@$_REQUEST['showQuery'])
                echo $query . '<br />';
            $result = mysql_query($query, $this->connId);
            if ($errors = mysql_error()) {
                @file_put_contents(BASE_DIR . '/test/'.$_SERVER['HTTP_HOST'].'_error.sql', $query . "\r\nError: " . $errors, FILE_APPEND | LOCK_EX);
            }
            if ($result) {
				$insertId = mysql_insert_id();
				$version = @file_get_contents(BASE_DIR . '/test/'.$_SERVER['HTTP_HOST'].'_sql_data_version.txt');
				$newVersion = $version + 1;
				mysql_query('insert into sync_table(line_data, v) values(\''.mysql_real_escape_string($query).'\', \''.$newVersion.'\')');
				$query .= ' # ' . mb_detect_encoding($query);
				@file_put_contents(BASE_DIR . '/test/'.$_SERVER['HTTP_HOST'].'.sql', $query . "\r\n", FILE_APPEND | LOCK_EX);
				@file_put_contents(BASE_DIR . '/test/'.$_SERVER['HTTP_HOST'].'_sql_data_version.txt', $newVersion);
                return $insertId;
            }
            return 0;
        } else if (@$this->options['action'] == 'update') {
            $columns = $this->describle($this->options['table']);
            $vals = array();
            foreach ($this->options['values'] as $key => $value) {
                if (in_array($key, $columns)) {
                    $vals[] = '`'.$key . '`=\'' . @mysql_real_escape_string($value) . '\'';
                }
            }
            $values = implode(',', $vals);
            $query = "update {$this->options['table']} set $values where {$this->options['conds']}";
            if (@$_REQUEST['showQuery'])
                echo($query . '<br />');
            $result = mysql_query($query, $this->connId);
			if($result) {
				$version = @file_get_contents(BASE_DIR . '/test/'.$_SERVER['HTTP_HOST'].'_sql_data_version.txt');
				$newVersion = $version + 1;
				mysql_query('insert into sync_table(line_data, v) values(\''.mysql_real_escape_string($query).'\', \''.$newVersion.'\')');
				$query .= ' # ' . mb_detect_encoding($query);
				@file_put_contents(BASE_DIR . '/test/'.$_SERVER['HTTP_HOST'].'_sql_data_version.txt', $newVersion);
				@file_put_contents(BASE_DIR . '/test/'.$_SERVER['HTTP_HOST'].'.sql', $query . "\r\n", FILE_APPEND | LOCK_EX);
			}
			return $result;
        } else if (@$this->options['action'] == 'delete') {
            $query = "delete from {$this->options['table']} where {$this->options['conds']}";
            $result = mysql_query($query, $this->connId);
			if($result) {
				$version = @file_get_contents(BASE_DIR . '/test/'.$_SERVER['HTTP_HOST'].'_sql_data_version.txt');
				$newVersion = $version + 1;
				mysql_query('insert into sync_table(line_data, v) values(\''.mysql_real_escape_string($query).'\', \''.$newVersion.'\')');
				$query .= ' # ' . mb_detect_encoding($query);
				@file_put_contents(BASE_DIR . '/test/'.$_SERVER['HTTP_HOST'].'.sql', $query . "\r\n", FILE_APPEND | LOCK_EX);
				@file_put_contents(BASE_DIR . '/test/'.$_SERVER['HTTP_HOST'].'_sql_data_version.txt', $newVersion);
			}
			return $result;
        }
        return $this;
    }
	
    /**
     * Trả về câu query trước khi execute
     * @return string
     */
	public function getQuery() {
		if (@$this->options['action'] == 'select') {
            $query = 'select ' . $this->options['fields']
                    . ' from ' . $this->options['table'];
			if(isset($this->options['joins'])) {
				$joins = $this->options['joins'];
				foreach($joins as $table => $join) {
					$query.= ' ' . $join['type'] . ' join ' . $table . ' on ' . $join['conds'];
				}
			}
            $query .= ((@$this->options['conds']) ? ' where ' . $this->options['conds'] : '')
                    . (@$this->options['groupBy'] ? ' group by ' . $this->options['groupBy'] : '')
                    . (@$this->options['having'] ? ' having ' . $this->options['having'] : '')
                    . (@$this->options['orderBy'] ? ' order by ' . $this->options['orderBy'] : '')
                    . (@$this->options['pagination'] ?
                            ' limit ' . $this->options['start'] . ', '
                            . $this->options['pagination'] : '');
			return $query;
        }
	}
	
	/**
	 * Trả về một bản ghi
	 * @param string $entity: trả về theo entity hay theo dạng mảng thông thường
	 * @return Ambigous <multitype:, Ambigous <NULL, unknown>>|NULL
	 */
	public function result_one($entity = false) {
		$this->limit(1,0);
		$rows = $this->result($entity);
		if(count($rows)) {
			return $rows[0];
		}
		return NULL;
	}
	
	public function treeDelete($table, $id) {
		$children = $this->clear()->select('id')->from($table)->where('parentId=' . $id)->result();
		foreach($children as $row) {
			$this->treeDelete($table, $row['id']);
		}
		$this->clear()->delete()->from($table)->where('id=' . $id)->result();
	}
	
	public function getParent($table, $id, $conditions = false) {
		$item = $this->clear()->select('*')->from($table)->where('id=' . $id)->result_one();
		if(!$item) return NULL;
		$itemWithCondition = $this->clear()->select('*')->from($table)->where('id=' . $id . ' and ' . pzk_or($conditions, '1'))->result_one();
		if($itemWithCondition) return $itemWithCondition;
		if(!$item['parentId']) return NULL;
		return $this->getParent($table, $item['parentId'], $conditions);
	}
	
	/**
	 * Trả về các con theo parentId và điều kiện
	 * @param unknown $table
	 * @param unknown $parentId
	 * @param mixed $conditions
	 * @return array
	 */
	public function getChildren($table, $parentId, $conditions = false) {
		return $this->clear()->useCB()->select('*')->from($table)->where('parentId=' . $parentId . ' and ' . pzk_or($conditions, '1'))->result();
	}
	
	/**
	 * Phân trang
	 * @param unknown $pagination: số bản ghi / trang
	 * @param unknown $page: số hiệu trang
	 * @return PzkCoreDatabase
	 */
    public function limit($pagination, $page = 0) {
        $this->options['start'] = $pagination * $page;
        $this->options['pagination'] = $pagination;
        return $this;
    }
	
    /**
     * Clear query để bắt đầu lại
     * @return PzkCoreDatabase
     */
    public function clear() {
        $this->options = array();
		//$this->useCache(15*60);
        return $this;
    }

    /**
     * Describle một bảng: trả về các columns của bảng
     * @param string $table
     * @param boolean $columns trả về danh sách tên column hay trả về danh sách chi tiết của column
     * @return array
     */
    public function describle($table, $columns = true) {
        $result = mysql_query('describe ' . $table, $this->connId);
        $rslt = array();
        while ($row = mysql_fetch_assoc($result)) {
            if ($columns) {
                $rslt[] = $row['Field'];
            } else {
                $rslt[] = $row;
            }
        }
        return $rslt;
    }

    /**
     * Query một câu lệnh sql thông thường
     * @param string $sql câu lệnh sql
     * @return array|resource|multitype:multitype:
     */
    public function query($sql) {
        $this->connect();
        if (@$_REQUEST['showQuery'])
            pre($sql);
        $result = mysql_query($sql, $this->connId);
        if (is_bool($result))
            return $result;
        $rslt = array();
        while ($row = mysql_fetch_assoc($result)) {
            $rslt[] = $row;
        }
        return $rslt;
    }
	
    /**
     * Query lấy một bản ghi
     * @param string $sql câu lệnh sql
     * @return array|NULL
     */
	public function query_one($sql) {
		$result = $this->query($sql);
		if(is_bool($result)) return $result;
		return $result[0];
	}
	
	/**
	 * Lấy các trường của một bảng trong csdl
	 * @param string $table
	 * @return array mảng các trường
	 */
	public function getFields($table) {
		$query = "select COLUMN_NAME from information_schema.columns where table_name = '$table' order by ordinal_position";
		$fields = $this->query($query);
		$columns = array();
		foreach($fields as $field) {
			$columns[] = $field['COLUMN_NAME'];
		}
		return $columns;
	}
	
	/**
	 * Xây dựng insert data
	 * @param string $table bảng
	 * @param array $data mảng dữ liệu chưa được lọc
	 * @return array mảng dữ liệu insert được
	 */
	public function buildInsertData($table, $data) {
		$fields = $this->getFields($table);
		$params = array();
		$result = array();
		foreach($data as $key => $val) {
			if(in_array($key, $fields)) {
				if(is_array($val)) {
					$val = ','.implode(',', $val).',';
				}
				$result[$key] = $val;
			} else {
				$params[$key] = $val;
			}
		}
		if(in_array('params', $fields)) {
			$result['params'] = json_encode($params);
		}
		return $result;
	}
	
	/**
	 * Trả về một entity trong model/entity
	 * @param string $entity tên entity theo kiểu edu.student
	 * @return PzkEntityModel
	 */
	public function getEntity($entity) {
		return pzk_loader()->createModel('entity.' . $entity);
	}
	/**
	 * Trả về entity table
	 * @param string $table tên bảng cơ sở dữ liệu
	 * @return PzkEntityTableModel
	 */
	public function getTableEntity($table) {
		$entity = $this->getEntity('table')->setTable($table);
		return $entity;
	}

}

/**
 * @return PzkCoreDatabase
 */
function _db() {
    return pzk_store_element('db')->clear();
}

function db_query($sql) {
    return _db()->query($sql);
}
?>