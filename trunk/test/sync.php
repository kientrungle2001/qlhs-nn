<?php
mb_language('uni');
mb_internal_encoding('UTF-8');

function utf8StringToHexString($string) {
	$nums = array();
	$convmap = array(0x0, 0xffff, 0, 0xffff);
	$strlen = mb_strlen($string, "UTF-8");
	for ($i = 0; $i < $strlen; $i++) {
		$ch = mb_substr($string, $i, 1, "UTF-8");
		$decimal = substr(mb_encode_numericentity($ch, $convmap, 'UTF-8'), -5, 4);
		$nums[] = "&#x" .base_convert($decimal, 10, 16). ";";
	}
	return implode("", $nums);
}

function remove_utf8_bom($text)
{
	//$text = htmlentities($text, ENT_QUOTES, "cp1252");
	//$text = html_entity_decode($text, ENT_QUOTES, "cp1252");
	return $text;
}
//require_once 'Encoding.php';
class GeneralSync {
	public $host;
	public $uname;
	public $pass;
	public $database;
	public $versionFile = 'sql_data_version.txt';
	public $backupFolder = 'clientbackup';
	public $connection = false;
	
	public function connect(){
		$version = @file_get_contents($this->versionFile);
		$this->version = $version;
		$connection=@mysql_connect($this->host,$this->uname,$this->pass);
		if(!$connection) return false;
		$selectdb=@mysql_select_db($this->database);
		if(!$selectdb) return false;
		$this->connection = $connection;
		mysql_set_charset('utf8', $connection);
		return true;
	}
	
	public function backup() {
		
		/* Store All Table name in an Array */
		$allTables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result)){
			 $allTables[] = $row[0];
		}
		$return = '';
		foreach($allTables as $table){
			$result = mysql_query('SELECT * FROM '.$table);
			$num_fields = mysql_num_fields($result);

			$return.= 'DROP TABLE IF EXISTS '.$table.';';
			$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
			$return.= "\n\n".$row2[1].";\n\n";

			for ($i = 0; $i < $num_fields; $i++) {
				while($row = mysql_fetch_row($result)){
					$return.= 'INSERT INTO '.$table.' VALUES(';
					for($j=0; $j<$num_fields; $j++){
						$row[$j] = addslashes($row[$j]);
						$row[$j] = str_replace("\n","\\n",$row[$j]);
						if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } 
						else { $return.= '""'; }
						if ($j<($num_fields-1)) { $return.= ','; }
					}
					$return.= ");\n";
				}
			}
			$return.="\n\n";
		}

		// Create Backup Folder
		$folder = $this->backupFolder . '/';
		if (!is_dir($folder))
		mkdir($folder, 0777, true);
		chmod($folder, 0777);

		$date = date('m-d-Y-H-i-s', time()); 
		$filename = $folder."db-backup-".$date; 

		$handle = fopen($filename.'.sql','w+');
		fwrite($handle,$return);
		fclose($handle);
		$z = new ZipArchive(); 
		$z->open($filename . '.zip', ZIPARCHIVE::CREATE); 
		$z->addFile($filename . '.sql');
		$z->close(); 
		unlink($filename . '.sql');
		return true;
	}
	
	public function clear() {
		//mysql_query('truncate table sync_table');
		file_put_contents($_SERVER['HTTP_HOST'] . '.sql', '');
		return true;
	}
	
	public function getData($version) {
		$rs = mysql_query('select * from sync_table where v > ' . $version);
		$result = array();
		while($row = mysql_fetch_assoc($rs)) {
			$result[] = $row['line_data'];
		}
		return $result;
	}
	
	public function saveData($data) {
		if(!is_array($data)) {
			$data = array($data);
		}
		foreach($data as $line) {
			if($line) {
				$line = str_replace('\\\'', '\'', $line);
				mysql_query('set names utf-8', $this->connection);
				mysql_set_charset('utf-8');
				file_put_contents('saveData.txt', remove_utf8_bom($line) . "\r\n", FILE_APPEND | LOCK_EX);
				mysql_query(remove_utf8_bom($line), $this->connection);
				if(mysql_errno($this->connection)) {
					file_put_contents('saveData.txt', mysql_error($this->connection) . "\r\n", FILE_APPEND | LOCK_EX);
				}
			}
		}
		return true;
	}
	
	public function getVersion() {
		return $this->version;
	}
	
	public function setVersion($version) {
		$this->version = $version;
		@file_put_contents($this->versionFile, $version);
		return $version;
	}
}

