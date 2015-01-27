<?php
require_once BASE_DIR . '/model/Entity.php';
class PzkEntityEduPeriodModel extends PzkEntityModel {
	public $table = 'payment_period';
	public function importSchedules($schedules) {
		$rs = array();
		foreach($schedules as $schedule) {
			if($schedule['studyDate'] >= $this->getStartDate() &&  $schedule['studyDate'] < $this->getEndDate()) {
				$rs[] = $schedule['studyDate'];
			}
		}
		$this->setSchedules($rs);
	}
}