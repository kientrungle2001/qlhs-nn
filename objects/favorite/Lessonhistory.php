<?php 
/**
* 
*/
class PzkFavoriteLessonhistory extends PzkObject
{
	public $num_record= 5;
	
	public function loadUserName($member)
	{
		$user=_db()->useCB()->select('user.name as name, user.username as username,user.id as userid, user.avatar as avatar')->from('user')->where(array('id',$member))->result_one();
		return $user;
	}
	public function loadUserId($username)
	{
		$user=_db()->useCB()->select('user.name as name, user.username as username,user.id as userid, user.avatar as avatar')->from('user')->where(array('username',$username))->result_one();
		return $user;
	}
	public function countLession($member)
	{
			
			$count=_db()->useCB()->select('count(*) as count')->from('lession_favorite')->where(array('userId',$member))->result_one();
			return $count; 
	}
	public function numberPage($member)
	{
		$countrow=$this->countFriend($member);
		$num_row= $countrow['count'];
		$num_record= $this->num_record;
        $num_page=ceil($num_row/$num_record);
        return $num_page;
	}
	public function viewListLesson($member)
	{
			
			/*$loadUserName= $this->loadUserName($member);
			$username= $loadUserName['username'];
			$page=pzk_request('page');
			if(!$page){
				$page=1;
			}
			*/
			$listLesson=_db()->useCB()->select('lesson_history.id as id, lessons.lesson_name as lessonName,categories.name as categoriesName, lesson_history.date as date')->from('lesson_history')->join('categories','categories.id=lesson_history.categoriesId')->join('lessons','lessons.id=lesson_history.lessonId')->where(array(array('column','lesson_history','userId'),$member))->result();
			//$friend=_db()->useCB()->select('user.id as id,user.username as username, friend.userfriend as userfriend')->from('friend')->leftjoin('user','friend.username=user.username')->where(array(array('column','user','id'),'99'))->result();
			//$listlession=_db()->useCB()->select('friend. *')->from('friend')->where(array('username',$username))->limit($this->num_record,$page-1)->result();
			//$listfriend=_db()->useCB()->select('friend. *')->from('friend')->where(array('username',$username))->result();
			
			//$viewwritewall=_db()->useCB()->select('user_write_wall. *')->from('user_write_wall')->where(array('username',$username))->limit(6,0)->result();
			return $listLesson; 
	}



	
}
 ?>