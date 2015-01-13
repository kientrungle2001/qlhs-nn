<?php
class PzkAdminQuestionsController extends PzkAdminController {
	public $masterStructure = 'admin/home/index';
	public $masterPosition = 'left';
	public $addFields = 'name, type, level, categoryIds';
	public $editFields = 'name, type, level, categoryIds';
	
	public $addValidator = array(
		'rules' => array(
			'name' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 255
			),
			'type' => array(
				'required' => true,
			),
		),
		'messages' => array(
			'name' => array(
				'required' => 'Tên câu hỏi không được để trống',
				'minlength' => 'Tên câu hỏi phải dài 2 ký tự trở lên',
				'maxlength' => 'Tên câu hỏi chỉ dài tối đa 255 ký tự'
			),
			'type' => array(
				'required' => 'Yêu cầu chọn loại câu hỏi',
			)
		)
	);
	
	public $editValidator = array(
		'rules' => array(
			'name' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 255
			),
			'type' => array(
				'required' => true,
			),
		),
		'messages' => array(
			'name' => array(
				'required' => 'Tên câu hỏi không được để trống',
				'minlength' => 'Tên câu hỏi phải dài 2 ký tự trở lên',
				'maxlength' => 'Tên câu hỏi chỉ dài tối đa 255 ký tự'
			),
			'type' => array(
				'required' => 'Yêu cầu chọn loại câu hỏi',
			)
		)
	);
	
	function indexAction(){
		
		$data = array();
		
		$admin_question = pzk_model('AdminQuestion');
		
		$data = $admin_question->get_question_type();
		
		$this->initPage()->append('admin/'.pzk_or($this->customModule, $this->module).'/index') 
						 ->append('admin/'.pzk_or($this->customModule, $this->module).'/menu', 'right');
		$this->fireEvent('index.after', $this);
		
		$question_type	= pzk_element('question');
		
		$question_type->setQuestionType($data);
		
		$this->display();
		
	}
}