<?php
ob_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');

// cac ham xu ly thong thuong
mb_language('uni');
mb_internal_encoding('UTF-8');
define('COMPILE_MODE', true);
require_once 'config.php';
require_once 'include.php';

define('regenerate', true);
compileObjects();
compileXmls();
//compileXmlFile('system/full.php', regenerate);
//compileXmlFile('app/ptnn/offapplication.php', regenerate);
//compileXmlFile('app/cms/pages/home/index.php', regenerate);
//pzk_element('page')->display();
//require_once 'compile/pages/system_full.php';
//require_once 'compile/pages/app_ptnn_offapplication.php';
