<?php
class PzkAdminReportController extends PzkReportController {
    public $table = 'orders';
    public $joins = array(
        array(
            'table' => 'shippers',
            'condition' => 'orders.shipper_id = shippers.shipper_id',
            'type' =>''
        )
    );
    public $selectFields = 'shippers.shipper_name, COUNT(orders.shipper_id) AS NumberOfOrders';
    public $groupByReport = array(
        array(
          'index'=> 'shippers.shipper_id',
        )

    );

    //public $having = 'NumberOfOrders > 1';

    public $typeChart = array(
        array(
            'index' => 'Dạng cột',
            'value' => 'column'
        ),
        array(
            'index' => 'Dạng dòng',
            'value' => 'line'
        ),
        array(
            'index' => 'AREA',
            'value' => 'area'
        ),
        array(
            'index' => 'SPLINE',
            'value' => 'spline'
        ),
        array(
            'index' => 'Bar',
            'value' => 'bar'
        ),
        array(
            'index' => 'PIE',
            'value' => 'pie'
        )


    );

    public $displayReport = array(
        'show' => 'shipper_name',
        'data' => 'NumberOfOrders'
    );




}
?>