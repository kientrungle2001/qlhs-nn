<?php 
class PzkInvitationController extends PzkController 
{
	public $masterPage='index';
	public $masterPosition='left';
	public function layout()
	{
		$this->page = pzk_parse($this->getApp()->getPageUri('index'));
	}
	public function listinvitationAction()
	{
		$this->layout();		
		$this->append('user/profile/profileuser', 'right');
		$this->append('user/profile/profileuserleft1')->append('communication/invitation/listinvitation');
		$this->page->display();
	
	}
	public function agreeAction()
	{
		$request=pzk_element('request');
		$usersendinvi=$request->get('userinvitation');
		$username=$request->get('userinvitation');
		$invitation=_db()->getEntity('communication.invitation');
		$invitation->loadWhere(array('and',array('userinvitation',pzk_session('username')),array('username',$usersendinvi)));
		//$invitation->loadWhere(array('userinvitation',pzk_session('username')));
		$invitation->delete();
		$rowfriend=array('username'=>pzk_session('username'),'userfriend'=>$usersendinvi);
		$friend=_db()->getEntity('communication.friend');
		$friend->setData($rowfriend);
		$friend->save();
		$rowfriend=array('userfriend'=>pzk_session('username'),'username'=>$username);
		$friend=_db()->getEntity('communication.friend');
		$friend->setData($rowfriend);
		$friend->save();
		$this->redirect('listinvitation');
	}
	public function denyAction()
	{
		$request=pzk_element('request');
		$usersendinvi=$request->get('userinvitation');
		$invitation=_db()->getEntity('communication.invitation');
		$invitation->loadWhere(array('and',array('userinvitation',pzk_session('username')),array('username',$usersendinvi)));
		$invitation->delete();
		$this->redirect('listinvitation');
	
	}

}
 ?>