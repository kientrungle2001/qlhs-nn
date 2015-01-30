<?php
pzk_loader()->importObject('core/db/List');
/**
 *
 */
class PzkReportReport extends PzkCoreDbList {
    public $scriptTo = 'head';

    public $joins = false;
    public function prepareQuery($query) {
        if(is_string($this->joins))
            $this->joins = json_decode($this->joins, true);
        $join = $this->joins;
        if($join) {
            foreach($join as $val) {
                $query->join($val['table'], $val['condition'], $val['type']);
            }
        }
    }

    public function init() {
        if (@$this->scriptTo && $scriptToElement = pzk_store_element($this->scriptTo)) {
            $scriptToElement->append(pzk_parse('<html.js src="/3rdparty/highchart/js/highcharts.js" />'));
            $scriptToElement->append(pzk_parse('<html.js src="/3rdparty/highchart/js/modules/exporting.js" />'));
        }
        $this->conditions = json_decode($this->conditions, true);
        if($this->parentMode && $this->parentMode !== 'false') {
            if(!$this->parentId) {
                $request = pzk_element('request');
                $this->parentId = $request->getSegment(3);
            }
            $this->conditions = array('and', $this->conditions, array($this->parentField, $this->parentId));
        }
    }

}
?>