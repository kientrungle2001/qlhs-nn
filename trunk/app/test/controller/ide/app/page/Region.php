<?php
class PzkIdeAppPageRegionController extends PzkController {
	
	public function addAction() {
		$request = pzk_element('request');
		$page = pzk_parse(pzk_app()->getPageUri('1/index'));
		$right = pzk_element('right');
		$pageId = $request->getSegment(3);
		$add = pzk_parse('<ide.app.page.region.add parentId="'.$pageId.'" />');
		$returnPage = pzk_parse('<a href="{url /ide_app_page}/edit/'.$pageId.'">Return to Page</a>');
		$right->append($returnPage);
		$right->append($add);
		$page->display();
	}
	
	public function editAction() {
		$request = pzk_element('request');
		$page = pzk_parse(pzk_app()->getPageUri('1/index'));
		$right = pzk_element('right');
		$regionId = $request->getSegment(3);
		$region = _db()->select('*')->from('profile_resource')->where('id=' . $regionId)->result_one();
		$pageEdit = pzk_parse('<a href="{url /ide_app_page/edit}/'.$region['parentId'].'">Return to Page</a>');
		$edit = pzk_parse('<ide.app.page.region.edit itemId="'.$regionId.'" />');
		$right->append($pageEdit);
		$right->append($edit);
		$page->display();
	}
	
	public function editPostAction() {
		$request = pzk_element('request');
		$eType = $request->get('eType', 'text');
		$extraTypeKeys = array(
			'text' => array(),
			'media' => array('url', 'width', 'height'),
			'gallery' => array('width', 'height', 'frame', 'class', 'image_title', 'alt'),
			'image' => array('width', 'height', 'frame', 'class', 'image_title', 'alt'),
			'banner' => array('width', 'height', 'frame', 'class', 'image_title', 'alt', 'url'),
			'section' => array('heading', 'body', 'ordering', 'link', 'width', 'height', 'frame', 'class', 'image_title', 'alt'),
			'menu' => array('ordering', 'enabled', 'ulmenu'),
			'social' => array('facebook', 'twitter', 'youtube', 'google', 'blogger')
		);
		$row = array();
		$keys = array('id','title', 'eType',  'region', 
			'code', 'style', 'orderNum');
		$extraKeys = $extraTypeKeys[$eType];
		foreach($extraKeys as $key) {
			$keys[] = $key;
		}
		foreach($keys as $key) {
			if(isset($request->query[$key]))
				$row[$key] = $request->query[$key];
		}
		$row = _db()->buildInsertData('profile_resource', $row);
		$row['type'] = 'Region';
		$row['subType'] = 'Region';
		if(!$row['id']) {
			$row['id'] = _db()->insert('profile_resource')->fields(implode(',', array_keys($row)))->values(array($row))->result();
		} else {
			_db()->update('profile_resource')->set($row)->where('id=' . $row['id'])->result();
		}
		$row = _db()->select('parentId')->from('profile_resource')->where('id=' . $row['id'])->result_one();
		header('Location: ' . BASE_URL . '/index.php/ide_app_page/edit/' . $row['parentId']);
	}
	
	public function editBuildAction() {
		$request = pzk_element('request');
		$row = array();
		$keys = array('id','title', 'eType',  'region');
		foreach($keys as $key) {
			if(isset($request->query[$key]))
				$row[$key] = $request->query[$key];
		}
		$page = pzk_parse(pzk_app()->getPageUri('1/index'));
		$right = pzk_element('right');
		$regionId = $request->getSegment(3);
		$eType = $row['eType'];
		$build = pzk_parse('<ide.app.page.region.build id="build" itemId="'.$regionId.'" eType="'.$eType.'" />');
			$builder = pzk_parse('<ide.app.page.region.build.'.$eType.' id="regionBuilder" />');
			$build->append($builder);
		$right->append($build);
		$page->display();
	}
	
	public function addPostAction() {
		$request = pzk_element('request');
		$parentId = $request->getSegment(3);
		$row = array();
		$keys = array('id','title', 'eType',  'region', 
			'code', 'style');
		foreach($keys as $key) {
			if(isset($request->query[$key]))
				$row[$key] = $request->query[$key];
		}
		$row = _db()->buildInsertData('profile_resource', $row);
		$row['type'] = 'Region';
		$row['subType'] = 'Region';
		$row['parentId'] = $parentId;
		if(!@$row['id']) {
			$row['id'] = _db()->insert('profile_resource')->fields(implode(',', array_keys($row)))->values(array($row))->result();
		} else {
			_db()->update('profile_resource')->set($row)->where('id=' . $row['id'])->result();
		}
		header('Location: ' . BASE_URL . '/index.php/ide_app_page_region/edit/' . $row['id']);
	}
	
	public function deleteAction() {
		$id = pzk_element('request')->getSegment(3);
		$row = _db()->select('parentId')->from('profile_resource')->where('id=' . $id)->result_one();
		_db()->treeDelete('profile_resource', $id);
		header('Location: ' . BASE_URL . '/index.php/ide_app_page/edit/' . $row['parentId']);
		
	}
	
}