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
		
		$productEntities = _db()->select('id, name, price')->from('product')->limit(10, 0)->result('catalog.product');
		$featuredProductEntities = _db()->select('id, name, price')->fromProduct()->whereFeatured(1)->limit(10, 0)->result('catalog.product.featured');
		foreach($featuredProductEntities as $entity) {
		}
	}
	
	public function create() {
		
	}
}
 ?>