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

// che do rewrite
define('REWRITE_MODE', true);

// diem khoi chay
if(REWRITE_MODE) {	
	define('BASE_REQUEST', "http://{$_SERVER['HTTP_HOST']}");
} else {
	define('BASE_REQUEST', "http://{$_SERVER['HTTP_HOST']}/index.php");
}

// che do seo | url than thien
define('SEO_MODE', false);

// them include path
set_include_path(get_include_path() . BASE_DIR . ';');

// che do cache
define('PZK_CACHE', true);

// MENU
define('MENU', 'MENU');
