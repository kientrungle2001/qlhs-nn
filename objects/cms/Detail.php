<?php
class PzkDetail extends PzkObject {
	public $model = 'Detail';
	public $table = 'News';
	public $itemId = false;
	public $layout = 'detail';
	public function loadData() {
		$this->item = $this->model->getItem(array(
			'fields' => pzk_or(@$this->select, 'id,alias,title,brief,content'), 
			'table' => pzk_or(@$this->table, 'News'),
			'id' => @$this->itemId
		));
	}
	
}
?>