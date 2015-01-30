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
    public $groupByReport = array(
        array(
          'index'=> 'shippers.shipper_id',
            'type'=> 1
        )

    );

    public $typeChart = array(
        'type' => 'column'
    );

    public $displayReport = array(
        'show' => 'shipper_name',
        'data' => 'NumberOfOrders'
    );


    public $selectFields = 'shippers.shipper_name, COUNT(orders.shipper_id) AS NumberOfOrders';


}
?>