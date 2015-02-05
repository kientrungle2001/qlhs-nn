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

    public function getReport(){
        $query = _db()->useCB()->select($this->fields)->from($this->table)
            ->where($this->conditions)
            //->where($this->status)
            //->orderBy($this->orderBy)
            ->limit($this->pageSize, $this->pageNum);
        $this->processGroupBy($query);
        $this->prepareQuery($query);
        //echo $query->getQuery();

        return $query->result();
    }

    public function processGroupBy($query) {
        $arrGroupBy = $this->groupByReport;
        $groupBy = '';
        foreach($arrGroupBy as $item) {
            $groupBy .= $item['index'].', ';
        }
        $query->groupBy(substr($groupBy, 0, -2))
            ->having($this->having);
    }

    public function getCountReportItems() {
        $row = _db()->useCB()->select('count(*) as c')
            ->from($this->table)
            ->where($this->conditions);

        $this->processGroupBy($row);
        $this->prepareQuery($row);
        $row = $row->result();
        return count($row);
    }

}
?>