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
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //check ip from share internet
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //to check ip is pass from proxy
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{
			$ip = $_SERVER['REMOTE_ADDR'];
		$id=pzk_request('id');
		$utm_source=pzk_request('utm_source');
		$time=date("Y-m-d");		
		$testclick=_db()->useCB()->select('ip')->from('banner_click')->where(array('ip', $ip))->where(array('timeclick', $time))->where(array('bannerId', $id))->where(array('utm_source', $utm_source))->result_one();
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