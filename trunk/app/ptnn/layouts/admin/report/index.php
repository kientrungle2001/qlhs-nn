<?php
$setting = pzk_controller();
$groupByReport = $setting->groupByReport;
$displayReport = $setting->displayReport;
$typeChart = $setting->typeChart;

//joins
if($setting->joins) {
    $data->joins = $setting->joins;
}

if($setting->selectFields) {
    $data->fields = $setting->selectFields;
}

if($groupByReport) {
    $data->groupByReport = $groupByReport;
}

if($setting->having) {
    $data->having = $setting->having;
}

$items = $data->getReport();

$arrname = array();
$arrvalue = array();

foreach($items as $val) {
    $arrname[] = $val[$displayReport['show']];
    $arrvalue[] = $val[$displayReport['data']]+12;
}

$category['categories'] = $arrname;
$xAxis = json_encode($category);

$arrvalue2['data'] =  $arrvalue;
$arrvalue2['name'] = 'so don hang';

if( pzk_session('report_type')) {
    $type = pzk_session('report_type');
}else {
    $type = 'column';
}


$series = '['.(json_encode($arrvalue2)).']';


$data = array(11,10,9,8,12,81);
$serie1[] = array('name' => 'serie 1', 'data' => $data);
$serie1[] = array('name' => 'serie 2', 'data' => $data);
$a = json_encode($serie1);
//echo $a;
?>

<script type="text/javascript">
    $(function () {
        // Set up the chart
        var chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: "<?php echo $type; ?>",
                margin: 75,
                options3d: {
                    enabled: true,
                    alpha: 15,
                    beta: 15,
                    depth: 50,
                    viewDistance: 25
                }
            },
            credits: {
                enabled: false
            },
            title: {
                text: 'report'
            },
            subtitle: {
                text: 'bao cao'
            },
            xAxis: <?php echo $xAxis; ?>,
            plotOptions: {
                column: {
                    depth: 25
                }
            },
            yAxis: {
                title: {
                    text: 'so don hang'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },

            series: <?php echo $a; ?>
        });

        function showValues() {
            $('#R0-value').html(chart.options.chart.options3d.alpha);
            $('#R1-value').html(chart.options.chart.options3d.beta);
        }

        // Activate the sliders
        $('#R0').on('change', function () {
            chart.options.chart.options3d.alpha = this.value;
            showValues();
            chart.redraw(false);
        });
        $('#R1').on('change', function () {
            chart.options.chart.options3d.beta = this.value;
            showValues();
            chart.redraw(false);
        });

        showValues();
    });
</script>

<div class="well">
    <div class="row">
        <div  class="form-group col-xs-3">
            <label>Chọn loại biểu đồ</label><br>
            <select class="form-control" id="type" name="type" onchange="window.location='{url /admin}_{setting.module}/filter?type=' + this.value;">
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
