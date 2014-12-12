<div class="item">
    <?php
    $categories = $data->getCateByParent();
    ?>
    <div style="height: 60px; border: 1px solid red;" class="item slieder">
        slider
    </div>
    <div class="item section_cate">
        {each $categories as $item}
        <a href="<?php echo pzk_request()->build($item['router'].'/'.$item['id']); ?>">{item[name]}</a>
        {/each}
    </div>
</div>

