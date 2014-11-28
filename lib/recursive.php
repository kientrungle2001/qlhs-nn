<?php 
/**
 * Function : Recursive
 * Author   : JosT
 * Date     : Dec 6, 2014
 */

	function buildArr($data, $columnName, $parentValue = 0)
	{
		recursive($data, $columnName, $parentValue, 1, $resultArr);
		return $resultArr;
	}
	
	function recursive($data,$columnName = "",$parentValue = 0, $lever = 1,&$resultArr)
	{
		if(count($data) > 0){
			foreach ($data as $key => $value) {
				if($value['parent'] == $parentValue){
					$value['lever'] = $lever;
					$resultArr[] = $value;
					$newParent = $value['id'];
					unset($data[$key]);
					recursive($data,$columnName,$newParent,$lever+1,$resultArr);
				}
			}
		}
	}
	function debug($data = array())
	{
		if($data){
			echo "<pre/>";
			print_r($data);
		}
	}
 ?>