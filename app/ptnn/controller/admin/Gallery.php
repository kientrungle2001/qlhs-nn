<?php
class PzkAdminGalleryController extends PzkGridAdminController {
	 public $table = 'gallery';
    public $joins = array(
        array(
            'table' => 'gallery_img',
            'condition' => 'gallery.id = gallery_img.galleryId',
            'type' =>'left'
        )
    );
    //select table
    public $selectFields = 'gallery.*, gallery_img.url';
	public $addFields = 'title, date, brief';
	public $editFields = 'title, date, brief';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm',
		'date asc' => 'Ngày tăng',
		'date desc' => 'Ngày giảm'
		
	);
	public $searchFields = array('title, date, brief,url');
		public $listFieldSettings = array(
        array(
            'index' => 'title',
            'type' => 'text',
            'label' => 'Hoạt động'
        ),
        array(
            'index' => 'brief',
            'type' => 'text',
            'label' => 'Mô tả ngắn gọn'
        ),
		array(
            'index' => 'url',
            'type' => 'text',
            'label' => 'Đường dẫn ảnh'
        ),
		array(
            'index' => 'date',
            'type' => 'text',
            'label' => 'Ngày diễn ra'
        )

    );
   public $addLabel = 'Thêm';
   public $addFieldSettings = array(
          array(
            'index' => 'title',
            'type' => 'text',
            'label' => 'Hoạt động'
        ),
        array(
            'index' => 'brief',
            'type' => 'text',
            'label' => 'Mô tả ngắn gọn'
        ),
		
		array(
            'index' => 'date',
            'type' => 'date',
            'label' => 'Ngày diễn ra'
        )

    );

    public $editFieldSettings = array(
           array(
            'index' => 'title',
            'type' => 'text',
            'label' => 'Hoạt động'
        ),
        array(
            'index' => 'brief',
            'type' => 'text',
            'label' => 'Mô tả ngắn gọn'
        ),
		
		array(
            'index' => 'date',
            'type' => 'date',
            'label' => 'Ngày diễn ra'
        )


		
    );
	//add menu links
    public $menuLinks = array(
        array(
            'name' => 'Thêm ảnh hoạt động',
            'href' => '/admin_galleryadd'
        )
    );
	
}