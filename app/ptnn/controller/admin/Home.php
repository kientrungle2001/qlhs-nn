<?php
class PzkAdminHomeController extends PzkController {
	/*nguyenson*/
	function __construct(){
		
		$admin = pzk_session('adminUser') ;
		
		if(!$admin){
			
			 $this->redirect('admin_login/index');
		}
		
		$menu =  pzk_session(MENU, 'admin_home');
	}
	
	public function indexAction() {
		$this->parse('admin/home/index')->display();
	}
	
}