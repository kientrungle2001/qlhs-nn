<?php
/**
 *
 */
class PzkNgonnguController extends PzkFrontendController{
	
    public $masterPage	=	"index";
    public $masterPosition = 'left';
    
    public function layout(){
    	
        $this->page = pzk_parse($this->getApp()->getPageUri('index'));
    }
    
    public function indexAction(){
    	
    	$category_id = pzk_request()->getSegment(3);
    	
        $this->layout();
        $this->page->display();
    }
    
    public function questionAction(){
    	
    	$category_id = pzk_request()->getSegment(3);
    	
    	$obj = pzk_parse('<question.choice id="id_choice" layout="ngonngu/choice" />');
    	/* $c = pzk_element('id_choice');
    	$c->message = 'hello'; */
    	$this->initPage()->/* append($c); $this->*/display();
    }
    
}