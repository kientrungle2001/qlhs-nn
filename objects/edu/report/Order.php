<?php
class PzkEduReportOrder extends PzkObject {
	public $layout = 'edu/report/order';
	public $startDate;
	public $endDate;
	public function getOrders() {
		$conds = array('and', array('status', ''), 
					array('gte', 'created', $this->startDate), 
					array('lte','created', $this->endDate) );
		$query = _db()->useCB()->select('*')->from('general_order')->where($conds);
		return $query->result();
	}
}