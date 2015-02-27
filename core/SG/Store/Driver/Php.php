<?php
class PzkSGStoreDriverPhp extends PzkSGStore {
	public function __construct() {
		$this->storage = array();
	}
	
	public function set($key, $value) {
		$this->storage[$key] = $value;
	}
	
	public function get($key, $timeout = NULL) {
		return $this->storage[$key];
	}
	
	public function clear(){
		$this->storage = array();
	}
}