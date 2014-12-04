<core.application id="app" name="ptnn" dispatcher="ControllerBased" 
	gsv="DJBoN802jfeoHdZJX1oM0vqdSuVjiqQ_0t4dHq0zEf4">
	<core.database.arrayCondition id="conditionBuilder" />
	<core.database id="db" host="localhost" 
		user="root" password="" dbName="ptnn" />
	<core.rewrite.request pattern="^\/([*controller*][\w_][\w\d_]*)[\/]?$" queryParams="controller" defaultQueryParams='{"action": "index"}' />
	<core.rewrite.request pattern="^\/([*controller*][\w_][\w\d_]*)\/([*action*][\w_][\w\d_]*)" queryParams="controller, action" />
	<core.mailer id="mailer" username="kieunghia.luckystar@gmail.com" password="Nghiak4bcntt" host="smtp.gmail.com" secure="tls" port="587" />
</core.application>