<core.application id="app" name="test" dispatcher="ControllerBased" 
		gsv="DJBoN802jfeoHdZJX1oM0vqdSuVjiqQ_0t4dHq0zEf4">
	<core.database id="db" host="localhost" user="root" password="" dbName="test" />
	<core.database.table id="dbtable"/>
	<core.rewrite.request pattern="^\/([*controller*][\w_][\w\d_]*)[\/]?$" queryParams="controller" defaultQueryParams='{"action": "index"}' />
	<core.rewrite.request pattern="^\/([*controller*][\w_][\w\d_]*)\/([*action*][\w_][\w\d_]*)" queryParams="controller, action" />
	<core.region id="region" />
</core.application>