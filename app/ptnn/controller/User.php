<?php
class PzkUserController extends PzkController {
	

	public function registerAction(){
		$pageUri = $this->getApp()->getPageUri('user/register');
		// doc trang
		$page = PzkParser::parse($pageUri);

		// thao tac

		// hien thi
		$page->display();
		

	}
	public function registerPostAction(){
		echo "register";
		$request= pzk_element('request');
		$name= $request->get('name');
		$username=$request->get('username');
		$email=$request->get('email');
		$testUser= _db()->useCB()->select('user.*')->from('user')->where(array('equal','username',$request->get('username')))->result();
		if($testUser){
			echo 'user đã tồn tại trên hệ thống';
		}else{
				$password=$request->get('password');
				$row = array('name' =>$name,'username'=>$username,'password'=>md5($password),'email'=>$email );
				$items= _db()->insert('user')->fields('name,username,password,email')->values(array($row))->result();
			}

	}
	public function loginAction() {
		
		// duong dan
		if(pzk_session('login')){
			echo "Đăng nhập thành công, Xin chào ^^: ";
			//die();
		}
		$pageUri = $this->getApp()->getPageUri('user/login');
		// doc trang
		$page = PzkParser::parse($pageUri);

		// thao tac

		// hien thi
		$page->display();
		
		
		
	}
	
	public function loginPostAction(){
		echo "hello";
		$request = pzk_element('request');
		//echo $request->get('login');
		$items = _db()->useCB()->select('user.*')->from('user')->where(array('and', array('equal', 'username', $request->get('login')), array('equal','password',$request->get('password')) ))->result_one();
		if($items){
			//echo 'dang nhap thanh cong';
			//echo $items['id'];
			pzk_session('login', true);
			pzk_session('username', $request->get('login'));
			pzk_session('userId',$items['id']);
			header('location:/user/Login');

		}else{
			
			$pageUri = $this->getApp()->getPageUri('user/login');
		// doc trang
		     $page = PzkParser::parse($pageUri);
		     $page->setError('dang nhap khong thanh cong');
		// thao tac

		// hien thi
		      $page->display();
		}
	}
	public function logoutAction(){
		pzk_session('login',false);
		pzk_session('username',false);
		pzk_session('userId',false);
		header('location:/user/Login');
	}
}