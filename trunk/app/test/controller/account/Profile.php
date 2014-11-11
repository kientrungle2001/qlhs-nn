<?php
class pzkAccountProfileController extends PzkController{
	public function indexAction() {
		$this->listAction();
	}
	
	public function listAction() {
		$page = pzk_parse(pzk_app()->getPageUri('1/index'));
		$right = pzk_element('right');
		$list = pzk_parse('<list layout="ide/account/profile/list" table="profile" fields="id,fullName,username" orderBy="username asc" condition="type=\'User\'" titleField="username"/>');
		$right->append($list);
		$page->display();
	}
	
	public function upgradeAction() {
		echo 'Upgrade';
	}
	
	public function domainAction() {
		echo 'Domain';
	}
	
	public function editAction() {
		echo 'Edit';
	}
	
	public function deleteAction() {
		echo 'Delete';
	}
	
	public function addAction() {
		echo 'Add';
	}
}