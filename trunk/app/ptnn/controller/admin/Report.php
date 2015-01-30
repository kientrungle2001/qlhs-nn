<?php
class PzkAdminReportController extends PzkReportController {
    public $table = 'test';
    public $groupByReport = array(
        array(
          'index'=> 'level',
            'type'=> 1
        )

    );
    public $selectFields = 'username, COUNT(id) AS number';

}
?>