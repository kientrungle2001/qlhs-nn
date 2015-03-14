<?php
class PzkCategoryModel {
	
	function get_category($id = ''){
		
		if(!empty($id)){
			$query = _db()->select('ct.*')
			->from('categories ct')
			->where("ct.id='$id'");
		}else{
			$query = _db()->select('ct.*')
			->orderBy('id ASC')
			->from('categories ct');
		}
		return $query->result();
	}
	
	function get_category_all($id = ''){
		
		if(!empty($id)){
			
			$query = _db()->select('ct.*') ->from('categories ct') ->where("ct.id='$id'");
			
			$results = $query->result();
			
			if(count($results) >0){
				
				$category = $results[0];
				
				$category['child']	=	$this->get_category_child($id);
				
				return $category;
			}
		}
		return NULL;
	}
	
	function get_category_child($id = ''){
		
		if(!empty($id)){
			
			$query = _db()->select('ct.*') ->from('categories ct') ->where("ct.parent='$id'");
			
			if(count($query->result()) >0){
				
				return $query->result();
			}
		}
		return NULL;
	}
}