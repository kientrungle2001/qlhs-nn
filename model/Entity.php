<?php
class PzkEntityModel extends PzkSG{
	public $data = array();
	public $table;
	public $type = '';
	public function setData($data) {
		$this->data = $data;
		return $this;
	}
	public function getData() {
		return $this->data;
	}
	public function load($id = false, $cacheTimeout = NULL) {
		if($id) {
			$query = _db();
			if($cacheTimeout) {
				$query->useCache($cacheTimeout);
			}
			$this->data = $query->select('*')->from($this->table)->where('id=' . $id)->result_one();
		}
		return $this;
	}
	public function loadWhere($conditions, $cacheTimeout = NULL) {
		if($conditions) {
			$query = _db();
			if($cacheTimeout) {
				$query->useCache($cacheTimeout);
			}
			$this->data = $query->useCB()->select('*')->from($this->table)->where($conditions)->result_one();
			//echo $query->getQuery();
		}
		return $this;
	}

	public function update($data) {
		$this->data = array_merge($this->data, $data);
		foreach($data as $key => &$value) {
			if($value === NULL) {
				$value = '';
			}
		}
		$data = _db()->buildInsertData($this->table, $this->data);
		_db()->update($this->table)->set($data)->where('id=' . $this->data['id'])->result();
	}
	public function save() {
		$data = _db()->buildInsertData($this->table, $this->data);
		if(!isset($this->data['id'])) {
			$keys = array_keys($data);
			foreach($keys as &$key) {
				$key = "`$key`";
			}
			$id = _db()->insert($this->table)->fields(implode(',', $keys))->values(array($data))->result();
			if($id) $this->data['id'] = $id;
		} else {
			_db()->update($this->table)->set($data)->where('id=' . $this->data['id'])->result();
		}
		//$this->children('updateClosure');
		//$this->updateClosure();
	}
	public function updateClosure() {
		if(isset($this->data['parentId'])) {
			$parentId = $this->data['parentId'];
			if($parentId) {
				$class = get_class($this);
				$obj = new $class();
				$obj->load($parentId);
				$closure = $obj->get('closure','') . $this->get('id') . ',';
			} else {
				$closure = ','.$this->get('id') . ',';
			}
			$this->data['closure'] = $closure;
			$closureData = array(
				'closure' => $closure
			);
			$this->update($closureData);
		}
		
	}
	
	public function getRelateds($table, $entity, $refField, $conditions = false) {
		$query = _db()->select('*')->from($table)->where($refField . '=' . $this->data['id']);
		if($conditions) {
			$query->useCB()->where($conditions);
		}
		return $query->result($entity);
	}
	/*
	public function getType() {
		$typeCode = $this->type;
		if(!$typeCode) $typeCode = str_replace('_', '', $this->table) . 'Table';
		$type = _db()->useCB()->select('*')->from('attribute_catalog_type')
				->where(array('and', array('sourceTable', $this->table), array('code', $typeCode)))->result_one('attribute.catalog.type');
		return $type;
	}*/
	
	public function get($key, $default = NULL) {
		return isset($this->data[$key]) && $this->data[$key]?$this->data[$key]: $default;
	}
	
	public function set($key, $value) {
		$this->data[$key] = $value;
		return $this;
	}
	
	public function has($key) {
		return isset($this->data[$key]);
	}
	
	public function children($action = false) {
		if($action) {
			if(gettype($action) == 'string') {
				if(method_exists($this, $action)) {
					$this->$action();
				} else {
					$action($this);
				}
			} else if(gettype($action) == 'object') {
				$action->process($this);
			}
		}
		
		$type = $this->getType();
		if(!$type) return false;
		$relations = $type->getRelations();
		
		foreach($relations as $rel) {
			$related = $rel->getRelatedType();
			$relation = $rel->getRelationType();
			$parentField = $rel->getAttribute();
			if($relation->get('code') == 'Parent') {
				$children = _db()->useCB()->select('*')->from($related->get('sourceTable'))
					->where(array($parentField->get('code') , $this->get('id')))->result(str_replace('_', '.', $related->get('sourceTable')));
				
				foreach($children as $child) {
					$child->children($action);
				}
			}
		}
	}
	
	public function delete() {
		return _db()->useCB()->delete()->from($this->table)
		->where(array('id', $this->get('id')))->result();
	}
	
	public function getWhere($where = 1, $orderBy = 'id asc'){
		$arr = array();
		$class = get_class($this);
		$items = _db()->useCB()->select('*')->from($this->table)->where($where)->orderBy($orderBy)->result();
		foreach($items as $item) {
			$entity = new $class();
			$entity->table = $this->table;
			$entity->setData($item);
			$arr[] = $entity;
		}
		return $arr;
	}
	public function getOne($where = 1, $orderBy = 'id asc'){
		$item = _db()->useCB()->select('*')->from($this->table)->where($where)->orderBy($orderBy)->result_one();
		if($item) {
			$class = get_class($this);
			$entity = new $class();
			$entity->table = $this->table;
			$entity->setData($item);
			return $entity;
		}
		return null;
	}
}