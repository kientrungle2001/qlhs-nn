<?php
$setting = pzk_controller();
$controller = pzk_controller();
$groupByReport = $setting->groupByReport;
$displayReport = $setting->displayReport;
$typeChart = $setting->typeChart;
$configChart = $setting->configChart;
$listFieldSettings = $setting->listFieldSettings;
$sortFields = $setting->sortFields;
$exportFields = $setting->exportFields;
$exportTypes = $setting->exportTypes;
//search
$searchFields = $controller->searchFields;
$Searchlabels = $controller->Searchlabels;

$keyword = pzk_session($controller->table.'Keyword');
$orderBy = pzk_session($controller->table.'OrderBy');

$showchart = $setting->showchart;

if($exportFields) {
    $data->exportFields = $exportFields;
}
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
//sort
if($orderBy) {
    $data->orderBy = $orderBy;
}

if($exportFields) {
    $query = $data->stringQueryReport($keyword, $controller->searchFields);
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
$items = $data->getReport($keyword, $controller->searchFields);

if($showchart && $displayReport) {

    foreach ($items as $val) {
        $arrname[] = $val[$displayReport['show']];
    }

    $category['categories'] = $arrname;
    $xAxis = json_encode($category);

    foreach($items as $val) {
        $arrvalue[] = $val[$displayReport['data']] + 0;
    }
    $result_arr['data'] = $arrvalue;
    $result_arr['name'] = $controller->configChart['titley'];
    $a[] = $result_arr;
    $series = json_encode($a);
}
//$data = array(11,10,9,8,12,81);
//$serie1[] = array('name' => 'serie 1', 'data' => $data);
//$serie1[] = array('name' => 'serie 2', 'data' => $data);
//$a = json_encode($serie1);
//echo $a;
?>

        <!-- search, filter, sort -->
        <div class="well well-sm">
            <?php if($sortFields or $searchFields) ?>
            <form role="search" action="{url /admin}_{controller.module}/searchFilter">
                <div class="row">
                    <?php if($searchFields) {
                        ?>
                        <div class="form-group col-xs-2">
                            <label>Tìm theo  </label><br>
                            <input type="text" name="keyword" class="form-control" placeholder="<?php if($Searchlabels){ echo $Searchlabels; } ?>" value="{keyword}">
                        </div>
                    <?Php } ?>
                    <?php if($sortFields) { ?>
                        <div class="form-group col-xs-2">
                            <label>Sắp xếp</label><br>
                            <select id="orderBy" name="orderBy" class="form-control" placeholder="Sắp xếp theo" onchange="window.location='{url /admin}_{controller.module}/changeOrderBy?orderBy=' + this.value;">
                                <?php foreach ($sortFields as $value => $label){ ?>
                                    <option value="{value}">{label}</option>
                                <?php } ?>
                            </select>
                            <script type="text/javascript">
                                $('#orderBy').val('{orderBy}');
                            </script>
                        </div>
                    <?php } ?>
                    <?php if($searchFields) { ?>
                        <div style="width: 12%;" class="form-group col-xs-2">
                            <label>&nbsp;</label><br>
                            <button type="submit" value="<?php echo ACTION_SEARCH; ?>" name="submit_action" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-search"></span> Tìm kiếm</button>
                        </div>
                    <?php } ?>
                    <div  class="form-group col-xs-1">
                        <label>&nbsp;</label><br>
                        <button type="submit" value="<?php echo ACTION_RESET; ?>" name="submit_action" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
                    </div>

                </div>
            </form>


        </div><!-- end well -->
        <!-- end search, filter, sort -->

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

            <div class="panel-footer item">
                <?php
                if($exportTypes && $exportFields) {
                    $time = time();
                    $username = pzk_session('adminUser');
                    if(!$username) $username = 'ongkien';
                    $token = md5($time.$username . 'onghuu');
                    ?>
                    <form id="fromexport"  class="col-md-3 pull-right" action="/export.php?token={token}&time={time}" method="post">
                        <input type="hidden" name="q" value="<?php echo base64_encode(encrypt($query, 'onghuu')); ?>" />
                        <input type="hidden" name="exportFields" value="<?php echo implode(',', $exportFields); ?>"/>
                        <select style="border: 1px solid #ccc;" class="btn" name="type">
                            {each $exportTypes as $val}
                            <option value="{val}">Export {val}</option>
                            {/each}
                        </select>
                        <div id="exportdata" class="btn  btn-sm pull-right btn-success ">
                            <span class="glyphicon glyphicon-export"></span>
                            Export
                        </div>

                    </form>
                <?php } ?>

            </div>
        </div>
        <script>
            $('#exportdata').click(function() {
                var r = confirm("Bạn có muốn export không?");
                if (r == true) {
                    $('#fromexport').submit();
                }
                return false;
            });

        </script>

        <!--endtable-->

<?php if($showchart &&  $xAxis) { ?>

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

            <div class="well">
                <div class="row">
                    <div class="form-group col-xs-3">
                        <label>Chọn loại biểu đồ</label><br>
                        <select class="form-control" id="type" name="type"
                                onchange="window.location='{url /admin}_{setting.module}/highchart?type=' + this.value;">
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

            <div  id="container"></div>
<?php } ?>



