<?php 
class PzkAccountController extends  PzkController
{
	public $masterPage='index';
	public $masterPosition='left';
	const CONTROLLER_HOME = 'home/index';
	const CONTROLLER_HOME_WELCOME = 'home/index';
	
	const PAGE_LOGIN = 'user/account/login';
	const LOGIN_ERROR_NOTACTIVATED = 0;
	const LOGIN_ERROR_WRONG_PASSWORD = 1;
	const LOGIN_ERROR_WRONG_USERNAME = 2;
	const LOGIN_ERROR_MISSING_USERNAME_OR_PASSWORD = 3;
	const LOGIN_SUCCESS = -1;
	
	const PAGE_LOGIN_FACEBOOK = 'user/account/loginfacebook';
	const PAGE_LOGIN_GOOGLE = 'user/account/logingoogle';
	
	const PAGE_REGISTER = 'user/account/register';
	const REGISTER_ERROR_USERNAME_EXISTED = -1;
	const REGISTER_ERROR_EMAIL_EXISTED = 0;
	const REGISTER_ERROR_WRONG_CAPTCHA = 2;
	const REGISTER_SUCCESS = 1;
	
	const PAGE_REGISTER_SUCCESS = 'user/account/showregister';
	const PAGE_REGISTER_ACTIVATED_SUCCESS = 'user/account/registersuccess';
	
	const PAGE_FORGOT_PASSWORD = 'user/account/forgotpassword';
	const FORGOT_PASSWORD_ERROR_NOTACTIVATED_ACCOUNT = "Tài khoản của bạn đang bị khóa hoặc chưa kích hoạt";
	const FORGOT_PASSWORD_ERROR_EMAIL_NOT_REGISTERED "Email của bạn chưa đăng ký tài khoản";
	const FORGOT_PASSWORD_ERROR_WRONG_CAPTCHA = "Mã bảo mật chưa đúng";
	
	const PAGE_RESET_PASSWORD = 'user/account/newpassword';
	const PAGE_FORGOT_PASSWORD_SUCCESS = 'user/account/showforgotpassword'; // forgot password success
	
	const MAIL_TEMPLATE_FORGOT_PASSWORD = 'user/mailtemplate/forgotpassword';
	const MAIL_TEMPLATE_REGISTER = 'user/mailtemplate/register';
	
	public function loginAction() 
	{
		
		if(pzk_session()->getLogin()){
			
			$this->redirect(self::CONTROLLER_HOME);
		}
		else{
			
			$this->render(self::PAGE_LOGIN);
		}
	}
	
	// Xử lý đăng nhập
	public function loginPostAction()
	{
		
		if(pzk_session()->getLogin()){
			$this->redirect(self::CONTROLLER_HOME);
		}
		$error="";
		$request = pzk_request();
		
		// Đăng nhập bằng form user
		$password=md5($request->getUserpassword());
		$username=$request->getUserlogin();
		
		// Đăng nhập bằng form login
		if($request->getPasswordlogin() !="" || $request->getLogin() !="") {
			
			$password=md5($request->getPasswordlogin());
			$username=$request->getLogin();
		}

		// Đăng nhập bằng facebook

		//end đăng nhập bằng facebook

		if($username !="") {

			$user=_db()->getEntity('user.account.user');
			$user->loadByUsername($username);
		
			if($user->getId()) {
				if($pass==$password) {
					if($status==1) {
						$user->login();
						$error = self::LOGIN_SUCCESS;
					}else {
						
						//$error="tài khoản của bạn đăng bị khóa hoặc chưa kích hoạt";
						$error = self::LOGIN_ERROR_NOTACTIVATED;
					}
				}else {
					
					//$error="Mật khẩu đăng nhập chưa đúng";
					$error = self::LOGIN_ERROR_WRONG_PASSWORD;
				}
			}else {
			
				//$error="Tên đăng nhập chưa đúng";
				$error = self::LOGIN_ERROR_WRONG_USERNAME;
			}
		}else {
			
			//$error="Bạn phải nhập đầy đủ tên đăng nhập và mật khẩu";
			$error = self::LOGIN_ERROR_MISSING_USERNAME_OR_PASSWORD;
		}
		echo $error;
		//pzk_notifier_add_message($error, 'danger');		
		//$this->render('user/account/login');
	}
	
