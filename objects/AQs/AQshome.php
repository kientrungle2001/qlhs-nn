<?php 

/**
* 
*/
class PzkAQsAQshome extends PzkObject
{
	
	
	public function getInfo($username){
		$info=_db()->useCB()->select("*")->from("user")->where(array('username',$username))->result_one();
		return($info);
	}
	public function getQuestion()
	{
		$allquestions=_db()->useCB()->select("aqs_question.*,user.name")->from("aqs_question")->join('user', 'aqs_question.userId=user.id')->orderBy('aqs_question.id desc')->result();
		return($allquestions);
	}
	public function getCountAnswer($id)
	{
		$allanswer=_db()->useCB()->select("answer")->from("aqs_answer")->where(array('questionId',$id))->result();
		$count=count($allanswer);
		return($count);
	}
	public function getAnswer($id)
	{
		$allanswers=_db()->useCB()->select("aqs_answer.*,user.name")->from("aqs_answer")->join('user', 'aqs_answer.userId=user.id')->where(array('questionId',$id))->orderBy('aqs_answer.id desc')->result();
		return($allanswers);
	}
}
 ?>