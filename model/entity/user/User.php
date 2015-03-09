<?php 
/**
* 
*/
class PzkEntityUserUserModel extends PzkEntityModel
{
	public $table="user";
	public function getWallets()
	{
		$wallets=_db()->getEntity('user.wallets');
		$wallets->loadWhere(array('username',$this->getUsername()));
		return $wallets;
	}
	
	public function addTransaction($transactionData) {
		$transaction = _db()->getEntity('user.transaction');
		$transaction->setData($transactionData);
		$transaction->save();
		$wallets = $this->getWallets();
		$wallets->executeTransaction($transaction);
	}
}
 ?>