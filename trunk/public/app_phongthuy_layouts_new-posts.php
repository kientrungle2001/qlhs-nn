<?php 
$index = 0;
$items = _db()->useCB()->select('*')->from('news_article')->where(array('like', 'categories', '%,27,%'))->orderBy('id desc')->limit(5, 0)->result();?>
<div class="gallery" id="gallery-27">
<?php foreach ( $items as $item ) : ?>
<?php preg_match('/src="([^"]+)"/', $item['thumbnail'], $match);
$img = @$match[1];
?>
<?php if($img) { ?>
	<div class="gallery-item">
	<a href="/<?php echo @$item['alias'];?>"><img src="<?php echo BASE_URL . createThumb($img, 640, 480);?>" /></a>
	</div>
<?php 
	$index++;
	if($index > 4) {
		break;
	}
} ?>
<?php endforeach; ?>
<script type="text/javascript">
	$(function () {
		/* SET PARAMETERS */
		var change_img_time     = 2000; 
		var transition_speed    = 100;

		var simple_slideshow    = $("#gallery-27"),
			listItems           = simple_slideshow.children('.gallery-item'),
			listLen             = listItems.length,
			i                   = 0,

			changeList = function () {

				listItems.eq(i).fadeOut(transition_speed, function () {
					i += 1;
					if (i === listLen) {
						i = 0;
					}
					listItems.eq(i).fadeIn(transition_speed);
				});

			};

		listItems.not(':first').hide();
		setInterval(changeList, change_img_time);

	});
</script>

</div>