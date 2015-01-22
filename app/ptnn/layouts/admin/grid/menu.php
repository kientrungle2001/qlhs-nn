<?php
$controller = pzk_request('controller');
$action = pzk_request('action');
$setting = pzk_controller();
?>

<div class="list-group rightmenu">
    <div class="panel-default">
        <div class="panel-heading"><b>Menu</b></div>
    </div>

    <a class="list-group-item <?php if($action =='index') { echo 'active'; } ?>" href="{url /}{controller}/index">Danh sách</a>
    <a class="list-group-item <?php if($action =='add') { echo 'active'; } ?>" href="{url /}{controller}/add">Thêm mới</a>
    <?php
    if(!empty($setting->menuLinks)) {
        foreach($setting->menuLinks as $val) {
            $tam = explode('/', $val['href']);
            $linkaction = end($tam);
            ?>
            <a class="list-group-item <?php if($action == $linkaction) { echo 'active'; } ?>" href="{val[href]}">{val[name]}</a>
        <?php
        }
    }
    ?>
</div>
