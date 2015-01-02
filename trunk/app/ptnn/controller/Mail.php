<?php
class PzkMailController extends PzkController {
	
	
	public function layout()
		{
			$this->page = pzk_parse($this->getApp()->getPageUri('index'));
		}
	
	 public function mailAction()
		{
			$this->layout();
			$pageUri = $this->getApp()->getPageUri('/mail/mail');
			$page = PzkParser::parse($pageUri); 
			$left = pzk_element('right');
			$left->append($page);
			$this->page->display();
		}
	public function sendMail($email="") 
		{
			$mailtemplate = pzk_parse(pzk_app()->getPageUri('mail/mailtemplate/register'));
			$mail = pzk_mailer();
			$mail->AddAddress($email);
			$mail->Subject = 'Cam on ban da dang ky nhan tin qua email';
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
						$this->layout();
						 pzk_notifier_add_message($error, 'danger');
						$left = pzk_element('left');
						$this->page->display();
						
					} else
					if($testEmail2)
					{
						$error="Email đã tồn tại trên hệ thống"."<br>"."Vui lòng đăng nhập để đăng ký";
						$this->layout();
						pzk_notifier_add_message($error, 'danger');
						$left = pzk_element('left');
						$this->page->display();
						
					}
			
			 
				else
					{
						$dateregister=date("Y-m-d H:i:s");
						$addLesson=array('mail'=>$email,'dateregister'=>$dateregister);
						$entity = _db()->useCb()->getEntity('table')->setTable('mail');
						$entity->setData($addLesson);
						$entity->save();
						$this->sendMail($email);
						$this->layout();
						$pageUri = $this->getApp()->getPageUri('mail/showregister');
						$page = PzkParser::parse($pageUri);	
						$left = pzk_element('left');
						$left->append($page);
						$this->page->display();
					
			}
	}
	public function showregisterAction()
		{	
		$this->layout();
		$pageUri = $this->getApp()->getPageUri('mail/showregister');
		$page = PzkParser::parse($pageUri);	
		$left = pzk_element('left');
		$left->append($page);
		$this->page->display();
		}
	public function registerAction()
	{
		$this->layout();
		$pageUri = $this->getApp()->getPageUri('mail/register');
		$page = PzkParser::parse($pageUri);	
		$left = pzk_element('left');
		$left->append($page);
		$this->page->display();
	}
	public function unregAction()
	{
		$this->layout();
		$pageUri = $this->getApp()->getPageUri('mail/unreg');
		$page = PzkParser::parse($pageUri);	
		$left = pzk_element('left');
		$left->append($page);
		$this->page->display();
	}
	public function unregPostAction()
	{
		$email=pzk_request('email')
		$del=_db()->useCB()->delete()->from('mail')
            ->where('mail'=$email)->result();
	}
	
	
	
}
?>