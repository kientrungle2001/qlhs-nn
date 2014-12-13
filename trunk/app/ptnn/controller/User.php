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
		$strConfirm = $password.$email.$username;
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
		$pageUri = $this->getApp()->getPageUri('/user/user');
		$page = PzkParser::parse($pageUri);	
		$this->page->display();
	
	}
	// Đăng ký tài khoản mới
	public function registerAction()
	{
		$this->layout();
		$pageUri = $this->getApp()->getPageUri('/user/register');
		$page = PzkParser::parse($pageUri);	
			$left = pzk_element('left');
			$left->append($page);
			$this->page->display();
	}
	public function registerPostAction()
	{	
		$error="hihi";	
		$request=pzk_element('request');
		$username=$request->get('username');
		$email=$request->get('email');
		$captcha= $request->get('captcha');
		if($captcha==$_SESSION['security_code'])
		{
			$testUser= _db()->useCB()->select('username')->from('user')->where(array('equal','username',$request->get('username')))->result();
			if($testUser)
			{
				$error="Tên đăng nhập đã tồn tại trên hệ thống";
			}
			else
			{	
				$testEmail= _db()->useCB()->select('email')->from('user')->where(array('equal','email',$request->get('email')))->result();
				if($testEmail)
				{
					$error= "Email đã tồn tại trên hệ thống";
				}
				else
				{
					$name= $request->get('name');
					$password=$request->get('password');
					$birthday= $request->get('birthday');
					$sex= $request->get('sex');
					$address= $request->get('address');
					$phone= $request->get('phone');
					$idpassport= $request->get('idpassport');
					$iddate= $request->get('iddate');
					$idplace= $request->get('idplace');
					$dateregister=date("Y-m-d H:i:s"); 
					$row = array('name' =>$name,'username'=>$username,'password'=>md5($password),'email'=>$email,'birthday'=>$birthday,'address'=>$address,'phone'=>$phone,'idpassport'=>$idpassport,'iddate'=>$iddate,'idplace'=>$idplace,'sex'=>$sex,'registered'=>$dateregister);
					$item= _db()->insert('user')->fields('name,username,password,email,birthday,address,phone,idpassport,iddate,idplace,sex,registered')->values(array($row))->result();
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
		else
		{
			$error="Mã bảo mật chưa đúng";

		}
			$this->layout();
			$pageUri = $this->getApp()->getPageUri('user/register');
		    $pageRegister = PzkParser::parse($pageUri);
		    $left=pzk_element('left');
		    $left->append($pageRegister);
		    pzk_notifier_add_message($error, 'danger');
		    //$pageRegister->setError($error);

		    $this->page->display();
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
			pzk_session('userId',$items['id']);
			pzk_session('name',$items['name']);
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
			$login = pzk_parse(pzk_app()->getPageUri('/user/login'));
			$left = pzk_element('left');
			$left->append($login);
			$this->page->display();
		}
	}
	// Xử lý đăng nhập
	public function loginPostAction()
	{
		
		$request = pzk_element('request');
		$password=md5($request->get('password'));
		//$items = _db()->useCB()->select('user.*')->from('user')->where(array('and', array('equal', 'username', $request->get('login')), array('equal','password',$password), array('equal','status',1) ))->result_one();
		$items = _db()->useCB()->select('user.*')->from('user')->where( array('equal', 'username', $request->get('login')))->result_one();
		if($items)
		{
			//lấy pass từ csdl
			$pass= $items['password'];
			$status=$items['status'];
			if($pass==$password)
			{
				if($status==1)
				{
					pzk_session('login', true);
					pzk_session('username', $request->get('login'));
					pzk_session('userId',$items['id']);
					pzk_session('name',$items['name']);
					$datelogin=date("Y-m-d H:i:s");    
					_db()->useCB()->update('user')->set(array('lastlogined' =>$datelogin ))->where(array('username',$items['username']))->result();
					header('location:/user/profileuser');	
				}else
				{
					//tài khoản của bạn đăng bị khóa hoặc chưa kích hoạt
					$error="tài khoản của bạn đăng bị khóa hoặc chưa kích hoạt";
				}
			}else 
				{
					//Mật khẩu đăng nhập chưa đúng
					$error="Mật khẩu đăng nhập chưa đúng";
				}
			

		}else
		{
			$error="Tên đăng nhập chưa đúng";
		}
			$this->layout();
			$pageUri = $this->getApp()->getPageUri('/user/login');
		    $pageLogin = PzkParser::parse($pageUri);
		    $left=pzk_element('left');
		    $left->append($pageLogin);
		    $pageLogin->setError($error);

		    $this->page->display();
		   
		
	}
	// Đăng xuất 
	public function logoutAction(){
		pzk_session('login',false);
		pzk_session('username',false);
		pzk_session('userId',false);
		header('location:/home');
	}
	
	// Gửi email quên mật khẩu
	public function sendMailForgotpassword($email="",$password="") {
		
		//tạo URL gửi email xác nhận đăng ký
		$url= "http://".$_SERVER["SERVER_NAME"].'/User/sendPassword';
		
		$strConfirm = $email.$password;
		$confirm= md5($strConfirm);
		$mailtemplate = pzk_parse(pzk_app()->getPageUri('user/mailtemplate/forgotpassword'));
			
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

		$error="";
		$request = pzk_element('request');
		$email= $request->get('email');
		$captcha= $request->get('captcha');
		if($captcha==$_SESSION['security_code'])
		{	
			$items = _db()->useCB()->select('user.*')->from('user')->where(array('equal','email',$request->get('email')))->result_one();
			if($items)
			{
				if($items['status']==1)
				{
					$password=$items['password'];
					$this->sendMailForgotpassword($email,$password);
					$this->layout();
					$pageUri = $this->getApp()->getPageUri('user/showforgotpassword');
					$page = PzkParser::parse($pageUri);	
					$left = pzk_element('left');
					$left->append($page);
					$this->page->display();
				}
				else
				{
					$error="Tài khoản của bạn đang bị khóa hoặc chưa kích hoạt";
				}
			
			}else
			{
				$error="Email của bạn chưa đăng ký tài khoản";
			}
		}
		else
		{
			$error="Mã bảo mật chưa đúng";
		}
		$this->layout();
		$pageForgetpassword = $this->getApp()->getPageUri('user/forgotpassword');
		$forgotpassword = PzkParser::parse($pageForgetpassword);	
		$left = pzk_element('left');
		$left->append($forgotpassword);
		$forgotpassword->setError($error);
		$this->page->display();
	}
	public function showforgotpasswordAction()
	{
			$this->layout();
			$pageUri = $this->getApp()->getPageUri('/user/showforgotpassword');
			$page = PzkParser::parse($pageUri);	
			$left = pzk_element('left');
			$left->append($page);
			$this->page->display();
	}
	//Gửi lại mật khẩu
		public function sendPasswordAction()
	{
		$request=pzk_element('request');
		$confirm=$request->get('forgotpassword');
		$items = _db()->useCB()->select('user.*')->from('user')->where(array('key', $confirm))->result_one();
		
		if($items)
		{
			$password=md5(rand(0,9999999999).$items['username']);
			$password=substr($password,0,8);
			$updatepassword=md5($password);
			$username=$items['username'];
			_db()->useCB()->update('user')->set(array('password' => $updatepassword,'key'=>''))->where(array('and',array('username',$username),array('status',1)))->result();
			$newpassword = pzk_parse(pzk_app()->getPageUri('user/newpassword'));
			$newpassword->setUsername($username);
			$newpassword->setPassword($password);
			$this->layout();
			$left = pzk_element('left');
			$left->append($newpassword);
			$this->page->display();

		}
		else
		{
			$newpassword = pzk_parse(pzk_app()->getPageUri('user/newpassword'));
			$newpassword->setUsername("");
			$this->layout();
			$left = pzk_element('left');
			$left->append($newpassword);
			$this->page->display();		
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

			$username= pzk_session('username');
			$items = _db()->useCB()->select('user.*')->from('user')->where(array('username',$username))->result_one();
			
			$editinfor = pzk_parse(pzk_app()->getPageUri('user/editinfor'));
			// lấy thông tin cá nhân
			$name= $items['name'];
			$birthday= $items['birthday'];
			$address= $items['address'];
			$phone= $items['phone'];
			$idpassport= $items['idpassport'];
			$iddate= $items['iddate'];
			$idplace= $items['idplace'];
			// Hiển thị thông tin tài khoản
			$editinfor->setname($name);
			$editinfor->setbirthday($birthday);
			$editinfor->setAddress($address);
			$editinfor->setphone($phone);
  			$editinfor->setidpassport($idpassport);
			$editinfor->setiddate($iddate);
			$editinfor->setidplace($idplace);
			$this->layout();			
			$left = pzk_element('left');
			$left->append($editinfor);
			$this->page->display();
			
			
		
	}
	public function editinforPostAction()
	{
		
		$request = pzk_element('request');
		$name=$request->get('name');
		$birthday=$request->get('birthday');
		$address=$request->get('address');
		$phone=$request->get('phone');
		$idpassport=$request->get('idpassport');
		$iddate=$request->get('iddate');
		$idplace=$request->get('idplace');
		$username= pzk_session('username');
		$editdate = date("Y-m-d H:i:s"); 
		$userId= pzk_session('userId');
		_db()->useCB()->update('user')->set(array('name' => $name,'birthday' => $birthday,'address' => $address,'phone' => $phone,'idpassport' => $idpassport,'iddate' => $iddate,'idplace' => $idplace,'modified'=>$editdate,'modifiedId'=>$userId))->where(array('username',$username))->result();
			$username= pzk_session('username');
			$items = _db()->useCB()->select('user.*')->from('user')->where(array('username',$username))->result_one();
			
			$editinfor = pzk_parse(pzk_app()->getPageUri('user/editinfor'));
			// lấy thông tin cá nhân
			$name= $items['name'];
			$birthday= $items['birthday'];
			$address= $items['address'];
			$phone= $items['phone'];
			$idpassport= $items['idpassport'];
			$iddate= $items['iddate'];
			$idplace= $items['idplace'];
			// Hiển thị thông tin tài khoản
			$editinfor->setname($name);
			$editinfor->setbirthday($birthday);
			$editinfor->setAddress($address);
			$editinfor->setphone($phone);
  			$editinfor->setidpassport($idpassport);
			$editinfor->setiddate($iddate);
			$editinfor->setidplace($idplace);
		
		$this->layout();
		$left=pzk_element('left');
		$left->append($editinfor);
		$this->page->display();
		   
		
	}
	public function editpasswordAction()
	{
			$this->layout();
			$pageUri = $this->getApp()->getPageUri('user/editpassword');
			$page = PzkParser::parse($pageUri);	
			$left = pzk_element('left');
			$left->append($page);
			$this->page->display();
	}
	public function editpasswordPostAction()
	{
		$request = pzk_element('request');
		$oldpassword=md5($request->get('oldpassword'));
		$newpassword=$request->get('newpassword');
		$username= pzk_session('username');
		$items = _db()->useCB()->select('user.*')->from('user')->where(array('and',array('username',$username),array('password',$oldpassword)))->result_one();
		if($items)
		{
			
			$confirmpassword= md5($oldpassword.$newpassword);
			$email=$items['email'];			
			// Update Key
			_db()->useCB()->update('user')->set(array('key' => $confirmpassword))->where(array('username',$username))->result();
			$this->sendMailEditPassword($email,$confirmpassword,$newpassword);
			$editinfor = pzk_parse(pzk_app()->getPageUri('user/showeditpassword'));

		}	
		else
		{
			$editinfor = pzk_parse(pzk_app()->getPageUri('user/showeditpasswordfalse'));
		}	
		
		$this->layout();
		$left=pzk_element('left');
		$left->append($editinfor);
		$this->page->display();
		   
		
	}

	public function sendMailEditPassword($email="",$key="",$newpassword="")
	{
		//tạo URL gửi email xác nhận đăng ký
		$mailtemplate = pzk_parse(pzk_app()->getPageUri('user/mailtemplate/editpassword'));
		$url= "http://".$_SERVER["SERVER_NAME"].'/User/confirmeditpassword';
		$newpassword=md5($newpassword);
		$arr=array('editpassword'=>$key,'conf'=>$newpassword);
		$url= $this->getLink($url,$arr);
		$mailtemplate->setUrl($url);
		$mail = pzk_mailer();
		$mail->AddAddress($email);
		$mail->Subject = 'Thay đổi mật khẩu';
		$mail->Body    = $mailtemplate->getContent();
		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}

	}
	public function showeditpasswordAcction()
	{
			$this->layout();
			$pageUri = $this->getApp()->getPageUri('user/showeditpassword');
			$page = PzkParser::parse($pageUri);	
			$left = pzk_element('left');
			$left->append($page);
			$this->page->display();
	}

	public function confirmeditpasswordAction()
	{
		$request=pzk_element('request');
		
		$confirm=$request->get('editpassword');
		$newpassword=$request->get('conf');
		$username=pzk_session('username');
		$userId= pzk_session('userId');
		$editdate = date("Y-m-d H:i:s");  
		$items = _db()->useCB()->select('user.*')->from('user')->where(array('key', $confirm),array('username',$username))->result_one();
		if($items)
		{			
			//$username=$items['username'];
			_db()->useCB()->update('user')->set(array('password' => $newpassword,'key'=>'','modified'=>$editdate,'modifiedId'=>$items['id']))->where(array('username',$username))->result();
			$editpasswordsuccess = pzk_parse(pzk_app()->getPageUri('user/editpasswordsuccess'));
			$editpasswordsuccess->setUsername("ok");
			$this->layout();
			$left = pzk_element('left');
			$left->append($editpasswordsuccess);
			$this->page->display();
		}
		else
		{
			$editpasswordsuccess = pzk_parse(pzk_app()->getPageUri('/user/editpasswordsuccess'));
			$editpasswordsuccess->setUsername("");
			$this->layout();
			$left = pzk_element('left');
			$left->append($editpasswordsuccess);
			$this->page->display();			

		}
	}
	
	public function editpasswordsuccessAction()
	{
			$this->layout();
			$pageUri = $this->getApp()->getPageUri('/user/editpasswordsuccess');
			$page = PzkParser::parse($pageUri);	
			$left = pzk_element('left');
			$left->append($page);
			$this->page->display();
	}
	public function editsignAction()
	{
			$username=pzk_session('username');
			$items=_db()->useCB()->select('user.*')->from('user')->where(array('username',$username))->result_one();
			$sign=$items['sign'];
			$this->layout();
			$editsign = pzk_parse(pzk_app()->getPageUri('/user/editsign'));

			$editsign->setSign($sign);
			$left = pzk_element('left');
			$left->append($editsign);
			$this->page->display();
	}
	public function editsignPostAction()
	{
			$username=pzk_session('username');
			$request = pzk_element('request');				
			$newsign=$request->get('newsign');
			$editdate = date("Y-m-d H:i:s"); 
			$userId= pzk_session('userId');
			_db()->useCB()->update('user')->set(array('sign'=>$newsign,'modified'=>$editdate,'modifiedId'=>$userId))->where(array('username',$username))->result();
			$items=_db()->useCB()->select('user.*')->from('user')->where(array('username',$username))->result_one();
			$sign=$items['sign'];
			$this->layout();
			$editsign = pzk_parse(pzk_app()->getPageUri('user/editsign'));
			$editsign->setSign($sign);
			$left = pzk_element('left');
			$left->append($editsign);
			$this->page->display();
	}
	// Function hiển thị thông tin cá nhân của user
	public function profileuserAction()
	{
		$this->layout();		
		$profileuser = $this->parse('user/profileuser');
		$this->append('user/profileuser', 'right');
		$this->page->display();
			
	}
}