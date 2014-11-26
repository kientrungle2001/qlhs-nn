<?php
$item = $data->getItem();
$next = $data->getNextItem(array('categories', $item['categories']));
$prev = $data->getPrevItem(array('categories', $item['categories']));
$displayFields = explode(',',$data->displayFields);
?>
<?php if ( @$data->showImages=="true" ) : ?>
<?php preg_match_all('/img src="([^"]+)"/', $item['images'], $matches);
$imgs = @$matches[1];
?>
<div>
<?php foreach ( $imgs as $img ) : ?>
<?php if($img) { ?>
	<div style="display: block; float: left; width: 162px; height: 110px;margin: 5px; border: 1px solid #ddd;">
	<a href="javascript:void(0);" rel="<?php echo @$img;?>" onclick="showImage('<?php echo @$img;?>');"><img src="<?php echo BASE_URL . createThumb($img, 160, 108);?>" /></a>
	</div>
<?php } ?>
<?php endforeach; ?>
<div style="clear:both;"></div>
<script>
function showImage(url) {
	var $img = $('<img src="'+url+'">');
	$img.click(function(){
		$img.remove();
	});
	var attrs = {'position': 'fixed', 'top': 50, 'left': 300, 'width': $(window).width() - 600, 'height': 'auto', 'right': 300, 'border': '1px solid #ddd', 'padding': '5px'};
	for(var name in attrs) {
		$img.css(name, attrs[name]);
	}
	$('body').append($img);
}
</script>
</div>
<?php endif; ?>
<?php foreach ( $displayFields as $field ) : ?>
<?php $field = trim($field); $fieldTag = $field . 'Tag'; $fieldTag=@$data->$fieldTag?@$data->$fieldTag: 'div'; $value = @$item[$field]; ?>
<<?php echo @$fieldTag;?> class="<?php echo @$data->classPrefix;?><?php echo @$field;?>"><?php echo @$value;?></<?php echo @$fieldTag;?>>
<?php endforeach; ?>
<?php $data->displayChildren('all');?>
<?php if ( @$data->showNav=="true" ) : ?>
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-left">
		<?php if($prev) { ?>
		<a href="/<?php echo @$prev['alias'];?>" style="padding: 5px; color: yellow;">Bài trước</a>
		<?php } ?>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
		<?php if($next) { ?>
		<a href="/<?php echo @$next['alias'];?>" style="padding: 5px; color: yellow;">Bài tiếp</a>
		<?php } ?>
		</div>
	</div>
<?php endif; ?>

<?php if ( @$data->facebookComment=="true" ) : ?>
<div style="background: #ddd;">
<fb:comments width="100%" xid="16626" href="http://<?php echo @$_SERVER['HTTP_HOST'];?><?php echo @$_SERVER['REQUEST_URI'];?>"></fb:comments>
</div>
<?php endif; ?>