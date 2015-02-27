<?php
function sg_session($key = NULL, $value = NULL, $timeout = NULL) {
	static $session;
	if(!$session)
	$session = new PzkSGStoreSession(new PzkSGStoreFormatSerialize(new PzkSGStoreCrypt(new PzkSGStoreDriverFile('cache/session'))));
	if($key === NULL) {
		return $session;
	} else {
		if($value === NULL) {
			return $session->get($key, $timeout);
		} else {
			return $session->set($key, $value);
		}
	}
	return $session;
}

function sg_memcache() {
	static $memcache;
	if(!$memcache)
	$memcache = new PzkSGStoreFormatSerialize(new PzkSGStoreDriverMemcache());
	if($key === NULL) {
		return $memcache;
	} else {
		if($value === NULL) {
			return $memcache->get($key, $timeout);
		} else {
			return $memcache->set($key, $value);
		}
	}
	return $memcache;
}

function pzk_element($key = NULL, $value = NULL) {
	static $store;
	if(!$store)
	$store = new PzkSGStoreDriverPhp();
	if($key === NULL) {
		return $store;
	} else {
		if($value === NULL) {
			return $store->get($key);
		} else {
			return $store->set($key, $value);
		}
	}
	return $store;
}