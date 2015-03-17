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
	$data_answers=$request->get('answers');
	$question_id=$data_answers['question_id'];
	$answers=$data_answers['answers'];
	$question_type= $data_answers['question_type'];
	$category_id= $data_answers['category_id'];
	$quantity_question= $data_answers['quantity_question'];
	$userBook= _db()->getEntity('userbook.userbook');
	$userAnswer= _db()->getEntity('userbook.useranswer');
	$userId=pzk_session('userId');
	$time= 60;
	$date= date("Y-m-d H:i:s");
	//insert database
	$row= array('userId'=>$userId,'categoryId'=>$category_id,'time'=>$time,'quantity_question'=>$quantity_question,'mark_status'=>0,'date'=>$date);
	$userBook->setData($row);
	$userBook->save();
	$userbookId=$userBook->getId();
	for($i=0; $i< $quantity_question; $i++){
		$count=count($answers[$i]);
		$answer[$i]='';
		if($count>0){
			for($j=0; $j< $count; $j++){
			
				$answer[$i]=$answer[$i].$answers[$i][$j].'|';
			}
		}
		$questionId=$question_id[$i];
		$questionType=$question_type[$i];
		$rowAnswer=array('user_book_id'=>$userbookId,'questionId'=>$questionId,'question_type'=>$questionType,'content'=>$answer[$i]);
		$userAnswer->setData($rowAnswer);
		$userAnswer->save();
	} 
	echo "1";
	
}
public function nextPageAction(){
	//$page=pzk_request()->get('page');
	$request = pzk_element('request');
	$page=$request->get('page');

	if(isset($page)){
		echo "1";
	}else{
		echo "0";
	}
	
}
}
 ?>