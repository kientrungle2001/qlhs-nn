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

}
?>