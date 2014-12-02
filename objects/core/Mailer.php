<?php
class PzkCoreMailer extends PzkObjectLightWeight {
	public $secure = 'ssl';
	public $port = 465;
	public $from = 'nextnobels.jsc.edu@gmail.com';
	public $fromName = 'NextNobels';
	public function getMail() {
		require_once BASE_DIR .'/3rdparty/PHPMailer/PHPMailerAutoload.php';

		$mail = new PHPMailer;

		//$mail->SMTPDebug = 3;                               // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = $this->host;  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = $this->username;                 // SMTP username
		$mail->Password = $this->password;                           // SMTP password
		$mail->SMTPSecure = $this->secure;                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = $this->port;                                    // TCP port to connect to
		$mail->From = $this->from;
		$mail->FromName = $this->fromName;
		$mail->isHTML(true);
		return $mail;
	}
}
function pzk_mailer() {
	return pzk_element('mailer')->getMail();
}