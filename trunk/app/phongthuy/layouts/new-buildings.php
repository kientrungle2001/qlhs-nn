<?php 
$request = pzk_element('request');
$parentId = $request->getSegment(3);
if(!$parentId) {
	$parentId = 3;
}
if($parentId == 3 || $parentId == 34) {
$categories = _db()->useCB()->select('*')->from('catalog_category')->where(array('parentId', $parentId))->orderBy('ordering asc')->result();
?>
{each $categories as $cat}
<div class="col-md-4" style="background: #ddd; overflow: hidden;">
<h3><a href="/{cat[alias]}">{cat[title]}</a></h3>
<div class="gallery" id="gallery-{cat[id]}">
<?php 
$index = 1;
$items = _db()->useCB()->select('*')->from('news_article')->where(array('like', 'categories', '%,'.$cat['id']. ',%'))->orderBy('id desc')->limit(5, 0)->result();?>
{each $items as $item}
<?php preg_match('/src="([^"]+)"/', $item['thumbnail'], $match);
$img = @$match[1];
?>
<?php if($img) { ?>
	<div class="gallery-item">
	<a href="/{cat[alias]}">{thumb 640x480 $img}</a>
	</div>
<?php 
	$index++;
	if($index > 4) {
		break;
	}
} ?>
{/each}
<script type="text/javascript">
	$(function () {
		/* SET PARAMETERS */
		var change_img_time     = 2000; 
		var transition_speed    = 100;

		var simple_slideshow    = $("#gallery-{cat[id]}"),
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
<!--ul>
{each $items as $item}
<li><a href="/{item[alias]}">{item[title]}</a></li>
{/each}
</ul-->
</div>
{/each}
<?php } else {
$cat = _db()->useCB()->select('*')->from('catalog_category')->where(array('id', $parentId))->result_one();
$cat['title'] = strip_tags($cat['title']);
?>
<h2><a href="/{cat[alias]}">{cat[title]}</a></h2>

<?php $items = _db()->useCB()->select('*')->from('news_article')->where(array('like', 'categories', '%,'.$cat['id'].',%'))->result();?>
{each $items as $item}
<?php /*$item['title'] = strip_tags($item['title']); */ ?>
<div class="col-md-4">
<h3><a href="/{item[alias]}">{item[title]}</a></h3>
<?php preg_match('/src="([^"]+)"/', $item['thumbnail'], $match);
$img = @$match[1];
?>
<?php if($img) { ?>
<div class="gallery">
	<div class="gallery-item">
	<a href="/{item[alias]}">{thumb 640x480 $img}</a>
	</div>
</div>
<?php } ?>
</div>
{/each}

<?php } ?>