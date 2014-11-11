<?php
class PzkNewsController extends PzkController {
	public function indexAction() {
		$page = $this->getStructure('news/index');
		$page->display();
	}
}