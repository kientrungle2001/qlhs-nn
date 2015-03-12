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
public function fillPost1Action(){
	
	$request = pzk_element('request');
	$answers = $request->get('data_answers');
	var_dump($answers);
}
public function fillPostAction(){

	$request = pzk_element('request');
	$answers=$request->get('answers');
	$question_id= $request->get('question_id');
	$question_type= $request->get('question_type');
	$category_id= $request->get('category_id');
	$quantity_question= $request->get('quantity_question');
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
			
				$answer[$i]=$answer[$i].'|'.$answers[$i][$j];
			}
		}
		$questionId=$question_id[$i];
		$questionType=$question_type[$i];
		$rowAnswer=array('user_book_id'=>$userbookId,'questionId'=>$questionId,'question_type'=>$questionType,'content'=>$answer[$i]);
		$userAnswer->setData($rowAnswer);
		$userAnswer->save();
	}


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