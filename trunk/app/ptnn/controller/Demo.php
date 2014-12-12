<?php
class PzkDemoController extends PzkController {
	
	public function sendMail() {
		$mailtemplate = pzk_parse(pzk_app()->getPageUri('user/mailtemplate/register'));
		$mailtemplate->setUsername('kientrungle2001');
		$mailtemplate->setPassword('kienkien');
		$mail = pzk_mailer();
		//$mail->AddAddress('kieunghia.cntt@gmail.com');
		//$mail->Subject = 'Here is the subject';
		//$mail->Body    = $mailtemplate->getContent();
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo 'Message has been sent';
		}
	}
	
	public function entityAction() {
		/*
		$entity = _db()->getTableEntity('news');
		$entity->setTitle('Tin tuc');
		$entity->setBrief('Mo ta');
		$entity->setContent('Noi dung');
		$entity->setRelated2s(array(1, 2, 3, 4));
		$entity->save();
		*/
		$entity = _db()->getTableEntity('news');
		$newss = $entity->getWhere(array('in', 'id', array(4, 5)));
		foreach($newss as $news) {
			echo $news->getTitle() . '<br />';
			var_dump($news->getRelated2s());
			//$news->setTitle($news->getTitle() . ' - updated');
			//$news->save();
		}
	}
	
	public function registerAction(){
		$pageUri = $this->getApp()->getPageUri('user/register');
		// doc trang
		$page = PzkParser::parse($pageUri);

		// thao tac

		// hien thi
		$page->display();
		

	}
	public function logoutAction(){
		pzk_session('login',false);
		pzk_session('username',false);
		pzk_session('userId',false);
		header('location:/demo/index');

	}
	public function indexAction() {
		// duong dan
		if(pzk_session('login')){
			echo "Đăng nhập thành công, Xin chào ^^: ";
			//die();
		}
		$pageUri = $this->getApp()->getPageUri('user/login');
		// doc trang
		$page = PzkParser::parse($pageUri);

		// thao tac

		// hien thi
		$page->display();
		
		
		// insert
		if(0) {
		$row1 = array( 'title' => 'Bai viet 3', 'content' => 'Bai viet 3' );
		$row2 = array( 'title' => 'Bai viet 4', 'content' => 'Bai viet 4' );
		_db()->insert('news')->fields('title,content')->values(array($row1, $row2))->result();
		}

		// update
		if(0) {
		_db()->update('news')->set(array('title' => 'Bai viet 4.1'))->where('id=4')->result();
		}

		// join
		if(0){
		$items = _db()->select('news.*, new2.*')->from('news')->join('new2', 'news.id = new2.id', 'left')->result();
		var_dump($items);
		}

		// delete
		if(0) {
		_db()->delete()->from('news')->where('id=4')->result();
		}

		// entity
		if(0){

		$news = _db()->getEntity('news');
		$news->load(2);
		//echo $news->getContent();
		$news->setTitle('Bai viet 2 updated');
		$news->save();

		$author = $news->getAuthor();
		$author->setLastEditTime(time());
		$author->save();
		$numberOfNews = $author->getNumberOfNews();
		echo $numberOfNews;
		}
		
		//entity from query
		$newsEntities = _db()->select('*')->from('news')->result('news');
		foreach($newsEntities as $newsEntity) {
			echo $newsEntity->getTitle() .'<br />';
		}
		
		// table entity
		$news = _db()->getTableEntity('news');
		$news->load(2);
		$news->setTitle('BV 2 Updated');
		$news->save();
		
		
		$entity = _db()->getTableEntity('news');
		$entity->setTitle('Tin tuc');
		$entity->setBrief('Mo ta');
		$entity->setContent('Noi dung');
		$entity->setRelated2s(array(1, 2, 3, 4));
		$entity->save();
		
		$entity = _db()->getTableEntity('news');
		// getWhere($conditions, $orderBy);
		$newss = $entity->getWhere(array('in', 'id', array(4, 5)));
		foreach($newss as $news) {
			echo $news->getTitle() . '<br />';
			var_dump($news->getRelated2s());
			$news->setTitle($news->getTitle() . ' - updated');
			$news->save();
		}
	}
	public function registerPostAction(){
		echo "register";
		$request= pzk_element('request');
		$name= $request->get('name');
		$username=$request->get('username');
		$testUser= _db()->useCB()->select('user.*')->from('user')->where(array('equal','username',$request->get('username')))->result();
		if($testUser){
			echo 'user đã tồn tại trên hệ thống';
		}else{
		$password=$request->get('password');
		$row = array('name' =>$name,'username'=>$username,'password'=>md5($password) );
		$items= _db()->insert('user')->fields('name,username,password')->values(array($row))->result();
	}

	}

	public function loginpostAction(){
		echo "hello";
		$request = pzk_element('request');
		//echo $request->get('login');
		$items = _db()->useCB()->select('user.*')->from('user')->where(array('and', array('equal', 'username', $request->get('login')), array('equal','password',$request->get('password')) ))->result_one();
		if($items){
			//echo 'dang nhap thanh cong';
			//echo $items['id'];
			pzk_session('login', true);
			pzk_session('username', $request->get('login'));
			pzk_session('userId',$items['id']);
			header('location:/demo/index');

		}else{
			
			$pageUri = $this->getApp()->getPageUri('user/login');
		// doc trang
		     $page = PzkParser::parse($pageUri);
		     $page->setError('dang nhap khong thanh cong');
		// thao tac

		// hien thi
		      $page->display();
		}
	}
}