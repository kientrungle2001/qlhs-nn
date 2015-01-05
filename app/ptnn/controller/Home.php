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
			$username = pzk_session('username');
			if (pzk_request('token') == md5( pzk_request('time') . $username . 'securekey' ) ) {
				$file = BASE_DIR . '/3rdparty/uploads/videos/Wildlife.wmv';
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename='.basename($file));
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
				header('Content-Length: ' . filesize($file));
				ob_clean();
				flush();
				readfile($file);
				exit;
			}
		}
	}
 ?>