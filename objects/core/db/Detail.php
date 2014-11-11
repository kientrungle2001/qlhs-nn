<?php
class PzkCoreDbDetail extends PzkObject {
	public $table = 'News';
	public $itemId = false;
	public $fields = '*';
	public $layout = 'db/detail';
	public $entity = false;
	public $facebookComment = false;
	public $displayFields = 'title,content';
	public $titleTag = 'h2';
	public $contentTag = 'div';
	public $classPrefix = 'core_db_';
	public $showImages = false;
	public $showRelateds = false;
	public $relatedFields = 'categories';
	public $hasAnswer = false;
	public function getItem() {
		if(!$this->itemId) {
			$request = pzk_element('request');
			$this->itemId = $request->getSegment(3);
		}
		return _db()->useCB()->select($this->fields)->from($this->table)
				->where(array('id', $this->itemId))->result_one($this->entity);
	}
	public function getPrevItem($conds = false) {
		return _db()->useCB()->select($this->fields)->from($this->table)
				->where(array('and', array('gt', 'id', $this->itemId), $conds) )->result_one($this->entity);
	}
	
	public function getNextItem($conds = false) {
		return _db()->useCB()->select($this->fields)->from($this->table)
				->where(array('and', array('lt', 'id', $this->itemId), $conds))->result_one($this->entity);
	}
}
?>