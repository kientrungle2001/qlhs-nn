<?php 

class PzkUserAccountLogin extends PzkObject
{
	public function CheckFB($id, $name){
		$user=_db()->getEntity('user.account.user');
		$dateregister= date("Y-m-d H:i:s");
		if($id){
			$user->loadWhere(array('idFacebook',$id));
			if($user->getId()){
				$userId=$user->getId();
				$name=$user->getName();
				$username=$user->getUsername();
				pzk_session('login', true);
				pzk_session('username', $username);
				pzk_session('userId',$userId);
				pzk_session('name',$name);

			}else{

				$row=array('idFacebook'=>$id,'username'=>$id,'name'=>$name,'status'=>1,'registered'=>$dateregister,'lastlogined' =>$dateregister);
				$user->setData($row);
				$user->save();
				$userId=$user->getId();
				$name=$user->getName();
				pzk_session('login', true);
				pzk_session('username', $id);
				pzk_session('userId',$userId);
				pzk_session('name',$name);
				$user->update(array('lastlogined' =>$dateregister ));
			}
		}
	}
	
	public function CheckGoogle($id, $name,$email,$sex){
		$user=_db()->getEntity('user.account.user');
		if($id){
			$user->loadWhere(array('idGoogle',$id));
			if($user->getId()){
				$userId=$user->getId();
				$name=$user->getName();
				$username=$user->getUsername();
				pzk_session('login', true);
				pzk_session('username', $username);
				pzk_session('userId',$userId);
				pzk_session('name',$name);
			}else{
				$dateregister= date("Y-m-d H:i:s");
				$row=array('idGoogle'=>$id,'name'=>$name,'username'=>$id, 'email'=>$email, 'sex'=>$sex,'status'=>1,'registered'=>$dateregister,'lastlogined' =>$dateregister);
				$user->setData($row);
				$user->save();
				$userId=$user->getId();
				pzk_session('login', true);
				pzk_session('username',$id);
				pzk_session('userId',$userId);
				pzk_session('name',$name);
			}
		}
	}	
}
 ?>