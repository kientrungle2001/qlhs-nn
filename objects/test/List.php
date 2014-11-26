<?php
class PzkTestList extends PzkObject {
	public function getItems() {
		return _db()->select('*')->from($this->table)->limit($this->limit, 0)->result();
	}
}