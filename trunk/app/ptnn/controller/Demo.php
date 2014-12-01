<?php
class PzkDemoController extends PzkController {
	

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