<?php 

/**
* 
*/
class PzkUserAccountLogin extends PzkObject
{
	public function CheckFB($id, $name){
		$user=_db()->getEntity('user.account.user');
		if($id){
			$user->loadWhere(array('idFacebook',$id));
			if($user->getId()){
				$userId=$user->getId();
				$name=$user->getName();
				pzk_session('login', true);
				pzk_session('username', $id);
				pzk_session('userId',$userId);
				pzk_session('name',$name);

				//header('location:'.'/home/');
				
			}else{

				$row=array('idFacebook'=>$id,'name'=>$name,'username'=>$id);
				$user->setData($row);
				$user->save();
				$userId=$user->getId();
				$name=$user->getName();
				pzk_session('login', true);
				pzk_session('username', $id);
				pzk_session('userId',$userId);
				pzk_session('name',$name);
				//header('location:'.'/home/');
				
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

				//header('location:'.'/home/');
				
			}else{

				$row=array('idGoogle'=>$id,'name'=>$name,'username'=>$id, 'email'=>$email, 'sex'=>$sex);
				$user->setData($row);
				$user->save();
				$userId=$user->getId();
				
				pzk_session('login', true);
				pzk_session('username',$id);
				pzk_session('userId',$userId);
				pzk_session('name',$name);
				//header('location:'.'/home/');
				
			}
		}
		

	}	
}
 ?>