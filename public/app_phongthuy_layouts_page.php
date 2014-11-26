<!DOCTYPE html>
<html <?php $isNotAdmin=true; ?><?php if ( @$data->isAdmin=="true" ) : ?><?php  $isNotAdmin = false; ?><?php endif; ?><?php if ( @$isNotAdmin ) : ?>xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml"<?php endif; ?> lang="vi">
<head>
	<title><?php echo @$data->title;?></title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="<?php echo @$data->description;?>">
	<?php $data->displayChildren('[tagName=html.head]');?>
</head>
<body ondragstart="return false" onselectstart="return false">
<script type="text/javascript">
	BASE_URL = '<?php echo BASE_URL?>';
</script><?php if ( @$isNotAdmin ) : ?>
<script type="text/javascript">(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script><?php endif; ?>
<?php $data->displayChildren('[tagName=html.body]');?>
<?php if (count($data->jsInstances)) { ?>
		<script type="text/javascript">
			pzk_init(<?php echo json_encode($data->jsInstances) ?>);
		</script>
		<?php } ?>
</body>
</html>