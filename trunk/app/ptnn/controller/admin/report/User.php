<?php
class PzkAdminReportUserController extends PzkReportController
{
    public $table = 'user';
	public $selectFields = 'COUNT(*) AS userCount, concat(month(registered) , "/", year(registered)) as createdMonth' ;
	public $listFieldSettings = array(
        array(
            'index' => 'userCount',
            'label' => 'Số người dùng'
        ),
		array(
			'index' => 'createdMonth',
			'label' => 'Tháng'
		)
    );
	public $groupByReport = array(
		array(
            'index' => 'concat(month(registered) , "/", year(registered))',
        )
	);
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
        )
        //array(
        //    'index' => 'PIE',
        //    'value' => 'pie'
        //)
    );
	
	public $configChart = array(
        'title' => 'Báo cáo',
        'subtitle' => 'Tháng',
        'titley' => 'Số người dùng'
    );
	
	public $showchart = true;
	public $displayReport = array(
        'show' => 'createdMonth',
        'data' => 'userCount'
    );
}