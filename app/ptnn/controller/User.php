<?php
class PzkUserController extends PzkController {
	
	//Load trang index
	public function layout()
		{
			$this->page = pzk_parse($this->getApp()->getPageUri('index'));
		}
	public function getLink($url,$params=array(),$use_existing_arguments=false)
		{
    		if($use_existing_arguments) $params = $params + $_GET;
    		if(!$params) return $url;
    		$link = $url;
    		if(strpos($link,'?') === false) $link .= '?'; //If there is no '?' add one at the end
    		elseif(!preg_match('/(\?|\&(amp;)?)$/',$link)) $link .= '&amp;'; //If there is no '&' at the END, add one.
    
   			 $params_arr = array();
    		foreach($params as $key=>$value) 
    		{
	        	if(gettype($value) == 'array') { //Handle array data properly
	            	foreach($value as $val)
	            	{
	                	$params_arr[] = $key . '[]=' . urlencode($val);
	            	}
	        	}
	        	else 
	        	{
	            	$params_arr[] = $key . '=' . urlencode($value);
	        	}
    		}
    		$link .= implode('&amp;',$params_arr);
    
    		return $link;
		} 
	// Gửi email kích hoạt tài khoản
	public function sendMail($username="",$password="",$email="") {
		$mailtemplate = pzk_parse(pzk_app()->getPageUri('user/mailtemplate/register'));
		$mailtemplate->setUsername($username);
		//tạo URL gửi email xác nhận đăng ký
		$url= "http://".$_SERVER["SERVER_NAME"].'/User/activeRegister';
		$strConfirm = $password+ $email+$username;
		$confirm= md5($strConfirm);
		_db()->useCB()->update('user')->set(array('key' => $confirm))->where(array('username',$username))->result();
		$arr=array('active'=>$confirm);
		$url= $this->getLink($url,$arr);
		$mailtemplate->setUrl($url);
		$mail = pzk_mailer();
		$mail->AddAddress($email);
		$mail->Subject = 'Confirm new Register';
		$mail->Body    = $mailtemplate->getContent();
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	}
	// Hiển thị tài khoản trên header
	public function userAction()
	{
		$this->layout();
		$pageUri = $this->getApp()->getPageUri('user/user');
		$page = PzkParser::parse($pageUri);	
		$this->page->display();
	
	}
	// Đăng ký tài khoản mới
	public function registerAction()
	{
		$this->layout();
		$pageUri = $this->getApp()->getPageUri('user/register');
		$page = PzkParser::parse($pageUri);	
			$left = pzk_element('left');
			$left->append($page);
			$this->page->display();
		//$pageUri = $this->getApp()->getPageUri('user/register');
		// doc trang
		//$page = PzkParser::parse($pageUri);

		// thao tac

		// hien thi
		//$page->display();
		

	}
	public function registerPostAction()
	{		
		$request=pzk_element('request');
		$username=$request->get('username');
		$email=$request->get('email');
		$testUser= _db()->useCB()->select('username')->from('user')->where(array('equal','username',$request->get('username')))->result();
		if($testUser)
		{
			echo 'user đã tồn tại trên hệ thống';
		}
		else
		{	
			$testEmail= _db()->useCB()->select('email')->from('user')->where(array('equal','email',$request->get('email')))->result();
			if(0)
			{
				echo "Email đã tồn tại trên hệ thống";
			}
			else
			{
				$name= $request->get('name');
				$password=$request->get('password');
				$birthday= $request->get('birthday');
				$address= $request->get('address');
				$phone= $request->get('phone');
				$idpassport= $request->get('idpassport');
				$iddate= $request->get('iddate');
				$idplace= $request->get('idplace');
				$row = array('name' =>$name,'username'=>$username,'password'=>md5($password),'email'=>$email,'birthday'=>$birthday,'address'=>$address,'phone'=>$phone,'idpassport'=>$idpassport,'iddate'=>$iddate,'idplace'=>$idplace);
				$item= _db()->insert('user')->fields('name,username,password,email,birthday,address,phone,idpassport,iddate,idplace')->values(array($row))->result();
				$this->sendMail($username,$password,$email);
				// Hiển thị layout showregister
				$showregister = pzk_parse(pzk_app()->getPageUri('user/showregister'));
				$this->layout();
				$left = pzk_element('left');
				$left->append($showregister);
				$this->page->display();
			}
		}
	}
	// Hiển thị thông báo sau khi đăng ký tài khoản
	public function showregisterAction()
	{
		$this->layout();
		$pageUri = $this->getApp()->getPageUri('user/showregister');
		$page = PzkParser::parse($pageUri);	
		$left = pzk_element('left');
		$left->append($page);
		$this->page->display();
	}
	public function activeregisterAction()
	{
		$request=pzk_element('request');

		
		$confirm=$request->get('active');
		$items = _db()->useCB()->select('user.*')->from('user')->where(array('key', $confirm))->result_one();
		if($items)
		{
			_db()->useCB()->update('user')->set(array('status' => 1))->where(array('username',$items['username']))->result();
			pzk_session('login', true);
			pzk_session('username',$items['username']);
			$active = pzk_parse(pzk_app()->getPageUri('user/registersuccess'));

			$this->layout();
			$left = pzk_element('left');
			$left->append($active);
			$this->page->display();

		}

	}
	// Hiển thị thông báo đăng ký thành công sau khi đã kích hoạt tài khoản
	public function registersuccesAction() 
		{
		
			$this->layout();
			$pageUri = $this->getApp()->getPageUri('user/registersuccess');
			$page = PzkParser::parse($pageUri);	
			$left = pzk_element('left');
			$left->append($page);
			$this->page->display();
		}
	// Hiển thị form đăng nhập
	public function loginAction() 
	{
		
		// duong dan
		if(pzk_session('login'))
		{
			//echo "Đăng nhập thành công, Xin chào ^^: ";
			//die();
		}
		else
		{
			$this->layout();
			$pageUri = $this->getApp()->getPageUri('user/login');
			$page = PzkParser::parse($pageUri);	
			$left = pzk_element('left');
			$left->append($page);
			$this->page->display();
		}
	}
	// Xử lý đăng nhập
	public function loginPostAction()
	{
		
		$request = pzk_element('request');
		//echo $request->get('login');
		$items = _db()->useCB()->select('user.*')->from('user')->where(array('and', array('equal', 'username', $request->get('login')), array('equal','password',$request->get('password')) ))->result_one();
		if($items)
		{
		
			pzk_session('login', true);
			pzk_session('username', $request->get('login'));
			pzk_session('userId',$items['id']);
			header('location:/home');

		}else
		{

			$this->layout();
			$pageUri = $this->getApp()->getPageUri('/user/login');
		    $pageLogin = PzkParser::parse($pageUri);
		    $left=pzk_element('left');
		    $left->append($pageLogin);
		    $pageLogin->setError('dang nhap khong thanh cong');

		    $this->page->display();
		   
		}
	}
	// Đăng xuất 
	public function logoutAction(){
		pzk_session('login',false);
		pzk_session('username',false);
		pzk_session('userId',false);
		header('location:/user/Login');
	}
	// Gửi email quên mật khẩu
	public function sendMailForgotpassword($email="",$key="") {
		
		//tạo URL gửi email xác nhận đăng ký
		$url= "http://".$_SERVER["SERVER_NAME"].'/User/sendPassword';
		
		$strConfirm = $email+$key;
		$confirm= md5($strConfirm);
		
		//_db()->useCB()->update('user')->set(array('key' => $confirm))->where(array('username',$username))->result();
		_db()->useCB()->update('user')->set(array('key' => $confirm))->where(array('and',array('email',$email),array('status',1)))->result();
		$arr=array('forgotpassword'=>$confirm);
		$url= $this->getLink($url,$arr);
		$mailtemplate->setUrl($url);
		$mail = pzk_mailer();
		$mail->AddAddress($email);
		$mail->Subject = 'Quên mật khẩu';
		$mail->Body    = $mailtemplate->getContent();
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	}
	// Hiển thị form quên mật khẩu
	public function forgotpasswordAction()
	{
		$this->layout();
		$pageUri = $this->getApp()->getPageUri('user/forgotpassword');
		$page = PzkParser::parse($pageUri);	
			$left = pzk_element('left');
			$left->append($page);
			$this->page->display();
	}
	// Xử lý lấy lại mật khẩu
	public function forgotpasswordPostAction()
	{

		$request = pzk_element('request');
		$email= $request->get('email');
		$items = _db()->useCB()->select('user.*')->from('user')->where(array('equal','email',$request->get('email')))->result_one();
		if($items)
		{
			$key=$items['key'];
			// gửi email
			$this->sendMailForgotpassword($email,$key);
		}
	}
	//Gửi lại mật khẩu
		public function sendPasswordAction()
	{
		$request=pzk_element('request');

		echo "Tài khoản của bạn trên website "."http://".$_SERVER["SERVER_NAME"]."<br>";
		$confirm=$request->get('forgotpassword');
		$items = _db()->useCB()->select('user.*')->from('user')->where(array('key', $confirm))->result_one();
		if($items)
		{
			$password=md5(rand(0,9999999999).$items['username']);
			$password=substr($password,0,8);
			$username=$items['username'];
			_db()->useCB()->update('user')->set(array('password' => $password))->where(array('and',array('password',$password),array('status',1)))->result();
			$newpassword = pzk_parse(pzk_app()->getPageUri('user/newpassword'));
			$newpassword->setUsername($username);
			$newpassword->setPassword($password);
			$this->layout();
			$left = pzk_element('left');
			$left->append($newpassword);
			$this->page->display();
			
			//header('location:/user/newpassword');

					
		}
		else
		{
			echo "sai rồi";
		}

	}
	// Hiển thị password mới
	public function newpasswordAction() 
	{
		
			$this->layout();
			$pageUri = $this->getApp()->getPageUri('user/newpassword');
			$page = PzkParser::parse($pageUri);	
			$left = pzk_element('left');
			$left->append($page);
			$this->page->display();
		
	}
	// Sửa thông tin cá nhân
	public function editinforAction() 
	{
		
			$this->layout();
			$pageUri = $this->getApp()->getPageUri('user/editinfor');
			$page = PzkParser::parse($pageUri);	
			$left = pzk_element('left');
			$left->append($page);
			$this->page->display();
		
	}
	public function editinforPostAction()
	{
		
		$request = pzk_element('request');
		//echo $request->get('login');
		$items = _db()->useCB()->select('user.*')->from('user')->where(array('and', array('equal', 'username', $request->get('login')), array('equal','password',$request->get('password')) ))->result_one();
		if($items)
		{
		
			pzk_session('login', true);
			pzk_session('username', $request->get('login'));
			pzk_session('userId',$items['id']);
			header('location:/home');

		}else
		{

			$this->layout();
			$pageUri = $this->getApp()->getPageUri('/user/login');
		    $pageLogin = PzkParser::parse($pageUri);
		    $left=pzk_element('left');
		    $left->append($pageLogin);
		    $pageLogin->setError('dang nhap khong thanh cong');

		    $this->page->display();
		   
		}
	}
}