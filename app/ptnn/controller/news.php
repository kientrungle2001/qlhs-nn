<?php
class PzkNewsController extends PzkController {
	public $masterPage='index';
	public $masterPosition='left';
	
	
	public function shownewsAction()
		{	
		$this->initPage()->append('news/shownews')->display();
		}
	
	public function newsAction()
		{
			$this->initPage()->append('news/news')->display();
			
		}
	public function commentsAction()
		{
			$this->initPage()->append('news/comments')->display();
			
		}
	public function commentsPostAction()
		{	
			if(pzk_session('login'))
				{
					$comments=pzk_request('comments');
					$ip=pzk_session('userIp');
					$newsid=pzk_session('newsid');
					$userid=pzk_session('id');
					$created=date("Y-m-d H:i:s");
					if(!empty($comments)){
						$addComments=array('newsId'=>$newsid,'ip'=>$ip,'comment'=>$comments,'created'=>$created,'userId'=>$userid);
						$entity = _db()->useCb()->getEntity('table')->setTable('comment');
						$entity->setData($addComments);
						$entity->save();
					}
					$this->redirect('shownews?id='.$newsid);
				}
			else
				{

					$this->redirect('user/login');
				}
			

		}

}
?>