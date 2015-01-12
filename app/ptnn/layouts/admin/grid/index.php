<?php 
$controller = pzk_controller();
$sortFields = $controller->sortFields;
$listFieldSettings = $controller->listFieldSettings;
$orderBy = pzk_session($controller->table.'OrderBy');
if($orderBy) {
	$data->orderBy = $orderBy;
}
//filter
if($controller->filterFileds) {
    $fileds = $controller->filterFileds;
    foreach($fileds as $val) {
        if($val['type'] == 'status') {
            $status = pzk_session($controller->table.'Status');
            if($status) {
                if($status ==1) {
                    $data->conditions .= " and status like '%1%'";
                }else {
                    $data->conditions .= " and status like '%0%'";
                }
            }
        }elseif($val['type']=='select') {
            $select = pzk_session($controller->table.'Select');
            if($select) {
                $data->conditions .= " and {$val['index']} like '%$select%'";
            }
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

$countItems = $data->getCountItems($keyword, $controller->searchFields);

$pages = ceil($countItems / $data->pageSize);
if(pzk_request('controller') =='admin_menu') {
    $datamenu = _db()->select('*')->from('admin_menu')->result();
    $arrmenu = buildArr($datamenu,'parent',0);
}

?>
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse fixfilter navbar-collapse" id="navbar-collapse-1">

        <?php if($controller->filterFileds) {
            $fileds = $controller->filterFileds;
            foreach($fileds as $field) {
            if($field['type'] == 'text') {
        ?>
            <style>
                .fixfilter .navbar-form{
                    padding: 10px 2px;
                }
            </style>

            <form class="navbar-form navbar-left" role="search" action="{url /admin}_{controller.module}/searchPost">
                <div class="form-group">
                    <input type="<?php echo $field['type'] ?>" name="keyword" class="form-control" placeholder="Từ khóa" value="{keyword}">
                </div>
                <button type="submit" class="btn btn-default">Tìm kiếm</button>
            </form>

            <?php } elseif($field['type'] == 'status') { ?>
            <form class="navbar-form navbar-right" role="{field[index]}">
                <div class="form-group">
                    <select id="{field[index]}" name="{field[index]}" class="form-control" placeholder="Lọc theo status" onchange="window.location='{url /admin}_{controller.module}/SetChangeStatus?status=' + this.value;">
                        <option value="">Tất cả</option>
                        <option value="2">Chưa kích hoạt</option>
                        <option value="1">kích hoạt</option>

                    </select>
                    <script type="text/javascript">
                        $('#{field[index]}').val('{status}');
                    </script>
                </div>
            </form>
            <?php } elseif($field['type'] == 'select') { ?>
            <form class="navbar-form navbar-right" role="{field[index]}">
                <div class="form-group">
                    <select id="{field[index]}" name="{field[index]}" class="form-control" placeholder="Lọc theo status" onchange="window.location='{url /admin}_{controller.module}/ChangeSelect?select=' + this.value;">
                        <option value="">Tất cả</option>
                        <?php
                        $table = $field['table'];
                        $dataselect = _db()->useCB()->select('*')->from($table)->where(array('status', 1))->result();
                        ?>
                        {each $dataselect as $val}
                        <option value="<?php echo $val[$field['show_value']]; ?>"><?php echo $val[$field['show_name']]; ?></option>
                        {/each}

                    </select>
                    <script type="text/javascript">
                        $('#{field[index]}').val('{select}');
                    </script>
                </div>
            </form>


            <?php } ?>


        <?php  } } ?>

	  <form class="navbar-form navbar-right" role="sort">
        <div class="form-group">
          <select id="orderBy" name="orderBy" class="form-control" placeholder="Sắp xếp theo" onchange="window.location='{url /admin}_{controller.module}/changeOrderBy?orderBy=' + this.value;">
			<?php foreach ($sortFields as $value => $label){ ?>
			<option value="{value}">{label}</option>
			<?php } ?>
		  </select>
		  <script type="text/javascript">
			$('#orderBy').val('{orderBy}');
		  </script>
        </div>
      </form>



    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<?Php if(isset($arrmenu)) { ?>

    <table class="table">
        <tr>
            <th>#</th>
            <th>Tên danh mục</th>
            <th>Trạng thái</th>
            <th colspan="2">Hành động</th>
        </tr>
        {each $arrmenu as $item}
        <?php
        $tab = '&nbsp;&nbsp;&nbsp;&nbsp;';
        $cate = str_repeat($tab, $item['lever']).$item['name'];
        ?>
        <tr>
            <td>{item[id]}</td>
            <td><a href="{url /admin_menu/edit}/{item[id]}">{cate}</a>

            </td>
            <td id="status-{item[id]}"><?php if($item['status']) { ?><input id="switch-state-{item[id]}" type="checkbox" checked data-size="mini" /><?php } else { ?><input id="switch-state-{item[id]}" type="checkbox" data-size="mini" /><?php } ?><script type="text/javascript">jQuery('#switch-state-{item[id]}').bootstrapSwitch({onSwitchChange: function(evt,state) { <?php echo $data->onEvent('changeStatus')?>({id: {item[id]}, status: state}); }})</script></td>
            <td><a href="{url /admin_menu/del}/{item[id]}">Xóa</td>
        </tr>
        {/each}
        <tr>
            <td colspan="5"><a href="{url /admin_menu/add}">Thêm danh mục</a></td>
        </tr>
    </table>

<?php } else { ?>

<table class="table">
	<tr>
		<th>#</th>
		{each $listFieldSettings as $field}
		<th>{field[label]}</th>
		{/each}
		<th colspan="2">Hành động</th>
	</tr>
	{each $items as $item}
	<tr>
		<td>{item[id]}</td>
		{each $listFieldSettings as $field}

		{? if ($field['type'] == 'text') : ?}
		<td>{? echo $item[$field['index']] ?}</td>

		{? elseif($field['type'] == 'status'): ?}
		<td><input id="switch-{field[index]}-{item[id]}" type="checkbox" {if $item['status']}checked="checked"{/if} data-size="mini" /><script type="text/javascript">jQuery('#switch-{field[index]}-{item[id]}').bootstrapSwitch({onSwitchChange: function(evt,state) { {event changeStatus}({id: {item[id]}, status: state}); }})</script></td>
		{? endif ?}
		{/each}
		<td><a href="{url /admin}_{controller.module}/edit/{item[id]}" class="btn btn-primary btn-xs">Sửa</a></td>
		<td><a href="{url /admin}_{controller.module}/del/{item[id]}">Xóa</td>
	</tr>
	{/each}
	<tr>
		<td colspan="8">
		<form class="form-inline" role="form">
		<strong>Số mục: </strong>
		<select id="pageSize" name="pageSize" class="form-control" placeholder="Số mục / trang" onchange="window.location='{url /admin}_{controller.module}/changePageSize?pageSize=' + this.value;">
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
		<a class="btn {btn}" href="{url /admin}_{controller.module}/index?page={page}">{? echo ($page + 1)?}</a>
		<?php } ?>
		</form>
		</td>
	</tr>
	<tr>
		<td colspan="8"><a class="btn btn-default" href="{url /admin}_{controller.module}/add">{controller.addLabel}</a></td>
	</tr>
</table>
<?php } ?>