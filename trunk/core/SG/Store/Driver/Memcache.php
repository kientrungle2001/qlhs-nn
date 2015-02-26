<?php
class PzkSGStoreDriverMemcache extends PzkSGStoreDriver {
	public function __construct() {
		$memcache = new Memcache ();
		$memcache->connect ( 'localhost', 11211 ) or die ( "Could not connect" );
		$this->storage = $memcache;
		
		$time = $this->getTime ();
		if (time () - $time > $this->timeout) {
			$this->storage->flush ();
			$this->time = $this->setTime ( time () );
		}
	}
	
	public function set($key, $value) {
		$this->storage->set($key, $value);
	}
	
	public function get($key, $timeout = NULL) {
		$this->storage->get($key);
	}
	
	public function clear(){
		$this->storage->flush();
	}
}