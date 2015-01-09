<?php
class PzkAdminHomeController extends PzkController {
	/*nguyenson*/
	function __construct(){
		
		$admin = pzk_session('adminUser') ;
		
		if(!$admin){
			
			 $this->redirect('admin_login/index');
		}
		
		$menu =  pzk_session(MENU, 'admin_home');
	}
	
	public function indexAction() {
		$pageUri = pzk_app()->getPageUri('admin/home/index');
		$page = pzk_parse($pageUri);
		$page->display();
	}
	public function ribbonAction() {
		$pageUri = pzk_app()->getPageUri('admin/home/index');
		$page = pzk_parse($pageUri);
		$ribbon = pzk_parse(pzk_app()->getPageUri('admin/home/ribbon'));
		pzk_element('left')->append($ribbon);
		$page->display();
	}
	public function categoryJSONAction() {
		$items = _db()->select('*')->from('categories')->orderBy('parent asc')->result();
		$result = array();
		foreach($items as $item) {
			if($item['parent'] == 0) {
				$result[] = array('id' => $item['id'], 'text' => $item['name'], 'children' => array());
			} else {
				foreach($result as $index => $child) {
					if($item['parent'] == $child['id']) {
						$result[$index]['children'][] = array('id' => $item['id'], 'text' => $item['name'], 'children' => array());
					}
					foreach($child['children'] as $subindex => $subchild) {
						if($item['parent'] == $subchild['id']) {
							$result[$index]['children'][$subindex]['children'][] = array('id' => $item['id'], 'text' => $item['name'], 'children' => array());
						}
					}
				}
			}
		}
		echo json_encode($result);
	}
	public function categoryAction() {
		$request = pzk_request();
		
		$pageUri = pzk_app()->getPageUri('admin/home/index');
		$page = pzk_parse($pageUri);
		
		$categoryId = $request->getSegment(3);
		$categoryUri = pzk_app()->getPageUri('admin/home/category');
		$cat = pzk_parse($categoryUri);
		pzk_element('right')->append($cat);
		
		$questionsUri = pzk_app()->getPageUri('admin/home/questions');
		$questions = pzk_parse($questionsUri);
		$questions->setParentId($categoryId);
		pzk_element('left')->append($questions);
		$page->display();
	}
}