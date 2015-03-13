<?php 
/**
* 
*/
class PzkEntityUserAccountUserModel extends PzkEntityModel
{
	public $table="user";
	public function getWallets()
	{
		$wallets=_db()->getEntity('user.account.wallets');
		$wallets->loadWhere(array('username',$this->getUsername()));
		return $wallets;
	}
	
	public function create($userData) {
		$this->setData($userData);
		$this->save();
	}
	
	public function addFriend($user) {
		if($user->getId()) {
			$friend = _db()->getEntity('user.friend');
			$friend->setUsername($this->getUsername());
			$friend->setUserfriend($this->getUserfriend());
			$friend->setDate(date('Y-m-d H:i:s', time()));
			$friend->save();
			
			$friend = _db()->getEntity('user.friend');
			$friend->setUsername($this->getUserfriend());
			$friend->setUserfriend($this->getUsername());
			$friend->setDate(date('Y-m-d H:i:s', time()));
			$friend->save();
		}
		
	}
	
	public function removeFriend($user) {
		if($user->getId()) {
			$friend = _db()->getEntity('user.friend');
			$friend->loadWhere(array('and', array('username', $this->getUsername()), array('userfriend', $user->getUsername())));
			if($friend->getId()) {
				$friend->delete();
			}

			$friend = _db()->getEntity('user.friend');
			$friend->loadWhere(array('and', array('username', $user->getUsername()), array('userfriend', $this->getUsername())));
			if($friend->getId()) {
				$friend->delete();
			}
		}
		
	}
	
	public function inviteFriend($user, $message) {
		if($user->getId()) {
			$invitation = _db()->getEntity('user.invitation');
			$invitation->setUsername($this->getUsername());
			$invitation->setUserinvitation($user->getUsername());
			$invitation->setInvitation($message);
			$invitation->save();	
		}
	}
	public function acceptInvitation($invitation) {
		$this->addFriend($invitation->getUser());
	}
	public functin denyInvitation($invitation) {
		$invitation->delete();
	}
}
 ?>