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
			$category = isset($_POST['category']) ? $_POST['category'] : "";
			$subject = isset($_POST['subject']) ? $_POST['subject'] : "";
			$number = isset($_POST['number']) ? $_POST['number'] : "";
			$tmie = isset($_POST['tmie']) ? $_POST['tmie'] : "";
			$lever = isset($_POST['lever']) ? $_POST['lever'] : "";
			$this->layout();
			$question = pzk_parse('<home.question table="questions" where="{$subject}" limit="{$number}" layout="home/question" />');
			$left = pzk_element('left');
			$left->append($question);
			$this->page->display();
		}
	}
 ?>