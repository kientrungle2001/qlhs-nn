<?php $item = $data->getItem();
$controllers = pzk_controller();
$addFieldSettings = $controllers->addFieldSettings;
$controller = pzk_request('controller');
$row = $item;
?>
<form role="form" method="post" action="{url /}{controller}/delPost}">


    <input type="hidden" name="id" value="{item[id]}" />
    {each $addFieldSettings as $field}
    {? if ($field['type'] == 'text' || $field['type'] == 'date' || $field['type'] == 'email' || $field['type'] == 'password') : ?}
    <div class="form-group clearfix">
        <label for="{field[index]}">{field[label]}</label>
        <input type="{field[type]}" class="form-control" id="{field[index]}" name="{field[index]}" placeholder="{field[label]}" value="{? if ($field['type'] != 'password') { echo $row[$field['index']]; } ?}">
    </div>
    {/if}
    {/each}

  <button type="submit" class="btn btn-primary">Đúng</button>
  <a href="{url /}{controller}/index}">Không, quay lại</a>
</form>