<html>
<head>
<?php $data->displayChildren('[id=head]');?>
</head>
<body>
<?php $data->displayChildren('[id=body]');?>	
<?php if (count($data->jsInstances)) { ?>
<script type="text/javascript">
	pzk_init(<?php echo json_encode($data->jsInstances) ?>);
</script>
<?php } ?>
</body>
</html>