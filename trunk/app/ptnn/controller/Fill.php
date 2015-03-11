<?php 
class PzkFillController extends PzkFrontendController 
{
	public $masterPage='index';
	public $masterPosition='left';
	public function layout()
	{
		$this->page = pzk_parse($this->getApp()->getPageUri('index'));
	}

	public function fillAction()
	{
		$this->layout();		
		$this->append('question/fill', 'left');
		$this->page->display();
	}
public function fillPostAction(){
	$request = pzk_element('request');
	$answers=$request->get('answers');
	var_dump($answers);
	die();
	
}

 ?>