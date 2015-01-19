<?php
class PzkAdminQuestiontypeController extends PzkAdminController {
    public $masterStructure = 'admin/home/index';
    public $masterPosition = 'left';
    public $addFields = 'name, request, question_type, group_question';
    public $editFields = 'name, request, question_type, group_question';
    public $addValidator = array(
        'rules' => array(
        	'request' => array(
        		'required' => true,
        		'minlength' => 2,
        		'maxlength' => 500
        	),
            'name' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 500
            ),
        	'question_type' => array(
        		'required' => true,
        		'minlength' => 2,
        		'maxlength' => 125
        	),
        	'group_question' => array(
        		'required' => true,
        	),
        ),
        'messages' => array(
            'request' => array(
                'required' 	=> 'Yêu cầu dạng câu hỏi không được để trống',
                'minlength' => 'Yêu cầu dạng câu hỏi phải dài 2 ký tự trở lên',
                'maxlength' => 'Yêu cầu dạng câu hỏi chỉ dài tối đa 500 ký tự'
            ),
        	'name' => array(
        		'required' 	=> 'Tên dạng câu hỏi không được để trống',
        		'minlength' => 'Tên dạng câu hỏi phải dài 2 ký tự trở lên',
        		'maxlength' => 'Tên dạng câu hỏi chỉ dài tối đa 500 ký tự'
        	),
        	'question_type' => array(
        		'required' 	=> 'Tên dạng câu hỏi không được để trống',
        		'minlength' => 'Mã dạng câu hỏi phải dài 2 ký tự trở lên',
        		'maxlength' => 'Mã dạng câu hỏi chỉ dài tối đa 125 ký tự'
        	),
        	'group_question' => array(
        		'required' 	=> 'Nhóm dạng câu hỏi không được để trống',
        		'minlength' => 'Nhóm dạng câu hỏi phải dài 2 ký tự trở lên',
        		'maxlength' => 'Nhóm dạng câu hỏi chỉ dài tối đa 125 ký tự'
        	),
        )
    );
    
    public $editValidator = array(
        'rules' => array(
        	'request' => array(
        		'required' => true,
        		'minlength' => 2,
        		'maxlength' => 500
        	),
            'name' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 500
            ),
        	'question_type' => array(
        		'required' => true,
        		'minlength' => 2,
        		'maxlength' => 125
        	),
       		'group_question' => array(
        		'required' => true,
        	),
        ),
        'messages' => array(
            'request' => array(
                'required' 	=> 'Yêu cầu dạng câu hỏi không được để trống',
                'minlength' => 'Yêu cầu dạng câu hỏi phải dài 2 ký tự trở lên',
                'maxlength' => 'Yêu cầu dạng câu hỏi chỉ dài tối đa 500 ký tự'
            ),
        	'name' => array(
        		'required' 	=> 'Dạng câu hỏi không được để trống',
        		'minlength' => 'Dạng câu hỏi phải dài 2 ký tự trở lên',
        		'maxlength' => 'Dạng câu hỏi chỉ dài tối đa 500 ký tự'
        	),
        	'question_type' => array(
        		'required' 	=> 'Tên dạng câu hỏi không được để trống',
        		'minlength' => 'Mã dạng câu hỏi phải dài 2 ký tự trở lên',
        		'maxlength' => 'Mã dạng câu hỏi chỉ dài tối đa 125 ký tự'
        	),
        	'group_question' => array(
        		'required' 	=> 'Nhóm dạng câu hỏi không được để trống',
        		'minlength' => 'Nhóm dạng câu hỏi phải dài 2 ký tự trở lên',
        		'maxlength' => 'Nhóm dạng câu hỏi chỉ dài tối đa 125 ký tự'
        	),
        )
    );
    
    function indexAction(){
    
    	$data = array();
    
    	$admin_question = pzk_model('AdminQuestion');
    
    	$data = $admin_question->get_question_type();
    
    	$this->initPage()->append('admin/'.pzk_or($this->customModule, $this->module).'/index')
    					 ->append('admin/'.pzk_or($this->customModule, $this->module).'/menu', 'right');
    	$this->fireEvent('index.after', $this);
    
    	$question_type	= pzk_element('questiontype');
    
    	$question_type->setQuestionType($data);
    
    	$this->display();
    }
    
   	function addAction() {
   		
		$this->initPage()
			->append('admin/'.pzk_or($this->customModule, $this->module).'/add')
			->append('admin/'.pzk_or($this->customModule, $this->module).'/menu', 'right')
			->display();
	}
	
	function delAction(){
		
		$questiontype_id = pzk_request()->getSegment(3);
		if($this->childTable) {
			foreach($this->childTable as $val) {
				_db()->useCB()->delete()->from($val['table'])
				->where(array($val['findField'], $questiontype_id))->result();
			}
	
		}
		_db()->useCB()->delete()->from($this->table)
		->where(array('id', $questiontype_id))->result();
		
		pzk_notifier()->addMessage('Xóa thành công');
		$this->redirect('index');
	}
	
}