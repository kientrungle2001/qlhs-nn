<?php
class PzkBackendController extends PzkController
{
    public function __construct() {
        $admin = pzk_session('adminUser') ;
        $level = pzk_session('adminLevel') ;

        switch ($level) {
            case 'mob':
            {
                $controller = pzk_request('controller');
                $action = pzk_request('action');
                if($action) {
                    $parentCa = $controller.'/'.$action;
                }else {
                    $parentCa = $controller;
                }


                $adminmodel = pzk_model('admin');
                $checkLogin = $adminmodel->checkAction($parentCa, $level);
                if(!$checkLogin) {
                    $view = pzk_parse('<div layout="erorr/erorr" />');
                    $view->display();
                    die();


                }
                break;
            }
            case 'admin':
                break;
            default :
                $this->redirect('admin_login/index');
                break;
        }




    }
}
?>