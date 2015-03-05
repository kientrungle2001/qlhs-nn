<?php
require_once '3rdparty/simpletest/autorun.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');

// cac ham xu ly thong thuong
mb_language('uni');
mb_internal_encoding('UTF-8');
require_once 'config.php';
require_once 'include.php';

$sys = pzk_parse('system/full');

$app = $sys->getApp();

$files = glob('testcases/*.php');
foreach($files as $file) {
	require_once $file;
}