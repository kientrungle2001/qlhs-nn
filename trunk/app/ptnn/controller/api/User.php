<?php
class PzkApiUserController extends PzkController {
	public function loginPostAction() {
		$request = pzk_request();
		$password=md5($request->get('password'));
		$items = _db()->useCB()->select('user.*')->from('user')
				->where( array('equal', 'username', $request->get('login')))->result_one();
		if($items)
		{
			//lấy pass từ csdl
			$pass= $items['password'];
			$status=$items['status'];
			if($pass==$password)
			{
				if($status==1)
				{
					pzk_session('login', true);
					pzk_session('username', $request->get('login'));
					pzk_session('userId',$items['id']);
					return json_encode(array('success' => 1));
				}else
				{
					//tài khoản của bạn đăng bị khóa hoặc chưa kích hoạt
					$error="Tài khoản của bạn đăng bị khóa hoặc chưa kích hoạt";
				}
			}else 
				{
					//Mật khẩu đăng nhập chưa đúng
					$error="Mật khẩu đăng nhập chưa đúng";
				}

		}else
		{
			$error="Tên đăng nhập chưa đúng";
		}
		return json_encode(array('error' => $error, 'success' => 0));
	}
	
	public function logoutAction() {
		pzk_session('login',false);
		pzk_session('username',false);
		pzk_session('userId',false);
	}
}