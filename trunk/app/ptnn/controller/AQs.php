<?php
class PzkAQsController extends PzkController {
	public $masterPage='index';
	public $masterPosition='right';
	
	
	
	
	public function AQshomeAction()
		{
			$this->initPage()->append('AQs/AQshome')->display();
			
		}
	public function questionPostAction()
		{	
			if(pzk_session('login'))
				{
					$question=pzk_request('question');				
					$userid=pzk_session('id');					
					if(!empty($question)){
						$addquestion=array('question'=>$question,'userId'=>$userid);
						$entity = _db()->useCb()->getEntity('table')->setTable('aqs_question');
						$entity->setData($addquestion);
						$entity->save();
					}
					$this->redirect('AQs/AQshome');
				}
			else
				{

					$this->redirect('user/login');
				}
			

		}
		public function answerAction()
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
					$this->redirect('AQs/AQs');
				}
			else
				{

					$this->redirect('user/login');
				}
		}
		
		
		

}
?>