<table id="<?php echo @$data->id;?>" class="easyui-datagrid" title="<?php echo @$data->title;?>" style="width:<?php echo @$data->width;?>;height:<?php echo @$data->height;?>"
	toolbar="#<?php echo @$data->id;?>_toolbar" pagination="<?php echo @$data->pagination;?>" nowrap="<?php echo @$data->nowrap;?>"
            rownumbers="<?php echo @$data->rownumbers;?>" fitColumns="<?php echo @$data->fitColumns;?>" 
			<?php $tmp = @$data->pageSize; if (isset($data->pageSize) && $data->pageSize !== "" && $data->pageSize !== false) {echo 'pageSize="'.$tmp.'"'; } ?> <?php $tmp = @$data->pageNumber; if (isset($data->pageNumber) && $data->pageNumber !== "" && $data->pageNumber !== false) {echo 'pageNumber="'.$tmp.'"'; } ?>
			singleSelect="<?php echo @$data->singleSelect;?>" collapsible="<?php echo @$data->collapsible;?>" 
			url="<?php echo @$data->url;?>" method="<?php echo @$data->method;?>" multiSort="<?php echo @$data->multiSort;?>" 
			data-options="<?php if(@$data->noClickRow != 'true') { ?>onClickRow:function() {eval($('#<?php echo @$data->id;?>_toolbar [iconcls=icon-sum]:first').attr('href').replace('javascript:', ''));}<?php } ?>">
	<thead>
		<tr>
			<?php $data->displayChildren('[className=PzkEasyuiDatagridDataGridItem]');?>
		</tr>
	</thead>
</table>
<?php $data->displayChildren('[className=PzkEasyuiLayoutToolbar]');?>
<?php $data->displayChildren('[className=PzkEasyuiWindowDialog]');?>