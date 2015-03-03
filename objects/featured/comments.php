<?php 

/**
* 
*/
class PzkFeaturedComments extends PzkObject
{
	
	public function getComments($featuredid)
	{
		$allcomments=_db()->useCB()->select("comment.*, user.avatar,user.name,user.username")->from("comment")->join('user', 'comment.userId=user.id')->where(array('featuredId',$featuredid))->orderBy('id desc')->result();
		return($allcomments);
	}
	public function getCountComment($featuredid)
	{
		$allcomments=_db()->useCB()->select("comment")->from("comment")->where(array('featuredId',$featuredid))->result();
		$count=count($allcomments);
		return($count);
	}
	public function getInfo($username){
		$info=_db()->useCB()->select("*")->from("user")->where(array('username',$username))->result_one();
		return($info);
	}
	public function getRealIPAddress(){  
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //check ip from share internet
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //to check ip is pass from proxy
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
}
}
 ?>