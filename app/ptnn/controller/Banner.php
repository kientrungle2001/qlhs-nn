<?php
class PzkBannerController extends PzkController {
	public $masterPage='index';
	public $masterPosition='right';
	
	
	public function bannerAction()
	{
		$this->initPage()->append('banner/banner')->display();
	}
	public function bannerPostAction()
	{
		$id=pzk_request('id');
		$utm_source=pzk_request('utm_source');
		$time=date("Y-m-d H:i:s");
		$ip=pzk_session('guestIP');
		
		$testclick=_db()->useCB()->select('ip')->from('banner_click')->where(array('ip', $ip))->where(array('bannerId', $id))->where(array('utm_source', $utm_source))->result_one();
		if(!$testclick)
		{
			
		
		$addclick=array('bannerId'=>$id,'ip'=>$ip,'utm_source'=>$utm_source,'timeclick'=>$time);
						$entity = _db()->useCb()->getEntity('table')->setTable('banner_click');
						$entity->setData($addclick);
						$entity->save();
		
		}
		$banner=_db()->useCB()->select("*")->from("banner_click")->where(array('bannerId',$id))->result();
		$click=count($banner);
		_db()->useCB()->update('banner')->set(array('click' => $click))->where(array('id',$id))->result();
		
		$this->redirect('news/news');
	}
	
	
	
}
?>