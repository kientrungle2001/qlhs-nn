<?php
class PzkManageController extends PzkController {
	public function articleAction() {
		
	}
	public function categoryAction() {
		$request = pzk_element('request');
		$appId = $request->getSegment(3);
		if(!isset($request->query['template'])) $request->query['template'] = '1';
		$template = $request->query['template'];
		$page = $this->getStructure($template . '/index');
		$page->title = 'Category';
		$page->append($this->getStructure('grid/category'));
		$grid = pzk_element('dg');
		$grid->rootId = $appId;
		$grid->url .= '/' . $appId;
		$page->display();
	}
}