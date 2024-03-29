<?php

$controller = pzk_controller();
$sortFields = $controller->sortFields;
$filedFilters = $controller->filterFields;
$searchFields = $controller->searchFields;
$Searchlabels = $controller->Searchlabels;
$listSettingType = $controller->listSettingType;
$listFieldSettings = $controller->listFieldSettings;
$exportFields = $controller->exportFields;
$exportTypes = $controller->exportTypes;
$orderBy = pzk_session($controller->table.'OrderBy');

if($exportFields) {
    $data->exportFields = $exportFields;
}


if($orderBy) {
	$data->orderBy = $orderBy;
}

//joins
if($controller->joins) {
    $data->joins = $controller->joins;
}
//select fields
if($controller->selectFields) {
    $data->fields = $controller->selectFields;
}
//filter
if($controller->filterFields) {
    $fileds = $controller->filterFields;
    foreach($fileds as $val) {
        $condition = pzk_session($controller->table.$val['type'].$val['index']);
        if(isset($condition)) {
            $data->addFilter($controller->table.'.'.$val['index'], $condition);
        }
    }
}
//end filter
$pageSize = pzk_session($controller->table.'PageSize');
if($pageSize) {
	$data->pageSize = $pageSize;
}
$data->pageNum = pzk_request('page');

$keyword = pzk_session($controller->table.'Keyword');
$items = $data->getItems($keyword, $controller->searchFields);

if($exportFields) {
    $query = $data->stringQuery($keyword, $controller->searchFields);
}

$countItems = $data->getCountItems($keyword, $controller->searchFields);

$pages = ceil($countItems / $data->pageSize);

//build data parent
if($listSettingType =='parent') {
    $items = buildArr($items,'parent',0);
}

?>
<!-- search, filter, sort -->
  <div class="well well-sm">
      <?php if($sortFields or $filedFilters or $searchFields) ?>
      <form role="search" action="{url /admin}_{controller.module}/searchFilter">
          <div class="row">
           <?php if($searchFields) {
           ?>
              <div class="form-group col-xs-2">
                  <label>Tìm theo  </label><br>
                  <input type="text" name="keyword" class="form-control" placeholder="<?php if($Searchlabels){ echo $Searchlabels; } ?>" value="{keyword}">
              </div>
            <?Php } ?>
        <?php if($filedFilters) {
            foreach($filedFilters as $field) {
                if($field['type'] == 'status') { ?>
                <div style="width: 19%" class="form-group col-xs-3">
                    <label>{field[label]}</label><br>
                    <select id="{field[index]}" name="{field[index]}" class="form-control" placeholder="Lọc theo status" onchange="window.location='{url /admin}_{controller.module}/filter?type={field[type]}&index={field[index]}&{field[type]}=' + this.value;">
                        <option value="">Tất cả</option>
                        <option value="0">Chưa kích hoạt</option>
                        <option value="1">kích hoạt</option>

                    </select>
                    <script type="text/javascript">
                        <?php $status = pzk_session($controller->table.$field['type'].$field['index']); ?>
                        $('#{field[index]}').val('{status}');
                    </script>
                </div>
                <?php } elseif($field['type'] == 'select') { ?>
                    <div  class="form-group col-xs-3">
                        <label>{field[label]}</label><br>
                        <select id="{field[index]}" name="{field[index]}" class="form-control" placeholder="Lọc theo status" onchange="window.location='{url /admin}_{controller.module}/filter?type={field[type]}&index={field[index]}&select=' + this.value;">

                            <?php
                            $parents = _db()->select('*')->from($field['table'])->result();
                            if(isset($parents[0]['parent'])) {
                                $parents = buildArr($parents, 'parent', 0);
                                echo "<option value='' >--Tất cả</option>";
                            }else {
                                echo "<option value=''>Tất cả</option>";
                            }
                            ?>
                            {each $parents as $parent}
                            <option value="<?php echo $parent[$field['show_value']]; ?>" ><?php if(isset($parent['parent'])){ echo str_repeat('--', @$parent['level']); } ?>
                                <?php echo $parent[$field['show_name']]; ?>
                            </option>
                            {/each}



                        </select>
                        <script type="text/javascript">
                            <?php $select = pzk_session($controller->table.$field['type'].$field['index']); ?>
                            $('#{field[index]}').val('{select}');
                        </script>
                    </div>

                 <?php } ?>

        <?php  } } ?>

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


