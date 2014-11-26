<page id="page" title="Trang chu" template="v1">
	<core.data.point id="departures" table="tourdeparture" />
	<core.data.point id="destinations" table="tourdestination" />
	<core.data.point id="durations" table="tourduration" />
	<core.data.point id="transports" table="tourtransport" />
	<core.data.point id="types" table="tourtype" />
	<core.data.point id="guides" table="tourguide" fields="id,title" />
	<html.head id="head">
		<html.js src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></html.js>
		<html.js src="<?php echo BASE_URL?>/3rdparty/bootstrap/js/bootstrap.min.js"></html.js>
		<html.js src="<?php echo BASE_URL?>/js/components.js"></html.js>
		<html.css src="<?php echo BASE_URL?>/3rdparty/bootstrap/css/bootstrap.min.css" />
	</html.head>
	<html.body>
		<html.header id="header"/>
		<cms.menu id="menu"/>
		<travel.searchbox id="searchbox" />
		<travel.category rootId="3" action="vietnamese" id="vietnamcategory" title="Du lich trong nuoc" />
		<travel.category rootId="7" action="foreign" id="foreigncategory" title="Du lich nuoc ngoai" />
		<travel.slider id="slider" />
		<travel.feature id="feature" />
		<travel.type id="type" />
		<travel.service id="service" />
		<travel.support id="support" />
		<travel.favorite categoryId="3" id="vietnamfavorite" title="Tour Vietnam duoc yeu thich" />
		<travel.favorite categoryId="7" id="foreignfavorite" title="Tour nuoc ngoai duoc yeu thich" />
		<travel.guide id="guide" />
		<travel.link id="links" />
		<html.footer id="footer"/>
	</html.body>	
</page>