<?php
class PzkSGStoreSession extends PzkSGStore {
	public function set($key, $value) {
		$key = session_id().'_'. $key;
		$this->storage->set($key, $value);
	}
	
	public function get($key, $timeout = null) {
		$key = session_id().'_'. $key;
		return $this->storage->get($key, $timeout);
	}
}