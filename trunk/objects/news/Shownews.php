<?php 

/**
* 
*/
class PzkNewsShownews extends PzkObject
{
	public function getNewsContent($id)
	{
		$content=_db()->useCB()->select('*')->from('news')->where(array('id', $id))->result_one();
		return($content);
	}
	public function getNewsList($id){
		$parentid=_db()->useCB()->select('parent,title')->from('news')->where(array('id', $id))->result_one();
		$parent=_db()->useCB()->select('parent,title,id')->from('news')->where(array('id', $parentid['parent']))->result_one();
		$lists=_db()->useCB()->select('*')->from('news')->where(array('parent', $parentid['parent']))->result();
		return(array($lists,$parentid,$parent));
	}
	public function getVisitor($ip,$id){
		$datevisit=date("Y-m-d 00:00:00");
		$test=_db()->useCB()->select('id')->from('news_visitor')->where(array('newsId', $id))->where(array('ip', $ip))->where(array('visited', $datevisit))->result_one();
		if(!$test){
			$addVisitor=array('newsId'=>$id,'ip'=>$ip,'visited'=>$datevisit);
			$entity = _db()->useCb()->getEntity('table')->setTable('news_visitor');
			$entity->setData($addVisitor);
			$entity->save();
		}
	}
	
}
 ?>