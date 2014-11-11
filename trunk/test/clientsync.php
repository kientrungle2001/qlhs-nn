<?php
require_once 'sync.php';
$client = new ClientSync();
$client->host = 'localhost';
$client->uname = 'root';
$client->pass = '';
$client->database = 'phattrienngonngu_com_website5';
$client->serverSocket = new ServerSyncSocket('http://www.phattrienngonngu.com/qlhs/test/serversync.php');
$client->versionFile = $_SERVER['HTTP_HOST'] . '_sql_data_version.txt';
$client->backupFolder = 'clientbackup';
$client->run();
?>
<script>
setTimeout(function() {
	window.location.reload();
}, 5000);
</script>