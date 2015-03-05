﻿<?php
class PzkFeaturedController extends PzkController {
	public $masterPage='index';
	public $masterPosition='right';
	
	
	public function showfeaturedAction()
		{	
		$this->initPage()->append('featured/showfeatured','left');
		$this->display();
		$featuredid=pzk_session('featuredid');
		$view=_db()->useCB()->select("id")->from("featured_visitor")->where(array('featuredId',$featuredid))->result();
		$count=count($view);
		_db()->useCB()->update('featured')->set(array('views' => $count))->where(array('id',$featuredid))->result();
		$allcomments=_db()->useCB()->select("comment")->from("comment")->where(array('featuredId',$featuredid))->result();
		$count2=count($allcomments);
		_db()->useCB()->update('featured')->set(array('comments' => $count2))->where(array('id',$featuredid))->result();
		
		
		}
	
	public function featuredAction()
		{
			$this->initPage()->append('featured/featured','right')->display();
			
		}
	public function commentsAction()
		{
			$this->initPage()->append('featured/comments')->display();
			
		}
	public function commentsPostAction()
		{	
			if(pzk_session('login'))
				{
					$comments=pzk_request('comments');
					$ip=pzk_session('userIp');
					$featuredid=pzk_session('featuredid');
					$userid=pzk_session('id');
					$created=date("Y-m-d H:i:s");
					if(!empty($comments)){
						$addComments=array('featuredId'=>$featuredid,'ip'=>$ip,'comment'=>$comments,'created'=>$created,'userId'=>$userid);
						$entity = _db()->useCb()->getEntity('table')->setTable('comment');
						$entity->setData($addComments);
						$entity->save();
					}
					$this->redirect('showfeatured?id='.$featuredid);
				}
			else
				{

					$this->redirect('user/login');
				}
			

		}
		public function likecommentAction()
		{
			
				if(pzk_session('login')==false)
			{
				echo "Bạn chưa đăng nhập";
			}
			else
			{
			$userid=pzk_request('userid');
			$featuredid=pzk_request('featuredid');
			$datelike=pzk_request('datelike');
			$commentid=pzk_request('commentid');
			$testlike=_db()->useCB()->select('id')->from('comment_like')->where(array('featuredId', $featuredid))->where(array('userId', $userid))->where(array('timelike', $datelike))->where(array('commentId', $commentid))->result_one();
			if(!$testlike){
				
				$alllike=_db()->useCB()->select("commentId")->from("comment_like")->where(array('commentId',$commentid))->result();				
				$count3=count($alllike);
				_db()->useCB()->update('comment')->set(array('likecomment' => $count3))->where(array('id',$commentid))->result();
				
				$addLikeComments=array('featuredId'=>$featuredid,'userId'=>$userid,'timelike'=>$datelike,'commentId'=>$commentid);
								$entity = _db()->getEntity('table')->setTable('comment_like');
								$entity->setData($addLikeComments);
								$entity->save();
								
				echo $count3;
				}
			}
		}
		
		
		

}
?>