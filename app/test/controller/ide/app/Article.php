<?php
class PzkIdeAppArticleController extends PzkController {
	public function editAction() {
		$request = pzk_element('request');
		$page = $this->getStructure('1/index');
		$right = pzk_element('right');
		$catId = $request->getSegment(3);
		$edit = pzk_parse('<ide.app.article.edit itemId="'.$catId.'" />');
		$right->append($edit);
		$page->display();
	}
	
	public function editPostAction() {
		$request = pzk_element('request');
		$row = array();
		$row['type'] = 'Article';
		$row['subType'] = 'Article';
		$keys = array('id', 'type', 'subType', 'layout',  'title', 'brief', 'content', 'image',
			'keywords', 'description');
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
		header('Location: ' . BASE_URL . '/index.php/ide_app_article/edit/' . $row['id']);
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
		header('Location: ' . BASE_URL . '/index.php/ide_app_category/edit/' . $row['parentId']);
	}
	
	public function addAction() {
		$request = pzk_element('request');
		$page = $this->getStructure('1/index');
		$right = pzk_element('right');
		$catId = $request->getSegment(3);
		$add = pzk_parse('<ide.app.article.add parentId="'.$catId.'" />');
		$right->append($add);
		$page->display();
	}
	
	public function addPostAction() {
		$request = pzk_element('request');
		$row = array();
		$row['type'] = 'Article';
		$row['subType'] = 'Article';
		$keys = array('id', 'type', 'subType', 'parentId', 'title', 'brief', 'content', 'image',
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
		header('Location: ' . BASE_URL . '/index.php/ide_app_article/edit/' . $row['id']);
	}
}