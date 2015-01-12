<?php 

/**
* 
*/
class PzkNewsComments extends PzkObject
{
	
	public function getComments($newsid)
	{
		$allcomments=_db()->useCB()->select("comment.*, user.avatar,user.name")->from("comment")->join('user', 'comment.userId=user.id')->where(array('newsId',$newsid))->orderBy('id desc')->result();
		return($allcomments);
	}
	public function getCountComment($newsid)
	{
		$allcomments=_db()->useCB()->select("comment")->from("comment")->where(array('newsId',$newsid))->result();
		$count=count($allcomments);
		return($count);
	}
	public function getInfo($username){
		$info=_db()->useCB()->select("*")->from("user")->where(array('username',$username))->result_one();
		return($info);
	}
}
 ?>