<?php
class PzkHomeController extends PzkController {
	public $masterStructure = 'master';
	public $masterPosition = 'content';
	public function indexAction() {
		$this->viewStructure('index');
	}
	public function smartyAction() {
		$this->viewStructure('smarty');
	}
	public function projectAction() {
		$this->viewStructure('project');
	}
	public function importAction() {
		$lines = file(BASE_DIR . '/dataphongthuy.txt');
		foreach($lines as $line) {
			$parts = explode(':', $line);
			$title = trim($parts[1]);
			$years = trim($parts[0]);
			$years = explode(',', $years);
			foreach($years as $year) {
				$year = trim($year);
				$item = _db()->useCB()->select('*')
					->from('review_menh')->where(array('yob', $year))
					->result_one();
				if(!$item) {
					_db()->insert('review_menh')->fields('yob,title')
					->values(array(array('yob' => $year, 'title' => $title)))
					->result();
				}
			}
		}
	}
	public function importimgAction(){
		$dir = '/uploads/image/nhamay';
		$files = scandir(BASE_DIR . $dir);
		foreach($files as $file) {
			if($file != '.' && $file != '..') {
				$data = array(
					'title' => $file,
					'alias' => str_replace('.jpg', '', $file),
					'content' => '<p><img src="'.$dir.'/'.$file.'" width="100%" height="auto" /></p>',
					'images' => '<p><img src="'.$dir.'/'.$file.'" /></p>',
					'categories' => ',32,',
					'thumbnail' => '<p><img src="'.$dir.'/'.$file.'" /></p>'
				);
				$item = _db()->useCB()->select('*')->from('news_article')->where(array('alias',str_replace('.jpg', '', $file)))->result_one();
				if(!$item) {
					_db()->insert('news_article')
						->fields('title,alias,content,images,categories,thumbnail')
						->values(array($data))->result();
				}
			}
		}
	}
}