	// Đăng xuất 
	public function logoutAction(){
		pzk_user()->logout();
		$this->redirect(self::CONTROLLER_HOME_WELCOME);
	}
	
	// Đăng ký tài khoản
	public function registerAction()
	{
		$this->render(PAGE_REGISTER);
	}
	
	public function registerPostAction()
	{	
		$error ="";	
		$request=pzk_request();
		$username=$request->getUsername();
		$email=$request->getEmail();
		$captcha= $request->getCaptcha();
		$user=_db()->getEntity('user.account.user');
		if($captcha==$_SESSION['security_code']) {
			
			$user->loadByUsername($username);
			if($user->getId()) {
				
				//$error="Tên đăng nhập đã tồn tại trên hệ thống";
				$error = self::REGISTER_ERROR_USERNAME_EXISTED; //-1
			} else {
				
				$user->loadByEmail($email);
				if($user->getId()) {
					
					//$error= "Email đã tồn tại trên hệ thống";
					$error = self::REGISTER_ERROR_EMAIL_EXISTED;
				}else {
					
					$name= $request->getName();
					$password=$request->getPassword1();
					$birthday= $request->getBirthday();
					$sex= $request->getSex();
					//$address= $request->get('address');
					$phone= $request->getPhone();
					//$idpassport= $request->get('idpassport');
					//$iddate= $request->get('iddate');
					//$idplace= $request->get('idplace');
					$dateregister=date("Y-m-d H:i:s"); 
					$rowRegister= array(
						'username' => $username, 
						'password'=>md5($password),
						'email'=>$email,
						'name'=>$name,
						'birthday'=>$birthday,
						'sex'=>$sex,
						'address'=>'',
						'phone'=>$phone,
						'idpassport'=>'',
						'idplace'=>'',
						'registered'=>$dateregister
					);
					$user->setData($rowRegister);
					$user->save();
					/*
					// Em Tien: Chuyen thong tin member dang ky sang forum
					$addForum=array('username' =>$username,'email'=>$email,'register_date'=>$dateregister,'gender'=>$sex,'language_id'=>1,'style_id'=>0,'visible'=>1,'activity_visible'=>1,'user_group_id'=>2,'user_state'=>'valid','is_staff'=>1);
					$entity = _db()->useCb()->getEntity('table')->setTable('xf_user');
					$entity->setData($addForum);
					$entity->save();
					// Em Tien: Chuyen mat khau member dang ky sang forum
					//$hash = hash('sha256', hash('sha256',$password.$salt));
					//$addPass=array('remember_key' =>sha256(sha256($password) . salt));
					//$entity = _db()->useCb()->getEntity('table')->setTable('xf_user_authenticate');
					//$entity->setData($addPass);
					//$entity->save();
					*/
					//_db()->useCB()->insert('user')->fields('username,password,email,name,birthday,sex,address,phone,idpassport,idplace,iddate,registered')->values(array($rowRegister))->result();
					
					$this->sendMail($username,$password,$email);
					// Hiển thị layout showregister
					//$this->render('user/account/showregister');
					
					//$error = "Bạn vui lòng đăng nhập vào email để kích hoạt tài khoản đăng ký trên website";
					$error = self::REGISTER_SUCCESS;//1
				}
			}
		}else {
			
			//$error = "Mã bảo mật chưa đúng";
			$error = self::REGISTER_ERROR_WRONG_CAPTCHA;//2
		}
		echo $error;
	}
	
	// Hiển thị thông báo sau khi đăng ký tài khoản
	public function showregisterAction()
	{
		$this->render(self::PAGE_REGISTER_SUCCESS);
	}
	
	public function activeregisterAction()
	{
		$request=pzk_request();
		$confirm=$request->getActive();
		$user=_db()->getEntity('user.account.user');
		$user->loadByKey($confirm);
		if($user->getId())
		{	
			$user->activate();
			$user->login();
			$confirmRegister = $this->parse(self::PAGE_REGISTER_ACTIVATED_SUCCESS);
			$confirmRegister->setMessage('ok');
			$this->render($confirmRegister);
		}
		else
		{
			$confirmRegister = $this->parse(self::PAGE_REGISTER_ACTIVATED_SUCCESS);
			$confirmRegister->setMessage('fail');
			$this->render($confirmRegister);
		}
	}
	
