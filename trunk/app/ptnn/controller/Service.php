<?php 
class PzkServiceController extends PzkController 
{
	public $masterPage='index';
	public $masterPosition='left';
	public function layout()
	{
		$this->page = pzk_parse($this->getApp()->getPageUri('index'));
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

	// Hiển thị password mới
	public function serviceAction() 
	{
		$this->layout();
		$this->append('service/service');
		$this->append('user/profile/profileuser','right');
		$this->display();
	
	}
	public function BuyServiceAction()
	{
		$opt_service= pzk_request('opt_service_type');
		$opt_service= explode(" ",$opt_service);
		$opt_service_id= $opt_service[0];
		$price= $opt_service[1];
		
		$price= trim($price);
		$price=(double)$price;
		$datetime=date("Y-m-d H:i:s");
		$wallets=_db()->getEntity('user.account.wallets');
		$wallets->loadWhere(array('username',pzk_session('username')));
		$amount=$wallets->getAmount();
		if($price < $amount)
		{
			// cập nhật database

			$amount= $amount- $price;
			$wallets->update(array('amount'=>$amount));
			$insert=_db()->getEntity('service.history_buyservice');
			$row=array('userId'=>pzk_session('userId'), 'serviceId'=>$opt_service_id, 'amount'=>$price, 'date'=>$datetime);
			$insert->setData($row);
			$insert->save();
			echo 1;

		}
		else echo 0;

	}
	public function ordercardAction() 
	{
		$this->layout();
		$this->append('service/ordercard');
		$this->append('user/profile/profileuser','right');
		$this->display();
	
	}
	public function OrderCardNexnobelsAction()
	{
		
		$ordercard_txtname= pzk_request('ordercard_txtname');
		$ordercard_txtphone= pzk_request('ordercard_txtphone');
		$ordercard_txtaddress= pzk_request('ordercard_txtaddress');
		$ordercard_quantity= pzk_request('ordercard_quantity');
		$ordercard_quantity= (int)$ordercard_quantity;
		$ordercard_selectcard= pzk_request('ordercard_selectcard');
		$opt_service= explode(" ",$ordercard_selectcard);
		$opt_service_id= $opt_service[0];
		$price= $opt_service[1];
		if($ordercard_quantity >=1){
			$price=$price*$ordercard_quantity;
		}else $ordercard_quantity=1;
		
		$price= trim($price);
		$price=(double)$price;
		$datetime=date("Y-m-d H:i:s");
		$ordercard=_db()->getEntity('service.order_card');
		$row=array('cardId'=>$opt_service_id,'fullname'=>$ordercard_txtname,'phone'=>$ordercard_txtphone, 'address'=>$ordercard_txtaddress,'quantity'=>$ordercard_quantity, 'amount'=>$price, 'date'=>$datetime);
		$ordercard->setData($row);
		$ordercard->save();
		echo 1;
	}
}
 ?>