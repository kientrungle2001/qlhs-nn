<?php
class PzkNewsController extends PzkController {
	
	
	public function layout()
		{
			$this->page = pzk_parse($this->getApp()->getPageUri('index'));
		}
	public function shownewsAction()
		{	
		$this->layout();
		$pageUri = $this->getApp()->getPageUri('news/shownews');
		$page = PzkParser::parse($pageUri);	
		$left = pzk_element('left');
		$left->append($page);
		$this->page->display();
		}
	
	public function newsAction()
		{
			$this->layout();
			$pageUri = $this->getApp()->getPageUri('/news/news');
			$page = PzkParser::parse($pageUri); 
			$left = pzk_element('left');
			$left->append($page);
			$this->page->display();
		}
	public function oldnewsAction()
		{
		$this->layout();
		$pageUri = $this->getApp()->getPageUri('news/oldnews');
		$page = PzkParser::parse($pageUri);	
		$left = pzk_element('left');
		$left->append($page);
		$this->page->display();
		}
	public function hotnewsAction()
		{
		$this->layout();
		$pageUri = $this->getApp()->getPageUri('news/hotnews');
		$page = PzkParser::parse($pageUri);	
		$left = pzk_element('left');
		$left->append($page);
		$this->page->display();
		}
}
?>