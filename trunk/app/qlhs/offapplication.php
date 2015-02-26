<core.application id="app" name="qlhs" dispatcher="ControllerBased" 
	gsv="DJBoN802jfeoHdZJX1oM0vqdSuVjiqQ_0t4dHq0zEf4">
	<core.database.arrayCondition id="conditionBuilder" />
	<core.database id="db" host="localhost" 
		user="root" password="" dbName="qlhs" />
	<core.database.schema id="db_schema" />
	<core.shorty name="dg" value="easyui.datagrid" />
	<core.shorty name="frm" value="easyui.form" />
	<core.shorty name="layout" value="easyui.layout" />
	<core.shorty name="wdw" value="easyui.window" />
	<core.rewrite.request matcher="host" matchMethod="equal" pattern="qlhs2.vn" 
			defaultElementParams='{"db.dbName":"phattrienngonngu_com_website5"}' />
	<core.rewrite.request matcher="host" matchMethod="equal" pattern="www.qlhs2.vn" 
			defaultElementParams='{"db.dbName":"phattrienngonngu_com_website5"}' />
	<core.config.db id="config" />
	<core.rewrite.request pattern="^\/([*controller*][\w_][\w\d_]*)[\/]?$" queryParams="controller" defaultQueryParams='{"action": "index"}' />
	<core.rewrite.request pattern="^\/([*controller*][\w_][\w\d_]*)\/([*action*][\w_][\w\d_]*)" queryParams="controller, action" />
	<core.rewrite.permission id="permission" />
	<crawler.hotel.mytour id="mytour" />
</core.application>