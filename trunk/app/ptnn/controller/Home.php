<?php

/**
 *
 */
class PzkHomeController extends PzkFrontendController{
		
	public $masterPage	=	"index";
	
	public function indexAction(){
		
		$this->initPage();
		$this->append('<home.content layout="home/content_home"/>','left');
		$this->display();
	}

    public function categoryAction(){
        $this->layout();
        $category = pzk_parse('<home.category table="categories" layout="home/category"/>');
        $left = pzk_element('left');
        $left->append($category);
        $this->page->display();
    }

    public function questionAction(){
        $this->layout();
        $question = pzk_parse('<core.db.list table="questions" layout="home/question" />');
        $left = pzk_element('left');
        $left->append($question);
        $this->page->display();
    }

    public function videoAction(){
    	
        $file = BASE_DIR . '/3rdparty/uploads/videos/test.txt';
        $file2 = BASE_DIR . '/3rdparty/uploads/videos/test_encrypted.txt';
        $handle = fopen($file, "rb");
        $initial_contents = fread($handle, filesize($file));
        fclose($handle);
        if ($initial_contents) {
            $td = mcrypt_module_open('tripledes', '', 'ecb', '');
            $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
            mcrypt_generic_init($td, '123456', $iv);
            $encrypted_data = mcrypt_generic($td, $initial_contents);

            $encrypted_file = @fopen($file2, 'wb');
            $ok_encrypt = @fwrite($encrypted_file, $encrypted_data);
			
            @fclose($encrypted_file);
        }
    }

    public function deVideoAction(){

        $file = BASE_DIR . '/3rdparty/uploads/videos/test_encrypted.txt';
        $file2 = BASE_DIR . '/3rdparty/uploads/videos/test_decrypted.txt';

        $handle = fopen($file, "rb");
        $initial_contents = fread($handle, filesize($file));
        fclose($handle);

        if ($initial_contents) {

            $td = mcrypt_module_open('tripledes', '', 'ecb', '');
            $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);

            mcrypt_generic_init($td, '123456', $iv);

            $encrypted_data = $initial_contents;

            $p_t = mdecrypt_generic($td, $encrypted_data);

            $newfile = @fopen($file2, 'wb');
            $ok_decrypt = @fwrite($newfile, $p_t);

            @fclose($newfile);
            mcrypt_generic_deinit($td);
            mcrypt_module_close($td);

        }
    }
	
	public function testAction() {
		//$item = _db()->from('user')->whereId('97')->result_one();
		//debug($item);
		/*
		$arrObj = pzk_array()->setData(array(
			'string' => 'string-1',
			'number' => 'number-2',
			'array' => array('key' => 'value')
		));
		$xmlStr = $arrObj->toXml();
		// echo $xmlStr;
		$arrObj = pzk_array();
		$arrObj->fromXml($xmlStr);
		// debug($arrObj->getData());
		$test = pzk_parse('<div xml="test" layout="test" />');
		$test->display();
		*/
		var_dump(pzk_session()->getFilterData('username', 'userId'));
	}
	
	public function importAction() {
		// đọc dữ liệu từ thư mục
		// lấy từng dòng
		// tách lấy username theo email
		// insert username và email, lấy name từ username, password: ptnn123456
		set_time_limit(0);
		$folder = BASE_DIR . '/tmp/data';
		$fileNames = $this->getFiles($folder);
		foreach($fileNames as $fileName) {
			echo 'imported: ' . $fileName . '<br />';
			$emails = file($fileName);
			foreach($emails as $email) {
				$email = trim($email); if(!$email) continue;
				$parts = explode('@', $email);
				$username = $parts[0];
				$userData = array(
					'username' => $username,
					'email' => $email,
					'name' => $username,
					'password' => md5('ptnn123456'),
					'status' => 1,
					'registered' => date('Y-m-d H:i:s', time())
				);
				$user = _db()->getEntity('user.account.user');
				$user->setData($userData);
				$user->save();	
			}	
		}
		
		
	}
	
	public function getFiles ($folder) {
		$rs = array();
		$files = glob($folder . '/*.txt');
		foreach($files as $file) {
			$rs[] = $file;
		}
		
		$files = glob($folder . '/*/*.txt');
		foreach($files as $file) {
			$rs[] = $file;
		}
		
		$files = glob($folder . '/*/*/*.txt');
		foreach($files as $file) {
			$rs[] = $file;
		}
		
		$files = glob($folder . '/*/*/*/*.txt');
		foreach($files as $file) {
			$rs[] = $file;
		}
		
		$files = glob($folder . '/*/*/*/*/*.txt');
		foreach($files as $file) {
			$rs[] = $file;
		}
		
		$files = glob($folder . '/*/*/*/*/*/*.txt');
		foreach($files as $file) {
			$rs[] = $file;
		}
		return $rs;
	}

}
