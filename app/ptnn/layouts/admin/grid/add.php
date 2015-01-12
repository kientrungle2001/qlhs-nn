<?php 
	$controller = pzk_controller();
	$addFieldSettings = $controller->addFieldSettings;
	$row = pzk_validator()->getEditingData();
    $scriptHolder = pzk_parse('<div id="holder" />');
?>


<form id="{controller.module}AddForm" role="form" enctype="multipart/form-data" method="post" action="{url /admin}_{controller.module}/addPost">
  <input type="hidden" name="id" value="" />


    <div class="form-group clearfix">
        <ul class="nav nav-tabs" role="tablist" id="myTab">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">sdf1</div>
            <div role="tabpanel" class="tab-pane" id="profile">sf2</div>
            <div role="tabpanel" class="tab-pane" id="messages">sfd3</div>
            <div role="tabpanel" class="tab-pane" id="settings">sf4</div>
        </div>

        <script>
            $(function () {
                $('#myTab a:last').tab('show')
            })
        </script>
    </div>


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
            $parents = _db()->select('*')->from($field['table'])->result();
            $parents = buildArr($parents, 'parent', 0);
            ?>
            <option value="0">&nbsp;&nbsp;&nbsp;&nbsp;Danh mục gốc</option>
            {each $parents as $parent}

            <option value="<?php echo $parent[$field['show_value']]; ?>" ><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $parent['lever']); ?>
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
  <button <?php if($field['type'] == 'upload'){ echo "id='uploadfile'";} ?> type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Cập nhật</button>
  <a class="btn btn-default" href="{url /admin}_{controller.module}/index"><span class="glyphicon glyphicon-refresh"></span> Quay lại</a>
  </div>
</form>