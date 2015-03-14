<?php 

/**
 * @author Admin
 *
 * Mar 9, 2015
 * 
 * Object Question Choice
 *
 */
class PzkQuestionChoice extends PzkObject{
	
	public $layout = 'question/choice';
	
	public $question_id;
	
	public $question;
	
	public $answer = array();
	
	public $type;
	
	public $request;
	
	function set_question_id($id){
		
		$this->question_id = $id;
	}
	
	function get_type(){
	
		$data_question = pzk_model('AdminQuestion');
		
		$data = $data_question->get_question($this->question_id);
		
		$this->type = $data[0]['type'];
	}
	
	function get_question(){
		
		$data_question = pzk_model('AdminQuestion');
		
		$data = $data_question->get_question($this->question_id);
		
		$this->question = $data[0]['name'];
	}
	
	function get_answer(){
		
		$data_question = pzk_model('AdminQuestion');
		
		$data = $data_question->get_question_answers($this->question_id);
		
		$this->answer = $data;
	}
	
	function showQuestion(){
		
		echo "123";
	}
}
 ?>