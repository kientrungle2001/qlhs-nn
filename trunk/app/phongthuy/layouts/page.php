<!DOCTYPE html>
<html {? $isNotAdmin=true; ?}{ifprop isAdmin=true}{?  $isNotAdmin = false; ?}{/if}{ifvar isNotAdmin}xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml"{/if} lang="vi">
<head>
	<title>{prop title}</title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="{prop description}">
	{children [tagName=html.head]}
</head>
<body ondragstart="return false" onselectstart="return false">
<script type="text/javascript">
	BASE_URL = '<?php echo BASE_URL?>';
</script>{ifvar isNotAdmin}
<script type="text/javascript">(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>{/if}
{children [tagName=html.body]}
<?php if (count($data->jsInstances)) { ?>
		<script type="text/javascript">
			pzk_init(<?php echo json_encode($data->jsInstances) ?>);
		</script>
		<?php } ?>
</body>
</html>