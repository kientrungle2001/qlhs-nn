<?php
class PzkSGStore extends PzkSG{
	public $storage;
	public function __construct(SGStore $storage) {
		$this->storage = $storage;
	}
	
	public function clear(){
		$this->storage->clear();
	}
}