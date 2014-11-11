<?php
class PzkProjectController extends PzkController {
	public $masterStructure = 'master';
	public $masterPosition = 'content';
	public function indexAction() {
		$this->viewStructure('project');
	}
	public function detailAction() {
		$this->viewStructure('project/detail');
	}
}