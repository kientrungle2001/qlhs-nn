<?php
class PzkHomeSampleController extends PzkController {
	public function indexAction() {
		$page = pzk_parse($this->getApp()->getPageUri('1/index'));
		$page->display();
	}
}