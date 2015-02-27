<?php

/**
 * View handling for displaying a list of all forums (nodes).
 *
 * @package XenForo_Nodes
 */
class XenForo_ViewPublic_Forum_List extends XenForo_ViewPublic_Base
{
	/**
	 * Renders the HTML page.
	 *
	 * @return mixed
	 */
	public function renderHtml()
	{
		$this->_params['renderedNodes'] = XenForo_ViewPublic_Helper_Node::renderNodeTreeFromDisplayArray(
			$this, $this->_params['nodeList']
		);
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
}