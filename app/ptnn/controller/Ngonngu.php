<?php
/**
 *
 */
class PzkNgonnguController extends PzkFrontendController{
	
    public $masterPage	=	"index";
    public $masterPosition = "left";
    
    public function layout(){
    	
        $this->page = pzk_parse($this->getApp()->getPageUri('index'));
    }
    
    public function questionAction(){
    	
    	$category_id = pzk_request()->getSegment(3);
    	
    	$obj = pzk_parse('<question.choice id="id_choice" layout="question/choice" />');
    	
    	$c	= pzk_element('id_choice');
    	
    	$ojb_ngonngu = pzk_parse('<question.ngonngu id="ngonngu" layout="question/ngonngu" />');
    	
    	$ngonngu = pzk_element('ngonngu');
    	
    	$data_category = pzk_model('Category');
    	
    	$category = $data_category->get_category_all($category_id);
    	
    	$ngonngu->setCategory($category);
    	
    	$category_parent = $data_category->get_category_parent($category['parent']);
    	
    	$question_types = explode(',', $category_parent['question_types']);
    	
    	$data_question = pzk_model('AdminQuestion');
    	
    	$data_types = array();
    	
    	foreach($question_types as $key =>$value){
    		
    		if(!empty($value) && $value !=''){
    		
    			$question_type =	$data_question->get_question_type($value);
    			$data_types[$key] = $question_type[0];
    		}
    	}
    	
    	$ngonngu->setData_types($data_types);
    	
    	$data_topics = $data_question->get_topics();
    	
    	$ngonngu->setData_topics($data_topics);
    	
    	$this->initPage()->append($c)->append($ngonngu)->display();
    }
    
}