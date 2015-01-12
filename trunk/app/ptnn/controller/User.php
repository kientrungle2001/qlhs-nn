<?php
class PzkUserController extends PzkController {
	public $masterPage='index';
	public $masterPosition='left';

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
		$this->render('user/register');
	
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
					$this->render('user/showregister');
				}
			}

		}
		else
		{
			$error="Mã bảo mật chưa đúng";

		}
		pzk_notifier_add_message($error, 'danger');
		$this->render('user/register');
		
	}
	// Hiển thị thông báo sau khi đăng ký tài khoản
	public function showregisterAction()
	{
		$this->render('user/showregister');
	}
	public function activeregisterAction()
	{
		$request=pzk_element('request');
		$confirm=$request->get('active');
		$user=_db()->getEntity('user.user');
		$items=$user->loadWhere(array('key', $confirm));
		if($items->getId())
		{	
			
			$user->update(array('status' => 1,'key'=>""));
			$wallets=_db()->getEntity('user.wallets');
			$username=$items->getUsername();
			$rowWallets = array('username' =>$username,'amount'=>0);
			$wallets->setData($rowWallets);
			$wallets->save();
			pzk_session('login', true);
			//pzk_session('username',$items->getUsername());
			pzk_session($items->getUsername(),true);
			pzk_session('userId',$items->getId());
			pzk_session('name',$items->getName());
			$this->render('user/registersuccess');
		
		}
		else

		{
			pzk_session('username',"");
			$this->render('user/registersuccess');
		}

	}
	// Hiển thị thông báo đăng ký thành công sau khi đã kích hoạt tài khoản
	public function registersuccesAction() 
		{
		
			$this->layout('user/registersuccess');
		}
	// Hiển thị form đăng nhập
	public function loginAction() 
	{
		if(pzk_session('login'))
		{
			$ip="192.168.1.2";
			pzk_session('ipdress','hellosss');
		}
		else
		{
			
			$this->render('user/login');
			
		}
	}
	// Xử lý đăng nhập
	public function loginPostAction()
	{
		if($_SERVER['HTTP_REFERER']!="http://nextnobels.vn/User/loginPost")
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
			$user=_db()->getEntity('user.user');
			$user->loadWhere(array('username',$username));
		
		if($user->getId())
		{
			$userId= $user->getId();
			$name= $user->getName();
			$pass= $user->getPassword();
			$status=$user->getStatus();
			if($pass==$password)
			{
				if($status==1)
				{
					pzk_session('login', true);
					pzk_session('username', $username);
					pzk_session('userId',$userId);
					pzk_session('name',$name);
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
			$this->render('user/login');
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
		$user=_db()->getEntity('user.user');
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
		$this->render('user/forgotpassword');
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
			
			$user=_db()->getEntity('user.user');
			$user->loadWhere(array('email',$email));
			if($user->getId())
			{
				if($user->getStatus()==1)
				{
					$password=$user->getPassword();
					$this->sendMailForgotpassword($email,$password);
					$this->render('user/showforgotpassword');
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
		$this->render('user/forgotpassword');
	}
	public function showforgotpasswordAction()
	{
		$this->render('user/showforgotpassword');
	}
	//Gửi lại mật khẩu
	public function sendPasswordAction()
	{
		$request=pzk_element('request');
		$confirm=$request->get('forgotpassword');
		//$items = _db()->useCB()->select('user.*')->from('user')->where(array('key', $confirm))->result_one();
		$user=_db()->getEntity('user.user');
		$user->loadWhere(array('key', $confirm));
		if($user->getId())
		{
			$password=md5(rand(0,9999999999).$user->getPassword());
			$password=substr($password,0,8);
			$updatepassword=md5($password);
			$username=$user->getUsername();
			$user->update(array('password' => $updatepassword,'key'=>''));
			//_db()->useCB()->update('user')->set(array('password' => $updatepassword,'key'=>''))->where(array('and',array('username',$username),array('status',1)))->result();
			$newpassword = pzk_parse(pzk_app()->getPageUri('user/newpassword'));
			$newpassword->setUsername($username);
			$newpassword->setPassword($password);
			$this->render($newpassword);
		
		}
		else
		{
			$newpassword = pzk_parse(pzk_app()->getPageUri('user/newpassword'));
			$newpassword->setUsername("");
			$this->render($newpassword);
			
		}
	}
	// Hiển thị password mới
	public function newpasswordAction() 
	{
		$this->render('user/newpassword');
	
	}
	// Sửa thông tin cá nhân
	public function editinforAction() 
	{

			$username= pzk_session('username');
			$user=_db()->getEntity('user.user');
			$user->loadWhere(array('username',$username));
			$editinfor = pzk_parse(pzk_app()->getPageUri('user/editinfor'));
			// lấy thông tin cá nhân
			$name= $user->getName();
			$birthday= $user->getBirthday();
			$address= $user->getAddress();
			$phone= $user->getPhone();
			$idpassport= $user->getIdpassport();
			$iddate= $user->getIddate();
			$idplace= $user->getIdplace();
			// Hiển thị thông tin tài khoản
			$editinfor->setname($name);
			$editinfor->setbirthday($birthday);
			$editinfor->setAddress($address);
			$editinfor->setphone($phone);
  			$editinfor->setidpassport($idpassport);
			$editinfor->setiddate($iddate);
			$editinfor->setidplace($idplace);
			$this->render($editinfor);			
			
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
		$user=_db()->getEntity('user.user');
		$user->loadWhere(array('username',$username));
		$user->update(array('name' => $name,'birthday' => $birthday,'address' => $address,'phone' => $phone,'idpassport' => $idpassport,'iddate' => $iddate,'idplace' => $idplace,'modified'=>$editdate,'modifiedId'=>$userId));
		//_db()->useCB()->update('user')->set(array('name' => $name,'birthday' => $birthday,'address' => $address,'phone' => $phone,'idpassport' => $idpassport,'iddate' => $iddate,'idplace' => $idplace,'modified'=>$editdate,'modifiedId'=>$userId))->where(array('username',$username))->result();
		$username= pzk_session('username');
		$user->loadWhere(array('username',$username));
		$editinfor = pzk_parse(pzk_app()->getPageUri('user/editinfor'));
		// lấy thông tin cá nhân
		$name= $user->getName();
		$birthday= $user->getBirthday();
		$address= $user->getAddress();
		$phone= $user->getPhone();
		$idpassport= $user->getIdpassport();
		$iddate= $user->getIddate();
		$idplace= $user->getIdplace();
		// Hiển thị thông tin tài khoản
		$editinfor->setname($name);
		$editinfor->setbirthday($birthday);
		$editinfor->setAddress($address);
		$editinfor->setphone($phone);
  		$editinfor->setidpassport($idpassport);
		$editinfor->setiddate($iddate);
		$editinfor->setidplace($idplace);
		
		$this->render($editinfor);
	}
	public function editpasswordAction()
	{
			$this->render('user/editpassword');
		
	}
	public function editpasswordPostAction()
	{
		$request = pzk_element('request');
		$oldpassword=md5($request->get('oldpassword'));
		$newpassword=$request->get('newpassword');
		$username= pzk_session('username');
		$user=_db()->getEntity('user.user');
		$user->loadWhere(array('and',array('username',$username),array('password',$oldpassword)));
		if($user->getId())
		{
			$confirmpassword= md5($oldpassword.$newpassword);
			$email=$user->getEmail();			
			// Update Key
			$user->update(array('key' => $confirmpassword));
			$this->sendMailEditPassword($email,$confirmpassword,$newpassword);
			$editinfor = pzk_parse(pzk_app()->getPageUri('user/showeditpassword'));

		}	
		else
		{
			$editinfor = pzk_parse(pzk_app()->getPageUri('user/showeditpasswordfalse'));
		}	
		
		$this->render($editinfor);
	
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
			$this->render('user/showeditpassword');
			
	}

	public function confirmeditpasswordAction()
	{
		$request=pzk_element('request');
		
		$confirm=$request->get('editpassword');
		$newpassword=$request->get('conf');
		$username=pzk_session('username');
		$userId= pzk_session('userId');
		$editdate = date("Y-m-d H:i:s"); 
		$user=_db()->getEntity('user.user');
		$user->loadWhere(array('key', $confirm),array('username',$username)); 
		//$items = _db()->useCB()->select('user.*')->from('user')->where(array('key', $confirm),array('username',$username))->result_one();
		if($user->getId())
		{			
			$user->update(array('password' => $newpassword,'key'=>'','modified'=>$editdate,'modifiedId'=>$user->getId()));
			//_db()->useCB()->update('user')->set(array('password' => $newpassword,'key'=>'','modified'=>$editdate,'modifiedId'=>$items['id']))->where(array('username',$username))->result();
			$editpasswordsuccess = pzk_parse(pzk_app()->getPageUri('user/editpasswordsuccess'));
			$editpasswordsuccess->setUsername("ok");
			$this->render($editpasswordsuccess);
		}
		else
		{
			$editpasswordsuccess = pzk_parse(pzk_app()->getPageUri('user/editpasswordsuccess'));
			$editpasswordsuccess->setUsername("");
			$this->render($editpasswordsuccess);
		}
	}
	
	public function editpasswordsuccessAction()
	{
			$this->render('user/editpasswordsuccess');
	}
	public function editsignAction()
	{
			$username=pzk_session('username');
			$user=_db()->getEntity('user.user');
			$user->loadWhere(array('username',$username));
			//$items=_db()->useCB()->select('user.*')->from('user')->where(array('username',$username))->result_one();
			$sign=$user->getSign();
			$editsign = pzk_parse(pzk_app()->getPageUri('user/editsign'));
			$editsign->setSign($sign);
			$this->render($editsign);
	}
	public function editsignPostAction()
	{
			$username=pzk_session('username');
			$request = pzk_element('request');				
			$newsign=$request->get('newsign');
			$editdate = date("Y-m-d H:i:s"); 
			$userId= pzk_session('userId');
			$user=_db()->getEntity('user.user');
			$user->loadWhere(array('username',$username));
			$user->update(array('sign'=>$newsign,'modified'=>$editdate,'modifiedId'=>$userId));
			//_db()->useCB()->update('user')->set(array('sign'=>$newsign,'modified'=>$editdate,'modifiedId'=>$userId))->where(array('username',$username))->result();
			$user->loadWhere(array('username',$username));
			$sign=$user->getSign();
			$editsign = pzk_parse(pzk_app()->getPageUri('user/editsign'));
			$editsign->setSign($sign);
			$this->render($editsign);
	}
	// Function hiển thị thông tin cá nhân của user
	public function profileuserAction()
	{
		$this->layout();		
		$profileuser = $this->parse('user/profileuser');
		$this->append('user/profileuser', 'right');
		$this->page->display();
			
	}
	public function editavatarAction()
	{
		//$this->render('user/editavatar');		
		$message="";
		$editavatar = pzk_parse(pzk_app()->getPageUri('user/editavatar'));
		$editavatar->setMessage($message);
		$this->render($editavatar);	
		
	}

	public function editavatarPostAction()
	{
		$error="";
		$target_dir =BASE_DIR."/uploads/avatar/";
		$basename= basename($_FILES["fileToUpload"]["name"]);
		$target_file = $target_dir .$basename;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$size =$_FILES["fileToUpload"]["size"];
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !==false)
		{
			if($size < 500000)
			{
				if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"|| $imageFileType == "gif"|| $imageFileType == "JPG" || $imageFileType == "PNG" || $imageFileType == "JPEG" || $imageFileType == "GIF")
				{
					// Đổi tên file ảnh trùng tên username
					$basename=pzk_session('username').'.'.$imageFileType;
					$target_file=$target_dir .$basename;
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
					{
						// Upload thành công
						//insert đường dẫn file vào database
						$username= pzk_session('username');
						$userId= pzk_session('userId');
						$editdate=date("Y-m-d H:i:s");
						//$avata=$target_file;
						$avatar=BASE_URL.'/uploads/avatar/'.$basename;
						$user=_db()->getEntity('user.user');
						$user->loadWhere(array('username',$username));
						$user->update(array('avatar'=>$avatar,'modified'=>$editdate,'modifiedId'=>$userId));
						$message="Bạn đã thay đổi avatar thành công";
						$editavatar = pzk_parse(pzk_app()->getPageUri('user/editavatar'));
						$editavatar->setMessage($message);
						$this->render($editavatar);		
					}else $error="Upload không thành công";
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
			// hiển thị 
			pzk_notifier_add_message($error, 'danger');
			$editavatar = pzk_parse(pzk_app()->getPageUri('user/editavatar'));
			$editavatar->setMessage("");
			$this->render($editavatar);	
		}
		
	}
	public function SearchAction()
	{
		$this->layout();		
		$this->append('user/profileuser', 'right');
		$this->append('user/search', 'left');
		$this->page->display();
	
	}
	public function ResultsearchAction()
	{
		$this->layout();		
		$this->append('user/resultsearch', 'left');
		$this->page->display();
	
	}
	public function searchPostAction()
	{
		$request=pzk_element('request');
		$searchfriend=$request->get('searchfriend');
		pzk_session('searchfriend', $searchfriend);

		$this->redirect('searchResult');
	}
	public function searchResultAction() {
		$searchfriend = pzk_session('searchfriend');
		//$items_name=_db()->useCB()->select('user.*')->from('user')->where(array('or',array('like','email',$searchfriend),array('like','name',$searchfriend),array('like','username',$searchfriend)))->result();
		$this->layout();
		$pageSearch = pzk_parse(pzk_app()->getPageUri('user/resultsearch'));
		$pageSearch->setTxtsearch($searchfriend);	
		$this->append('user/profileuser', 'right');
		$this->append('user/search', 'left');
		$this->append($pageSearch, 'left');
		$this->page->display();
	}
	public function invitationAction()
	{
		$this->layout();		
		$this->append('user/profileuser', 'right');
		$this->append('user/invitation', 'left');
		$this->page->display();
	
	}

	public function invitationPostAction()
	{
		$request=pzk_element('request');
		$txtinvitation=$request->get('invitation');
		$userIdInvitation=$request->get('userid');
		$user=_db()->getEntity('user.user');
		$user->loadWhere(array('id',$userIdInvitation));
		$usernameInvitation=$user->getUsername();
		$invitation=_db()->getEntity('user.invitation');
		// kiểm tra nếu đã gửi lời mời kết bạn thì không insert được nữa
		$invitation->loadWhere(array('and',array('username',pzk_session('username')),array('userinvitation',$usernameInvitation)));
		
		if($invitation->getId())
		{
			//$showinvitation = pzk_parse(pzk_app()->getPageUri('user/showinvitation'));
			$message="false";
			//$showinvitation->setMessage($message);
		}
		else
		{
			$rowInvitation=array('username'=>pzk_session('username'),'userinvitation'=>$usernameInvitation,'invitation'=>$txtinvitation);
			$invitation->setData($rowInvitation);
			$invitation->save();
			$message="ok";
		}	

		$this->layout();
		$showinvitation = pzk_parse(pzk_app()->getPageUri('user/showinvitation'));
		$showinvitation->setUsername($usernameInvitation);
		$showinvitation->setMessage($message);
		$this->append('user/profileuser', 'right');
		$this->append($showinvitation, 'left');
		$this->page->display();
	
	}
	public function listinvitationAction()
	{
		$this->layout();		
		$this->append('user/profileuser', 'right');
		$this->append('user/listinvitation', 'left');
		$this->page->display();
	
	}
	public function friendlistAction()
	{
		$this->layout();		
		$this->append('user/profileuser', 'right');
		$this->append('user/friendlist', 'left');
		$this->page->display();
	
	}

	public function denyAction()
	{
		$request=pzk_element('request');
		$usersendinvi=$request->get('userinvitation');
		$invitation=_db()->getEntity('user.invitation');
		$invitation->loadWhere(array('and',array('userinvitation',pzk_session('username')),array('username',$usersendinvi)));
		$invitation->delete();
		$this->redirect('listinvitation');
	
	}

	public function agreeAction()
	{
		$request=pzk_element('request');
		$usersendinvi=$request->get('userinvitation');
		$invitation=_db()->getEntity('user.invitation');
		$invitation->loadWhere(array('and',array('userinvitation',pzk_session('username')),array('username',$usersendinvi)));
		$invitation->delete();
		$rowfriend=array('username'=>pzk_session('username'),'userfriend'=>$usersendinvi);
		$friend=_db()->getEntity('user.friend');
		$friend->setData($rowfriend);
		$friend->save();
		$this->redirect('listinvitation');
	}
	public function denyfriendAction()
	{
		$request=pzk_element('request');
		$userfriend=$request->get('userfriend');
		$friend=_db()->getEntity('user.friend');
		$friend->loadWhere(array('userfriend',$userfriend));
		$friend->delete();
		$this->redirect('friendlist');
	
	}
	public function profilefriendAction()
	{
		$this->layout();		
		$this->append('user/profileuser', 'right');
		$this->append('user/profilefriend', 'left');
		$this->page->display();
	
	}



	public function paymentAction()
	{
		$this->render('user/payment/payment');		
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
			$return_url="http://ptnn.vn/user/payment/confirmpayment.php";
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
	public function PostPaymentNLAction()
	{
		$request=pzk_element('request');
		$request->get('username');
		$request->get('code');
		echo $request->get('code');
	}
	public function confirmpaymentAction()
	{
		require(BASE_DIR.'/3rdparty/nganluong/include/nganluong.microcheckout.class.php');
    	require(BASE_DIR.'/3rdparty/nganluong/include/lib/nusoap.php');
   	 	require(BASE_DIR.'/3rdparty/nganluong/config.php');
		// Nạp tiền bằng popup Ngân Lượng
		$request=pzk_element('request');
		$token=$request->get('token');

		$obj = new NL_MicroCheckout(MERCHANT_ID, MERCHANT_PASS, URL_WS);
	
		if ($obj->checkReturnUrlAuto()) {
			$inputs = array(
							'token'	=> $obj->getTokenCode(),//$token_code,
		);
		$result = $obj->getExpressCheckout($inputs);
		if ($result != false) {
			if ($result['result_code'] != '00') {
				die('Mã lỗi '.$result['result_code'].' ('.$result['result_description'].') ');
			}
		} else {
			die('Lỗi kết nối tới cổng thanh toán Ngân Lượng');
		}
	} else {
		die('Tham số truyền không đúng');
	}
		//$datetime= date("Y-m-d H:i:s");

		// Kiểm tra thông tin trả về từ trang thanh toán
		
			//update database
			//insert table history_payment
			$row = array('username' =>$username,'amount'=>$price,'typepayment'=>$transaction_info,'datepayment'=>$datetime);
			$user=_db()->getEntity('user.user');
			$user->setData($row);
			$user->save();
			//$item= _db()->insert('history_payment')->fields('username,amount,typepayment,datepayment')->values(array($row))->result();
			// inset or update table wallets
			$wallets=_db()->getEntity('user.wallets');
			$wallets->loadWhere(array('username',$username));
			//$items=_db()->useCB()->select('wallets.*')->from('wallets')->where(array('username',$username))->result_one();
			if($wallets->getId())
			{
				$price= $price+ $wallets->getAmount();
				$wallets->update(array('amount'=>$price));
				//_db()->useCB()->update('wallets')->set(array('amount'=>$price))->where(array('username',$username))->result();
			}
			else
			{
				$row = array('username' =>$username,'amount'=>$price);
				$wallets->setData($row);
				$wallets->save();
				//$item= _db()->insert('wallets')->fields('username,amount')->values(array($row))->result();
			}
	
			/*$this->layout();		
			$payment = $this->parse('user/payment/confirmpayment');
			$this->append('user/payment/confirmpayment', 'left');
			$this->page->display();		*/
			$payment = pzk_parse(pzk_app()->getPageUri('user/payment/confirmpayment'));
			$payment->setPrice($request->get('price'));
			$payment->setMethod($request->get('transaction_info'));
			$payment->setAmount($price);
			$this->render($payment);			
			
	}

 


}