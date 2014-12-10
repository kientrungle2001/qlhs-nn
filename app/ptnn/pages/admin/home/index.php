<page id="page">
	<home.head id="head" layout="admin/home/head" charset="utf-8">
		<html.js src="/3rdparty/jquery/jquery-1.11.1.min.js"></html.js>
		<html.js src="/3rdparty/jquery/jquery.validate.min.js"></html.js>
		<html.js src="/3rdparty/jquery/additional-methods.min.js"></html.js>
		<html.js src="/js/components.js"></html.js>
		<html.js src="<?php echo BASE_URL?>/3rdparty/easyui/jquery.easyui.min.js" />
		<html.css src="<?php echo BASE_URL?>/3rdparty/easyui/themes/default/easyui.css" />
		<html.css src="<?php echo BASE_URL?>/3rdparty/easyui/themes/icon.css" />
		<html.js src="<?php echo BASE_URL?>/3rdparty/easyui/ribbon/jquery.ribbon.js" />
		<html.css src="<?php echo BASE_URL?>/3rdparty/easyui/ribbon/ribbon.css" />
		<html.css src="<?php echo BASE_URL?>/3rdparty/easyui/ribbon/ribbon-icon.css" />
		<html.css src="<?php echo BASE_URL?>/3rdparty/bootstrap3/css/bootstrap.min.css" />
		<html.css src="<?php echo BASE_URL?>/3rdparty/bootstrap3/css/bootstrap-theme.min.css" />
		<html.js src="<?php echo BASE_URL?>/3rdparty/bootstrap3/js/bootstrap.min.js" />
	</home.head>
	<home.menu layout="admin/home/menu" />
		<home.left id="left" layout="admin/home/left" />
		<home.right id="right" layout="admin/home/right" />
	<home.footer layout="admin/home/footer" />
</page>