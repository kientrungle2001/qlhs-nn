<form name="regionpageapp" id="regionpageapp" method="post" action="{url /home/wizard?step=4}">
	<input type="hidden" name="appId" value="{_REQUEST[appId]}" />
	<input type="hidden" name="parentId" value="{_REQUEST[parentId]}" />
	<input type="hidden" name="title" value="{_REQUEST[title]}" />
	<input type="hidden" name="eType" value="{_REQUEST[eType]}" />
	<input type="hidden" name="region" value="{_REQUEST[region]}" />
<?php if(@$_REQUEST['eType'] == 'object') { ?> 
Object Type: <br />
{children [name=objectType]}<br />
<?php } ?>
<input type="submit" value="Cập nhật" />
</form>