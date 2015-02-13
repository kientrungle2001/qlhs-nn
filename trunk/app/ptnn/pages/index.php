<page id="page">
	<home.head id="head" layout="home/head" charset="utf-8">
		<html.css src="<?php echo BASE_URL ?>/default/skin/ptnn/css/style.css" />
		<html.css src="<?php echo BASE_URL ?>/default/skin/ptnn/css/user.css" />
		<html.css src="/3rdparty/bootstrap3/css/bootstrap.min.css" />
		<html.css src="/3rdparty/bootstrap3/css/bootstrap-theme.min.css" />
		<html.js src="/3rdparty/jquery/jquery-1.11.1.min.js" />
		<html.js src="<?php echo BASE_URL?>/js/components.js" />
		<html.js src="/3rdparty/bootstrap3/js/bootstrap.min.js" />
        <html.js src="/3rdparty/jquery.countdownTimer.js" />
        
        <html.less src="/default/skin/ptnn/less/style.less" />
        <html.js src="/3rdparty/less.min.js" />
        
		<html.css src="/3rdparty/jquery-ui-1.11.2.datepicker/jquery-ui.min.css" />
		<html.js  src="/3rdparty/jquery-ui-1.11.2.datepicker/jquery-ui.min.js" />
		
		
	</home.head>
	<home.top id="top" layout="home/top"/>
	<home.search id="search" layout="home/search" />
	<core.db.list table="categories" layout="home/menu"/>
	<home.left id="left" layout="home/left"/>
	<home.right id="right" layout="home/right">
		<user.account.user id="user" layout="user/account/user" />
	</home.right>
	<home.footer layout="home/footer"/>
</page>
