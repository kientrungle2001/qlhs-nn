<page id="page">
	<home.head id="head" layout="home/head" charset="utf-8">
		<user.account.user id="user" layout="user/account/user" />
		<html.js src="/3rdparty/jquery/jquery-1.11.1.min.js"></html.js>
		<html.js src="/3rdparty/jquery/jquery.validate.min.js"></html.js>
		<html.js src="/3rdparty/jquery/additional-methods.min.js"></html.js>
		<html.css src="/3rdparty/bootstrap3/css/bootstrap.min.css" />
		<html.css src="/3rdparty/bootstrap3/css/bootstrap-theme.min.css" />
		<html.js src="/3rdparty/bootstrap3/js/bootstrap.min.js" />
        <html.js src="/3rdparty/jquery.countdownTimer.js" />

	</home.head>
	<core.db.list table="categories" layout="home/menu"/>
		<home.left id="left" layout="home/left"/>
		
		<home.right id="right" layout="home/right">
			
			
		</home.right>
	<home.footer layout="home/footer"/>
</page>
