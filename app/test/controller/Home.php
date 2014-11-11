<?php
class PzkHomeController extends PzkController {
	public function indexAction() {
		$request = pzk_element('request');
		if(!isset($request->query['template'])) $request->query['template'] = '1';
		$template = $request->query['template'];
		$page = pzk_parse($this->getApp()->getPageUri($template . '/index'));
		$page->display();
	}
	
	public function registerAction() {
		$this->indexAction();
	}
	
	public function regionAction() {
		$request = pzk_element('request');
		if(!isset($request->query['template'])) $request->query['template'] = '1';
		$template = $request->query['template'];
		$page = pzk_parse($this->getApp()->getPageUri($template . '/index'));
		$page->title = 'Region Management';
		$page->append(pzk_parse($this->getApp()->getPageUri('grid/region')));
		$page->display();
	}
	
	public function productAction() {
		$this->indexAction();
	}
	
	public function serviceAction() {
		$this->indexAction();
	}
	
	public function historyAction() {
		$this->indexAction();
	}
	
	public function contactAction() {
		$this->indexAction();
	}
	
	public function directoryAction() {
		$request = pzk_element('request');
		if(!isset($request->query['template'])) $request->query['template'] = '1';
		$template = $request->query['template'];
		$page = pzk_parse($this->getApp()->getPageUri($template . '/index'));
		$page->title = 'Directory';
		$page->append(pzk_parse($this->getApp()->getPageUri('grid/directory')));
		$page->display();
	}
	
	public function resourceAction() {
		$request = pzk_element('request');
		if(!isset($request->query['template'])) $request->query['template'] = '1';
		$template = $request->query['template'];
		$page = pzk_parse($this->getApp()->getPageUri($template . '/index'));
		$page->title = 'Resource';
		$page->append(pzk_parse($this->getApp()->getPageUri('grid/resource')));
		$page->display();
	}
	
	public function profileAction() {
		$request = pzk_element('request');
		if(!isset($request->query['template'])) $request->query['template'] = '1';
		$template = $request->query['template'];
		$page = pzk_parse($this->getApp()->getPageUri($template . '/index'));
		$page->title = 'Profile';
		$page->append(pzk_parse($this->getApp()->getPageUri('grid/profile')));
		$page->display();
	}
	
	public function profile_resourceAction() {
		$request = pzk_element('request');
		if(!isset($request->query['template'])) $request->query['template'] = '1';
		$template = $request->query['template'];
		$page = pzk_parse($this->getApp()->getPageUri($template . '/index'));
		$page->title = 'Profile Resource';
		$page->append(pzk_parse($this->getApp()->getPageUri('grid/profile_resource')));
		$page->display();
	}
	
	public function profileappsAction() {
		$request = pzk_element('request');
		if($request->get('appAction') == 'delete') {
			$appId = $request->get('appId');
			$pages = $this->getProfileResource($appId, 'Page');
			
			if($pages) foreach($pages as $page) {
				$regions = $this->getProfileResource($page['id'], 'Region');
				if($regions) {
					foreach($regions as $region) {
						_db()->delete()->from('profile_resource')->where('id=' . $region['id'])->result();
					}
				}
				_db()->delete()->from('profile_resource')->where('id=' . $page['id'])->result();
			}
			_db()->delete()->from('profile_resource')->where('id=' . $appId)->result();
		}
		if(!isset($request->query['template'])) $request->query['template'] = '1';
		$template = $request->query['template'];
		$page = pzk_parse($this->getApp()->getPageUri($template . '/index'));
		$page->title = 'Profile Apps';
		$profile_apps = pzk_parse($this->getApp()->getPageUri('operation/profile_apps'));
		$profile_apps->profileId = $request->get('profileId');
		$page->append($profile_apps);
		$page->display();
	}
	
	public function editapppostAction() {
		$request = pzk_element('request');
		$row = array();
		$keys = array('id', 'layout', 'profileId', 'resourceId', 'title', 'domain', 'keywords', 'description', 'templateId');
		foreach($keys as $key) {
			if(isset($request->query[$key]))
				$row[$key] = @$request->query[$key];
		}
		$row = _db()->buildInsertData('profile_resource', $row);
		$row['type'] = 'Application';
		$row['subType'] = 'Application';
		if(!$row['id']) {
			$row['id'] = _db()->insert('profile_resource')->fields(implode(',', array_keys($row)))->values(array($row))->result();
		} else {
			_db()->update('profile_resource')->set($row)->where('id=' . $row['id'])->result();
		}
		if(isset($request->query['pageId']) && $request->query['pageId']) {
			header('Location: ' . BASE_URL . '/index.php/editapp/' . $row['id'] . '/page/' . $request->query['pageId']);
			return ;
		}
		header('Location: ' . BASE_URL . '/index.php/editapp/' . $row['id']);
	}
	
	public function editpageapppostAction() {
		$request = pzk_element('request');
		$row = array();
		$keys = array('id', 'type', 'subType', 'layout', 'parentId', 'title', 'keywords', 'description');
		foreach($keys as $key) {
			$row[$key] = @$request->query[$key];
		}
		$app = $this->getProfileResource($row['parentId'], 'Application');
		$row['profileId'] = $app['profileId'];
		$row['resourceId'] = $app['resourceId'];
		$row = _db()->buildInsertData('profile_resource', $row);
		if(!$row['id']) {
			$row['id'] = _db()->insert('profile_resource')->fields(implode(',', array_keys($row)))->values(array($row))->result();
		} else {
			_db()->update('profile_resource')->set($row)->where('id=' . $row['id'])->result();
		}
		header('Location: ' . BASE_URL . '/index.php/editapp/' . $row['parentId'] . '/page/' . $row['id']);
	}
	
