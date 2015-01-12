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

// che do cache
define('PZK_CACHE', true);


// MENU
define('MENU', 'MENU');
