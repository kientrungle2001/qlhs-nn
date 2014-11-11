<?php
class PzkHomeController extends PzkController {
	public function indexAction() {
		$page = $this->getStructure('index');
		$page->display();
	}
}