<?php 
$controller = pzk_controller();
$sortFields = $controller->sortFields;
$listFieldSettings = $controller->listFieldSettings;
$orderBy = pzk_session($controller->table.'OrderBy');
if($orderBy) {
	$data->orderBy = $orderBy;
}

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
    <div class="collapse navbar-collapse" id="navbar-collapse-1">
      <form class="navbar-form navbar-left" role="search" action="{url /admin}_{controller.module}/searchPost">
        <div class="form-group">
          <input type="text" name="keyword" class="form-control" placeholder="Từ khóa" value="{keyword}">
        </div>
        <button type="submit" class="btn btn-default">Tìm kiếm</button>
      </form>
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