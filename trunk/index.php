<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

$start_time = microtime(TRUE);

function pre($msg) {
	echo "<pre>$msg</pre>";
}
// cac ham xu ly thong thuong
mb_language('uni');
mb_internal_encoding('UTF-8');
require_once 'config.php';
require_once 'include.php';

$sys = pzk_parse('system/full');
//$sys->display();
$app = $sys->getApp();
$app->run();