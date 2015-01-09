<?php 

/**
* 
*/
class PzkUserUser extends PzkObject
{
	public function loadData()
	{
			$ip=$_SERVER['REMOTE_ADDR'];
			$username= pzk_session('username');
			pzk_session('userIp',$ip);
			$user=_db()->getEntity('user.user');
			$user->loadWhere(array('username',$username));
			$wallets= $user->getWallets();
			$this->setName($user->getName());
			$this->setAmount($wallets->getAmount());
	}
	
}
 ?>