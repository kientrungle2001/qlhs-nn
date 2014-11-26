<?php
$items = $data->getItems();
?>
<ul>
<?php foreach ( $items as $item ) : ?>
<li><?php echo @$item['name'];?></li>
<?php endforeach; ?>
</ul>