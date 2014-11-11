<?php 
class PzkQuestionQuestionController extends PzkController {
	public $masterStructure = 'master';
	public $masterPosition = 'content';
	public function indexAction() {
	}
	public function detailAction() {
		$this->viewStructure('question/question/detail');
	}
}