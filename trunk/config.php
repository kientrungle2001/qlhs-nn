<?php
// Bat thong bao loi;
ini_set('error_reporting', E_ALL);
session_start();
// bat quyen truy cap
define('PZK_ACCESS', 1);

// thu muc he thong
define('SYSTEM_DIR', dirname(__FILE__));

// thu muc goc
define('BASE_DIR', SYSTEM_DIR);

// duong dan goc
define('BASE_URL', "http://{$_SERVER['HTTP_HOST']}");

define('REWRITE_MODE', true);

if(REWRITE_MODE) {
// diem khoi chay
	define('ROUTE_START_INDEX', 1);
	define('BASE_REQUEST', "http://{$_SERVER['HTTP_HOST']}");
} else {
	define('ROUTE_START_INDEX', 2);
	define('BASE_REQUEST', "http://{$_SERVER['HTTP_HOST']}/index.php");
}

// che do request | url than thien
define('REQUEST_MODE', true);

// them include path
set_include_path(get_include_path() . BASE_DIR . ';');

// ung dung mac dinh
$hosts = array(
	'iweb.vn' => 'test',
	'www.iweb.vn' => 'test',
	//'test.vn' => 'test'
	'qlhs.vn' => 'qlhs',
	'www.qlhs.vn' => 'qlhs',
	'phongthuy.vn' => 'phongthuy',
	'www.phongthuy.vn' => 'phongthuy'
);
$app = 'test';
foreach($hosts as $host => $a) {
	if($_SERVER['HTTP_HOST'] == $host) {
		$app = $a;
		break;
	}
}
define('PZK_DEFAULT_APP', $app);

// che do cache
define('PZK_CACHE', true);