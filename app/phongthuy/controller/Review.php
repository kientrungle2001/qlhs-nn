<?php
class PzkReviewController extends PzkController {
	public $masterStructure = 'master';
	public $masterPosition = 'content';
	public function menhAction() {
		$this->viewStructure('review/menh');
	}
	public function kimlauhoangocAction() {
		$this->viewStructure('review/kimlauhoangoc');
	}
	
	public function tuoihopAction() {
		$this->viewStructure('review/tuoihop');
	}
	
	public function thangcuoiAction() {
		$this->viewStructure('review/thangcuoi');
	}
}