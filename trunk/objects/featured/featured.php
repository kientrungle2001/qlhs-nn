<?php 

/**
* 
*/
class PzkFeaturedFeatured extends PzkObject
{
	
	public function getFeatured()
	{
		$titles=_db()->useCB()->select("*")->from("featured")->where(array('parent','0'))->result();
		return($titles);
	}
	public function getSubFeatured($id)
	{
		$titles2=_db()->useCB()->select("*")->from("featured")->where(array('parent',$id))->limit(5)->result();
		return($titles2);
	}
	
	
}
 ?>