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
		$allquestions=_db()->useCB()->select("aqs_question.*,user.name")->from("aqs_question")->join('user', 'aqs_question.userId=user.id')->orderBy('id desc')->result();
		return($allquestions);
	}
	public function getCountAnswer($questionid)
	{
		$allanswer=_db()->useCB()->select("answer")->from("aqs_answer")->where(array('questionId',$questionid))->result();
		$count=count($allanswer);
		return($count);
	}
	
}
 ?>