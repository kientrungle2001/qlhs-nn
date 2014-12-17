<?php
class PzkAdminQuestiontypeController extends PzkAdminController {
    public $masterStructure = 'admin/home/index';
    public $masterPosition = 'left';
    public $addFields = 'name, question_id';
    public $editFields = 'name, question_id';
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
                'required' => 'Tên câu hỏi không được để trống',
                'minlength' => 'Tên câu hỏi phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên câu hỏi chỉ dài tối đa 255 ký tự'
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
                'required' => 'Tên câu hỏi không được để trống',
                'minlength' => 'Tên câu hỏi phải dài 2 ký tự trở lên',
                'maxlength' => 'Tên câu hỏi chỉ dài tối đa 255 ký tự'
            )
        )
    );
}