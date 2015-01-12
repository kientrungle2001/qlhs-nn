<?php 
$controller = pzk_controller();
$item = $data->getItem(); 
$row = pzk_validator()->getEditingData();
if($row) {
	$item = array_merge($item, $row);
}
$row = $item;

$editFieldSettings = $controller->editFieldSettings;
?>
<form role="form" method="post" enctype="multipart/form-data"  action="{url /admin}_{controller.module}/editPost">
  <input type="hidden" name="id" value="{item[id]}" />
  {each $editFieldSettings as $field}
  {? if ($field['type'] == 'text' || $field['type'] =='file' || $field['type'] == 'date' || $field['type'] == 'email' || $field['type'] == 'password') : ?}
  <div class="form-group clearfix">
    <label for="{field[index]}">{field[label]}</label>
    <input type="{field[type]}" class="form-control" id="{field[index]}" name="{field[index]}" placeholder="{field[label]}" value="{? if ($field['type'] != 'password') { echo $row[$field['index']]; } ?}">
  </div>

    {? elseif($field['type'] == 'select'): ?}
    <div class="form-group clearfix">
        <label for="{field[index]}">{field[label]}</label>
        <select class="form-control" id="{field[index]}" name="{field[index]}" >
            <option value="0">Danh mục gốc</option>
            <?php
            $parents = _db()->select('*')->from($field['table'])->result();
            $parents = buildArr($parents, 'parent', 0);
            ?>
            {each $parents as $parent}
            <?php
            $selected = '';
            if($parent[$field['show_value']] == $row[$field['index']]) { $selected = 'selected'; }?>
            <option value="<?php echo $parent[$filed['show_value']]; ?>" {selected}><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $parent['lever']); ?>
            <?php echo $parent[$field['show_name']]; ?>
            </option>
            {/each}

        </select>
    </div>

    {? elseif($field['type'] == 'selectInput'): ?}
    <div class="form-group clearfix">
        <label for="{field[index]}">{field[label]}</label>
        <select class="form-control" id="{field[index]}" name="{field[index]}" >
            <?php
            $table = $field['table'];
            $data = _db()->useCB()->select('*')->from($table)->where(array('status', 1))->result();
            ?>
            {each $data as $val }
            <option <?php if($row[$field['index']] == $val[$field['show_value']]) { echo 'selected'; } ?> value="<?php echo $val[$field['show_value']]; ?>"><?php echo $val[$field['show_name']]; ?></option>
            {/each}

        </select>
        <input id="{field[hidden]}" type="hidden" value="<?php echo $row[$field['hidden']]; ?>" name="{field[hidden]}"/>
    </div>
    <script>
        $('#{field[index]}').change(function() {
            var optionSelected = $(this).find("option:selected");
            var textSelected   = optionSelected.text();
            $('#{field[hidden]}').val(textSelected);
        });
    </script>


    {? elseif($field['type'] == 'admin_controller'): ?}
    <div class="form-group clearfix">
        <label for="{field[index]}">{field[label]}</label>
        <select class="form-control" id="{field[index]}" name="{field[index]}" >
            <option value="">Chọn controller</option>
            <?php
            $arrcontroller = glob(BASE_DIR.'/app/ptnn/controller/admin/*.php');

            ?>
            {each $arrcontroller as $val }
            <?php
            $namec = 'admin_'.strtolower(basename($val,".php"));
            //var_dump($row[$field['index']]);
            //$file = file_get_contents($val);
            //preg_match('/\/\/\[([^\]]+)\]/', $file, $match);
            //var_dump($match);
            ?>

            <option <?php if($row[$field['index']] == $namec) { echo 'selected'; } ?> value="<?php echo 'admin_'.strtolower(basename($val,".php"));  ?>"><?php echo 'admin_'.strtolower(basename($val,".php"));  ?></option>
            {/each}

        </select>
    </div>

    {? elseif($field['type'] == 'upload'): ?}

    <link rel="stylesheet" href="/3rdparty/uploadify/uploadify.css" type="text/css"/>

    <div class="form-group clearfix">
        <b>{field[label]}</b><br><br>

        <?php if($field['uploadtype'] == 'image') { ?>
            <img id="{field[index]}_image" src="<?php echo $row[$field['index']]; ?>" height="80px" width="auto">
        <?php } ?>

        <input id="{field[index]}_value" name="{field[index]}" value="{row[url]}" type="hidden">
        <input type="file" name="{field[index]}" id="{field[index]}"  multiple="true" />
        <a href="javascript:$('#{field[index]}').uploadify('upload')">Upload Files</a>

    </div>

    <script type="text/javascript">
        <?php $timestamp = time();?>
        $(function() {
            $('#{field[index]}').uploadify({
                'formData'     : {
                    'timestamp' : '<?php echo $timestamp;?>',
                    'token'     : '<?php echo md5('ptnn' . $timestamp);?>',
                    'uploadtype' : '<?php echo $field['uploadtype']; ?>'
                },
                'swf'      : BASE_URL+'/3rdparty/uploadify/uploadify.swf',
                'uploader' : BASE_URL+'/3rdparty/uploadify/uploadify.php',
                'folder' : BASE_URL+'/3rdparty/uploads/videos',
                'auto' : false,
                'onUploadSuccess' : function(file, data, response) {
                    var src = data;
                    $('#{field[index]}_value').val(src);
                    <?php if($field['uploadtype'] == 'image') { ?>
                    $('#{field[index]}_image').attr('src', src);
                    <?php } ?>
                }


            });
        });
    </script>



    {? elseif($field['type'] == 'select_fix'): ?}
    <div class="form-group clearfix">
        <label for="{field[index]}">{field[label]}</label>
        <select class="form-control" id="{field[index]}" name="{field[index]}" >
            <option <?php if($row[$field['index']] == 1) { echo 'selected'; } ?> value="1">Không cấm</option>
            <option <?php if($row[$field['index']] == 'edit') { echo 'selected'; } ?> value="edit">edit</option>
            <option <?php if($row[$field['index']] == 'add') { echo 'selected'; } ?> value="add">add</option>
        </select>
    </div>


    {? elseif($field['type'] == 'tinymce'): ?}
    <div class="form-group clearfix">
        <label for="{field[index]}">{field[label]}</label>
        <div style="float: left;width: 100%;" class="item">
            <textarea id="{field[index]}" name="{field[index]}"><?php if(isset($row[$field['index']])) { echo $row[$field['index']];}  ?></textarea>
        </div>
    </div>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea#{field[index]}",
            forced_root_block : "",
            force_br_newlines : true,
            force_p_newlines : false,
            relative_url: false,
            remove_script_host: false,
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen media",
                "insertdatetime media table contextmenu paste responsivefilemanager textcolor"
            ],

            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | styleselect formatselect fontselect fontsizeselect | forecolor backcolor",
            entity_encoding : "raw",
            relative_urls: false,
            external_filemanager_path: "/3rdparty/Filemanager/filemanager/",
            filemanager_title:"Quản lý file upload" ,
            external_plugins: { "filemanager" :"/3rdparty/Filemanager/filemanager/plugin.min.js"},
            height: 250
        });
    </script>


  {? elseif($field['type'] == 'status'): ?}
  <div class="form-group clearfix"><?php 
		$selected0 = ''; $selected1 = ''; 
		$selectedField = 'selected'.$row['status'];
		$$selectedField = 'selected';
		?>
    <label for="{field[index]}">{field[label]}</label>
    <select class="form-control" id="{field[index]}" name="{field[index]}" placeholder="Chưa kích hoạt" value="{item[status]}">
		<option value="0" {selected0}>Chưa kích hoạt</option>
		<option value="1" {selected1}>Đã kích hoạt</option>
	</select>
  </div>
  {? endif ?}
  {/each}
  
  <button type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="{url /admin}_{controller.module}/index">Quay lại</a>
</form>