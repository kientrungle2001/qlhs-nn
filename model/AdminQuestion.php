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
	
	function get_question($id=''){
		if(!empty($id)){
			$query = _db()->select('q.*')
			->from('questions q')
			->where("q.id='$id'");
		}else{
			$query = _db()->select('q.*')
			->orderBy('id ASC')
			->from('questions q');
		}
		return $query->result();
	}
	
	function get_question_type_of_question($id=''){
		if(!empty($id)){
			$query = _db()->select('q.type')
			->from('questions q')
			->where("q.id='$id'");
			$data =  $query->result();
			if(count($data) >0){
				return $data[0]['type'];
			}
		}
		return false;
	}
	
	function question_answers_add($data = array()){
		
		$addition = array(
			'date_modify'	=>	date(DATEFORMAT),
			'admin_modify'	=>	pzk_session('adminId'),
		);
		
		$data_merger = array_merge($data, $addition);
		
		if(!empty($data_merger) && is_array($data_merger)){
			
			$query	= _db()->insert('answers_question_tn')->fields('question_id, content, status, content_full, recommend, date_modify, admin_modify')->values(array($data_merger))->result();
			
			return $query;
		}
		return false;
	}
	
	function get_question_answers($question_id = ''){
		
		if(!empty($question_id)){
			
			$query = _db()->select('qa.*')
			->from('answers_question_tn qa')
			->where("qa.question_id='$question_id'");
			$data =  $query->result();
			if(count($data) >0){
				
				return $data;
			}
			return NULL;
		}
		return NULL;
	}
	
	function del_question_answers($question_id = '', $table = ''){
		
		if(!empty($question_id) && !empty($table)){
			
			$query = _db()->delete()->from($table)
			->where(array('question_id', $question_id))->result();
			return true;
		}
		return false;
	}
	
	function check_question_answers($question_id = ''){
		
		if(!empty($question_id)){
			
			$query = _db()->select('*')	->from('answers_question_tn')	->where("question_id='$question_id'");
			$data =  $query->result();
			if(count($data) >0){
				return true;
			}
		}
		return false;
	}
	
	function update_question_answers($data = array(), $table =''){
		
		$addition = array(
				'date_modify'	=>	date(DATEFORMAT),
				'admin_modify'	=>	pzk_session('adminId'),
		);
		
		$data_merger = array_merge($data, $addition);
		
		if(!empty($data_merger) && !empty($table)){
			
			$query = _db()->update($data_merger)->from($table)
			->where(array('question_id', $data['question_id']))->result();
			return true;
		}
		return false;
	}
}
?>