	// Hiển thị thông báo đăng ký thành công sau khi đã kích hoạt tài khoản
	public function registersuccesAction() 
	{
		$this->render(self::PAGE_REGISTER_SUCCESS);
	}
	
	// Hiển thị form quên mật khẩu
	public function forgotpasswordAction()
	{
		$this->render(self::PAGE_FORGOT_PASSWORD);
	}	
	
	// Xử lý lấy lại mật khẩu
	public function forgotpasswordPostAction()
	{
		$error="";
		$request = pzk_request();
		$email= $request->getEmail();
		$captcha= $request->getCaptcha();
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
					return $this->render(self::PAGE_FORGOT_PASSWORD_SUCCESS);
				}
				else
				{
					$error= self::FORGOT_PASSWORD_ERROR_NOTACTIVATED_ACCOUNT;
				}
			
			}else
			{
				$error=self::FORGOT_PASSWORD_ERROR_EMAIL_NOT_REGISTERED;
			}
		}
		else
		{
			$error=self::FORGOT_PASSWORD_ERROR_WRONG_CAPTCHA;
		}
		pzk_notifier_add_message($error, 'danger');
		$this->render(self::PAGE_FORGOT_PASSWORD);
	}
	
	public function showforgotpasswordAction()
	{
		$this->render(self::PAGE_FORGOT_PASSWORD_SUCCESS);
	}
	
	//Gửi lại mật khẩu
	public function sendPasswordAction()
	{
		$request = pzk_request();
		$confirm = $request->getForgotpassword();
		$user = _db()->getEntity('user.account.user');
		$user->loadByKey($confirm);
		if($user->getId())
		{
			$password = $user->resetPasssword()
			$newpassword = $this->parse(self::PAGE_RESET_PASSWORD);
			$newpassword->setUsername($username);
			$newpassword->setPassword($password);
			$this->render($newpassword);
		
		}
		else
		{
			$newpassword = $this->parse(self::PAGE_RESET_PASSWORD);
			$newpassword->setUsername("");
			$this->render($newpassword);
			
		}
	}
	
	// Hiển thị password mới
	public function newpasswordAction() 
	{
		$this->render(self::PAGE_RESET_PASSWORD);
	}
	
	public function loginfacebookAction() 
	{
		$this->render(self::PAGE_LOGIN_FACEBOOK);
	}
	
	public function logingoogleAction() 
	{
		$this->render(self::PAGE_LOGIN_GOOGLE);
	}
	
	// Gửi email kích hoạt tài khoản
	public function sendMail($username="",$password="",$email="") {
		
		$confirm= md5($password.$email.$username);
		$user=_db()->getEntity('user.account.user')->loadWhere(array('username', $username));
		$user->update(array('key' => $confirm));
		
		$arr=array('active' => $confirm);
		//tạo URL gửi email xác nhận đăng ký
		$url= 'Account/activeRegister';
		$url= pzk_request()->build($url,$arr);
		
		$mailtemplate = $this->parse(self::MAIL_TEMPLATE_REGISTER);
		$mailtemplate->setUsername($username);
		$mailtemplate->setUrl($url);
		$mail = pzk_mailer();
		$mail->AddAddress($email);
		$mail->Subject = 'Xác nhận đăng ký tài khoản';
		$mail->Body    = $mailtemplate->getContent();

		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	}
	
	// Gửi email quên mật khẩu
	public function sendMailForgotpassword($email="",$password="") {
		$strConfirm = $email.$password;
		$confirm = md5($strConfirm);
		$mailtemplate = $this->parse(self::MAIL_TEMPLATE_FORGOT_PASSWORD);
		$user = _db()->getEntity('user.account.user');
		$user->loadWhere(array('and',array('email',$email),array('status',1)));	
		$user->update(array('key' => $confirm));
		
		$request=pzk_request();
		//tạo URL gửi email xác nhận đăng ký
		$url= 'Account/sendPassword';
		$url= $request->build($url, array('forgotpassword'=>$confirm));
		$mailtemplate->setUrl($url);
		$mail = pzk_mailer();
		$mail->AddAddress($email);
		$mail->Subject = 'Quên mật khẩu';
		$mail->Body    = $mailtemplate->getContent();
		
		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	}
}
 ?>