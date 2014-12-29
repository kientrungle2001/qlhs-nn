<?php
class PzkAdminMailsController extends PzkAdminController {
	
		public function sendMailAction() {
	
		$mailtemplate->setUsername('kientrungle2001');
		$mailtemplate->setPassword('kienkien');
		$mail = pzk_mailer();
		$mail->AddAddress('dungbuonnua88@gmail.com');
		$mail->Subject = 'Here is the subject';
		$mail->Body    = 'content here';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo 'Message has been sent';
		}
	}
}
	
?>