<core.application id="app" name="phongthuy" dispatcher="ControllerBased" 
	gsv="DJBoN802jfeoHdZJX1oM0vqdSuVjiqQ_0t4dHq0zEf4">
	<core.database.arrayCondition id="conditionBuilder" />
	<core.database id="db" host="localhost" user="root" password="" dbName="phongthuy" />
	<core.database id="forumdb" host="localhost" user="root" password="" dbName="forumphongthuy" />
	<core.database id="chatdb" host="localhost" user="root" password="" dbName="chatphongthuy" />
	<core.shorty name="dg" value="easyui.datagrid" />
	<core.shorty name="bg" value="bootstrap.grid" />
	<core.shorty name="frm" value="easyui.form" />
	<core.shorty name="layout" value="easyui.layout" />
	<core.shorty name="wdw" value="easyui.window" />
	<core.config.db id="config" />
	<core.rewrite.table table="catalog_category" routeField="code" />
	<core.rewrite.table table="news_article" action="news_article/detail" />
	<core.rewrite.request pattern="^\/([*controller*][\w_][\w\d_]*)[\/]?$" queryParams="controller" defaultQueryParams='{"action": "index"}' />
	<core.rewrite.request pattern="^\/([*controller*][\w_][\w\d_]*)\/([*action*][\w_][\w\d_]*)" queryParams="controller, action" />
	<core.rewrite.permission id="permission" />
</core.application>