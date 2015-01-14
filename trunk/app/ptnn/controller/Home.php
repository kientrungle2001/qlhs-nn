<?php 
	/**
	* 
	*/
	class PzkHomeController extends PzkController
	{
		public function layout()
		{
			$this->page = pzk_parse($this->getApp()->getPageUri('index'));
		}
		public function indexAction()
		{
			$this->layout();
			$this->page->display();
		}
		public function categoryAction()
		{
			$this->layout();
			$category = pzk_parse('<home.category table="categories" layout="home/category"/>');
			$left = pzk_element('left');
			$left->append($category);
			$this->page->display();
		}
		public function questionAction()
		{
			$this->layout();
			$question = pzk_parse('<core.db.list table="questions" layout="home/question" />');
			$left = pzk_element('left');
			$left->append($question);
			$this->page->display();
		}
		
		public function videoAction() {


      $file = BASE_DIR.'/3rdparty/uploads/videos/test.txt';
            $file2 = BASE_DIR.'/3rdparty/uploads/videos/test_encrypted.txt';
            $handle = fopen($file, "rb");
            $initial_contents = fread($handle, filesize($file));
            fclose($handle);
      if($initial_contents){
              $td = mcrypt_module_open('tripledes', '', 'ecb', '');
              $iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
              mcrypt_generic_init($td, '123456', $iv);
              $encrypted_data = mcrypt_generic($td, $initial_contents);

              $encrypted_file = @fopen($file2,'wb');
              $ok_encrypt = @fwrite($encrypted_file,$encrypted_data);


              @fclose($encrypted_file);

                }
		}
        public function deVideoAction() {

            $file = BASE_DIR.'/3rdparty/uploads/videos/test_encrypted.txt';
            $file2 = BASE_DIR.'/3rdparty/uploads/videos/test_decrypted.txt';

            $handle = fopen($file, "rb");
            $initial_contents = fread($handle, filesize($file));
            fclose($handle);

            if($initial_contents){

            $td = mcrypt_module_open('tripledes', '', 'ecb', '');
            $iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);

            mcrypt_generic_init($td, '123456', $iv);

            $encrypted_data = $initial_contents;

                $p_t = mdecrypt_generic($td, $encrypted_data);

                $newfile = @fopen($file2,'wb');
                $ok_decrypt = @fwrite($newfile,$p_t);

                @fclose($newfile);
                mcrypt_generic_deinit($td);
                mcrypt_module_close($td);

        }
		
		
    }
	
	public function testAction() {
		$item = _db()->from('user')->whereId('97')->result_one();
		debug($item);
	}
}
 ?>