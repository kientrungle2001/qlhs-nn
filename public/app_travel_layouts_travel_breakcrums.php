<?php
$cats = $data->getCategories();
$cats = array_reverse($cats);
?>
<div class="col-sm-12">
<div class="my-box">
<a href="<?php echo BASE_REQUEST . '/'; ?>">Trang chủ</a>
<?php foreach ( $cats as $cat ) : ?>
&gt; <a href="<?php echo BASE_REQUEST . '/tour'; ?>/<?php echo @$data->action;?>/<?php echo @$cat['id'];?>"><?php echo @$cat['title'];?></a> 
<?php endforeach; ?>
</div>
</div>