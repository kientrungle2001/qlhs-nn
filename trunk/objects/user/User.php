<?php 

/**
* 
*/
class PzkUserUser extends PzkObject
{
	public function loadData()
	{
			
			$username= pzk_session('username');
			
			$user=_db()->getEntity('user.user');
			$user->loadWhere(array('username',$username));
			$wallets= $user->getWallets();
			$this->setName($user->getName());
			$this->setAmount($wallets->getAmount());
	}
	
}
 ?>