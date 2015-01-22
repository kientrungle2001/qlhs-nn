<?php
class PzkAdminNewletterController extends PzkGridAdminController {
	public $table = 'mail';
	public $addFields = 'mail, dateregister' ;
	public $editFields = 'mail,dateregister';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'mail asc' => 'email tăng',
		'mail desc' => 'email giảm',
		'dateregister asc' => 'Ngày đăng ký tăng',
		'dateregister desc' => 'Ngày đăng ký giảm'
	);
	public $searchFields = array('mail', 'dateregister');
	public $listFieldSettings = array(
        array(
            'index' => 'mail',
            'type' => 'text',
            'label' => 'Địa chỉ mail'
        ),

        array(
            'index' => 'dateregister',
            'type' => 'text',
            'label' => 'Ngày đăng ký'
        )
	);
    public $addLabel = 'Thêm menu';
    public $addFieldSettings = array(
        array(
            'index' => 'mail',
            'type' => 'text',
            'label' => 'Địa chỉ mail'
        ),

        array(
            'index' => 'dateregister',
            'type' => 'text',
            'label' => 'Ngày đăng ký'
        )
    );
    public $editFieldSettings = array(
        array(
            'index' => 'mail',
            'type' => 'text',
            'label' => 'Địa chỉ mail'
        ),

        array(
            'index' => 'dateregister',
            'type' => 'text',
            'label' => 'Ngày đăng ký'
        )
    );
	public $menuLinks = array(
        array(
            'name' => 'Gửi thư cho người đăng ký',
            'href' => '/admin_newletter/send'
        ),
		array(
            'name' => 'Gửi thư cho toàn bộ thành viên',
            'href' => '/admin_newletter/sendall'
        )
    );
	   public $sendFieldSettings = array(
        array(
            'index' => 'mail',
            'type' => 'text',
            'label' => 'Địa chỉ mail'
        ),

        array(
            'index' => 'dateregister',
            'type' => 'text',
            'label' => 'Ngày đăng ký'
        )
    );
	   public $sendallFieldSettings = array(
        array(
            'index' => 'mail',
            'type' => 'text',
            'label' => 'Địa chỉ mail'
        ),

        array(
            'index' => 'dateregister',
            'type' => 'text',
            'label' => 'Ngày đăng ký'
        )
    );
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
		public function addAction() {
		$this->initPage()
			->append('admin/'.$this->module.'/add')
			->append('admin/'.$this->module.'/menu', 'right');
		$this->display();
	}
	public function sendMail($email="",$title="",$content="") 
		{
			$mail = pzk_mailer();
			$mail->CharSet = "UTF-8";
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

		}
	
	
}