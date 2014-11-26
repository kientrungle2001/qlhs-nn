<?php
$categories = $data->getCategories();
?>
<div class="tour-category-list my-box">
	<h2><a href="#"><?php echo @$data->title;?></a></h2>
	<ul>
	<?php foreach ( $categories as $cat ) : ?>
	  <li ><a href="<?php echo BASE_REQUEST . '/tour'; ?>/<?php echo @$data->action;?>/<?php echo @$cat['id'];?>"><?php echo @$cat['title'];?></a></li>
	<?php endforeach; ?>
	</ul>
</div>