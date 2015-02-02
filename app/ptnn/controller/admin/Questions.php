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
				'maxlength' => 1000
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
				'maxlength' => 1000
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
		
		$question	= pzk_element('question');
		
		$question->setQuestionType($data);
		
		$this->display();
	}
	
	public function addAction() {
		
		$data = array();
		
		$admin_question = pzk_model('AdminQuestion');
		
		$data = $admin_question->get_question_type();
		
		$this->initPage()
		->append('admin/'.pzk_or($this->customModule, $this->module).'/add')
		->append('admin/'.pzk_or($this->customModule, $this->module).'/menu', 'right');
		
		$question	= pzk_element('question_add');
		
		$question->setQuestionType($data);
		
		$this->display();
	}
	
	public function editAction() {
		$module = pzk_parse(pzk_app()->getPageUri('admin/'.pzk_or($this->customModule, $this->module).'/edit'));
		$module->setItemId(pzk_request()->getSegment(3));
		$this->initPage()
		->append($module)
		->append('admin/'.pzk_or($this->customModule, $this->module).'/menu', 'right');
		
		$question	= pzk_element('question_edit');
		
		$data = array();
		
		$admin_question = pzk_model('AdminQuestion');
		
		$data = $admin_question->get_question_type();
			
		$question->setQuestionType($data);
		
		$this->display();
	}
	
	function delAction(){
	
		$question_id = pzk_request()->getSegment(3);
		if($this->childTable) {
			foreach($this->childTable as $val) {
				_db()->useCB()->delete()->from($val['table'])
				->where(array($val['findField'], $question_id))->result();
			}
	
		}
		_db()->useCB()->delete()->from($this->table)
		->where(array('id', $question_id))->result();
	
		pzk_notifier()->addMessage('Xóa thành công');
		$this->redirect('index');
	}
	
	function detailAction() {
		
		$question_id	=	pzk_request()->getSegment(3);
		
		$item	=	pzk_model('AdminQuestion');
		
		$type	=	$item->get_question_type_of_question($question_id);
		
		if($type == 'Q0' || $type == 'Q4' || $type == 'Q19' || $type == 'Q8'){
			
			$module = pzk_parse(pzk_app()->getPageUri('admin/'.pzk_or($this->customModule, $this->module).'/question_answers_tn/answers'));
			$module->setItemId(pzk_request()->getSegment(3));
			$this->initPage() ->append($module);
			
			$question	= pzk_element('question_answers');
			
			$question_answers = pzk_model('AdminQuestion');
			
			$itemAnswers = $question_answers->get_question_answers($question_id);
			
			$question->setItemAnswers($itemAnswers);
			
			$this->display();
			
		}elseif($type == 'Q20'){
			
			$module = pzk_parse(pzk_app()->getPageUri('admin/'.pzk_or($this->customModule, $this->module).'/question_answers_tn/answers20'));
			$module->setItemId(pzk_request()->getSegment(3));
			$this->initPage() ->append($module);
				
			$question	= pzk_element('question_answers20');
				
			$question_answers = pzk_model('AdminQuestion');
				
			$itemAnswers = $question_answers->get_question_answers($question_id);
				
			$question->setItemAnswers($itemAnswers);
			
			$this->display();
			
		}elseif($type == 'Q1'){
			
			$module = pzk_parse(pzk_app()->getPageUri('admin/'.pzk_or($this->customModule, $this->module).'/question_answers_dt/answers'));
			$module->setItemId(pzk_request()->getSegment(3));
			$this->initPage() ->append($module);
			
			$question	= pzk_element('question_answers');
			
			$question_answers = pzk_model('AdminQuestion');
			
			$itemAnswers = $question_answers->get_question_answers($question_id);
			
			$question->setItemAnswers($itemAnswers);
				
			$this->display();
			
		}elseif($type == 'Q9' || $type == 'Q10' || $type == 'Q11' || $type == 'Q12' || $type == 'Q13' || $type == 'Q14'){
			
			$module = pzk_parse(pzk_app()->getPageUri('admin/'.pzk_or($this->customModule, $this->module).'/question_answers_dt/answers9'));
			$module->setItemId(pzk_request()->getSegment(3));
			$this->initPage() ->append($module);
				
			$question	= pzk_element('question_answers');
				
			$question_answers = pzk_model('AdminQuestion');
				
			$itemAnswers = $question_answers->get_question_answers($question_id);
				
			$question->setItemAnswers($itemAnswers);
			
			$this->display();
			
		}elseif($type == 'Q2' || $type == 'Q3' || $type == 'Q5' || $type == 'Q6' || $type == 'Q15' || $type == 'Q16' || $type == 'Q17' || $type == 'Q18'){
			
			$module = pzk_parse(pzk_app()->getPageUri('admin/'.pzk_or($this->customModule, $this->module).'/question_answers_dt/answers2'));
			$module->setItemId(pzk_request()->getSegment(3));
			$this->initPage() ->append($module);
			
			$question	= pzk_element('question_answers');
			
			$question_answers = pzk_model('AdminQuestion');
			
			$itemAnswers = $question_answers->get_question_answers($question_id);
			
			$question->setItemAnswers($itemAnswers);
				
			$this->display();
			
			
		}elseif($type == 'Q7'){
			
			$module = pzk_parse(pzk_app()->getPageUri('admin/'.pzk_or($this->customModule, $this->module).'/question_answers_dt/answers7'));
			$module->setItemId(pzk_request()->getSegment(3));
			$this->initPage() ->append($module);
				
			$question			= pzk_element('question_answers');
				
			$question_answers 	= pzk_model('AdminQuestion');
				
			$itemAnswers 		= $question_answers->get_question_answers($question_id);
				
			$question->setItemAnswers($itemAnswers);
			
			$this->display();
			
		}elseif($type == 'Q21' ||$type == 'Q24'){
			
			$module = pzk_parse(pzk_app()->getPageUri('admin/'.pzk_or($this->customModule, $this->module).'/question_answers_dt/answers21'));
			$module->setItemId(pzk_request()->getSegment(3));
			$this->initPage() ->append($module);
			
			$question			= pzk_element('question_answers');
			
			$question_answers 	= pzk_model('AdminQuestion');
			
			$itemAnswers 		= $question_answers->get_question_answers($question_id);
			
			$question->setItemAnswers($itemAnswers);
				
			$this->display();
		}elseif($type == 'Q22' || $type == 'Q23'){
			
			$module = pzk_parse(pzk_app()->getPageUri('admin/'.pzk_or($this->customModule, $this->module).'/question_answers_dt/answers22'));
			$module->setItemId(pzk_request()->getSegment(3));
			$this->initPage() ->append($module);
			
			$question			= pzk_element('question_answers');
			
			$question_answers 	= pzk_model('AdminQuestion');
			
			$itemAnswers 		= $question_answers->get_question_answers($question_id);
			
			$question->setItemAnswers($itemAnswers);
				
			$this->display();
		}elseif($type == 'Q25'){
			
			$module = pzk_parse(pzk_app()->getPageUri('admin/'.pzk_or($this->customModule, $this->module).'/question_answers_dt/answers25'));
			$module->setItemId(pzk_request()->getSegment(3));
			$this->initPage() ->append($module);
			
			$question			= pzk_element('question_answers');
			
			$question_answers 	= pzk_model('AdminQuestion');
			
			$itemAnswers 		= $question_answers->get_question_answers($question_id);
			
			$question->setItemAnswers($itemAnswers);
				
			$this->display();
		}elseif($type == 'Q26' || $type == 'Q27' || $type == 'Q28' || $type == 'Q29' || $type == 'Q30'){
			
			$module = pzk_parse(pzk_app()->getPageUri('admin/'.pzk_or($this->customModule, $this->module).'/question_answers_dt/answers21'));
			$module->setItemId(pzk_request()->getSegment(3));
			$this->initPage() ->append($module);
			
			$question			= pzk_element('question_answers');
			
			$question_answers 	= pzk_model('AdminQuestion');
			
			$itemAnswers 		= $question_answers->get_question_answers($question_id);
			
			$question->setItemAnswers($itemAnswers);
				
			$this->display();
		}
	}
	
	function edit_tnPostAction() {
		
		$row = $this->getEditData();
		
		if(isset($row['content']) && isset($row['status']) && !empty($row['content']) && isset($row['id'])){
			
			if(is_array($row['content'])){
				
				$question_answers	=	pzk_model('AdminQuestion');
				
				$question_answers->del_question_answers($row['id'], 'answers_question_tn');
				
				$status = $row['status'];
				
				$data_answers = array();
				
				foreach( $row['content'] as $key => $content ){
					
					$content = trim($content);
					
					if($key == $status){
						$value = 1;
						$content_full	=	trim($row['content_full']);
						$recommend		= 	trim($row['recommend']);
					}else{
						$value = 0;
						$content_full	=	NULL;
						$recommend		= 	NULL;
					}
					$data_answers[$key] = array(
						'question_id'	=> $row['id'],
						'content'		=> $content,
						'status'		=> $value,
						'content_full'	=> $content_full,
						'recommend'		=> $recommend,
					);
					
					$result	=	$question_answers->question_answers_add($data_answers[$key]);
				}
				if($result !=false){
					
					pzk_notifier()->addMessage('Cập nhật thành công');
					$this->redirect('detail/' . pzk_request('id'));
				}else{
					
					pzk_notifier()->addMessage('<div class="color_delete">Cập nhật không thành công !</div>');
					$this->redirect('detail/' . pzk_request('id'));
				}
			}
		}
	}
	
	function edit_tn20PostAction() {
		
		$row = $this->getEditData();
		
		if(isset($row['content']) && isset($row['content_full'])){
			
			$question_answers	=	pzk_model('AdminQuestion');
			
			$question_answers->del_question_answers($row['id'], 'answers_question_tn');
			
			$data_answers = array(
				'question_id'	=>	$row['id'],
				'content'		=>	trim($row['content']),
				'content_full'	=>	trim($row['content_full']),
				'recommend'		=>	trim($row['recommend']),
			);
			
			$status = $question_answers->check_question_answers($row['id']);
			
			if($status){
				
				$result = 	$question_answers->update_question_answers($data_answers, 'answers_question_tn');
			}else{
				
				$result	=	$question_answers->question_answers_add($data_answers);
			}
			if($result !=false){
					
				pzk_notifier()->addMessage('Cập nhật thành công');
				$this->redirect('detail/' . pzk_request('id'));
			}else{
					
				pzk_notifier()->addMessage('<div class="color_delete">Cập nhật không thành công !</div>');
				$this->redirect('detail/' . pzk_request('id'));
			}
		}
	}
	
	function edit_tn2PostAction() {
	
		$row = $this->getEditData();
	
		if(isset($row['content']) && !empty($row['content']) && isset($row['id'])){
				
			if(is_array($row['content'])){
	
				$question_answers	=	pzk_model('AdminQuestion');
	
				$question_answers->del_question_answers($row['id'], 'answers_question_tn');
				
				$data_answers = array();
				
				foreach( $row['content'] as $key => $content ){
						
					$content = trim($content);
						
					if($key == 0){
						$content_full	=	trim($row['content_full']);
						$recommend		= 	trim($row['recommend']);
					}else{
						$content_full	=	NULL;
						$recommend		= 	NULL;
					}
					$data_answers[$key] = array(
							'question_id'	=> $row['id'],
							'content'		=> $content,
							'status'		=> 0,
							'content_full'	=> $content_full,
							'recommend'		=> $recommend,
					);
						
					$result	=	$question_answers->question_answers_add($data_answers[$key]);
				}
				if($result !=false){
						
					pzk_notifier()->addMessage('Cập nhật thành công');
					$this->redirect('detail/' . pzk_request('id'));
				}else{
						
					pzk_notifier()->addMessage('<div class="color_delete">Cập nhật không thành công !</div>');
					$this->redirect('detail/' . pzk_request('id'));
				}
			}
		}
	}
	
	function edit_tn7PostAction() {
	
		$row = $this->getEditData();
		
		if(isset($row['content']) && !empty($row['content']) && isset($row['id'])){
	
			if(is_array($row['content'])){
				
				$question_answers	=	pzk_model('AdminQuestion');
	
				$question_answers->del_question_answers($row['id'], 'answers_question_tn');
				
				$question_answers->del_question_answers($row['id'], 'answers_question_topic');
				
				if(isset($row['answers'])){
					
					$answers	=	$row['answers'];
				}
				
				$data_answers = array();
	
				foreach( $row['content'] as $key => $content ){
					$status = 0;
					if(isset($row['status'])){
						if($key == 0 ){
							$status = 1;
						}
					}
					$content = trim($content);
					$data_answers[$key] = array(
						'question_id'	=> $row['id'],
						'content'		=> $content,
						'status'		=> $status,
					);
	
					$result	=	$question_answers->question_answers_add($data_answers[$key]);
					
					$data_answers_topic = array();
					
					if($result != false){
						
						$answers_question_tn_id = $result;
						
						if(isset($answers[$key]) && is_array($answers[$key])){
							
							foreach($answers[$key] as $a => $value){
								
								$data_answers_topic = array(
								
										'question_id'				=> $row['id'],
										'answers_question_tn_id'	=> $answers_question_tn_id,
										'content'					=> $value
								);
								
								$result_answers = $question_answers->question_answers_topic_add($data_answers_topic);
							}
						}
					}
				}
				
				if($result != false){
					
					pzk_notifier()->addMessage('Cập nhật thành công');
					$this->redirect('detail/' . pzk_request('id'));
				}else{
	
					pzk_notifier()->addMessage('<div class="color_delete">Cập nhật không thành công !</div>');
					$this->redirect('detail/' . pzk_request('id'));
				}
			}
		}
	}
	
	function getEditData() {
		
		return pzk_request()->getFilterData();
	}
}