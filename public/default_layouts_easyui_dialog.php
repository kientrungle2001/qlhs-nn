<div id="dlg-<?php echo @$data->gridId;?>" class="easyui-dialog" style="width:<?php echo @$data->width;?>;height:<?php echo @$data->height;?>;padding:10px 20px; overflow: scroll-X;"
        closed="<?php echo @$data->closed;?>" buttons="#dlg-buttons-<?php echo @$data->gridId;?>">
    <span class="title"><?php echo @$data->title;?></span><br />
	<?php $data->displayChildren('[className=PzkEasyuiFormForm]');?>
</div>
<div id="dlg-buttons-<?php echo @$data->gridId;?>">
    <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="pzk.elements.<?php echo @$data->gridId;?>.save()">Save</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-<?php echo @$data->gridId;?>').dialog('close')">Cancel</a>
</div>