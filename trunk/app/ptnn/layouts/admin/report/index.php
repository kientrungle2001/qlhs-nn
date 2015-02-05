<?php
$setting = pzk_controller();
$groupByReport = $setting->groupByReport;
$displayReport = $setting->displayReport;
$typeChart = $setting->typeChart;
$configChart = $setting->configChart;
$listFieldSettings = $setting->listFieldSettings;

//joins
if ($setting->joins) {
    $data->joins = $setting->joins;
}
//select
if ($setting->selectFields) {
    $data->fields = $setting->selectFields;
}
//group by
if ($groupByReport) {
    $data->groupByReport = $groupByReport;
}
//having
if ($setting->having) {
    $data->having = $setting->having;
}

$pageSize = pzk_session($setting->table.'PageSize');
if($pageSize) {
    $data->pageSize = $pageSize;
}
$data->pageNum = pzk_request('page');
$countItems = $data->getCountReportItems();

$pages = ceil($countItems / $data->pageSize);
//type chart
if (pzk_session('report_type')) {
    $type = pzk_session('report_type');
} else {
    $type = 'column';
}
//data
$items = $data->getReport();

foreach ($items as $val) {
    $arrname[] = $val[$displayReport['show']];
}

$category['categories'] = $arrname;
$xAxis = json_encode($category);

foreach($items as $val) {
    $arrvalue[] = $val[$displayReport['data']] + 12;
}
$result_arr['data'] = $arrvalue;
$result_arr['name'] = 'so don hang';
$a[] = $result_arr;
$series = json_encode($a);

//$data = array(11,10,9,8,12,81);
//$serie1[] = array('name' => 'serie 1', 'data' => $data);
//$serie1[] = array('name' => 'serie 2', 'data' => $data);
//$a = json_encode($serie1);
//echo $a;
?>

<script type="text/javascript">
    $(function () {
        // Set up the chart
        var chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: "<?php echo $type; ?>",
                margin: 75
            },
            credits: {
                enabled: false
            },
            title: {
                text: "<?php echo $configChart['title']; ?>"
            },
            subtitle: {
                text: "<?php echo $configChart['subtitle']; ?>"
            },
            xAxis: <?php echo $xAxis; ?>,
            plotOptions: {
                column: {
                    depth: 25
                }
            },
            yAxis: {
                title: {
                    text: "<?php echo $configChart['titley']; ?>"
                },
                plotLines: [
                    {
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }
                ]
            },

            series: <?php echo $series; ?>
        });


    });
</script>

<div class="panel panel-default">
    <div class="panel-heading">
        <b><?php echo $setting->titleController; ?></b>
    </div>
    <table class="table table-hover">
        <tr>
            {each $listFieldSettings as $field}
            <th>{field[label]}</th>
            {/each}
        </tr>
        <?php if($items) {  ?>
            {each $items as $item}

            <tr>
                {each $listFieldSettings as $field}

                <td><?php echo $item[$field['index']]; ?></td>
                {/each}
            </tr>
            {/each}
        <?php } ?>
        <tr>
            <td colspan="8">
                <form class="form-inline" role="form">
                    <strong>Số mục: </strong>
                    <select id="pageSize" name="pageSize" class="form-control input-sm" placeholder="Số mục / trang" onchange="window.location='{url /admin}_{setting.module}/changePageSize?pageSize=' + this.value;">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="200">200</option>
                    </select>
                    <script type="text/javascript">
                        $('#pageSize').val('{pageSize}');
                    </script>
                    <strong>Trang: </strong>
                    <?php for ($page = 0; $page < $pages; $page++) {
                        if($page == $data->pageNum) { $btn = 'btn-primary'; }
                        else { $btn = 'btn-default'; }
                        ?>
                        <a class="btn btn-xs {btn}" href="{url /admin}_{setting.module}/index?page={page}">{? echo ($page + 1)?}</a>
                    <?php } ?>
                </form>

            </td>
        </tr>

    </table>
</div>

<div class="well">
    <div class="row">
        <div class="form-group col-xs-3">
            <label>Chọn loại biểu đồ</label><br>
            <select class="form-control" id="type" name="type"
                    onchange="window.location='{url /admin}_{setting.module}/filter?type=' + this.value;">
                {each $typeChart as $item }
                <option value="{item[value]}">{item[index]}</option>
                {/each}
            </select>
            <script type="text/javascript">
                <?php $select = pzk_session('report_type'); ?>
                $('#type').val('{select}');
            </script>
        </div>
    </div>

</div>

<div id="container"></div>
