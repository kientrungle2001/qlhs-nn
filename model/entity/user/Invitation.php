<?php 
/**
* 
*/
class PzkEntityUserInvitationModel extends PzkEntityModel
{
	public $table="invitation"; 
	public function getUser() {
		return _db()->getEntity('user.account.user')->loadWhere(array('username', $this->getUsername()));
	}
}
 ?>