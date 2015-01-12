<?php 
	$controller = pzk_controller();
	$addFieldSettings = $controller->addFieldSettings;
	$row = pzk_validator()->getEditingData();
    $scriptHolder = pzk_parse('<div id="holder" />');
?>
<form id="{controller.module}AddForm" role="form" enctype="multipart/form-data" method="post" action="{url /admin}_{controller.module}/addPost">
  <input type="hidden" name="id" value="" />
  {each $addFieldSettings as $field}
  {? if ($field['type'] == 'text' || $field['type'] == 'date' || $field['type'] == 'email' || $field['type'] == 'password') : ?}
  <div class="form-group clearfix">
    <label for="{field[index]}">{field[label]}</label>
    <input type="{field[type]}" class="form-control" id="{field[index]}" name="{field[index]}" placeholder="{field[label]}" value="{? if ($field['type'] != 'password') { echo $row[$field['index']]; } ?}">
  </div>
    {? elseif($field['type'] == 'select'): ?}
    <div class="form-group clearfix">
        <label for="{field[index]}">{field[label]}</label>
        <select class="form-control" id="{field[index]}" name="{field[index]}" >
            <?php
            $table = $field['table'];
            $data = _db()->useCB()->select('*')->from($table)->where(array('status', 1))->result();
            ?>
            {each $data as $val }
            <option value="{val[field[level]]}">{val[field[level]]}</option>
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
            <option value="<?php echo $val[$field['show_value']]; ?>"><?php echo $val[$field['show_name']]; ?></option>
            {/each}

        </select>
        <input id="{field[hidden]}" type="hidden" name="{field[hidden]}"/>
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
            <?php
            $arrcontroller = glob(BASE_DIR.'/app/ptnn/controller/admin/*.php');

            ?>
            <option value="0">Chọn controller</option>
            {each $arrcontroller as $val }

            <option value="<?php echo 'admin_'.strtolower(basename($val,".php"));  ?>"><?php echo 'admin_'.strtolower(basename($val,".php"));  ?></option>
            {/each}

        </select>
    </div>

  {? elseif($field['type'] == 'upload'): ?}

  <link rel="stylesheet" href="/3rdparty/uploadify/uploadify.css" type="text/css"/>
  <div class="form-group clearfix">
      <b>{field[label]}</b><br><br>
      <?php if($field['uploadtype'] == 'image') { ?>
      <img id="{field[index]}_image" src="" height="80px" width="auto">
      <?php } ?>
      <input id="{field[index]}_value" name="{field[index]}" value="" type="hidden">
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
            <option value="1">Không cấm</option>
            <option value="edit">edit</option>
            <option value="add">add</option>
        </select>
    </div>


    {? elseif($field['type'] == 'parent'): ?}
    <div class="form-group clearfix">
        <label for="{field[index]}">{field[label]}</label>
        <select class="form-control" id="{field[index]}" name="{field[index]}" >
            <?php
            $parentId = $data->getParentId();
            $parents = _db()->select('*')->from($field['table'])->result();
            $parents = buildArr($parents, 'parent', 0);
            $row = pzk_validator()->getEditingData();

            ?>
            <option value="0">Danh mục gốc</option>
            {each $parents as $parent}
            <?php
            $selected = '';
            if($parent['id'] == $parentId) { $selected = 'selected'; }?>
            <option value="{parent[id]}" {selected}><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $parent['lever']); ?>
                <?php echo $parent[$field['show_value']]; ?>
            </option>
            {/each}

        </select>
    </div>

    {? elseif($field['type'] == 'tinymce'): ?}
    <div class="form-group clearfix">
        <label for="{field[index]}">{field[label]}</label>
        <div style="float: left;width: 100%;" class="item">
            <textarea id="{field[index]}" name="{field[index]}"></textarea>
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
  <div class="form-group clearfix">
	<label for="{field[index]}">{field[label]}</label>
    <select class="form-control" id="{field[index]}" name="{field[index]}" placeholder="Chưa kích hoạt">
		<option value="0">Chưa kích hoạt</option>
		<option value="1">Đã kích hoạt</option>
	</select>
  </div>
  {? endif ?}
  {/each}



  <div class="form-group">
  <button <?php if($field['type'] == 'upload'){ echo "id='uploadfile'";} ?> type="submit" class="btn btn-primary">Cập nhật</button>
  <a href="{url /admin}_{controller.module}/index">Quay lại</a>
  </div>
</form>