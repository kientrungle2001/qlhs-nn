<?php 
	/**
	* 
	*/
	class PzkWelComeController extends PzkController{
		
		public $masterPage	=	"home";
		
		public function __construct() {
		
			$login = pzk_session('login');
		
			if($login) {
				$this->redirect('Home/index');
			}
		}
		
		public function indexAction(){
				
			$this->initPage()->display();
		}
	}
	
?>