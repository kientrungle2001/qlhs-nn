<?php
/**
 * View object
 *
 */
	public $scriptTo = 'head';


	/**
	 * cac tham so dung de cache, viet cach nhau boi dau phay
	 */


	/**
	 * Cac tham so dung de cho ham toArray, viet cach nhau boi dau phay
	 */
	public $arrayParams = false;

	/**
	 * Id cua parent element
	 */
	public $pzkParentId = false;

	/**
	 * Id lon nhat cua element
	 */

	/**
	 * Css lien quan den object, css nay se duoc cache lai
	 */
	public $cssLink = false;

	/**
	 * Css nay khong can cache lai
	 */
	public $cssExternalLink = false;
	
	public static $selectors = array();

	/**
	 * Ham khoi tao mot object voi cac attribute cua no truyen
	 * dang mang
	 * @param $attrs la cac thuoc tinh cua doi tuong
	 */
		foreach($attrs as $key => $value) $this->$key = $value;

		$this->css();
		$this->javascript();

	}
	
	/**
	 * Ham them css cho trang
	 */
	public function css() {
		if ($this->cssLink != false) {
			if($page = pzk_page())
				$page->addObjCss($this->cssLink);
		}
		if ($this->cssExternalLink != false) {
			if($page = pzk_page()) {
				$page->addExternalCss($this->cssExternalLink);
			}
		}

	}
	
	/**
	 * Add javascript tag for object
	 */
	public function javascript() {
		if ($this->scriptable === true || $this->scriptable === 'true') {
			
			if(@$this->scriptTo) {
				$element = pzk_store_element($this->scriptTo);
				if($element) {
					$element->append(pzk_parse('<html.js src="'.BASE_URL.'/js/'.implode('/', $this->fullNames).'.js" />'));
				}
			} else {
				$page =pzk_page();
				if ($page) {
					$page->addObjJs($this->tagName);
				}
			}
		}
	}
	/**
	 * Ham nay chay khi doi tuong vua duoc khoi tao,
	 * cac doi tuong con cua no chua duoc khoi tao
	 */
	/**
	 * Ham nay dung de hien thi doi tuong
	 */
		$this->script();
		
	/**
	 * Ham nay tao 1 instance javascript cho doi tuong hien thi
	 */
			$page = pzk_page();
			if ($page) {
			}
	/**
	 * Ham nay tra ve html cua doi tuong can hien thi
	 * Neu request no cache hoac cau hinh cua doi tuong
	 * co cacheable = false thi se ko cache
	 * nguoc lai thi se cache
	 */
		|| $this->cacheable === 'true')) {

	/**
	 *	Ham cache lai noi dung hien thi
	 * 	Dua tren cac tham so dua vao de cache
	 * 	Cache nay theo 1 loai cacher nao do:
	 * 	file cache hay memcache hoac db cache, session cache,... 
	 */
	public function cache() {
		$key = $this->cacher.'.' . $this->hash();
		if (($content = pzk_store($key)) === NULL) {
			$content = $this->getContent();
			pzk_store($key, $content);
		}
		echo $content;
	}

	 *	Tra ve html cua doi tuong can hien thi
	 * 	truong hop nay la truong hop khi khong co cache
	 */
		return PzkParser::parseLayout($this->layout, $this, true);
	/**
	 * 	Tao key cho doi tuong can hien thi (de cache)
	 */
	/**
	 *	Append mot child object 
	 */
		$obj->pzkParentId = @$this->id;
	
	/**
	 * Prepend mot child object
	 */
	public function prepend($obj) {
		$obj->pzkParentId = @$this->id;
		array_unshift($this->children, $obj);
	}
	
	/**
	 * Insert mot child object vao vi tri index
	 */
	public function insertObject($obj, $index) {
		$obj->pzkParentId = @$this->id;
		array_splice($this->children, $index, 0, $obj);
	}
	
	/**
	 * Tra ve vi tri cua doi tuong trong danh sach anh em cua no
	 */
	public function index() {
		if ($parent = $this->getParent()) {
			return array_search($this, $parent->children);
		}
		return -1;
	}
	
	/**
	 * Insert mot doi tuong vao ngay truoc doi tuong
	 */
	public function before(&$obj) {
		if ($parent = $this->getParent()) {
			$parent->insert($obj, $this->index());
		}
	}
	
	/**
	 * Insert mot doi tuong vao ngay sau doi tuong
	 */
	public function after(&$obj) {
		if ($parent = $this->getParent()) {
			$parent->insert($obj, $this->index() + 1);
		}
	}
	
	/**
	 * Lay ra cha cua doi tuong do
	 */
	public function getParent() {
		if ($this->pzkParentId) {
			return pzk_store_element($this->pzkParentId);
		}
		return NULL;
	}
	
	/**
	 * Lay ra tat ca cac con cua doi tuong theo selector
	 * @param $selector: selector can chon dua theo cau truc
	 * 	tagName[name=value][name=value]
	 */
	public function getChildren($selector = 'all') {
		if ($selector == 'all') return $this->children;
		$rslt = array();
		$attrs = $this->parseSelector($selector);
		foreach($this->children as $child) {
			if ($child->matchAttrs($attrs)) {
				$rslt[] = $child;
			}
		}
		return $rslt;
	}
	
	/**
	 * Tim mot element la con cua doi tuong goc, theo 1 selector
	 */
	public function findElement($selector = 'all') {
		$attrs = $this->parseSelector($selector);
		foreach($this->children as $child) {
			if ($child->matchAttrs($attrs)) {
				return $child;
			} else {
				if ($elem = $child->findElement($selector)) {
					return $elem;
				}
			}
		}
		return null;
	}
	
	/**
	 * Tim cac elements theo selectors
	 */
	public function findElements($selector = 'all') {
		$attrs = $this->parseSelector($selector);
		$result = array();
		foreach($this->children as $child) {
			if ($child->matchSelector($attrs)) {
				$result[] = $child;
			}
			$childElements = $child->findElements($selector);
			foreach($childElements as $elem) {
				$result[] = $elem;
			}
		}
		return $result;
	}
	
	/**
	 * tim parent theo selector
	 */
	public function findParent($selector) {
		if ($parent = $this->getParent()) {
			if($parent->matchSelector($selector)) {
				return $parent;
			}
		}
		return null;
	}
	
	/**
	 * Tim cac parent theo selector
	 */
	public function findParents($selector) {
		$parents = array();
		$cur = $this->getParent();
		while($cur) {
			if ($cur->matchSelector($selector)) {
				$parents[] = $cur;
			}
			$cur = $cur->getParent();
		}
		return $parents;
	}
	
	/**
	 * Hien thi tat ca cac children theo selector
	 */
	public function displayChildren($selector = 'all') {
		$children = $this->getChildren($selector);
		if(is_array($children)) {
			foreach($children as $child) {
				$child->display();
			}
		} else $children->display();
	}
	
	public function matchSelector($selector) {
		$attrs = $this->parseSelector($selector);
		if ($this->matchAttrs($attrs)) {
			return true;
		}
		return false;
	}
	
	/**
	 * khop cac thuoc tinh
	 */
	public function matchAttrs($attrs) {
		foreach($attrs as $key => $attr) {
			if(!isset($attr['comparator'])) continue;
			switch($attr['comparator']) {
				case '=':
					if (@$this->$key != $attr['value']) {
						return false;
					}
					break;
				case '!=':
				case '<>':
					if (@$this->$key == $attr['value']) {
						return false;
					}
					break;
				case '^=':
					if (strpos(@$this->$key, $attr['value']) !== 0) {
						return false;
					}
					break;
				case '*=':
					if (strpos(@$this->$key, $attr['value']) === FALSE) {
						return false;
					}
					break;
			}
		}
		return true;
	}
	/**
	 * Parse selector tra ve 1 mang cac dieu kien loc
	 *
	 * @param $selector
	 * @return mang kieu kien
	 */
	function parseSelector($selector) {
		if (isset(self::$selectors[$selector])) return self::$selectors[$selector];
		$pattern = '/^([\w\.\d]+)?((\[[^\]]+\])*)?$/';
		$subPattern = '/\[([^=\^\$\*\!\<]+)(=|\^=|\$=|\*=|\!=|\<\>)([^\]]+)\]/';
		if (preg_match($pattern, $selector, $match)) {
			preg_match_all($subPattern, $match[2], $matches);
			$attrs = array();

			$tagName = $match[1];
			if ($tagName) {
				$attrs['tagName'] = $tagName;
			}

			for($i = 0; $i < count($matches[1]); $i++) {
				$attrs[$matches[1][$i]] = array('comparator' => $matches[2][$i], 'value' => $matches[3][$i]);
			}
			
			self::$selectors[$selector] = $attrs;

			return $attrs;
		}
		self::$selectors[$selector] = array();
		return array();
	}

	/**
	 * Ham nay chay khi tat ca cac child object cua no da duoc khoi tao
	 */
	
	/**
	 * Ham nay tra ve array mo ta doi tuong dua theo arrayParams
	 */
	public function toArray() {
		$result = (array)$this;
		unset($result['children']);
		if(@$this->excludeParams) {
			$arrayParams = explode(',', $this->excludeParams);
			foreach($arrayParams as $param) {
				$param = trim($param);
				if (isset($this->$param)) {
					unset($result[$param]);
				}
			}
		}
		return $result;
	}
	
	public function translate($text) {
		if(pzk_language()) {
			return pzk_language()->translateText(implode('/', $this->fullNames), $text);
		} else {
			return $text;
		}
	}
	
	public function getProp($prop, $default = null) {
		if(isset($this->$prop)) return $this->$prop;
		return $default;
	}
	
	public function getModel($model) {
		return pzk_loader()->getModel($model);
	}
	
	public function __call($name, $arguments) {

		//Getting and setting with $this->property($optional);

		if (property_exists(get_class($this), $name)) {


			//Always set the value if a parameter is passed
			if (count($arguments) == 1) {
				/* set */
				$this->$name = $arguments[0];
			} else if (count($arguments) > 1) {
				throw new \Exception("Setter for $name only accepts one parameter.");
			}

			//Always return the value (Even on the set)
			return $this->$name;
		}

		//If it doesn't chech if its a normal old type setter ot getter
		//Getting and setting with $this->getProperty($optional);
		//Getting and setting with $this->setProperty($optional);
		$prefix = substr($name, 0, 3);
		$property = strtolower($name[3]) . substr($name, 4);
		switch ($prefix) {
			case 'get':
				return $this->$property;
				break;
			case 'set':
				//Always set the value if a parameter is passed
				if (count($arguments) != 1) {
					throw new \Exception("Setter for $name requires exactly one parameter.");
				}
				$this->$property = $arguments[0];
				//Always return this (Even on the set)
				return $this;
			default:
				throw new \Exception("Property $name doesn't exist.");
				break;
		}
	}