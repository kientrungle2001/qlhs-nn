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
		$user=_db()->getEntity('user.user');
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
	// Hiển thị tài khoản trên header
	public function userAction()
	{
			$this->layout();
					
			$this->display();
	
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
		$error="";	
		$request=pzk_element('request');
		$username=$request->get('username');
		$email=$request->get('email');
		$captcha= $request->get('captcha');
		$user=_db()->getEntity('user.user');
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

		$user=_db()->getEntity('user.user');
		$items=$user->loadWhere(array('key', $confirm));
		
		//$items = _db()->useCB()->select('user.*')->from('user')->where(array('key', $confirm))->result_one();
		if($items->getId())
		{	
			
			$user->update(array('status' => 1,'key'=>""));
			$wallets=_db()->getEntity('user.wallets');
			$username=$items->getUsername();
			$rowWallets = array('username' =>$username,'amount'=>0);
			$wallets->setData($rowWallets);
			$wallets->save();
			//$itemWallets= _db()->useCB()->insert('wallets')->fields('username,amount')->values(array($rowWallets))->result();
			pzk_session('login', true);
			pzk_session('username',$items->getUsername());
			pzk_session('userId',$items->getId());
			pzk_session('name',$items->getName());
			$active = pzk_parse(pzk_app()->getPageUri('user/registersuccess'));

			$this->layout();
			$left = pzk_element('left');
			$left->append($active);
			$this->page->display();

		}
		else

		{
			pzk_session('username',"");
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
		if($_SERVER['HTTP_REFERER']!="http://ptnn.vn/User/loginPost")
		{
			pzk_session('referer_url',$_SERVER['HTTP_REFERER']);
		}
		//$referer_url= $_SERVER['HTTP_REFERER'];
		
		if(pzk_session('login'))
		{
			header('location: /home');
		}
		$error="";
		$path=$_SERVER['HTTP_REFERER'];

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
			$items = _db()->useCB()->select('user.*')->from('user')->where( array('equal', 'username',$username))->result_one();
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
					pzk_session('username', $username);
					pzk_session('userId',$items['id']);
					pzk_session('name',$items['name']);
					$datelogin=date("Y-m-d H:i:s");    
					_db()->useCB()->update('user')->set(array('lastlogined' =>$datelogin ))->where(array('username',$items['username']))->result();
					$referer_url=pzk_session('referer_url');
					pzk_session('referer_url',false);
					header('location:'.$referer_url);
					
					die();	
					//header('location:http://'.$_SERVER['SERVER_NAME']);	
				}else
				{
					//tài khoản của bạn đăng bị khóa hoặc chưa kích hoạt
					$error="tài khoản của bạn đăng bị khóa hoặc chưa kích hoạt";
				}
			}else 
				{
					//Mật khẩu đăng nhập chưa đúng
					$error="Mật khẩu đăng nhập chưa đúng";
					//echo "mật khẩu database:".$items['password'];
					//echo "mật khẩu nhập vào ".$password;
					//echo "mã hóa ".md5(md5("Nghiak4bcntt"));


				}
		}else
		{
			$error="Tên đăng nhập chưa đúng";
		}
		}else $error="Bạn phải nhập đầy đủ tên đăng nhập và mật khẩu";
					
			$this->layout();
			
			$pageUri = $this->getApp()->getPageUri('user/login');
		    $pageLogin = PzkParser::parse($pageUri);
		    $left=pzk_element('left');
		    $left->append($pageLogin);
		    pzk_notifier_add_message($error, 'danger');
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
		pzk_notifier_add_message($error, 'danger');
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
	public function editavataAction()
	{
		$this->layout();		
		$editavata = pzk_parse(pzk_app()->getPageUri('user/editavata'));
		$left = pzk_element('left');
		$left->append($editavata);
		$this->page->display();
	}
	public function editavatasuccessAction()
	{
		$this->layout();		
		$editavatasuccess = pzk_parse(pzk_app()->getPageUri('user/editavatasuccess'));
		$left = pzk_element('left');
		$left->append($editavatasuccess);
		$this->page->display();
	}
	public function editavataPostAction()
	{
		$error="";
		$target_dir = "C:/wamp/www/qlhs/3rdparty/uploads/images/";
		$basename= basename($_FILES["fileToUpload"]["name"]);
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$size =$_FILES["fileToUpload"]["size"];
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !==false)
		{
			if($size < 500000)
			{
				if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"|| $imageFileType == "gif"|| $imageFileType == "JPG" || $imageFileType == "PNG" || $imageFileType == "JPEG" || $imageFileType == "GIF")
				{
					// Kiểm tra nếu tên file ảnh đã có trong thư mục thì đổi tên
					if(file_exists($target_file))
					{
						$add=md5(rand(0,200000));
   						$target_file=$target_dir .$add.basename($_FILES["fileToUpload"]["name"]);
					}
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
					{
						// Upload thành công
						//insert đường dẫn file vào database
						$username= pzk_session('username');
						$userId= pzk_session('userId');
						$editdate=date("Y-m-d H:i:s");
						//$avata=$target_file;
						$avata='http://'.$_SERVER['SERVER_NAME'].'/3rdparty/uploads/images/'.$basename;
						_db()->useCB()->update('user')->set(array('avata'=>$avata,'modified'=>$editdate,'modifiedId'=>$userId))->where(array('username',$username))->result();
						$this->layout();		
						$editavata = pzk_parse(pzk_app()->getPageUri('user/editavata'));
						$left = pzk_element('left');
						$left->append($editavata);
						$this->page->display();
					}
				}
				else
				{
					$error="Bạn chỉ được phép upload file ảnh JPG, JPEG, PNG, GIF";
				}
			}
			else
			{
				$error="Dung lượng của file ảnh quá lớn, bạn hãy chọn file ảnh có kích thước < 488kb ";
			}
		}
		else
		{
			$error="Bạn chỉ được phép upload file ảnh JPG, JPEG, PNG, GIF";
		}
		// hiển thị thành công
		$this->layout();		
		$editavata = pzk_parse(pzk_app()->getPageUri('user/editavata'));
		
		pzk_notifier_add_message($error, 'danger');
		$left = pzk_element('left');
		$left->append($editavata);
		$this->page->display();
	}
	public function editavataPost1Action()
	{
		$request=pzk_element('request');
		$fileToUpload= $request->get('fileToUpload');
		//$fileToUpload= $request->get('test');
		echo $fileToUpload;
		die();
		$target_dir = "C:/wamp/www/qlhs/3rdparty/uploads/images/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 0;
		$message="";
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Kiểm tra xem có phải là file ảnh ko?
    	$check = getimagesize($fileToUpload);
    	// Nếu là file ảnh
    	if($check !== false)
    	{	
    		echo "file ảnh đây ";
    		die();
    		// Chỉ chấp nhận file ảnh .jpg, npg, jpeg
    		if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"|| $imageFileType == "gif" ) 
    		{
    			// Dung lượng file ảnh phải <500.000byte hoặc 488kb
    			if ($_FILES["fileToUpload"]["size"] < 500000)
    			{
    				$uploadOk = 1;
    				//Ok
    			}else
    			{
    				$message=" Dung lượng file ảnh quá lớn, bạn hãy chọn file ảnh có kích thước < 488 kb";
    			} 
    		}
    		else
    		{
    			// Không phải là file .jpg, png, jpeg
    			$message= "Bạn chỉ được phép upload file ảnh .JPG, JPEG, PNG, GIF";
    		}
    		// File ảnh up lên đã thỏa mãn điều kiện
    		if($uploadOk == 1)
    		{
    			// Kiểm tra nếu tên file ảnh đã tồn tại trong thư mục thì đổi tên
    			if (file_exists($target_file)) 
				{
    				// Trường hợp tên file đã tồn tại thì đổi tên
    				$add=md5(rand(0,200000));
    				$target_file=$add.$target_file;
    			}
    			//copy ảnh vào file upload
    			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
    			{
        			$message="Bạn đã thay đổi avata thành công";
        		}
    		}
    	}
    	$this->layout();		
		$editavata = pzk_parse(pzk_app()->getPageUri('user/editavata'));
		$editavata->setMessage($message);

		$left = pzk_element('left');
		$left->append($editavata);
		$this->page->display();
	}
	public function paymentAction()
	{
		$this->layout();		
		$payment = $this->parse('user/payment/payment');
		$this->append('user/payment/payment', 'left');
		$this->page->display();		
	}
	public function buildCheckoutUrl($return_url, $receiver, $transaction_info, $order_code, $price)
	{

		//$nganluong_url = 'https://www.nganluong.vn/checkout.php';
		$nganluong_url = 'http://nextnobels.vn/user/confirmpayment.php';
	
		// Mã website của bạn đăng ký trong chức năng tích hợp thanh toán của NgânLượng.vn.
		$merchant_site_code = '17185'; //100001 chỉ là ví dụ, bạn hãy thay bằng mã của bạn

		// Mật khẩu giao tiếp giữa website của bạn và NgânLượng.vn.
		$secure_pass= '123456789'; //d685739bf1 chỉ là ví dụ, bạn hãy thay bằng mật khẩu của bạn
		// Nếu bạn thay đổi mật khẩu giao tiếp trong quản trị website của chức năng tích hợp thanh toán trên NgânLượng.vn, vui lòng update lại mật khẩu này trên website của bạn
	
		$affiliate_code = ''; 
		// Bước 1. Mảng các tham số chuyển tới nganluong.vn
		$arr_param = array(
			'merchant_site_code'=>	strval($merchant_site_code),
			'return_url'		=>	strtolower(urlencode($return_url)),
			'receiver'			=>	strval($receiver),
			'transaction_info'	=>	strval($transaction_info),
			'order_code'		=>	strval($order_code),
			'price'				=>	strval($price)					
		);
		$secure_code ='';
		$secure_code = implode(' ', $arr_param) . ' ' . $secure_pass;
		$arr_param['secure_code'] = md5($secure_code);
		
		/* Bước 2. Kiểm tra  biến $redirect_url xem có '?' không, nếu không có thì bổ sung vào*/
		$redirect_url = $nganluong_url;
		if (strpos($redirect_url, '?') === false)
		{
			$redirect_url .= '?';
		}
		else if (substr($redirect_url, strlen($redirect_url)-1, 1) != '?' && strpos($redirect_url, '&') === false)
		{
			// Nếu biến $redirect_url có '?' nhưng không kết thúc bằng '?' và có chứa dấu '&' thì bổ sung vào cuối
			$redirect_url .= '&';			
		}
				
		/* Bước 3. tạo url*/
		$url = '';
		foreach ($arr_param as $key=>$value)
		{
			if ($key != 'return_url') $value = urlencode($value);
			
			if ($url == '')
				$url .= $key . '=' . $value;
			else
				$url .= '&' . $key . '=' . $value;
		}
		
		return $redirect_url.$url;
	}
	public function verifyPaymentNL($transaction_info, $order_code, $price, $payment_id, $payment_type, $error_text, $secure_code)
	{
		$merchant_site_code = '17185'; //100001 chỉ là ví dụ, bạn hãy thay bằng mã của bạn

		// Mật khẩu giao tiếp giữa website của bạn và NgânLượng.vn.
		$secure_pass= '123456789'; 
		$str = '';
		$str .= ' ' . strval($transaction_info);
		$str .= ' ' . strval($order_code);
		$str .= ' ' . strval($price);
		$str .= ' ' . strval($payment_id);
		$str .= ' ' . strval($payment_type);
		$str .= ' ' . strval($error_text);
		$str .= ' ' . strval($merchant_site_code);
		$str .= ' ' . strval($secure_pass);

        // Mã hóa các tham số
		$verify_secure_code = '';
		$verify_secure_code = md5($str);
		
		// Xác thực mã của chủ web với mã trả về từ nganluong.vn
		if ($verify_secure_code === $secure_code) return true;
		else return false;
	}


	public function paymentPostAction()
	{
		$request=pzk_element('request');
		$price=$request->get('amount');
		$payment=$request->get('payment');
		if($payment=='nganluong')
		{
			$return_url="http://nextnobels.vn/user/payment/confirmpayment.php";
			$receiver="kieunghia.cntt@gmail.com";
			$transaction_info="Nạp tiền qua Ngân Lượng";
			$order_code=pzk_session('username');
			
			$url=$this->buildCheckoutUrl($return_url, $receiver, $transaction_info, $order_code, $price);
			header('location:'.$url);
		}
		if($payment=='baokim')
		{
			require(BASE_DIR.'/3rdparty/nganluong/include/nganluong.microcheckout.class.php');
			require(BASE_DIR.'/3rdparty/nganluong/include/lib/nusoap.php');
			require(BASE_DIR.'/3rdparty/nganluong/config.php');
		$inputs = array(
		'receiver'		=> RECEIVER,
		'order_code'	=> 'DH-'.date('His-dmY'),
		'return_url'	=> '',
		'cancel_url'	=> '',
		'language'		=> 'vn'
	);
	$link_checkout = '';
	$obj = new NL_MicroCheckout(MERCHANT_ID, MERCHANT_PASS, URL_WS);
	$result = $obj->setExpressCheckoutDeposit($inputs);
	if ($result != false) {
		if ($result['result_code'] == '00') {
			$link_checkout = $result['link_checkout'];
			$link_checkout = str_replace('micro_checkout.php?token=', 'index.php?portal=checkout&page=micro_checkout&token_code=', $link_checkout);
			$link_checkout .='&payment_option=nganluong';
			header('location:'.$link_checkout);
			//die($link_checkout);
		} else {
			die('Ma loi '.$result['result_code'].' ('.$result['result_description'].') ');
		}
	} else {
		die('Loi ket noi toi cong thanh toan ngan luong');
	}
	
			
		}
		if($payment=='thecao')
		{

		}
	
	}
	// Nạp thẻ cào qua Ngân Lương
	// Get error code
	public function GetErrorMessage($error_code) 
	{
		$arrCode = array(
				   '00'=>  'Giao dịch thành công',
				   '99'=>  'Lỗi, tuy nhiên lỗi chưa được định nghĩa hoặc chưa xác định được nguyên nhân',
				   '01'=>  'Lỗi, địa chỉ IP truy cập API của NgânLượng.vn bị từ chối',
				   '02'=>  'Lỗi, tham số gửi từ merchant tới NgânLượng.vn chưa chính xác (thường sai tên tham số hoặc thiếu tham số)',
				   '03'=>  'Lỗi, Mã merchant không tồn tại hoặc merchant đang bị khóa kết nối tới NgânLượng.vn',
				   '04'=>  'Lỗi, Mã checksum không chính xác (lỗi này thường xảy ra khi mật khẩu giao tiếp giữa merchant và NgânLượng.vn không chính xác, hoặc cách sắp xếp các tham số trong biến params không đúng)',
				   '05'=>  'Tài khoản nhận tiền nạp của merchant không tồn tại',
				   '06'=>  'Tài khoản nhận tiền nạp của merchant đang bị khóa hoặc bị phong tỏa, không thể thực hiện được giao dịch nạp tiền',
				   '07'=>  'Thẻ đã được sử dụng ',
				   '08'=>  'Thẻ bị khóa',
				   '09'=>  'Thẻ hết hạn sử dụng',
				   '10'=>  'Thẻ chưa được kích hoạt hoặc không tồn tại',
				   '11'=>  'Mã thẻ sai định dạng',
				   '12'=>  'Sai số serial của thẻ',
				   '13'=>  'Mã thẻ và số serial không khớp',
				   '14'=>  'Thẻ không tồn tại',
				   '15'=>  'Thẻ không sử dụng được',
				   '16'=>  'Số lần thử (nhập sai liên tiếp) của thẻ vượt quá giới hạn cho phép',
				   '17'=>  'Hệ thống Telco bị lỗi hoặc quá tải, thẻ chưa bị trừ',
				   '18'=>  'Hệ thống Telco bị lỗi hoặc quá tải, thẻ có thể bị trừ, cần phối hợp với NgânLượng.vn để tra soát',
				   '19'=>  'Kết nối từ NgânLượng.vn tới hệ thống Telco bị lỗi, thẻ chưa bị trừ (thường do lỗi kết nối giữa NgânLượng.vn với Telco, ví dụ sai tham số kết nối, mà không liên quan đến merchant)',
				   '20'=>  'Kết nối tới telco thành công, thẻ bị trừ nhưng chưa cộng tiền trên NgânLượng.vn');
				   
		return $arrCode[$error_code];
	}
	// Gạch thẻ
			
	public function CardPay($pin_card,$card_serial,$type_card,$ref_code,$client_fullname,$client_mobile,$client_email) 
	{
		$params = array(
						'func'					=> 'CardCharge',
						'version'				=> '2.0',
						'merchant_id'			=> '17185',
						'merchant_account'		=> 'kieunghia.cntt@gmail.com',
						'merchant_password'		=> MD5('17185|'.'123456789'),
						'pin_card'				=> $pin_card,
						'card_serial'			=> $card_serial,
						'type_card'				=> $type_card,
						'ref_code'				=> $ref_code,
						'client_fullname'		=> $client_fullname,
						'client_email'			=> $client_email,
						'client_mobile'			=> $client_mobile,
					);	
//print_r( $params);	 
				
					$post_field = '';
					foreach ($params as $key => $value){
						if ($post_field != '') $post_field .= '&';
						$post_field .= $key."=".$value;
					}
					
				$api_url = "https://www.nganluong.vn/mobile_card.api.post.v2.php";
				//$api_url = "http://exu.vn/mobile_card.api.post.v2.php";
				
				//echo $api_url. $post_field;
				//https://www.nganluong.vn/mobile_card.api.post.v2.php?func=CardCharge&version=2.0&merchant_id=24338&merchant_account=hoannet@gmail.com&merchant_password=e4285e0c4ca12bb265af1f00adf706de&pin_card=34565454343344&card_serial=34565454343344&type_card=VIETTEL&ref_code=23254807583&client_fullname=Tên khách hàng&client_email= Email Khách hàng&client_mobile=Mobile Khách Hàng
				//die;
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL,$api_url);
				curl_setopt($ch, CURLOPT_ENCODING , 'UTF-8');
				curl_setopt($ch, CURLOPT_VERBOSE, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post_field);
				$result = curl_exec($ch);
				
				$status = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
				$error = curl_error($ch);
				
				var_dump($result);
				
				
				if ($result != '' && $status==200){
					$arr_result = explode("|",$result);
					if (count($arr_result) == 13) {
					   $error_code	     = $arr_result[0];
					   $merchant_id	     = $arr_result[1];
					   $merchant_account = $arr_result[2];				
					   $pin_card	     = $arr_result[3];
						$card_serial     = $arr_result[4];
						$type_card	     = $arr_result[5];
						$order_id		 = $arr_result[6];
						$client_fullname = $arr_result[7];
						$client_email    = $arr_result[8];
						$client_mobile   = $arr_result[9];
						$card_amount     = $arr_result[10];
						$amount			 = $arr_result[11];
						$transaction_id	 = $arr_result[12];
						
					}
					return $arr_result;
				}
				else return $error;	
				
				
		}

	public function paycardPostAction()
	{
		$request=pzk_element('request');
		$type_card=$request->get('typecard');
		$card_serial=$request->get('txtSeri');
		$pin_card=$request->get('txtPin');
		$ref_code= pzk_session('username').date("Y-m-d H:i:s");
		$client_fullname="";
		$client_mobile="";
		$client_email="";
		$arr_result=$this->CardPay($pin_card,$card_serial,$type_card,$ref_code,$client_fullname,$client_mobile,$client_email);
		if (count($arr_result) == 13)
		{
					   $error_code	     = $arr_result[0];
					   $merchant_id	     = $arr_result[1];
					   $merchant_account = $arr_result[2];				
					   $pin_card	     = $arr_result[3];
						$card_serial     = $arr_result[4];
						$type_card	     = $arr_result[5];
						$order_id		 = $arr_result[6];
						$client_fullname = $arr_result[7];
						$client_email    = $arr_result[8];
						$client_mobile   = $arr_result[9];
						$card_amount     = $arr_result[10];
						$amount			 = $arr_result[11];
						$transaction_id	 = $arr_result[12];	
			if($error_code=='00')
			{
				// Nạp thẻ thành công

			}
			else
			{
				
				//Nạp thất bại
				$error=$this->GetErrorMessage($error_code);
				echo $error;
			}
		} else echo $arr_result;
	}
	public function confirmpaymentAction()
	{

		$request=pzk_element('request');
		// Thanh toán bằng tài khoản Ngân Lượng
		$username=$request->get('order_code');
		$price=$request->get('price');
		$transaction_info=$request->get('transaction_info');
		$datetime= date("Y-m-d H:i:s");
		// Kiểm tra thông tin trả về từ trang thanh toán
		
			//update database
			//insert table history_payment
			$row = array('username' =>$username,'amount'=>$price,'typepayment'=>$transaction_info,'datepayment'=>$datetime);
			$item= _db()->insert('history_payment')->fields('username,amount,typepayment,datepayment')->values(array($row))->result();
			// inset or update table wallets
			$items=_db()->useCB()->select('wallets.*')->from('wallets')->where(array('username',$username))->result_one();
			if($items)
			{
				$price= $price+ $items['amount'];
				_db()->useCB()->update('wallets')->set(array('amount'=>$price))->where(array('username',$username))->result();
			}
			else
			{
				$row = array('username' =>$username,'amount'=>$price);
				$item= _db()->insert('wallets')->fields('username,amount')->values(array($row))->result();
			}
	
			/*$this->layout();		
			$payment = $this->parse('user/payment/confirmpayment');
			$this->append('user/payment/confirmpayment', 'left');
			$this->page->display();		*/
			$payment = pzk_parse(pzk_app()->getPageUri('user/payment/confirmpayment'));
			$payment->setPrice($request->get('price'));
			$payment->setMethod($request->get('transaction_info'));
			$payment->setAmount($price);
			$this->layout();			
			$left = pzk_element('left');
			$left->append($payment);
			$this->page->display();

		
	}
}