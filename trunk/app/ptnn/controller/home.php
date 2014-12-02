<?php 
	/**
	* 
	*/
	class PzkHomeController extends PzkController
	{
		public function layout()
		{
			$this->page = pzk_parse($this->getApp()->getPageUri('index'));
		}
		public function indexAction()
		{
			$this->layout();
			$this->page->display();
		}
		public function categoryAction()
		{
			$this->layout();
			$category = pzk_parse('<home.category table="categories" layout="home/category"/>');
			$left = pzk_element('left');
			$left->append($category);
			$this->page->display();
		}
		public function questionAction()
		{
			$this->layout();
			$question = pzk_parse('<home.question table="questions" layout="home/question" />');
			$left = pzk_element('left');
			$left->append($question);
			$this->page->display();
		}
	}
 ?>