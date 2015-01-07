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
}
 ?>