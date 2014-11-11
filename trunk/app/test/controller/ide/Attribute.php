<?php
class PzkIdeAttributeController extends PzkController {
	public function indexAction() {
		$page = $this->getStructure('1/index');
		pzk_element('right')->append($this->getStructure('grid/attribute/attribute'));
		$page->display();
	}
	
	public function typeAction() {
		$page = $this->getStructure('1/index');
		pzk_element('right')->append($this->getStructure('grid/attribute/type'));
		$page->display();
	}
	
	public function groupAction() {
		$page = $this->getStructure('1/index');
		pzk_element('right')->append($this->getStructure('grid/attribute/group'));
		$page->display();
	}
	
	public function setAction() {
		$page = $this->getStructure('1/index');
		pzk_element('right')->append($this->getStructure('grid/attribute/set'));
		$page->display();
	}
}