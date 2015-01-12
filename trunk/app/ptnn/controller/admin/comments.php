<?php
class PzkAdminCommentsController extends PzkGridAdminController {
	public $table = 'comment';
	
	public $editFields = 'newsId, comment, ip, created,userId';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'created asc' => 'Ngày tăng',
		'created desc' => 'Ngày giảm',
		
	);
	public $searchFields = array('title', 'url', 'ngaytao', 'code', 'status');
		public $listFieldSettings = array(
        array(
            'index' => 'newsId',
            'type' => 'text',
            'label' => 'Id Tin tức'
        ),
        array(
            'index' => 'comment',
            'type' => 'text',
            'label' => 'Bình luận'
        ),
		array(
            'index' => 'ip',
            'type' => 'text',
            'label' => 'Địa chỉ IP'
        ),
        array(
            'index' => 'created',
            'type' => 'text',
            'label' => 'Ngày tạo'
        )

    );
   public $addLabel = 'Thêm Menu';
   public $addFieldSettings = array(
          array(
            'index' => 'newsId',
            'type' => 'text',
            'label' => 'Id Tin tức'
        ),
        array(
            'index' => 'comment',
            'type' => 'text',
            'label' => 'Bình luận'
        ),
		array(
            'index' => 'ip',
            'type' => 'text',
            'label' => 'Địa chỉ IP'
        ),
        array(
            'index' => 'created',
            'type' => 'date',
            'label' => 'Ngày tạo'
        )

    );

    public $editFieldSettings = array(
           array(
            'index' => 'newsId',
            'type' => 'text',
            'label' => 'Id Tin tức'
        ),
        array(
            'index' => 'comment',
            'type' => 'text',
            'label' => 'Bình luận'
        ),
		array(
            'index' => 'ip',
            'type' => 'text',
            'label' => 'Địa chỉ IP'
        ),
        array(
            'index' => 'created',
            'type' => 'date',
            'label' => 'Ngày tạo'
        )


		
    );
	
}