<?php
// --IGNORE--
class PzkHomeController extends PzkController{
	
	public function indexAction() {
		$page = pzk_parse($this->getApp()->getPageUri('index'));
		$page->title = 'Trang chủ';
		$page->display();
	}
	
	public function smartyAction() {
		$smarty = $this->parse('smarty');
		$smarty->display();
	}
}
?>