<?php
class PzkAdminNewletterController extends PzkAdminController {
	public $masterStructure = 'admin/home/index';
	public $masterPosition = 'left';
	public $table = 'mail';
	public $addFields = 'mail, dateregister' ;
	public $editFields = 'mail,dateregister';
	public $addValidator = array(
		'rules' => array(
			'mail' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 255
			)
		),
		'messages' => array(
			'mail' => array(
				'required' => 'Nhập vào địa chỉ email',
				'minlength' => 'Địa chỉ email không được để trống',
				'maxlength' => 'Địa chỉ email quá dài'
			)
		)
	);
	public $editValidator = array(
		'rules' => array(
			'mail' => array(
				'required' => true,
				'minlength' => 2,
				'maxlength' => 255
			)
		),
		'messages' => array(
			'mail' => array(
				'required' => 'Nhập vào địa chỉ email',
				'minlength' => 'Địa chỉ email không được để trống',
				'maxlength' => 'Địa chỉ email quá dài'
			)
		)
	);
	public function layout()
		{
		$this->initPage();
		$news = pzk_parse(pzk_app()->getPageUri('admin/newletter/send'));
		$news->setParentId(pzk_request()->getSegment(3));
		$this	->append($news)
				->append('admin/newletter/menu','right')
				->display();
		}
	public function sendMail($email="",$title="",$content="") 
		{
			$mail = pzk_mailer();
			$mail->AddAddress($email);
			$mail->Subject = $title;
			$mail->Body    = $content;
			//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) 
			{
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
			}
		}
	public function sendPostAction()
	{
		$emails=_db()->select('mail')->from('mail')->result();
		//var_dump($email);
		$title=pzk_request('title');
		$content=pzk_request('content');
		foreach ($emails as $email)
		{
			$this->sendMail($email['mail'],$title,$content);
		}
		pzk_notifier()->addMessage('Gửi thành công');
		$this->layout();
	}
	public function sendAction()
		{
						$this->layout();
						$pageUri = $this->getApp()->getPageUri('mail/showsend');
						$page = PzkParser::parse($pageUri);	
						$left = pzk_element('left');
						$left->append($page);
						$this->page->display();
		}
	
	public function addAction() {
		if(pzk_request()->is('POST')) 
		{
			$post = pzk_request()->query;	
			$addnews=array(
                    'mail'=>$post['mail'],
					'dateregister'=>$post['dateregister']);
			$entity = _db()->useCb()->getEntity('table')->setTable('mail');
            $entity->setData($addnews);
            $entity->save();	
		}
				
		$this->initPage();
		$news = pzk_parse(pzk_app()->getPageUri('admin/newletter/add'));
		$news->setParentId(pzk_request()->getSegment(3));
		$this	->append($news)
				->append('admin/newletter/menu','right')
				->display();
	}
	public function sendallPostAction()
	{
		$emails=_db()->select('email')->from('user')->result();
		//var_dump($email);
		$title=pzk_request('title');
		$content=pzk_request('content');
		foreach ($emails as $email)
		{
			$this->sendMail($email['email'],$title,$content);
		}
		pzk_notifier()->addMessage('Gửi thành công');
		$this->layout();
	}
	public function sendallAction()
		{
						$this->layout();
						$pageUri = $this->getApp()->getPageUri('mail/showsend');
						$page = PzkParser::parse($pageUri);	
						$left = pzk_element('left');
						$left->append($page);
						$this->page->display();
		}
	
	
}