	public function editregionpageapppostAction() {
		$request = pzk_element('request');
		$row = array();
		$keys = array('id', 'parentId', 'title', 'eType', 'region', 'code', 'style');
		foreach($keys as $key) {
			$row[$key] = @$request->query[$key];
		}
		$row['type'] = 'Region';
		$row['subType'] = 'Region';
		$page = $this->getProfileResource($row['parentId'], 'Page');
		$row['profileId'] = $page['profileId'];
		$row['resourceId'] = $page['resourceId'];
		$row = _db()->buildInsertData('profile_resource', $row);
		if(!$row['id']) {
			$row['id'] = _db()->insert('profile_resource')->fields(implode(',', array_keys($row)))->values(array($row))->result();
		} else {
			_db()->update('profile_resource')->set($row)->where('id=' . $row['id'])->result();
		}
		header('Location: ' . BASE_URL . '/index.php/editapp/' . $request->query['appId'] . '/page/' . $row['parentId'] . '/region/' . $row['id']);
	}
	
	public function editappAction() {
		$request = pzk_element('request');
		if (@$request->query['regionAction'] == 'delete') {
			_db()->delete()->from('profile_resource')->where('id=' . $request->get('regionId'))->result();
			unset($request->query['regionId']);
		}
		if(@$request->query['pageAction'] == 'delete') {
			_db()->delete()->from('profile_resource')->where('id=' . $request->get('pageId'))->result();
			_db()->delete()->from('profile_resource')->where('parentId=' . $request->get('pageId'))->result();
			$request->un_set('pageId');
		}
		if(!isset($request->query['template'])) $request->query['template'] = '1';
		$template = $request->query['template'];
		$page = pzk_parse(pzk_app()->getPageUri($template . '/index'));
		$page->title = 'Edit App';
		$app = pzk_parse(pzk_app()->getPageUri('operation/edit_app'));
		$app->appId = $request->get('appId');
		if($request->get('pageId')) {
			$app->pageId = $request->get('pageId');
		}
		if($request->get('regionId')) {
			$app->regionId = $request->get('regionId');
		}
		$page->append($app);
		$page->display();
	}
	
	public function appAction() {
		$request = pzk_element('request');
		$app = $this->getProfileResource(@$request->query['appId'], 'Application');
		if($app) {
			$page = pzk_parse($this->getApp()->getPageUri('1/index'));
			$page->display();
		} else {
			echo 'Wrong App!';
		}
	}
	
	public function pageappAction() {
		$request = pzk_element('request');
		$app = $this->getProfileResource(@$request->query['appId'], 'Application');
		$page = $this->getProfileResource(@$request->query['pageId'], 'Page');
		$template = $this->getResource(pzk_or(@$page['templateId'], @$app['templateId']), 'Template');
		if($template && ($templateCode = @$template['code'])) {
			$page = pzk_parse($this->getApp()->getPageUri($templateCode . '/' . pzk_or(@$page['layout'], @$app['layout'], 'index')));
			$page->display();
		}
	}
	
	public function wizardAction() {
		$request = pzk_element('request');
		if(!isset($request->query['step'])) $request->query['step'] = '1';
		$step = $request->query['step'];
		$page = pzk_parse($this->getApp()->getPageUri('1/index'));
		$wizard = pzk_parse($this->getApp()->getPageUri('1/wizard'));
		$right = pzk_element('right');
		$right->append($wizard);
		$stepObj = $wizard->gotoStep($step);
		if(@$request->query['step'] == '2' && @$request->query['eType'] == 'raw') {
			$layout = pzk_parse('<form.fckEditor name="layout" height="400px"/>');
			$style = pzk_parse('<textarea name="style" style="height: 400px; width: 500px" />');
			$layout->value = '<p>aaaa</p>';
			$stepObj->append($layout);
			$stepObj->append($style);
		}
		$page->display();
	}
	
	public function getProfileResource($resourceId, $type) {
		if(!$resourceId) return NULL;
		$items = _db()->select('*')->from('profile_resource')->where('id=' . $resourceId . ' and (`type`=\'' . $type . '\' or subType=\'' . $type . '\')')->result();
		if(count($items)) {
			$resource = $items[0];
			if($resource['params']) {
				$params = json_decode($resource['params'], true);
				$resource = array_merge($resource, $params);
			}
			return $resource;
		}
		return NULL;
	}
	
	public function getResource($resourceId, $type) {
		if(!$resourceId) return NULL;
		$items = _db()->select('*')->from('resource')->where('id=' . $resourceId . ' and (`type`=\'' . $type . '\' or subType=\'' . $type . '\')')->result();
		if(count($items)) {
			$resource = $items[0];
			if($resource['params']) {
				$params = json_decode($resource['params'], true);
				$resource = array_merge($resource, $params);
			}
			return $resource;
		}
		return NULL;
	}
}