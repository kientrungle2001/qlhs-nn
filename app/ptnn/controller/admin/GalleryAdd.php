<?php
class PzkAdminGalleryAddController extends PzkGridAdminController {
	 public $table = 'gallery_img';
    
	public $addFields = 'galleryId, url';
	public $editFields = 'galleryId, url';
	public $sortFields = array(
		'id asc' => 'ID tăng',
		'id desc' => 'ID giảm'
		
		
	);
	
	public $listFieldSettings = array(
        array(
            'index' => 'galleryId',
            'type' => 'text',
            'label' => 'Id hoạt động'
        ),
        array(
            'index' => 'url',
            'type' => 'text',
            'label' => 'Đường dẫn ảnh'
        )

    );
   public $addLabel = 'Thêm';
   public $addFieldSettings = array(
            array(
            'index' => 'galleryId',
            'type' => 'text',
            'label' => 'Id hoạt động'
        ),
        array(
            'index' => 'url',
            'type' => 'upload',
            'uploadtype'=>'image',
            'label' => 'Chọn ảnh',
        )

    );

    public $editFieldSettings = array(
           array(
            'index' => 'galleryId',
            'type' => 'text',
            'label' => 'Id hoạt động'
        ),
        array(
            'index' => 'url',
            'type' => 'upload',
            'uploadtype'=>'image',
            'label' => 'Chọn ảnh',
        )
    );
	public $menuLinks = array(
        array(
            'name' => 'Quay lại',
            'href' => '/admin_gallery'
        )
    );
	
	
}