class ClientSync  extends GeneralSync {
	
	public $version;
	public $serverSocket;
	
	public function run() {
		$this->connect();
		$this->serverSocket->connect();
		if($this->serverSocket->isConnected()) {
			echo 'Server: ' . $this->serverSocket->getVersion() . ' - Local: ' . $this->getVersion() . '<br />';
			if($this->serverSocket->getVersion() > $this->getVersion()) {
				echo 'Sync server to local<br />';
				$data = $this->serverSocket->getData($this->getVersion());
				//$this->backup();
				
				if($this->saveData($data)) {
					$this->serverSocket->clear();
					$this->setVersion($this->serverSocket->getVersion());
				}
			} else if ($this->serverSocket->getVersion() < $this->getVersion()) {
				echo 'Sync local to server<br />';
				$data = $this->getData($this->serverSocket->getVersion());
				//$this->serverSocket->backup();
				if($this->serverSocket->saveData($data)) {
					$this->clear();
					$this->serverSocket->setVersion($this->getVersion());
				}
			} else {
				echo 'Do nothing<br />';
			}
		} else {
			echo 'not connected!<br />';
		}
	}
}

class ServerSync extends GeneralSync{
	
}

class ServerSyncSocket {
	public $serverUrl = false;
	public $connected = false;
	public function __construct($serverUrl) {
		$this->serverUrl = $serverUrl;
	}
	public function connect() {
		$connect = @file_get_contents($this->serverUrl . '?action=connect');
		$result = json_decode($connect, true);
		if($result) {
			$this->connected = true;
			$this->version = json_decode(@file_get_contents($this->serverUrl . '?action=getVersion'), true);
		} else {
			$this->connected = false;
		}
	}
	
	public function isConnected() {
		return $this->connected;
	}
	
	public function backup() {
		$rs = json_decode(@file_get_contents($this->serverUrl . '?action=backup'), true);
		if($rs) {
			echo 'Server Backup Success<br />';
		} else {
			echo 'Server Backup Failed<br />';
		}
	}
	
	public function clear() {
		$rs = json_decode(@file_get_contents($this->serverUrl . '?action=clear'), true);
		if($rs) {
			echo 'Server Clear Success<br />';
		} else {
			echo 'Server Clear Failed<br />';
		}
	}
	
	public function getData($version) {
		$rs = json_decode(@file_get_contents($this->serverUrl . '?action=getData&data=' . $version), true);
		if($rs !== NULL) {
			echo 'Server getData Success<br />';
			return $rs;
		} else {
			echo 'Server getData Failed<br />';
			return NULL;
		}
		
	}
	
	public function saveData($datas) {
		$rs = NULL;
		foreach($datas as $data) {
			$query = array(
				'action' => 'saveData',
				'data' => array($data)
			);
			$builtQuery = http_build_query($query);
			$result = @file_get_contents($this->serverUrl . '?' . $builtQuery);
			$rs = json_decode($result, true); 
		}
		if($rs !== NULL) {
			echo 'Server saveData Success<br />';
			return true;
		} else {
			
			echo 'Server saveData Failed<br />';
			return false;
		}
	}
	
	public function getVersion() {
		return $this->version;
	}
	
	public function setVersion($version) {
		$this->version = $version;
		$rs = json_decode(@file_get_contents($this->serverUrl . '?action=setVersion&data=' . $version), true);
		if($rs !== NULL) {
			echo 'Server setVersion Success<br />';
		} else {
			echo 'Server setVersion Failed<br />';
		}
	}
}