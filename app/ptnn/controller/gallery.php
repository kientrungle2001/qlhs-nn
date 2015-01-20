<?php
class PzkGalleryController extends PzkController {
	public $masterPage='index';
	public $masterPosition='left';
	
	
	public function showgalleryAction()
	{
		$this->initPage()->append('gallery/showgallery')->display();
	}
	public function thumbnailgalleryAction()
	{
		$this->initPage()->append('gallery/thumbnailgallery')->display();
	}
	
	
}
?>