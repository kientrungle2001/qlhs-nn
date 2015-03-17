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
			$friend = _db()->getEntity('communication.friend');
			$friend->setUsername($this->getUsername());
			$friend->setUserfriend($this->getUserfriend());
			$friend->setDate(date('Y-m-d H:i:s', time()));
			$friend->save();
			
			$friend = _db()->getEntity('communication.friend');
			$friend->setUsername($this->getUserfriend());
			$friend->setUserfriend($this->getUsername());
			$friend->setDate(date('Y-m-d H:i:s', time()));
			$friend->save();
		}
		
	}
	
	public function removeFriend($user) {
		if($user->getId()) {
			$friend = _db()->getEntity('communication.friend');
			$friend->loadWhere(array('and', array('username', $this->getUsername()), array('userfriend', $user->getUsername())));
			if($friend->getId()) {
				$friend->delete();
			}

			$friend = _db()->getEntity('communication.friend');
			$friend->loadWhere(array('and', array('username', $user->getUsername()), array('userfriend', $this->getUsername())));
			if($friend->getId()) {
				$friend->delete();
			}
		}
		
	}
	
	public function inviteFriend($user, $message) {
		if($user->getId()) {
			$invitation = _db()->getEntity('communication.invitation');
			$invitation->setUsername($this->getUsername());
			$invitation->setUserinvitation($user->getUsername());
			$invitation->setInvitation($message);
			$invitation->save();	
		}
	}
	public function acceptInvitation($invitation) {
		if($this->getUsername() == $invitation->getUserinvitation()) {
			$this->addFriend($invitation->getUser());
			$invitation->delete();
		}
		
	}
	public function denyInvitation($invitation) {
		if($this->getUsername() == $invitation->getUserinvitation()) {
			$invitation->delete();
		}
	}
	
	public function loadByUsername($username) {
		return $this->loadWhere(array('username', $username));
	}
	
	public function loadByKey($key) {
		return $this->loadWhere(array('key', $key));
	}
	
	public function loadByEmail($email) {
		return $this->loadWhere(array('email', $email));
	}
	
	public function login() {
		$s = pzk_session();
		$s->setLogin(true);
		$s->setUsername($this->getUsername());
		$s->setUserId($this->getId());
		$s->setName($this->getName());
		$s->setAvatar($this->getAvatar());
		
		$datelogin = date("Y-m-d H:i:s");
		$this->update(array('lastlogined' => $datelogin ));
		
	}
	
	public function logout() {
		$s = pzk_session();
		$s->delLogin();
		$s->delUsername();
		$s->delUserId();
		$s->delName();
		$s->delAvatar();
	}
	
	public function activate() {
		$this->update(array('status' => 1,'key'=>""));
		$wallets = $this->getWallets();
		$wallets->setUsername($this->getUsername());
		$wallets->setAmount(0);
		$wallets->save();
	}
	
	public function resetPasssword() {
		$password=md5(rand(0,9999999999) . $this->getPassword());
		$password=substr($password,0,8) . 'AH1';
		$newPassword = md5($password);
		$this->update(array('password' => $newPassword, 'key'=>''));
		return $password;
	}
}
 ?>