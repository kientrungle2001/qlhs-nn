<!DOCTYPE HTML>
<!--
	Affection: A responsive HTML5 website template by HTML5Templates.com
	Released for free under the Creative Commons Attribution 3.0 license (html5templates.com/license)
	Visit http://html5templates.com for more great templates or follow us on Twitter @HTML5T
-->
<html>
<head>
<title><?php echo @$data->title;?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="<?php echo @$data->description;?>" />
<meta name="keywords" content="<?php echo @$data->keywords;?>" />
<noscript>
<link rel="stylesheet" href="/design/template/affection/css/5grid/core.css" />
<link rel="stylesheet" href="/design/template/affection/css/5grid/core-desktop.css" />
<link rel="stylesheet" href="/design/template/affection/css/5grid/core-1200px.css" />
<link rel="stylesheet" href="/design/template/affection/css/5grid/core-noscript.css" />
<link rel="stylesheet" href="/design/template/affection/css/style.css" />
<link rel="stylesheet" href="/design/template/affection/css/style-desktop.css" />
</noscript>
<script src="/design/template/affection/css/5grid/jquery.js"></script>
<script src="/design/template/affection/css/5grid/init.js?use=mobile,desktop,1000px&amp;mobileUI=1&amp;mobileUI.theme=none"></script>
<!--[if IE 9]><link rel="stylesheet" href="/design/template/affection/css/style-ie9.css" /><![endif]-->
<?php $data->displayChildren('[tagName=html.head]');?>
</head><body>
<?php $data->displayChildren('[tagName=html.body]');?>
</body>
</html>