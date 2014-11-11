<?php
class PzkIdeAppPageController extends PzkController {
	public function editAction() {
		$request = pzk_element('request');
		$page = pzk_parse(pzk_app()->getPageUri('1/index'));
		$right = pzk_element('right');
		$pageId = $request->getSegment(3);
		$app = _db()->getParent('profile_resource', $pageId, 'type="Application"');
		$pageRow = _db()->select('*')->from('profile_resource')->where('id=' . $pageId)->result_one();
		$currentTemplate  = _db()->select('*')->from('resource')->where('id=' . $app['templateId'])->result_one();
		$appEdit = pzk_parse('<h2><a href="{url /ide_app/edit}/'.$pageRow['parentId'].'">Return to App</a></h2>');
		$list = pzk_parse('<list layout="ide/app/page/region/list" table="profile_resource" fields="*" orderBy="title asc" condition="type=\'Region\' and parentId=\''.$pageId.'\'" titleField="title" pageId="'.$pageId.'" />');
		$edit = pzk_parse('<ide.app.page.edit itemId="'.$pageId.'" />');
		$pageLayout = pzk_parse('<ide.layout id="pageLayout" appId="'.$app['id'].'" templateId="'.$currentTemplate['id'].'" pageId="'.$pageRow['id'].'" layout="'.$currentTemplate['code'] . '/'.@$pageRow['layout'].'/abstract" />');
		$right->append($appEdit);
		$right->append($edit);
		$right->append($pageLayout);
		$right->append($list);
		$page->display();
	}
	
	public function editPostAction() {
		$request = pzk_element('request');
		$row = array();
		$row['type'] = 'Page';
		$row['subType'] = 'Page';
		$keys = array('id', 'type', 'subType', 'layout',  'title', 
			'keywords', 'description', 'basePageId');
		foreach($keys as $key) {
			if(isset($request->query[$key]))
				$row[$key] = $request->query[$key];
		}
		$row = _db()->buildInsertData('profile_resource', $row);
		
		if(!$row['id']) {
			$row['id'] = _db()->insert('profile_resource')->fields(implode(',', array_keys($row)))->values(array($row))->result();
		} else {
			_db()->update('profile_resource')->set($row)->where('id=' . $row['id'])->result();
		}
		header('Location: ' . BASE_URL . '/index.php/ide_app_page/edit/' . $row['id']);
	}
	
	public function previewAction() {
		$request = pzk_element('request');
		$pageId = $request->getSegment(3);
		$prTable = db_table('profile_resource');
		$rTable = db_table('resource');
		$page = $prTable->get($pageId);
		$app = $prTable->get($page['parentId']);
		$templateId = pzk_or(@$page['templateId'], @$app['templateId']);
		$template = $rTable->get($templateId);
		
		if($template && ($templateCode = @$template['code'])) {
			$layout = pzk_or(@$page['layout'], @$app['layout'], 'index');
			
			$pageObject = pzk_parse('<ide.app.page id="page" />');
			$pageObject->layout = "$templateCode/$layout";
			$pageObject->template = $templateCode;
			$pageObject->item = $page;
			$pageObject->app = $app;
			
			$pageObject->display();
		}
	}
	
	public function deleteAction() {
		$id = pzk_element('request')->getSegment(3);
		$row = db_table('profile_resource')->get($id);
		_db()->treeDelete('profile_resource', $id);
		header('Location: ' . BASE_URL . '/index.php/ide_app/edit/' . $row['parentId']);
	}
	
	public function addAction() {
		$request = pzk_element('request');
		$page = $this->getStructure('1/index');
		$right = pzk_element('right');
		$appId = $request->getSegment(3);
		$add = pzk_parse('<ide.app.page.add parentId="'.$appId.'" />');
		$right->append($add);
		$page->display();
	}
	
	public function addPostAction() {
		$request = pzk_element('request');
		$row = array();
		$row['type'] = 'Page';
		$row['subType'] = 'Page';
		$keys = array('id', 'type', 'subType', 'parentId', 'layout',  'title', 
			'keywords', 'description');
		foreach($keys as $key) {
			if(isset($request->query[$key]))
				$row[$key] = $request->query[$key];
		}
		$row = _db()->buildInsertData('profile_resource', $row);
		
		if(!@$row['id']) {
			$row['id'] = _db()->insert('profile_resource')->fields(implode(',', array_keys($row)))->values(array($row))->result();
		} else {
			_db()->update('profile_resource')->set($row)->where('id=' . $row['id'])->result();
		}
		header('Location: ' . BASE_URL . '/index.php/ide_app_page/edit/' . $row['id']);
	}
}