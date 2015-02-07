<?php
class PzkAdminFirstStatusController extends PzkGridAdminController {
    public $table = 'type_first_status';
    public $joins = array(
        array(
            'table' => 'admin_level',
            'condition' => 'type_first_status.type_id = admin_level.id',
            'type' =>''
        )
    );
    //select table
    public $selectFields = 'type_first_status.*, admin_level.level';
    public $listFieldSettings = array(
        array(
            'index' => 'level',
            'type' => 'text',
            'label' => 'Tên quyền'
        ),
        array(
            'index' => 'value',
            'type' => 'text',
            'label' => 'Tên trạng thái'
        ),


        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'status'
        )

    );

    public $searchFields = array('name');
    public $Searchlabels = 'Tên';
    //filter cho cac truong co type la select
    public $filterFields = array(

        array(
            'index' => 'usertype_id',
            'type' => 'select',
            'label' => 'Tên quyền',
            'table' => 'admin_level',
            'show_value' => 'id',
            'show_name' => 'level',
        ),
        array(
            'index'=>'status',
            'type' => 'status',
            'label' => 'status'
        )

    );
    //sort by
    public $sortFields = array(
        'id asc' => 'ID tăng',
        'id desc' => 'ID giảm',

    );

    //add theo dang binh thuong
    public $addLabel = 'Thêm trạng thái';
    public $addFields = 'type_id, value, status, date_create';
    public $addFieldSettings = array(
        array(
            'index' => 'type_id',
            'type' => 'select',
            'label' => 'tên quyền',
            'table' => 'admin_level',
            'show_value' => 'id',
            'show_name' => 'level',
        ),
        array(
            'index' => 'value',
            'type' => 'selectoption',
            'option' => array(
                'new'=> 'New',
                'accepted'=>'Accepted',
                'processing'=>'Processing',
                'deleted'=>'Deleted'
            ),
            'label' => 'Trạng thái đầu'
        ),
        array(
            'index' => 'date_create',
            'type' => 'datenow',
        ),

        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái',
            'options' => array(
                '0' => 'Không hoạt động',
                '1' => 'Hoạt động'
            ),
            'actions' => array(
                '0' => 'mở',
                '1' => 'dừng'
            )
        )
    );
    //edit
    public $editFieldSettings = array(
        array(
            'index' => 'type_id',
            'type' => 'select',
            'label' => 'tên quyền',
            'table' => 'admin_level',
            'show_value' => 'id',
            'show_name' => 'level',
        ),
        array(
            'index' => 'value',
            'type' => 'selectoption',
            'option' => array(
                'new'=> 'New',
                'accepted'=>'Accepted',
                'processing'=>'Processing',
                'deleted'=>'Deleted'
            ),
            'label' => 'Trạng thái đầu'
        ),
        array(
            'index' => 'date_edit',
            'type' => 'datenow',
        ),

        array(
            'index' => 'status',
            'type' => 'status',
            'label' => 'Trạng thái',
            'options' => array(
                '0' => 'Không hoạt động',
                '1' => 'Hoạt động'
            ),
            'actions' => array(
                '0' => 'mở',
                '1' => 'dừng'
            )
        )
    );


}
?>