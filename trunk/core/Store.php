<?php

/**
 * Kho luu du lieu, truy xuat theo key
 *
 */
class PzkStore {
	public $storage;
	public $timeout = 900;
	public $time = 900;
	public static $current;

	/**
	 * Ham khai bao kho du lieu
	 * @param $type: loai kho du lieu luu tru
	 */
	public function PzkStore($type = 'php') {
		$storage = 'Pzk' . strtoupper($type[0]) . substr($type, 1) . 'Store';
		$this->storage = new $storage();
	}

	/**
	 * Ham khoi tao doi tuong kho du lieu theo loai
	 * @param $type: loai kho can khoi tao
	 */
	public static function instance($type = 'php') {
		return new PzkStore($type);
	}

	/**
	 * Ham lay kho du lieu hien thoi
	 * @return kho du lieu hien thoi
	 */
	public static function getCurrent() {
		return self::$current;
	}

	/**
	 * Dat mot kho du lieu la kho luu tru hien thoi
	 */
	public static function setCurrent($current) {
		return self::$current = $current;
	}

	/**
	 * Ham lay hoac dat gia tri cho 1 key
	 * @param $key: khoa de lay gia tri hoac dat gia tri
	 * @param $value: gia tri can dat cho key
	 */
	public static function store($key, $value = NULL) {
		if ($value !== NULL) {
			return self::$current->set($key, $value);
		} else {
			return self::$current->get($key);
		}
	}

	/**
	 * Ham lay gia tri theo khoa
	 * @param $key: khoa can lay du lieu
	 * @return gia tri theo khoa
	 */
	public function get($key, $timeout = null) {
		return @$this->storage->get($key);
	}

	/**
	 * Ham dat gia tri cho khoa
	 * @param $key: khoa
	 * @param $value: gia tri can dat
	 * @return gia tri vua dat
	 */
	public function set($key, $value) {
		return @$this->storage->set($key, $value);
	}

	/**
	 * Ham xoa tat ca cac du lieu trong kho
	 */
	public function clear() {
	}

	/**
	 * Ham tai du lieu vao kho
	 * @param $data: mang du lieu can dat vao kho
	 */
	public function load($data) {
	}
	
	public function __get($name) {
		return $this->get($name);
	}
	
	public function __set($name, $value) {
		return $this->set($name, $value);
	}
	
}

/**
 * Luu tru theo mang thong thuong
 *
 */
class PzkPhpStore extends PzkStore {
	public function PzkPhpStore() {
		$this->storage = array();
	}
	public function get($key, $timeout = null) {
		return @$this->storage[$key];
	}

	public function set($key, $value) {
		return $this->storage[$key] = $value;
	}
}

/**
 * Luu tru bang memcached
 *
 */
class PzkMemcacheStore extends PzkStore {
	public function PzkMemcacheStore() {

		$memcache = new Memcache();
		$memcache->connect('localhost', 11211) or die ("Could not connect");
		$this->storage = $memcache;

		if (@$_REQUEST['noCache']) {
			$this->storage->flush();
		}

		$time = $this->get('time');
		if (time() - $time > $this->timeout) {
			$this->storage->flush();
			$this->time = $this->set('time', time());
		}
	}

}

/**
 * Luu tru theo file
 *
 */
class PzkFilecacheStore extends PzkStore {
	public $dir = 'cache';
	public $nocache = false;
	public function get($key, $timeout = null) {
		if (!@$key) return false;
		$fileName = $this->dir . '/' . md5($key) . '.txt';

		if (!file_exists($fileName)) {
			return NULL;
		}
		if(!$this->nocache) {
			if(!$timeout) {
				$timeout = $this->timeout;
			}
			$remainingTime = -(time() - filemtime($fileName) - $timeout);

			if ($remainingTime < 0) {
				unlink($fileName);
				return NULL;
			}
		}

		return file_get_contents($fileName);
	}

	public function set($key, $value) {
		return file_put_contents($this->dir . '/' . md5($key) . '.txt', $value);
	}

	public function clear() {

		$d = dir("cache");
		while (false !== ($entry = $d->read())) {
			unlink('cache/' . $entry . '.txt');
		}
		$d->close();
	}
	
}

/**
 * Luu tru theo session
 *
 */
class PzkSessionStore extends PzkStore {
	public function PzkSessionStore() {
		//session_start();
	}

	public function get($key, $timeout = null) {
		return @$_SESSION[$key];
	}

	public function set($key, $value) {
		return $_SESSION[$key] = $value;
	}
}

class PzkFileVarStore extends PzkFilecacheStore {
	public $nocache = true;
	public function get($key, $timeout = null) {
		$value = parent::get($key, $timeout);
		if ($value !== NULL)
		return unserialize($value);
		return NULL;
	}

	public function set($key, $value) {
		return parent::set($key, serialize($value));
	}
}

/**
 * Luu tru bang database
 *
 */
class PzkDatabaseStore extends PzkStore {
	public function PzkDatabaseStore() {
		$this->storage = pzk_db();
	}

	public function get($key, $timeout = null) {
		return @$this->storage->select('id, key, value')->from('store');
	}

