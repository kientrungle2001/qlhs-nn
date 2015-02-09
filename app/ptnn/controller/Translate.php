<?php
class PzkTranslateController extends PzkController {
	public $masterPage='index';
	public $masterPosition='right';
	
	
	public function translateAction()
	{
		$this->initPage()->append('translate/translate')->display();
	}
	
	
	
}
?>