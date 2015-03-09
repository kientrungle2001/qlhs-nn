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
    	
    	$this->layout();
    	$this->page->display();
    }
    
}