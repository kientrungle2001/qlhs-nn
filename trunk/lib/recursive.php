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

    function buildTree(array $elements, $parentId = 0) {
        $branch = array();
        foreach ($elements as $key1=>$element) {
            if ($element['parent'] == $parentId) {
                $children = buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

    function show_menu($array = array())
    {
        echo '<ul class="drop">';
        foreach ($array as $item)
        {
            echo '<li>';
            echo '<a href="'.pzk_request()->build($item['router'].'/'.$item['id']).'"">';
            echo $item['name'];
            echo '</a>';
            if (!empty($item['children']))
            {
                show_menu($item['children']);
            }
            echo '</li>';
        }
        echo '</ul>';
    }

function showAdminMenu($array = array()){
    echo '<ul class="drop">';
        foreach ($array as $item)
        {
            echo '<li>';
            if($item['admin_controller'] == '0'){
                echo '<a href="javarscript:void(0);">';
            }else {
                echo '<a href="/'.$item['admin_controller'].'/index">';
            }
            echo $item['name'];
            echo '</a>';
            if (!empty($item['children']))
            {
                showAdminMenu($item['children']);
            }
            echo '</li>';
        }
        echo '</ul>';
    }

    function getChilds($root_id, &$array_themes=array()) {//tham so la mang truyen vao, muon thao tac voi mang can them & dang truoc
        $this->load->model('catalog/category');
        $rootChild = $this->model_catalog_category->getCategories($root_id);
        if($rootChild){
            if(count($rootChild) > 0){
                foreach($rootChild as $key => $val) {
                    $array_themes[]=$val['category_id'];
                    $this->getChilds($val['category_id'], $array_themes);
                }
            }
        }
        return $array_themes;
    }

	function debug($data = array())
	{
		if($data){
			echo "<pre/>";
			print_r($data);
		}
	}
 ?>