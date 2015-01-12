<?php
class PzkMailController extends PzkController {
	public $masterPage='index';
	public $masterPosition='right';
	
	
	
	 public function mailAction()
		{
			$this->initPage()->append('/mail/mail')->display();
			
		}
	public function sendMail($email="") 
		{
			$mailtemplate = pzk_parse(pzk_app()->getPageUri('mail/mailtemplate/register'));
			$mail = pzk_mailer();
			$mail->CharSet = "UTF-8";
			$mail->AddAddress($email);
			$mail->Subject = 'Cảm ơn bạn đã đăng ký nhận tin qua Email';
			$mail->Body    = $mailtemplate->getContent();
			//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	}
	public function showregisterPostAction()
	{
			$error="";	
			$email=pzk_request('email');
			$testEmail= _db()->useCB()->select('mail')->from('mail')->where(array('equal','mail',$email))->result();
			$testEmail2= _db()->useCB()->select('email')->from('user')->where(array('equal','email',$email))->result();
				if($testEmail)
					{
						$error="Email đã tồn tại trên hệ thống";
						pzk_notifier_add_message($error, 'danger');
						$this->initPage()->display();
						
					} else
					if($testEmail2)
					{
						$error="Email đã tồn tại trên hệ thống"."<br>"."Vui lòng đăng nhập để đăng ký";
						pzk_notifier_add_message($error, 'danger');
						$this->initPage()->display();
					}
				else
					{
						$dateregister=date("Y-m-d H:i:s");
						$addLesson=array('mail'=>$email,'dateregister'=>$dateregister);
						$entity = _db()->useCb()->getEntity('table')->setTable('mail');
						$entity->setData($addLesson);
						$entity->save();
						$this->sendMail($email);
						$this->initPage()->append('mail/showregister')->display();
			}
	}
	public function showregisterAction()
		{	
		$this->initPage()->append('mail/showregister')->display();
		}
	public function registerAction()
	{
		$this->initPage()->append('mail/register')->display();
	}
	public function unregAction()
	{
		$this->initPage()->append('mail/unreg')->display();
	}
	public function unregPostAction()
	{
		
	}
	
	
	
}
?>