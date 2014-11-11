<?php
class PzkTourController extends PzkController {
	public function indexAction() {
		$page = $this->getStructure('tour/index');
		$page->display();
	}
	public function listAction() {
		$page = $this->getStructure('tour/list');
		$page->display();
	}
	public function detailAction() {
		$request = pzk_element('request');
		$tourId = $request->getSegment(3);
		$page = $this->getStructure('tour/detail');
		$detail = pzk_element('detail');
		$detail->tourId = $tourId;
		$page->display();
	}
	public function foreignAction() {
		$request = pzk_element('request');
		$categoryId = $request->getSegment(3);
		if(!$categoryId) $categoryId = 7;
		$pageNum = $request->getSegment(4);
		
		$page = $this->getStructure('tour/foreign');
		
		$list = pzk_element('foreignTours');
		$list->categoryId = $categoryId;
		$list->pageNum = $pageNum;
		
		$breakcrums = pzk_element('breakcrums');
		$breakcrums->categoryId = $categoryId;
		
		$page->display();
	}
	public function vietnameseAction() {
		$request = pzk_element('request');
		$categoryId = $request->getSegment(3);
		if(!$categoryId) $categoryId = 3;
		$pageNum = $request->getSegment(4);
		
		$page = $this->getStructure('tour/vietnamese');
		
		$list = pzk_element('vietnameseTours');
		$list->categoryId = $categoryId;
		$list->pageNum = $pageNum;
		
		$breakcrums = pzk_element('breakcrums');
		$breakcrums->categoryId = $categoryId;
		
		$page->display();
	}
	public function featureAction() {
		$page = $this->getStructure('tour/feature');
		$page->display();
	}
	public function bookingAction() {
		$page = $this->getStructure('tour/booking');
		$page->display();
	}
}