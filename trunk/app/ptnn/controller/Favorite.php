<?php 
class PzkFavoriteController extends PzkController 
{
	public $masterPage='index';
	public $masterPosition='left';
	public function layout()
	{
		$this->page = pzk_parse($this->getApp()->getPageUri('index'));
	}

	public function lessonfavoriteAction()
	{
		$this->layout();		
		//$this->append('user/profilefriend', 'left');
		$this->append('favorite/lessonfavorite', 'left');
		$this->append('user/profile/profileuser','right');
		$this->page->display();
			
	}

	public function lessonfavoritememberAction()
	{
		$this->layout();
		$this->append('favorite/lessonfavoritemember', 'left');
		$this->append('user/profile/profileuser','right');
		$this->display();
	}
	public function lessonhistoryAction()
	{
		$this->layout();
		$this->append('favorite/lessonhistory', 'left');
		$this->append('user/profile/profileuser','right');
		$this->display();
				
	}
	public function delLessionfavoriteAction()
	{
	
		$id = pzk_request()->getSegment(3);
		$lessonfavorite=_db()->getEntity('favorite.lesson_favorite');
		$lessonfavorite->load($id);
		$lessonfavorite->delete();
		$this->redirect('lessonfavorite?member='.pzk_session('userId'));
	}

}
 ?>