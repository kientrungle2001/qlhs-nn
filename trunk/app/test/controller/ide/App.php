<?php
class PzkIdeAppController extends PzkController {
	public function indexAction() {
		$this->listAction();
	}
	
	public function listAction() {
		$request = pzk_element('request');
		$page = pzk_parse(pzk_app()->getPageUri('1/index'));
		$right = pzk_element('right');
		$profileId = $request->get('profileId');
		$list = pzk_parse('<list layout="ide/app/list" 
			table="profile_resource" fields="*" 
			orderBy="title asc" 
			condition="type=\'Application\' and profileId=\''.$profileId.'\'" 
			titleField="title" 
			profileId="'.$profileId.'" />');
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
		$request = pzk_element('request');
		$page = pzk_parse(pzk_app()->getPageUri('1/index'));
		$right = pzk_element('right');
		$appId = $request->get('appId');
		$app = _db()->select('*')->from('profile_resource')->where('id='. $appId)->result_one();
		$profileId = $app['profileId'];
		$list = pzk_parse('<list layout="ide/app/page/list" 
				table="profile_resource" fields="*" 
				orderBy="title asc" 
				condition="type=\'Page\' and parentId=\''.$appId.'\'" 
				titleField="title" appId="'.$appId.'" />');
		$catList = pzk_parse('<list layout="ide/app/category/list" 
				table="profile_resource" fields="*" 
				orderBy="title asc" 
				condition="type=\'Category\' and parentId=\''.$appId.'\'" 
				titleField="title" parentId="'.$appId.'" />');
		$edit = pzk_parse('<ide.app.edit itemId="'.$appId.'" />');
		$profileList = pzk_parse('<h1><a href="{url /ide_app/list}/' . $profileId . '">Return</a></h1>');
		$right->append($profileList);
		$right->append($edit);
		$right->append($list);
		$right->append($catList);
		$page->display();
	}
	
	public function deleteAction() {
		echo 'Delete';
	}
	
	public function addAction() {
		echo 'Add';
	}
	
	public function editPostAction() {
		$request = pzk_element('request');
		$row = array();
		$keys = array('id', 'layout', 'profileId', 'resourceId', 'title', 'domain', 
			'keywords', 'description', 'templateId');
		foreach($keys as $key) {
			if(isset($request->query[$key]))
				$row[$key] = $request->query[$key];
		}
		$row = _db()->buildInsertData('profile_resource', $row);
		$row['type'] = 'Application';
		$row['subType'] = 'Application';
		if(!$row['id']) {
			$row['id'] = _db()->insert('profile_resource')->fields(implode(',', array_keys($row)))->values(array($row))->result();
		} else {
			_db()->update('profile_resource')->set($row)->where('id=' . $row['id'])->result();
		}
		header('Location: ' . BASE_URL . '/index.php/ide_app/edit/' . $row['id']);
	}
}