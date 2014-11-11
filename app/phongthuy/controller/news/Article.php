<?php
class PzkNewsArticleController extends PzkController {
	public $masterStructure = 'master';
	public $masterPosition = 'content';
	public function indexAction() {
		$this->viewStructure('news/article/index');
	}
	public function detailAction() {
		$this->viewStructure('news/article/detail');
	}
}