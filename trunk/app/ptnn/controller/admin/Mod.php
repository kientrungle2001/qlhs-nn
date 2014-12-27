<?php
class PzkAdminModController extends PzkAdminController {
    public $masterStructure = 'admin/home/index';
    public $masterPosition = 'left';
    public $addFields = 'name, usertype_id, password, status';
    public $editFields = 'name, usertype_id, password, status';
    public $addValidator = array(
        'rules' => array(
            'name' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 255
            )
        ),
        'messages' => array(
            'name' => array(
                'required' => 'Tên người dùng không được để trống',
                'minlength' => 'Tên người dùng phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên người dùng chỉ dài tối đa 255 ký tự'
            )
        )
    );
    public $editValidator = array(
        'rules' => array(
            'name' => array(
                'required' => true,
                'minlength' => 2,
                'maxlength' => 255
            )
        ),
        'messages' => array(
            'name' => array(
                'required' => 'Tên người dùng không được để trống',
                'minlength' => 'Tên người dùng phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên người dùng chỉ dài tối đa 255 ký tự'
            )
        )
    );
}