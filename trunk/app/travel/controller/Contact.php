<?php
class PzkContactController extends PzkController {
	public function indexAction() {
		$page = $this->getStructure('contact/index');
		$page->display();
	}
}