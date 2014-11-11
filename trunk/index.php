<?php
function pre($msg) {
	echo "<pre>$msg</pre>";
}
// cac ham xu ly thong thuong
mb_language('uni');
mb_internal_encoding('UTF-8');
require_once 'config.php';
require_once 'include.php';

$uri = PzkURI::instance();
$uri->dispatch();

ob_start();
$sys = pzk_parse('system/full');
//$sys->display();
$app = $sys->getApp();
$app->run();
$content = ob_get_contents();

ob_end_clean();
$charset = "utf-8";
 $mime    = (stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml")) ? "application/xhtml+xml" : "text/html";

 header("content-type:text/html;charset=$charset");
echo trim($content);
