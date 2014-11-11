<?php
class PzkAttributeController extends PzkController {
	public function indexAction() {
		$request = pzk_element('request');
		if(!isset($request->query['template'])) $request->query['template'] = '1';
		$template = $request->query['template'];
		$page = pzk_parse($this->getApp()->getPageUri($template . '/index'));
		$page->title = 'Attribute Management';
		$page->append(pzk_parse($this->getApp()->getPageUri('grid/attribute/attribute')));
		$page->display();
	}
}