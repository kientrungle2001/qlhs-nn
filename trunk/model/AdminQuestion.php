<?php
class PzkAdminQuestionModel {
	
	function get_question_type($id = ''){
		
		if(!empty($id)){
			$query = _db()->select('qt.*')
			->from('questiontype qt')
			->where("qt.id='$id'");
		}else{
			$query = _db()->select('qt.*')
			->orderBy('id ASC')
			->from('questiontype qt');
		}
		return $query->result();
	}
}
?>