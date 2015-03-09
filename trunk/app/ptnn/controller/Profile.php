<?php 
class PzkProfileController extends PzkFrontendController 
{
	public $masterPage='index';
	public $masterPosition='left';
	public function layout()
	{
		$this->page = pzk_parse($this->getApp()->getPageUri('index'));
	}

	public function profileuserAction()
	{
		$this->layout();		
		//$this->append('user/profilefriend', 'left');
		$this->append('user/profile/profileuser', 'right');
		$this->page->display();
			
	}
	public function addinforAction()
	{
		$this->layout();		
		
		$this->append('user/profile/addinfor');
		$this->page->display();
			
	}
	public function addinforgoogleAction()
	{
		$this->layout();		
		
		$this->append('user/profile/addinforgoogle');
		$this->page->display();
			
	}
	public function profileuserleft1Action()
	{
		$this->layout();
		$this->append('user/profile/profileuserleft1');
		$this->display();
	}
	public function profileusercontentAction()
	{
		$this->layout();
		$this->append('user/profile/profileusercontent');
		
		$this->display();
		//$this->render('user/payment/payment');		
	}
	// Sửa thông tin cá nhân
	public function editinforAction() 
	{

			$userId= pzk_session('userId');
			$user=_db()->getEntity('user.account.user');
			$user->loadWhere(array('id',$userId));
			$editinfor = pzk_parse(pzk_app()->getPageUri('user/profile/editinfor'));
			// lấy thông tin cá nhân
			$name= $user->getName();
			$birthday= $user->getBirthday();
			$address= $user->getAddress();
			$phone= trim($user->getPhone());
			$sex= $user->getSex();
			// Hiển thị thông tin tài khoản
			$editinfor->setname($name);
			$editinfor->setbirthday($birthday);
			$editinfor->setAddress($address);
			$editinfor->setphone($phone);
  			$editinfor->setSex($sex);
			$this->layout();
			$this->append($editinfor);
			
			$this->display();
			//$this->render($editinfor);			
			
	}
	public function editinforPostAction()
	{
		
		$request = pzk_element('request');
		$name=$request->get('frm_editinfor_name');
		$birthday=$request->get('frm_editinfor_birthday');
		$address=$request->get('frm_editinfor_address');
		$phone=$request->get('frm_editinfor_phone');
		$sex=$request->get('frm_editinfor_sex');
		$editdate = date("Y-m-d H:i:s"); 
		$userId= pzk_session('userId');
		
		$user=_db()->getEntity('user.account.user');
		$user->loadWhere(array('id',$userId));
		$user->update(array('name' => $name,'birthday' => $birthday,'address' => $address,'sex' => $sex,'phone' => $phone,'modified'=>$editdate,'modifiedId'=>$userId));
		//_db()->useCB()->update('user')->set(array('name' => $name,'birthday' => $birthday,'address' => $address,'phone' => $phone,'idpassport' => $idpassport,'iddate' => $iddate,'idplace' => $idplace,'modified'=>$editdate,'modifiedId'=>$userId))->where(array('username',$username))->result();
		$user->loadWhere(array('id',$userId));
		$editinfor = pzk_parse(pzk_app()->getPageUri('user/profile/editinfor'));
		// lấy thông tin cá nhân
		$name= $user->getName();
		$birthday= $user->getBirthday();
		$address= $user->getAddress();
		$phone= $user->getPhone();
		$sex= $user->getSex();
		// Hiển thị thông tin tài khoản
		$editinfor->setname($name);
		$editinfor->setbirthday($birthday);
		$editinfor->setAddress($address);
		$editinfor->setphone($phone);
  		$editinfor->setSex($sex);
		
		//$this->render($editinfor);
		$this->layout();
		pzk_notifier_add_message('Bạn đã thay đổi thành công', 'success');
		$this->append($editinfor);
		
		$this->display();
	}
	public function addinforPostAction()
	{
		$message="";
		$error="";
		$request = pzk_element('request');
		$username=$request->get('frm_add_username');
		$email=$request->get('frm_add_email');
		$user=_db()->getEntity('user.account.user');
		$testUser=$user->loadWhere(array('username',$username));
		if($testUser->getId()) {
				
				//$error="Tên đăng nhập đã tồn tại trên hệ thống";
				$error = "Tên đăng nhập đã tồn tại. Bạn vui lòng chọn tên đăng nhập khác";
		}else{
				
			$testEmail= $user->loadWhere(array('email',$email));
			if($testEmail->getId()) {
				//$error= "Email đã tồn tại trên hệ thống";
					$error = "Email đã tồn tại trên hệ thống. Bạn vui lòng chọn email khác";
			}else{
				$sex=$request->get('frm_add_sex');
				$password=$request->get('frm_add_password');
				$password=md5($password);
				$birthday=$request->get('frm_add_birthday');
				$phone=$request->get('frm_add_phone');
				$address=$request->get('frm_add_address');
				$editdate = date("Y-m-d H:i:s"); 
				$userId= pzk_session('userId');
				
				$user->loadWhere(array('id',$userId));
				$user->update(array('username' => $username,'birthday' => $birthday,'address' => $address,'phone' => $phone,'sex' => $sex,'password' => $password,'email' => $email,'modified'=>$editdate,'modifiedId'=>$userId));
				pzk_session('username',$username);
				$message="Cập nhật thành công";
			}
		}
		$addinfor = pzk_parse(pzk_app()->getPageUri('user/profile/addinfor'));
		$addinfor->setError($error);
		$addinfor->setMessage($message);
		$this->layout();
		$this->append($addinfor);
		$this->display();
	}
	public function addinforgooglePostAction()
	{
		$message="";
		$error="";
		$request = pzk_element('request');
		$username=$request->get('frm_addg_username');
		$user=_db()->getEntity('user.account.user');
		$testUser=$user->loadWhere(array('username',$username));
		if($testUser->getId()) {

				$error = "Tên đăng nhập đã tồn tại. Bạn vui lòng chọn tên đăng nhập khác";
		}else{

				$password=$request->get('frm_addg_password');
				$password=md5($password);
				$birthday=$request->get('frm_addg_birthday');
				$phone=$request->get('frm_addg_phone');
				$address=$request->get('frm_addg_address');
				$editdate = date("Y-m-d H:i:s"); 
				$userId= pzk_session('userId');
				
				$user->loadWhere(array('id',$userId));
				$user->update(array('username' => $username,'birthday' => $birthday,'address' => $address,'phone' => $phone,'password' => $password,'modified'=>$editdate,'modifiedId'=>$userId));
				pzk_session('username',$username);
				$message="Cập nhật thành công";
			
		}
		$addinforgoogle = pzk_parse(pzk_app()->getPageUri('user/profile/addinforgoogle'));
		$addinforgoogle->setError($error);
		$addinforgoogle->setMessage($message);
		$this->layout();
		$this->append($addinforgoogle);
		$this->display();
	}
	public function editpasswordAction()
	{
		$this->layout();
		$this->append('user/profile/editpassword');
		$this->display();
	}
	public function editpasswordPostAction()
	{
		$request = pzk_element('request');
		$oldpassword=md5($request->get('frm_editpass_oldpassword'));
		$newpassword=$request->get('frm_editpass_newpassword');
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
		$this->append($editpassword);
		$this->display();
	}
	public function sendMailEditPassword($email="",$key="",$newpassword="")
	{
		//tạo URL gửi email xác nhận đăng ký
		$mailtemplate = pzk_parse(pzk_app()->getPageUri('user/mailtemplate/editpassword'));
		//$url= "http://".$_SERVER["SERVER_NAME"].'/Profile/confirmeditpassword';
		$url= 'Profile/confirmeditpassword';
		$newpassword=md5($newpassword);
		$arr=array('editpassword'=>$key,'conf'=>$newpassword);
		$request=pzk_request();
		$url= $request->build($url,$arr);
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
		if($user->getId())
		{	
			$editpasswordsuccess = pzk_parse(pzk_app()->getPageUri('user/profile/editpasswordsuccess'));
			$editpasswordsuccess->setUsername("ok");		
			$user->update(array('password' => $newpassword,'key'=>'','modified'=>$editdate,'modifiedId'=>$user->getId()));
			
			$this->layout();
			$this->append($editpasswordsuccess);
			$this->display();
		}
		else
		{
			$editpasswordsuccess = pzk_parse(pzk_app()->getPageUri('user/profile/editpasswordsuccess'));
			$editpasswordsuccess->setUsername("");
			$this->layout();
			$this->append($editpasswordsuccess);
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
			$this->append($editsign);
			$this->display();
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
			$this->append($editsign);
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
		$this->append($editavatar);
		$this->display();
	}
	//Edit Avatar
	public function normal_resize_image($source, $destination, $image_type, $max_size, $image_width, $image_height, $quality){
	
	if($image_width <= 0 || $image_height <= 0){return false;} //return false if nothing to resize
	
	//do not resize if image is smaller than max size
	if($image_width <= $max_size && $image_height <= $max_size){
		if($this->save_image($source, $destination, $image_type, $quality)){
			return true;
		}
	}
	
	//Construct a proportional size of new image
	$image_scale	= min($max_size/$image_width, $max_size/$image_height);
	$new_width		= ceil($image_scale * $image_width);
	$new_height		= ceil($image_scale * $image_height);
	
	$new_canvas		= imagecreatetruecolor( $new_width, $new_height ); //Create a new true color image
	
	//Copy and resize part of an image with resampling
	if(imagecopyresampled($new_canvas, $source, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height)){
		$this->save_image($new_canvas, $destination, $image_type, $quality); //save resized image
	}

	return true;
}

##### This function corps image to create exact square, no matter what its original size! ######
	public function crop_image_square($source, $destination, $image_type, $square_size, $image_width, $image_height, $quality){
	if($image_width <= 0 || $image_height <= 0){return false;} //return false if nothing to resize
	
	if( $image_width > $image_height )
	{
		$y_offset = 0;
		$x_offset = ($image_width - $image_height) / 2;
		$s_size 	= $image_width - ($x_offset * 2);
	}else{
		$x_offset = 0;
		$y_offset = ($image_height - $image_width) / 2;
		$s_size = $image_height - ($y_offset * 2);
	}
	$new_canvas	= imagecreatetruecolor( $square_size, $square_size); //Create a new true color image
	
	//Copy and resize part of an image with resampling
	if(imagecopyresampled($new_canvas, $source, 0, 0, $x_offset, $y_offset, $square_size, $square_size, $s_size, $s_size)){
		$this->save_image($new_canvas, $destination, $image_type, $quality);
	}

	return true;
}

##### Saves image resource to file ##### 
	public function save_image($source, $destination, $image_type, $quality){
	switch(strtolower($image_type)){//determine mime type
		case 'image/png': 
			imagepng($source, $destination); return true; //save png file
			break;
		case 'image/gif': 
			imagegif($source, $destination); return true; //save gif file
			break;          
		case 'image/jpeg': case 'image/pjpeg': 
			imagejpeg($source, $destination, $quality); return true; //save jpeg file
			break;
		default: return false;
	}
}
	// End Edit Avatar
public function editavatarPostAction(){
	$max_image_size 		= 120; //Maximum image size (height and width
	$jpeg_quality 			= 90; 
	$image_name = $_FILES['fileToUpload']['name']; //file name
	$image_size = $_FILES['fileToUpload']['size']; //file size
	$image_temp = $_FILES['fileToUpload']['tmp_name'];
	$error="";
	$destination_folder= BASE_DIR."/uploads/avatar/";
	$target_dir =BASE_DIR."/uploads/avatar/";
	$basename= basename($_FILES["fileToUpload"]["name"]);
	$target_file = $target_dir .$basename;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$size =$_FILES["fileToUpload"]["size"];	
	if($size < 500000){
		if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"|| $imageFileType == "gif"|| $imageFileType == "JPG" || $imageFileType == "PNG" || $imageFileType == "JPEG" || $imageFileType == "GIF"){
			$image_size_info 	= getimagesize($image_temp);
			if($image_size_info){
				$image_width 		= $image_size_info[0]; //image width
				$image_height 		= $image_size_info[1]; //image height
				$image_type 		= $image_size_info['mime']; //image type
			}else{
					$error="File ảnh không đúng quy định";
				}
			switch($image_type){
				case 'image/png':
					$image_res =  imagecreatefrompng($image_temp); break;
				case 'image/gif':
					$image_res =  imagecreatefromgif($image_temp); break;			
				case 'image/jpeg': case 'image/pjpeg':
					$image_res = imagecreatefromjpeg($image_temp); break;
				default:
					$image_res = false;
			}
			if($image_res){
				$image_info = pathinfo($image_name);
				$image_extension = strtolower($image_info["extension"]); //image extension
				$image_name_only = strtolower($image_info["filename"]);//file name only, no extension
				$new_file_name =pzk_session('userId').'.'. $imageFileType;
				$image_save_folder 	= $target_dir . $new_file_name;
				$this->normal_resize_image($image_res, $image_save_folder, $image_type, $max_image_size, $image_width, $image_height, $jpeg_quality);
				imagedestroy($image_res); //freeup memory
				$username= pzk_session('username');
				$userId= pzk_session('userId');
				$editdate=date("Y-m-d H:i:s");
				$avatar=BASE_URL.'/uploads/avatar/'.$new_file_name;
				$user=_db()->getEntity('user.account.user');
				$user->loadWhere(array('username',$username));
				$user->update(array('avatar'=>$avatar,'modified'=>$editdate,'modifiedId'=>$userId));
				$message="Bạn đã thay đổi avatar thành công";
				$editavatar = pzk_parse(pzk_app()->getPageUri('user/profile/editavatar'));
				$editavatar->setMessage($message);
				$editavatar->setError("");
				$this->layout();
				$this->append($editavatar);
				
				$this->display();	
			}
		}else{
			$error="Bạn chỉ được phép upload file ảnh JPG, JPEG, PNG, GIF";
		}

	}else{
		$error=$error="Dung lượng của file ảnh quá lớn, bạn hãy chọn file ảnh có kích thước < 488kb ";
	}
	$editavatar = pzk_parse(pzk_app()->getPageUri('user/profile/editavatar'));
	$editavatar->setMessage("");
	$editavatar->setError($error);
	$this->layout();
	$this->append($editavatar);
	
	$this->display();
}
}
 ?>