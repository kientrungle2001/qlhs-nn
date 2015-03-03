<?php
class PzkAdminTopicsController extends PzkAdminController {
	public $masterStructure = 'admin/home/index';
	public $masterPosition = 'left';
	public $addFields = 'name';
	public $editFields = 'name';
	
	public $addValidator = array(
		'rules' => array(
			'name' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 1000
			)
		),
		'messages' => array(
			'name' => array(
				'required' => 'Tên chủ điểm không được để trống',
				'minlength' => 'Tên chủ điểm phải dài 2 ký tự trở lên',
				'maxlength' => 'Tên chủ điểm chỉ dài tối đa 255 ký tự'
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
		
		$question	= pzk_element('question');
		
		$question->setQuestionType($data);
		
		$this->display();
	}
}