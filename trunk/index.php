<?php
define('COMPILE_MODE', false);
ob_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');

// cac ham xu ly thong thuong
mb_language('uni');
mb_internal_encoding('UTF-8');
require_once 'config.php';
require_once 'include.php';

if(COMPILE_MODE) {
	if(!file_exists('compile/pages/system_full.php')) {
		compileObjects();
		compileXmls();
	}
	require_once 'compile/pages/system_full.php';
	$sys = pzk_element('system');


	$application = pzk_request()->getApp();
	require_once 'compile/pages/app_'.$application.'_'.$sys->bootstrap.'.php';

	//$app = PzkParser::parse('app/'. $application . '/' . $sys->bootstrap);
	$app = pzk_element('app');

	$controller = pzk_request()->getController();
	$action = pzk_request()->getAction();
	$controllerObject = $app->_getController($controller);
	if(!$controllerObject) die('No controller ' .$controller);
	if(method_exists($controllerObject, $action . 'Action'))
		$controllerObject->{$action . 'Action'}();
	else {
		die('No route ' . $action);
	}	
} else {
	$sys = pzk_parse('system/full');

	$app = $sys->getApp();
	if(0 && time() - pzk_session('installationTime') > 300) {
		
		ob_start();
			_dbs()->create('schema_version')
				->addVarchar('schema_table')
				->addInt('schema_version')
				->execute();
			_dbs()->menu('schema', 'Phiên bản Database');
			$files = glob('install/*.php');
			foreach($files as $file) {
				require_once $file;
			}
		ob_end_clean();
		
		pzk_session('installationTime', time());
	}
	$app->run();	
}