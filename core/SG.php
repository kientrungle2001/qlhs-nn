<?php
/**
 * 
 * @author kienhang
 * Setter and Getter
 */
class PzkSG {
	/**
	 * Ham lay gia tri theo khoa
	 * @param $key: khoa can lay du lieu
	 * @return gia tri theo khoa
	 */
	public function get($key, $timeout = null) {
		return @$this->$key;
	}
	
	/**
	 * Ham dat gia tri cho khoa
	 * @param $key: khoa
	 * @param $value: gia tri can dat
	 * @return gia tri vua dat
	 */
	public function set($key, $value) {
		$this->$key = $value;
	}
	
	/**
	 * Ham xoa tat ca cac du lieu trong kho
	 */
	public function clear() {
	}
	
	public function __call($name, $arguments) {
		$prefix = substr($name, 0, 3);
		$property = strtolower($name[3]) . substr($name, 4);
		switch ($prefix) {
			case 'get':
				return $this->get($property, @$arguments[0], @$arguments[1]);
				break;
			case 'set':
				//Always set the value if a parameter is passed
				if (count($arguments) != 1) {
					throw new \Exception("Setter for $name requires exactly one parameter.");
				}
				$this->set($property, $arguments[0]);
				//Always return this (Even on the set)
				return $this;
			default:
				throw new \Exception("Property $name doesn't exist.");
				break;
		}
	}
	
	public function getFilterData() {
		$fields = array();
		$arguments = func_get_args();
		if(count($arguments) == 0) {
			if(is_a($this, 'PzkCoreRequest'))
			return (array)@$this->query;
			else
				return (array)$this;
		} else if(count($arguments) == 1) {
			if(is_string($arguments[0])) {
				$fields = explodetrim(',', $arguments[0]);
			} else if (is_array($arguments[0])) {
				$fields = $arguments[0];
			}
		} else {
			$fields = $arguments;
		}
		$data = array();
		foreach($fields as $field) {
			$data[$field] = $this->get($field);
		}
		return $data;
	}
}