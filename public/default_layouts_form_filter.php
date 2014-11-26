<?php 
$items = _db()->query($data->sql);
?>
<div <?php $tmp = @$data->id; if (isset($data->id) && $data->id !== "" && $data->id !== false) {echo 'id="'.$tmp.'"'; } ?> <?php $tmp = @$data->class; if (isset($data->class) && $data->class !== "" && $data->class !== false) {echo 'class="'.$tmp.'"'; } ?>>
<div class="selected_filter">Đang chọn: <span class="selected_value" style="color: green;">Tất cả</span> <a href="javascript:void(0)" onclick="pzk.elements.<?php echo @$data->id;?>.clear();(function() {<?php echo @$data->onSelect;?><?php echo @$data->onselect;?>}).call(pzk.elements.<?php echo @$data->id;?>);" class="selected_clear"></a></div>
<?php if (@$data->displayType == 'ul') { ?>
<ul class="filter_list">
<?php foreach ( $items as $item ) : ?>
	<li><a href="javascript:void(0)" onclick="pzk.elements.<?php echo @$data->id;?>.select('<?php echo @$item['value'];?>', '<?php echo @$item['label'];?>');(function() {<?php echo @$data->onSelect;?><?php echo @$data->onselect;?>}).call(pzk.elements.<?php echo @$data->id;?>);" rel="<?php echo @$item['value'];?>"><?php echo @$item['label'];?></a></li>
<?php endforeach; ?>
</ul>
<?php } else { ?>
<div class="filter_list">
<?php foreach ( $items as $item ) : ?>
	<a href="javascript:void(0)" onclick="pzk.elements.<?php echo @$data->id;?>.select('<?php echo @$item['value'];?>', '<?php echo @$item['label'];?>');(function() {<?php echo @$data->onSelect;?><?php echo @$data->onselect;?>}).call(pzk.elements.<?php echo @$data->id;?>);" rel="<?php echo @$item['value'];?>"><?php echo @$item['label'];?></a><br />
<?php endforeach; ?>
</div>
<?php } ?>
</div>