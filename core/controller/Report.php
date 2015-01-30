<?php
class PzkReportController extends PzkController {
    public $masterStructure = 'admin/home/index';
    public $masterPosition = 'left';
    public $scriptTo = 'head';
    public $customModule = false;
    public $module = 'report';
    public $table = false;
    public $joins = false;
    public $selectFields = '*';
    public $childTable = false;
    public $groupBy = false;
    public $groupByReport = false;
    public $titleController = false;
    public $events = array(
        'index.after' => array('this.indexAfter')
    );

    public function __construct() {
        debug(pzk_element('head'));
    }

    public function append($obj, $position = NULL) {
        $obj = $this->parse($obj);
        $obj->setTable($this->table);
        return parent::append($obj, $position);
    }
    public function indexAfter($event, $data) {
        $list = pzk_element('list');
        if($list) {
            $list->addEventListener('changeStatus', 'onChangeStatus');
        }
    }

    public function onChangeStatusAction() {
        $id = pzk_request('id');
        $field = pzk_request('field');
        if(!$field) $field = 'status';
        $entity = _db()->getTableEntity($this->table)->load($id);
        $status = 1 - @$entity->data[$field];
        $entity->update(array($field => $status));
        if($entity->data[$field] == '1') {
            //jQuery('#status-' . $id)->html('Hoạt động')->display();
        } else {
            //jQuery('#status-' . $id)->html('Không hoạt động')->display();
        }
    }
    public function setCss() {
        if (@$this->scriptTo && $scriptToElement = pzk_store_element($this->scriptTo)) {
            $scriptToElement->append(pzk_parse('<html.js src="/3rdparty/highchart/js/highcharts.js" />'));
            $scriptToElement->append(pzk_parse('<html.js src="/3rdparty/highchart/js/modules/exporting.js" />'));
        }
    }
    public function indexAction() {
        $this->initPage();
        //debug( pzk_store_element($this->scriptTo));
        //$this->setCss();
        $this->append('admin/'.pzk_or($this->customModule, $this->module).'/index')
            ->append('admin/'.pzk_or($this->customModule, $this->module).'/menu', 'right');
        $this->display();
    }
}
?>