<?php
require_once 'core/controller/Table.php';
class PzkDtableController extends PzkTableController {
	public $tables = array();
	public $defaultConds = array('profile_resource' => 
		array('category' => array(
			array('type' => 'Category')
		)));
	
	public $inserts = array(
		'region' => array('title', 'type', 'page', 'region', 'code', 'layout', 'style', 'ordering'),
		'directory' => array('title', 'type', 'subType', 'parentId'),
		'resource' => array('title', 'alias', 'type', 'subType', 'directoryId', 'access', 'params'),
		'profile' => array('type', 'subType', 'fullName', 'username', 'password', 'parentId'),
		'profile_resource' => array('title', 'type', 'subType', 'parentId', 'profileId', 'resourceId', 'params'),
	);
	
	public $filters = array();
	
	public $constraints = array();
	
	public function treejsonAction() {
		if(!isset($_REQUEST['table'])) {
			$_REQUEST['table'] = pzk_element('request')->getSegment(3);
			if(!isset($_REQUEST['id']))
				$_REQUEST['id'] = pzk_element('request')->getSegment(4);
		}
		parent::treejsonAction();
	}
}