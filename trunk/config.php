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

//	MENU
define('MENU', 'MENU');

//	SEARCH
define('ACTION_SEARCH', '1');

define('ACTION_RESET', '0');

//	QUESTION TYPE

define('QUESTION_WORDS',	'Dạng về từ');
define('QUESTION_PHRASE',	'Dạng về câu');
define('QUESTION_PASSAGE',	'Dạng bài về đoạn văn');
define('QUESTION_CITATION',	'Dạng bài về bài văn');
$type_level = array(
    'index' => 'Xem',
    'add'=> 'Thêm',
    'edit'=>'Sửa',
    'del'=>'Xóa',
    'import'=>'Thêm dữ liệu',
    'export'=>'Xuất dữ liệu'
);
define('TYPE_LEVEL', json_encode($type_level));
//	FORMAT DATE

define('DATEFORMAT',	'Y-m-d H:i:s');

define('SECRETKEY', 'onghuu');

define('NUMBER_QUESTION10',	10);

define('NUMBER_QUESTION20',	20);

define('NUMBER_QUESTION30',	30);

define('NUMBER_QUESTION40',	40);

define('NUMBER_QUESTION50',	50);

define('WORK_TIME15', 15);

define('WORK_TIME30', 30);

define('WORK_TIME45', 45);

define('WORK_TIME60', 60);
