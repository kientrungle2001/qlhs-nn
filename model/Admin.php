<?php
class PzkAdminModel {
    public function getUser($username) {
        static $data = array();
        if (!$username) return false;
        if (!@$data[$username]) {
            if (is_numeric($username)) {
                $userId = $username;
                $conds = "`id`='$userId'";
            } else {
                $conds = "`username`='$username'";
            }
            $users = _db()->select('*')->from('user')
                ->where($conds)->limit(0, 1)->result();
            if ($users) $data[$username] = $users[0];
            else $data[$username] = false;
        }
        return $data[$username];
    }

    public function login($username, $password) {
        $password = md5(trim($password));
        $users = _db()->select('a.*, at.*')
            ->from('admin a')
            ->join('admin_type at', 'a.usertype_id = at.id')
            ->where("name='$username' and password='$password'")
            ->limit(0, 1);
        $users = $users->result_one();

        if ($users) {
            return $users;
        }else{
            return false;

        }
    }

    public function logout() {

    }
}
?>