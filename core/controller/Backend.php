<?php
class PzkBackendController extends PzkController
{
    public function __construct() {
        $admin = pzk_session('adminUser') ;
        $level = pzk_session('adminLevel') ;

        if(!$admin) {
            $this->redirect('admin_login/index');
        }
        elseif($admin && $level=='Administrator') {

        }
        else {
            $controller = pzk_request('controller');
            $parentCa = $controller;

            $adminmodel = pzk_model('admin');
            $checkLogin = $adminmodel->checkAction($parentCa, $level);
            if(!$checkLogin) {
                $view = pzk_parse('<div layout="erorr/erorr" />');
                $view->display();
                die();
            }
        }

    }
}
?>