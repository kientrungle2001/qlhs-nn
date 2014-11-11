<form name="regionpageapp" id="regionpageapp" method="post" action="{url /home/wizard?step=2}">
<h4>Tạo vùng mới</h4>
	<input type="hidden" name="appId" value="10" />
	<input type="hidden" name="parentId" value="25" />
	Tên vùng : 
	<input name="title" value="{currentRegion[title]}" /> <br />
	Kiểu : 
	<select name="eType">
		<option value="raw">Raw</option>
		<option value="object">Object</option>
	</select><br />
	Vị trí :
	<select name="region">
		<option value="menu">Menu</option>
		<option value="right">Bên phải</option>
	</select><br />
	<input type="submit" value="Cập nhật" />
</form>