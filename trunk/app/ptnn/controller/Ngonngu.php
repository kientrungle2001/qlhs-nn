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
    
    public function indexAction(){
    	
    	$category_id = pzk_request()->getSegment(3);
    	
        $this->layout();
        $this->append('question/ngonngu');
        $this->page->display();
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
    	
    	$this->initPage()->append($c)->append($ngonngu)->display();
    }
    
}