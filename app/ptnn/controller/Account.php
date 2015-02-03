<?php 
class PzkAccountController extends PzkController 
{
	public $masterPage='index';
	public $masterPosition='left';
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
		$url= "http://".$_SERVER["SERVER_NAME"].'/Account/activeRegister';
		$strConfirm = $password.$email.$username;
		$confirm= md5($strConfirm);
		$user=_db()->getEntity('user.account.user');
		$user->loadWhere(array('username',$username));
		//var_dump($user->getId());
		$user->update(array('key' => $confirm));
		//_db()->useCB()->update('user')->set(array('key' => $confirm))->where(array('username',$username))->result();
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
	public function userAction()
	{
			$this->layout();
					
			$this->display();
	
	}
	public function loginAction() 
	{
		
		if(pzk_session('login'))
		{
			$ip="192.168.1.2";
			pzk_session('ipdress','hellosss');
		}
		else
		{
			
			$this->render('user/account/login');
			
		}
	}
	// Xử lý đăng nhập
	public function loginPostAction()
	{
		if($_SERVER['HTTP_REFERER']!="http://nextnobels.vn/User_Account/loginPost")
		{
			pzk_session('referer_url',$_SERVER['HTTP_REFERER']);
		}
		//$referer_url= $_SERVER['HTTP_REFERER'];
		
		if(pzk_session('login'))
		{
			header('location: /home');
		}
		$error="";
		$request = pzk_element('request');
		// Đăng nhập bằng form user
		$password=md5($request->get('userpassword'));
		$username=$request->get('userlogin');
		$submitlogin=$request->get('submitlogin');
		// Đăng nhập bằng form login
		if($request->get('passwordlogin') !="" || $request->get('login') !="")
		{
			$password=md5($request->get('passwordlogin'));
			$username=$request->get('login');
		}
		if($username !="")
		{
			$user=_db()->getEntity('user.account.user');
			$user->loadWhere(array('username',$username));
		
		if($user->getId())
		{
			$userId= $user->getId();
			$name= $user->getName();
			$pass= $user->getPassword();
			$status=$user->getStatus();
			$avatar=$user->getAvatar();
			if($pass==$password)
			{
				if($status==1)
				{
					pzk_session('login', true);
					pzk_session('username', $username);
					pzk_session('userId',$userId);
					pzk_session('name',$name);
					pzk_session('avatar',$avatar);
					$datelogin=date("Y-m-d H:i:s");
					$user->update(array('lastlogined' =>$datelogin ));
					$referer_url=pzk_session('referer_url');
					pzk_session('referer_url',false);
					header('location:'.$referer_url);
				
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
		}else $error="Bạn phải nhập đầy đủ tên đăng nhập và mật khẩu";
			
			pzk_notifier_add_message($error, 'danger');		
			$this->render('user/account/login');
		}
	// Đăng xuất 
	public function logoutAction(){
		pzk_session('login',false);

		pzk_session('username',false);
		pzk_session('userId',false);
		//$this->redirect('/home');
		header('location:/home');
	}
// Đăng ký tài khoản
	public function registerAction()
	{
		//$this->render('user/account/register');
		$this->layout();
		$this->append('user/account/register','left');
		$this->display();
	}
	public function registerPostAction()
	{	
		$error="";	
		$request=pzk_element('request');
		$username=$request->get('username');
		$email=$request->get('email');
		$captcha= $request->get('captcha');
		$user=_db()->getEntity('user.account.user');
		if($captcha==$_SESSION['security_code'])
		{
			//$testUser= _db()->useCB()->select('username')->from('user')->where(array('equal','username',$request->get('username')))->result();
			$testUser=$user->loadWhere(array('username',$username));
			if($testUser->getId())
			{
				
				$error="Tên đăng nhập đã tồn tại trên hệ thống";
			}
			else
			{	
				$testEmail= $user->loadWhere(array('email',$email));
				if($testEmail->getId())
				{
					$error= "Email đã tồn tại trên hệ thống";
				}
				else
				{
					$name= $request->get('name');
					$password=$request->get('password1');
					$birthday= $request->get('birthday');
					$sex= $request->get('sex');
					$address= $request->get('address');
					$phone= $request->get('phone');
					$idpassport= $request->get('idpassport');
					$iddate= $request->get('iddate');
					$idplace= $request->get('idplace');
					$dateregister=date("Y-m-d H:i:s"); 
					$rowRegister= array('username' =>$username,'password'=>md5($password),'email'=>$email,'name'=>$name,'birthday'=>$birthday,'sex'=>$sex,'address'=>$address,'phone'=>$phone,'idpassport'=>$idpassport,'idplace'=>$idplace,'registered'=>$dateregister);
					$user->setData($rowRegister);
					$user->save();
					//_db()->useCB()->insert('user')->fields('username,password,email,name,birthday,sex,address,phone,idpassport,idplace,iddate,registered')->values(array($rowRegister))->result();
					$this->sendMail($username,$password,$email);
					// Hiển thị layout showregister
					$this->render('user/account/showregister');
				}
			}

		}
		else
		{
			$error="Mã bảo mật chưa đúng";

		}
		pzk_notifier_add_message($error, 'danger');
		$this->render('user/account/register');
		
	}
	// Hiển thị thông báo sau khi đăng ký tài khoản
	public function showregisterAction()
	{
		$this->render('user/account/showregister');
	}
	public function activeregisterAction()
	{
		$request=pzk_element('request');
		$confirm=$request->get('active');
		$user=_db()->getEntity('user.account.user');
		$items=$user->loadWhere(array('key', $confirm));
		if($items->getId())
		{	
			$username=$items->getUsername();
			$userId=$items->getId();
			$name=$items->getName();
			$user->update(array('status' => 1,'key'=>""));
			$wallets=_db()->getEntity('user.account.wallets');
			
			$rowWallets = array('username' =>$username,'amount'=>0);
			$wallets->setData($rowWallets);
			$wallets->save();
			pzk_session('login', true);
			//pzk_session('username',$items->getUsername());
			pzk_session('username',$username);
			pzk_session('userId',$userId);
			pzk_session('name',$name);
			$confirmRegister = pzk_parse(pzk_app()->getPageUri('user/account/registersuccess'));
			$confirmRegister->setMessage('ok');
			$this->render($confirmRegister);

		
		}
		else

		{
			$confirmRegister = pzk_parse(pzk_app()->getPageUri('user/account/registersuccess'));
			$confirmRegister->setMessage('fail');
			$this->render($confirmRegister);
		}

	}
	// Hiển thị thông báo đăng ký thành công sau khi đã kích hoạt tài khoản
	public function registersuccesAction() 
		{
		
			$this->layout('user/account/registersuccess');
		}
		// Gửi email quên mật khẩu
	public function sendMailForgotpassword($email="",$password="") {
		
		//tạo URL gửi email xác nhận đăng ký
		$url= "http://".$_SERVER["SERVER_NAME"].'/Account/sendPassword';
		
		$strConfirm = $email.$password;
		$confirm= md5($strConfirm);
		$mailtemplate = pzk_parse(pzk_app()->getPageUri('user/mailtemplate/forgotpassword'));
		$user=_db()->getEntity('user.account.user');
		$user->loadWhere(array('and',array('email',$email),array('status',1)));	
		$user->update(array('key' => $confirm));
		//_db()->useCB()->update('user')->set(array('key' => $confirm))->where(array('username',$username))->result();
		//_db()->useCB()->update('user')->set(array('key' => $confirm))->where(array('and',array('email',$email),array('status',1)))->result();
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
		$this->render('user/account/forgotpassword');
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
			
			$user=_db()->getEntity('user.account.user');
			$user->loadWhere(array('email',$email));
			if($user->getId())
			{
				if($user->getStatus()==1)
				{
					$password=$user->getPassword();
					$this->sendMailForgotpassword($email,$password);
					$this->render('user/account/showforgotpassword');
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
		pzk_notifier_add_message($error, 'danger');
		$this->render('user/account/forgotpassword');
	}
	public function showforgotpasswordAction()
	{
		$this->render('user/account/showforgotpassword');
	}
	//Gửi lại mật khẩu
	public function sendPasswordAction()
	{
		$request=pzk_element('request');
		$confirm=$request->get('forgotpassword');
		//$items = _db()->useCB()->select('user.*')->from('user')->where(array('key', $confirm))->result_one();
		$user=_db()->getEntity('user.account.user');
		$user->loadWhere(array('key', $confirm));
		if($user->getId())
		{
			$password=md5(rand(0,9999999999).$user->getPassword());
			$password=substr($password,0,8);
			$password=$password.'AH1';
			$updatepassword=md5($password);
			$updatepassword=$updatepassword;
			$username=$user->getUsername();
			$user->update(array('password' => $updatepassword,'key'=>''));
			//_db()->useCB()->update('user')->set(array('password' => $updatepassword,'key'=>''))->where(array('and',array('username',$username),array('status',1)))->result();
			$newpassword = pzk_parse(pzk_app()->getPageUri('user/account/newpassword'));
			$newpassword->setUsername($username);
			$newpassword->setPassword($password);
			$this->render($newpassword);
		
		}
		else
		{
			$newpassword = pzk_parse(pzk_app()->getPageUri('user/account/newpassword'));
			$newpassword->setUsername("");
			$this->render($newpassword);
			
		}
	}
	// Hiển thị password mới
	public function newpasswordAction() 
	{
		$this->render('user/account/newpassword');
	
	}
}
 ?>