	public function set($key, $value) {
		return $_SESSION[$key] = $value;
	}
}

/**
 * Luu tru bang MongoDB
 *
 */
class PzkMongoStore extends PzkStore {
	public function PzkMongoStore() {
		$this->storage = new Mongo();
	}
}

/**
@desc: ham lay gia tri trong cac store theo kieu key, value
@param $key: viet duoi dang store.key
@example: 	_pzk('session.abc123') se tra ve gia tri tuong ung voi key = abc123 luu trong session
_pzk('session.abc123', 'cai gi do') se gan gia tri 'cai gi do' cho key = abc123 luu trong session
*/
function pzk_store($key, $value = NULL, $timeout = NULL) {

	// chon store
	$store = NULL;
	$arr = explode('.', $key);

	$storeType = 'php';
	$realKey = $key;

	if (count($arr) == 2){
		$storeType = $arr[0];
		$realKey = $arr[1];
	}

	$store = PzkStore::store($storeType);

	// get hoac set cac gia tri
	if (!$store) return NULL;
	if ($value === NULL) {
		return $store->get($realKey, $timeout);
	}
	return $store->set($realKey, $value);
}

// Khoi tao Store de luu cac bien global
$phpStorage = PzkStore::setCurrent(PzkStore::instance('php'));
PzkStore::store('php', $phpStorage);

// khoi tao store de luu cac element
$elementStorage = PzkStore::instance('php');
PzkStore::store('element', $elementStorage); // php element

/**
 * Ham lay hoac dat cac element
 *
 * @param String $key: id cua element
 * @param PzkObject $value: instance cua element
 * @return PzkObject
 */

function pzk_store_element($key, $value = NULL) {
	return pzk_store('element.'. $key, $value);
}

function pzk_element($key, $value = NULL) {
	return pzk_store_element($key, $value);
}

/**
 * Ham lay gia tri cua 1 bien session
 *
 * @param String $key: khoa
 * @param Object $value: gia tri can dat
 * @return gia tri tuong ung voi khoa
 */

function pzk_store_session($key, $value = NULL, $timeout = NULL) {
	return pzk_store('session.'. $key, $value, $timeout);
}

function pzk_session($key, $value = NULL, $timeout = NULL) {
	return pzk_store_session($key, $value, $timeout);
}

/**
 * Ham lay gia tri trong memcache
 *
 * @param String $key: khoa
 * @param String $value: gia tri can dat
 * @return gia tri tuong ung voi khoa
 */

function pzk_store_memcache($key, $value = NULL, $timeout = NULL) {
	return pzk_store('memcache.'. $key, $value, $timeout);
}

function pzk_memcache($key, $value = NULL, $timeout = NULL) {
	return pzk_store_memcache($key, $value, $timeout);
}

/**
 * Ham lay gia tri duoc cache o file
 *
 * @param String $key: ten khoa
 * @param String $value: gia tri duoc luu ra file
 * @return gia tri tuong ung voi khoa
 */

function pzk_store_filecache($key, $value = NULL, $timeout = NULL) {
	return pzk_store('filecache.'. $key, $value, $timeout);
}

function pzk_filecache($key, $value = NULL, $timeout = NULL) {
	return pzk_store_filecache($key, $value, $timeout);
}

function pzk_store_filevar($key, $value = NULL, $timeout = NULL) {
	return pzk_store('fileVar.'. $key, $value, $timeout);
}

function pzk_filevar($key, $value = NULL, $timeout = NULL) {
	return pzk_store_filevar($key, $value, $timeout);
}

/////////////////////////// Cache Shortcuts /////////////////////////

function pzk_parse($xml) {
	return PzkParser::parse($xml);
}

function pzk_system() {
	return pzk_store_element('system');
}

/**
 * Return application element
 *
 * @return {PzkApplication}
 */
function pzk_app() {
	return pzk_store_element('app');
}


/**
 * Return page object
 *
 * @return PzkPage
 */
function pzk_page() {
	return pzk_store_element('page');
}

/**
 * Return menubar element
 *
 * @return PzkMenubar
 */

function pzk_route() {
	return pzk_store_element('route');
}

function pzk_redirect($url) {
	return pzk_route()->redirect($url);
}

function pzk_loader() {
	return pzk_store_element('loader');
}

function pzk_model($name) {
	return pzk_loader()->getModel($name);
}

function pzk_router($name) {
	return pzk_model("route/$name");
}

function pzk_controller($name) {
	return pzk_loader()->getController($name);
}

function pzk_rule($name) {
	return pzk_controller("rules/$name");
}

function pzk_user($key = NULL) {
	if ($key == NULL) return pzk_store_session('user');
	if (is_string($key)) {
		$user = pzk_store_session('user');
		return @$user[$key];	
	} else if (is_array($key)) {
		pzk_store_session('user', $key);
	} else if (is_bool($key) && $key === false) {
		pzk_store_session('user', false);
	}
}

function pzk_pclass($selector) {
	$pss = pzk_store_element('pss'); 
	if ($pss) {
		return @$pss->arr[$selector];
	}
	return 0;
}