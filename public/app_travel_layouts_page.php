<!DOCTYPE html>
<html>
<head>
	<title><?php echo @$data->title;?></title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	
	<?php $data->displayChildren('[tagName=html.head]');?>
</head>
<body>
<script type="text/javascript">
	BASE_URL = '<?php echo BASE_URL?>';
</script>
<?php $data->displayChildren('[tagName=html.body]');?>
<?php if (count($data->jsInstances)) { ?>
		<script type="text/javascript">
			pzk_init(<?php echo json_encode($data->jsInstances) ?>);
		</script>
		<?php } ?>
</body>
</html>