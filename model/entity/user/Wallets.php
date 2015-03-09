<?php 
/**
* 
*/
class PzkEntityUserWalletsModel extends PzkEntityModel
{
	public $table="wallets";
	public function executeTransaction($transaction) {
		$this->addAmount($transaction->getAmount());
		$this->save();
	}
	
	public function addAmount($amount) {
		$this->setAmount($amount + $this->getAmount());
	}
}
 ?>