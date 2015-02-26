<?php
class PzkSGStoreCrypt extends PzkSGStore {
	public $encryption_key = 'secrete';
	public function __construct($storage, $encryption_key = 'secrete') {
		$this->encryption_key = $encryption_key;
	}
	public function set($key, $value) {
		$value = encrypt($value, $this->encryption_key);
		$this->storage->set($key, $value);
	}
	
	public function get($key, $timeout = NULL) {
		return decrypt($this->storage->get($key, $timeout), $this->encryption_key);
	}
}