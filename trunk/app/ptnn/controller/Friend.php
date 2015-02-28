<?php 
class PzkFriendController extends PzkFrontendController 
{
	public $masterPage='index';
	public $masterPosition='left';
	public function layout()
	{
		$this->page = pzk_parse($this->getApp()->getPageUri('index'));
	}
	public function friendlistuserAction() 
	{
		
		$this->layout();
		$this->append('user/profile/profileuser', 'right');
		$this->append('user/profile/profileuserleft1')->append('communication/friend/friendlistuser');
		$this->display();
	}
	public function friendlistuserpageAction()
	{
		$searchuser=$this->parse('communication/friend/friendlistuserpage')	;
		$searchuser->display();

	}
	public function denyfriendAction()
	{
		$request=pzk_element('request');
		$member=$request->get('member');
		$user=_db()->useCB()->select('user.username as username')->from('user')->where(array('id',$member))->result_one();
		$userfriend=$user['username'];
		$username=$user['username'];
		$friend=_db()->getEntity('communication.friend');
		$friend->loadWhere(array('userfriend',$userfriend));
		$friend->delete();
		$friend->loadWhere(array('username',$username));
		$friend->delete();
		$url=$_SERVER["HTTP_REFERER"];
		
		$this->redirect($url);
	
	}
	public function SearchAction()
	{
		$this->layout();		
		$this->append('user/profile/profileuser', 'right');
		$this->append('user/profile/profileuserleft1')->append('communication/friend/search');
		$this->page->display();
			
	}
	public function ResultsearchAction()
	{
		$this->layout();		
		$this->append('communication/friend/resultsearch', 'left');
		$this->page->display();
	
	}
	public function searchPostAction()
	{
		$request=pzk_element('request');
		$searchfriend=$request->get('searchfriend');
		pzk_session('searchfriend', $searchfriend);

		$this->redirect('searchResult');
	}
	public function searchResultAction() 
	{
	
		$searchfriend = pzk_session('searchfriend');
		//$items_name=_db()->useCB()->select('user.*')->from('user')->where(array('or',array('like','email',$searchfriend),array('like','name',$searchfriend),array('like','username',$searchfriend)))->result();
		$this->layout();
		$pageSearch = pzk_parse(pzk_app()->getPageUri('communication/friend/resultsearch'));
		$pageSearch->setTxtsearch($searchfriend);	
		$this->append('user/profile/profileuser', 'right');
		$this->append('user/profile/profileuserleft1')->append('communication/friend/search')->append($pageSearch);
		$this->page->display();

		
	}
	public function searchuserAction()
	{
		$searchuser=$this->parse('communication/friend/searchuser')	;
		$searchuser->display();

	}
	public function PostCommentFriendAction()
	{
		$request=pzk_element('request');
		if(pzk_session('login')==false)
		{
			echo "bạn phải đăng nhập mới được bình luận";
		}
		else
		{

			$content=$request->get('write_wall');
			//echo $content;
			
			$username=$request->get('username');
			$userwritewall=pzk_session('username');
			$write_wall=_db()->getEntity('communication.user_write_wall');
			//$write_wall->loadWhere(array('username',$username));
			$datewrite= date("Y-m-d H:i:s");
			$row=array('username'=>$username, 'userwritewall'=>$userwritewall,'content'=>$content,'datewrite'=>$datewrite);
			$write_wall->setData($row);
			$write_wall->save();
			

		}
	}
	public function viewnoteAction()
	{
		$this->layout();
		$this->append('user/profile/profileuserleft1')->append('communication/friend/viewnote');
		$this->append('user/profile/profileuser','right');
		$this->display();
		//$this->render('user/payment/payment');		
	}
	public function viewnotePageAction()
	{
		$viewnotepage=$this->parse('communication/friend/viewnotepage')	;
		$viewnotepage->display();	
	}
	public function PostDelUserNoteAction()
	{
		$request=pzk_element('request');
		$idnote=$request->get('del');
		$username=pzk_session('username');
		$user_note=_db()->getEntity('communication.user_note');
		foreach ($idnote as $id) {
			$user_note->load($id);
			$user_note->delete();
		}
		echo "ok";
		
	}
	public function detailnoteAction()
	{
		$this->layout();
		$this->append('user/profile/profileuserleft1')->append('communication/friend/detailnote');
		$this->append('user/profile/profileuser','right');
		$this->display();
	}
	public function PostCommentNoteAction()
	{
		$note_id=pzk_request('note_id');
		
		
		
		if(pzk_session('login')==false)
		{
			echo "bạn phải đăng nhập mới được bình luận";
		}
		else
		{

			$comment_note1=pzk_request('comment_note');
			//echo $content;
			
			
			$userId=pzk_session('userId');
			$comment_note=_db()->getEntity('communication.user_note_comment');
			//$comment_note->loadWhere(array('username',$username));
			$date= date("Y-m-d H:i:s");
			$row=array('userId'=>$userId, 'noteId'=>$note_id,'comment'=>$comment_note1,'date'=>$date);
			$comment_note->setData($row);
			$comment_note->save();
			echo 'ok';
		}
		
		
	}
	public function addnoteAction()
	{
		$this->layout();
		$this->append('user/profile/profileuserleft1')->append('communication/friend/addnote');
		$this->append('user/profile/profileuser','right');
		$this->display();
		//$this->render('user/payment/payment');		
	}
	public function PostUserNoteAction()
	{
		$request=pzk_element('request');
		$titlenote=$request->get('notetitle');
		$contentnote=$request->get('notecontent');
		$datenote= date("Y-m-d H:i:s");
		$username=pzk_session('username');
		$user_note=_db()->getEntity('communication.user_note');
		
		$rownote=array('username'=>$username,'titlenote'=>$titlenote,'contentnote'=>$contentnote,'datenote'=>$datenote);
		$user_note->setData($rownote);
		$user_note->save();
		
	}
	public function viewCommentAction()
	{
		$commentId= pzk_request('commentId');
		$detailnotepage=$this->parse('communication/friend/detailnotepage')	;
		$detailnotepage->display();

	}
	public function viewwritewallAction()
	{
		$this->layout();
		$this->append('user/profile/profileuserleft1')->append('communication/friend/viewwritewall');
		$this->append('user/profile/profileuser','right');
		$this->display();

	}
	public function viewwritewallPageAction()
	{
		$viewwritewallpage=$this->parse('communication/friend/viewwritewallpage')	;
		$viewwritewallpage->display();	
	}
}
 ?>