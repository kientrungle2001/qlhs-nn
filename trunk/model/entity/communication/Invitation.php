<?php 
/**
* 
*/
class PzkEntityCommunicationInvitationModel extends PzkEntityModel
{
	public $table="invitation"; 
	public function getUser() {
		return _db()->getEntity('user.account.user')->loadWhere(array('username', $this->getUsername()));
	}
	public function getInvitationUser() {
		return _db()->getEntity('user.account.user')->loadWhere(array('username', $this->getUserinvitation()));
	}
}
 ?>