<!-- Show data -->
<div class="panel panel-default">
    <div class="panel-heading">
        <b><?php echo $controller->titleController; ?></b>
    </div>
<table class="table table-hover">
	<tr>
		<th><input type="checkbox" id="selecctall"/>
        </th>
        <th>#</th>
		{each $listFieldSettings as $field}
		<th>{field[label]}</th>
		{/each}
		<th colspan="2">Hành động</th>
	</tr>
    <?php if($items) {  ?>
	{each $items as $item}

	<tr>
		<td><input class="grid_checkbox" type="checkbox" name="grid_check[]" value="{item[id]}"></td>
        <td>{item[id]}</td>
		{each $listFieldSettings as $field}

		{? if ($field['type'] == 'text') : ?}
		<td>{? echo $item[$field['index']] ?}</td>

        {? elseif ($field['type'] == 'parent') : ?}
        <?php
        $tab = '&nbsp;&nbsp;&nbsp;&nbsp;';
        $cate = str_repeat($tab, $item['level']).$item[$field['index']];
        ?>
        <td>{cate}</td>

		{? elseif($field['type'] == 'status'): ?}
		<td><input id="switch-{field[index]}-{item[id]}" type="checkbox" {if $item['status']}checked="checked"{/if} data-size="mini" /><script type="text/javascript">jQuery('#switch-{field[index]}-{item[id]}').bootstrapSwitch({onSwitchChange: function(evt,state) { {event changeStatus}({id: {item[id]}, status: state}); }})</script></td>
		{? endif ?}
		{/each}
		<td><a href="{url /admin}_{controller.module}/edit/{item[id]}" class="text-center"><span class="glyphicon glyphicon-edit"></span> Sửa</a></td>
		<td><a class="color_delete text-center" href="{url /admin}_{controller.module}/del/{item[id]}"><span class="glyphicon glyphicon-remove"></span> Xóa</td>
	</tr>
	{/each}
    <?php } ?>
	<tr>
		<td colspan="8">
		<form class="form-inline" role="form">
		<strong>Số mục: </strong>
		<select id="pageSize" name="pageSize" class="form-control input-sm" placeholder="Số mục / trang" onchange="window.location='{url /admin}_{controller.module}/changePageSize?pageSize=' + this.value;">
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
		<a class="btn btn-xs {btn}" href="{url /admin}_{controller.module}/index?page={page}">{? echo ($page + 1)?}</a>
		<?php } ?>
		</form>

		</td>
	</tr>

</table>
    <div class="panel-footer item">
        <div  id="griddelete" style="margin-left: 10px;" class="btn  btn-sm pull-right btn-danger" >
            <span class="glyphicon glyphicon-remove"></span> Xóa tất
        </div>
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


        <a class="btn  btn-sm btn-primary pull-right" href="{url /admin}_{controller.module}/add"><span class="glyphicon glyphicon-plus"></span> {controller.addLabel}</a>
    </div>
</div>
<!-- js check all--->
<script>

    $(document).ready(function() {
        $('#selecctall').click(function(event) {
            if(this.checked) {
                $('.grid_checkbox').each(function() {
                    this.checked = true;
                });
            }else{
                $('.grid_checkbox').each(function() {
                    this.checked = false;
                });
            }
        });

        $('#griddelete').click(function(){
            var allVals = [];
            $('.grid_checkbox:checked').each(function() {
                allVals.push($(this).val());
            });

            if(allVals.length > 0){
                var r = confirm("Bạn có muốn xóa không?");
                if (r == true) {
                    $.ajax({
                        type: "POST",
                        url: "{url /admin}_{controller.module}/delAll",
                        data:{ids:JSON.stringify(allVals)},
                        success: function(data) {
                            if(data ==1) {
                                window.location.href = '{url /admin}_{controller.module}/index';
                            }

                        }
                    });
                }
            }else {
                alert('Bạn hãy chọn bảng ghi muốn xóa!');
            }

            return false;
        });

        $('#exportdata').click(function() {
            var r = confirm("Bạn có muốn export không?");
            if (r == true) {
            $('#fromexport').submit();
            }
            return false;
        });

    });

</script>