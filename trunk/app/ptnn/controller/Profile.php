<?php 
class PzkProfileController extends PzkController 
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
	public function profileuserAction()
	{
		$this->layout();		
		//$this->append('user/profilefriend', 'left');
		$this->append('user/profile/profileuser', 'right');
		$this->page->display();
			
	}

	public function profileuserleft1Action()
	{
		$this->layout();
		$this->append('user/profileuserleft1');
		$this->display();
	}
	public function profileusercontentAction()
	{
		$this->layout();
		$this->append('user/profile/profileuserleft1')->append('user/profile/profileusercontent');
		$this->append('user/profile/profileuser','right');
		$this->display();
		//$this->render('user/payment/payment');		
	}
	// Sửa thông tin cá nhân
	public function editinforAction() 
	{

			$username= pzk_session('username');
			$user=_db()->getEntity('user.account.user');
			$user->loadWhere(array('username',$username));
			$editinfor = pzk_parse(pzk_app()->getPageUri('user/profile/editinfor'));
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
			$this->layout();
			$this->append('user/profile/profileuserleft1')->append($editinfor);
			$this->append('user/profile/profileuser','right');
			$this->display();
			//$this->render($editinfor);			
			
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
		$user=_db()->getEntity('user.account.user');
		$user->loadWhere(array('username',$username));
		$user->update(array('name' => $name,'birthday' => $birthday,'address' => $address,'phone' => $phone,'idpassport' => $idpassport,'iddate' => $iddate,'idplace' => $idplace,'modified'=>$editdate,'modifiedId'=>$userId));
		//_db()->useCB()->update('user')->set(array('name' => $name,'birthday' => $birthday,'address' => $address,'phone' => $phone,'idpassport' => $idpassport,'iddate' => $iddate,'idplace' => $idplace,'modified'=>$editdate,'modifiedId'=>$userId))->where(array('username',$username))->result();
		$username= pzk_session('username');
		$user->loadWhere(array('username',$username));
		$editinfor = pzk_parse(pzk_app()->getPageUri('user/profile/editinfor'));
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
		
		//$this->render($editinfor);
		$this->layout();
		pzk_notifier_add_message('Bạn đã thay đổi thành công', 'success');
		$this->append('user/profile/profileuserleft1')->append($editinfor);
		$this->append('user/profile/profileuser','right');
		$this->display();
	}
	public function editpasswordAction()
	{
			//$this->render('user/editpassword');
		$this->layout();
		$this->append('user/profile/profileuserleft1')->append('user/profile/editpassword');
		$this->append('user/profile/profileuser','right');
		$this->display();
	}
	public function editpasswordPostAction()
	{
		$request = pzk_element('request');
		$oldpassword=md5($request->get('oldpassword'));
		$newpassword=$request->get('newpassword');
		$username= pzk_session('username');
		$user=_db()->getEntity('user.account.user');
		$user->loadWhere(array('and',array('username',$username),array('password',$oldpassword)));
		if($user->getId())
		{
			$confirmpassword= md5($oldpassword.$newpassword);
			$email=$user->getEmail();			
			// Update Key
			$user->update(array('key' => $confirmpassword));
			$this->sendMailEditPassword($email,$confirmpassword,$newpassword);
			$editpassword = pzk_parse(pzk_app()->getPageUri('user/profile/showeditpassword'));

		}	
		else
		{
			$error='Mật khẩu cũ chưa chính xác';
			pzk_notifier_add_message($error,'danger');
			$editpassword = pzk_parse(pzk_app()->getPageUri('user/profile/editpassword'));
		}	
		$this->layout();
		$this->append('user/profile/profileuserleft1')->append($editpassword);
		$this->append('user/profile/profileuser','right');
		$this->display();
		//$this->render($editpassword);
	
	}

	public function sendMailEditPassword($email="",$key="",$newpassword="")
	{
		//tạo URL gửi email xác nhận đăng ký
		$mailtemplate = pzk_parse(pzk_app()->getPageUri('user/mailtemplate/editpassword'));
		$url= "http://".$_SERVER["SERVER_NAME"].'/Profile/confirmeditpassword';
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
			$this->render('user/profile/showeditpassword');
			
	}

	public function confirmeditpasswordAction()
	{
		$request=pzk_element('request');
		
		$confirm=$request->get('editpassword');
		$newpassword=$request->get('conf');
		$username=pzk_session('username');
		$userId= pzk_session('userId');
		$editdate = date("Y-m-d H:i:s"); 
		$user=_db()->getEntity('user.account.user');
		$user->loadWhere(array(array('key', $confirm),array('username',$username))); 
		
		//$items = _db()->useCB()->select('user.*')->from('user')->where(array('key', $confirm),array('username',$username))->result_one();
		if($user->getId())
		{	
			$editpasswordsuccess->setUsername("ok");		
			$user->update(array('password' => $newpassword,'key'=>'','modified'=>$editdate,'modifiedId'=>$user->getId()));
		
			//_db()->useCB()->update('user')->set(array('password' => $newpassword,'key'=>'','modified'=>$editdate,'modifiedId'=>$items['id']))->where(array('username',$username))->result();
			$editpasswordsuccess = pzk_parse(pzk_app()->getPageUri('user/profile/editpasswordsuccess'));
			
			$this->layout();
			$this->append('user/profile/profileuserleft1')->append($editpasswordsuccess);
			$this->append('user/profile/profileuser','right');
			$this->display();
			
		}
		else
		{
			$editpasswordsuccess = pzk_parse(pzk_app()->getPageUri('user/profile/editpasswordsuccess'));
			$editpasswordsuccess->setUsername("");
			$this->layout();
			$this->append('user/profile/profileuserleft1')->append($editpasswordsuccess);
			$this->append('user/profile/profileuser','right');
			$this->display();
			
		}
	}
	
	public function editpasswordsuccessAction()
	{
			$this->render('user/profile/editpasswordsuccess');
	}
	public function editsignAction()
	{
			$username=pzk_session('username');
			$user=_db()->getEntity('user.account.user');
			$user->loadWhere(array('username',$username));
			//$items=_db()->useCB()->select('user.*')->from('user')->where(array('username',$username))->result_one();
			$sign=$user->getSign();
			$editsign = pzk_parse(pzk_app()->getPageUri('user/profile/editsign'));
			$editsign->setSign($sign);
			$this->layout();
			$this->append('user/profile/profileuserleft1')->append($editsign);
			$this->append('user/profile/profileuser','right');
			$this->display();
			//$this->render($editsign);
	}
	public function editsignPostAction()
	{
			$username=pzk_session('username');
			$request = pzk_element('request');				
			$newsign=$request->get('newsign');
			$editdate = date("Y-m-d H:i:s"); 
			$userId= pzk_session('userId');
			$user=_db()->getEntity('user.account.user');
			$user->loadWhere(array('username',$username));
			$user->update(array('sign'=>$newsign,'modified'=>$editdate,'modifiedId'=>$userId));
			//_db()->useCB()->update('user')->set(array('sign'=>$newsign,'modified'=>$editdate,'modifiedId'=>$userId))->where(array('username',$username))->result();
			$user->loadWhere(array('username',$username));
			$sign=$user->getSign();
			$editsign = pzk_parse(pzk_app()->getPageUri('user/profile/editsign'));
			$editsign->setSign($sign);
			$message="Bạn đã thay đổi chữ ký thành công";
			pzk_notifier_add_message($message, 'success');
			$this->layout();
			$this->append('user/profile/profileuserleft1')->append($editsign);
			$this->append('user/profile/profileuser','right');
			$this->display();
	}
	// Function hiển thị thông tin cá nhân của user

	public function editavatarAction()
	{
		//$this->render('user/editavatar');		
		$message="";
		$editavatar = pzk_parse(pzk_app()->getPageUri('user/profile/editavatar'));
		$editavatar->setMessage($message);
		$this->layout();
		$this->append('user/profile/profileuserleft1')->append($editavatar);
		$this->append('user/profile/profileuser','right');
		$this->display();
		//$this->render($editavatar);	
		
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
						$user=_db()->getEntity('user.account.user');
						$user->loadWhere(array('username',$username));
						$user->update(array('avatar'=>$avatar,'modified'=>$editdate,'modifiedId'=>$userId));
						$message="Bạn đã thay đổi avatar thành công";
						$editavatar = pzk_parse(pzk_app()->getPageUri('user/profile/editavatar'));
						$editavatar->setMessage($message);
						//pzk_notifier_add_message($message, 'success');
						$this->layout();
						$this->append('user/profile/profileuserleft1')->append($editavatar);
						$this->append('user/profile/profileuser','right');
						$this->display();		
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
			$editavatar = pzk_parse(pzk_app()->getPageUri('user/profile/editavatar'));
			$editavatar->setMessage("");
			$this->layout();
			$this->append('user/profile/profileuserleft1')->append($editavatar);
			$this->append('user/profile/profileuser','right');
			$this->display();
			//$this->render($editavatar);	
		}
		
	}

}
 ?>