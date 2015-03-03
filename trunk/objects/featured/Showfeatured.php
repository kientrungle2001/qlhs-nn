<?php 

/**
* 
*/
class PzkFeaturedShowfeatured extends PzkObject
{
	public function getFeaturedContent($id)
	{
		$content=_db()->useCB()->select('*')->from('featured')->where(array('id', $id))->result_one();
		return($content);
	}
	public function getFeaturedList($id){
		$parentid=_db()->useCB()->select('parent,title')->from('featured')->where(array('id', $id))->result_one();
		$parent=_db()->useCB()->select('parent,title,id')->from('featured')->where(array('id', $parentid['parent']))->result_one();
		$lists=_db()->useCB()->select('*')->from('featured')->where(array('parent', $parentid['parent']))->result();
		return(array($lists,$parentid,$parent));
	}
	public function getVisitor($ip,$id){
		$datevisit=date("Y-m-d 00:00:00");
		$test=_db()->useCB()->select('id')->from('featured_visitor')->where(array('featuredId', $id))->where(array('ip', $ip))->where(array('visited', $datevisit))->result_one();
		if(!$test){
			$addVisitor=array('featuredId'=>$id,'ip'=>$ip,'visited'=>$datevisit);
			$entity = _db()->useCb()->getEntity('table')->setTable('featured_visitor');
			$entity->setData($addVisitor);
			$entity->save();
		}
	}
	public function getRemoteIPAddress(){
		$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
		return $ip;
		echo $ip;
}
  
/* If your visitor comes from proxy server you have use another function
to get a real IP address: */

	public function getRealIPAddress(){  
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //check ip from share internet
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //to check ip is pass from proxy
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
}
	
}
 ?>