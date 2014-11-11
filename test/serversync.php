<?php
require_once 'sync.php';
$server = new ServerSync();
$server->host = 'localhost';
$server->uname = 'root';
$server->pass = '';
$server->database = 'phattrienngonngu_com_website4';
$server->versionFile = $_SERVER['HTTP_HOST'] . '_sql_data_version.txt';
$server->backupFolder = 'serverbackup';
$action = $_REQUEST['action'];
$data = @$_REQUEST['data'];
if($action == 'connect') {
	$rs = $server->connect();
	echo json_encode($rs);
	die();
}
$server->connect();
$rs = $server->$action($data);
echo json_encode($rs);