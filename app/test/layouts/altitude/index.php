<!DOCTYPE HTML>
<!--
	Altitude: A responsive HTML5 website template by HTML5Templates.com
	Released for free under the Creative Commons Attribution 3.0 license (html5templates.com/license)
	Visit http://html5templates.com for more great templates or follow us on Twitter @HTML5T
-->
<html>
<head>
<title>{data.item[title]}</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="{data.item[description]}" />
<meta name="keywords" content="{data.item[keywords]}" />
<noscript>
<link rel="stylesheet" href="{turl css/5grid/core.css}" />
<link rel="stylesheet" href="{turl css/5grid/core-desktop.css}" />
<link rel="stylesheet" href="{turl css/5grid/core-1200px.css}" />
<link rel="stylesheet" href="{turl css/5grid/core-noscript.css}" />
<link rel="stylesheet" href="{turl css/style.css}" />
<link rel="stylesheet" href="{turl css/style-desktop.css}" />
</noscript>
<script src="{turl css/5grid/jquery.js}"></script>
<script src="{turl css/5grid/init.js?use=mobile,desktop,1000px&amp;mobileUI=1&amp;mobileUI.theme=none&amp;mobileUI.openerWidth=52}"></script>
<!--[if IE 9]><link rel="stylesheet" href="{turl css/style-ie9.css}" /><![endif]-->
</head><body>
<div id="wrapper">
	<div id="header-wrapper">
		<header id="header">
			<div class="5grid-layout">
				<div id="menu">
					<nav class="mobileUI-site-nav">
						{pageappregion menu}
					</nav>
				</div>
			</div>
		</header>
	</div>
	<div class="5grid-layout">
		<div class="row">
			<div class="12u">
				{pageappregion banner}
			</div>
		</div>
	</div>
	<div class="divider"></div>
	<div id="featured-content-wrapper">
		<div class="12u" id="feature-content">
			<div class="5grid-layout">
				{pageappregion feature}
				<div class="row">
					<div class="3u">
						{pageappregion feature1}
					</div>
					<div class="3u">
						{pageappregion feature2}
					</div>
					<div class="3u">
						{pageappregion feature3}
					</div>
					<div class="3u">
						{pageappregion feature4}
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="page-wrapper">
		<div class="divider"></div>
		<div class="12u">
			<div class="5grid-layout" id="page">
				<div class="row">
					<div class="7u">
						{pageappregion marketingright}
					</div>
					<div class="1u">&nbsp;</div>
					<div class="2u" id="sidebar1">
						{pageappregion marketingmiddle}
					</div>
					<div class="2u">
						{pageappregion marketingleft}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="page-wrapper">
	<div class="12u">
		<div id="page" class="5grid-layout">
			{pageappregion footer}
			<div class="row">
				<div class="9u">
					{pageappregion footerleft}
				</div>
				<div class="3u">
					{pageappregion footerright}
				</div>
			</div>
		</div>
	</div>
</div>
<div id="copyright">
	<p>&copy; Your Site Name | Images: <a href="http://fotogrph.com/">Fotogrph</a> | Design: <a href="http://html5templates.com/">HTML5Templates.com</a></p>
</div>
</body>
</html>