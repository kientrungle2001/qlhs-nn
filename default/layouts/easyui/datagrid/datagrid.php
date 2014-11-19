<table id="{prop id}" class="easyui-datagrid" title="{prop title}" style="width:{prop width};height:{prop height}"
	toolbar="#{prop id}_toolbar" pagination="{prop pagination}" nowrap="{prop nowrap}"
            rownumbers="{prop rownumbers}" fitColumns="{prop fitColumns}" 
			{attrs pageSize, pageNumber}
			singleSelect="{prop singleSelect}" collapsible="{prop collapsible}" 
			url="{prop url}" method="{prop method}" multiSort="{prop multiSort}" 
			data-options="<?php if(@$data->noClickRow != 'true') { ?>onClickRow:function() {eval($('#{prop id}_toolbar [iconcls=icon-sum]:first').attr('href').replace('javascript:', ''));}<?php } ?>">
	<thead>
		<tr>
			{children [className=PzkEasyuiDatagridDataGridItem]}
		</tr>
	</thead>
</table>
{children [className=PzkEasyuiLayoutToolbar]}
{children [className=PzkEasyuiWindowDialog]}