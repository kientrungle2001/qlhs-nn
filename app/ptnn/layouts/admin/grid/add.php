<?php 
	$controller = pzk_controller();
	$addFieldSettings = $controller->addFieldSettings;
    $setAddTabs = $controller->setAddTabs;
	$row = pzk_validator()->getEditingData();
    $scriptHolder = pzk_parse('<div id="holder" />');
?>

<div class="panel panel-default">
<div class="panel-heading">
    <b><?php echo $controller->addLabel; ?></b>
</div>
<div class="panel-body borderadmin">
<form id="{controller.module}AddForm" role="form" enctype="multipart/form-data" method="post" action="{url /admin}_{controller.module}/addPost">
  <input type="hidden" name="id" value="" />
    <?php if(!empty($setAddTabs)) { ?>

    <div class="form-group clearfix">
        <ul class="nav nav-tabs" role="tablist" id="myTab">
            <?php
            $i=1;
            foreach($setAddTabs as $val) { ?>
            <li role="presentation" <?php if($i == 1) { echo "class='active'"; }?> ><a href="#{val[name]}" aria-controls="{val[name]}" role="tab" data-toggle="tab">{val[name]}</a></li>
            <?php $i++; } ?>

        </ul>

        <div style="margin-top: 10px;" class="tab-content">
            <?php
            $i=1;
            foreach($setAddTabs as $val) { ?>
                <div role="tabpanel" class="tab-pane <?php if($i == 1) { echo "active"; }?>" id="{val[name]}">
                    <?php foreach($val['listFields'] as $field ) { ?>
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
                            if(isset($parents[0]['parent'])) {
                                echo "<option value='0'>&nbsp;&nbsp;&nbsp;&nbsp;Danh mục gốc</option>";
                            }else{
                                echo "<option value='0'>Danh mục gốc</option>";
                            }
                            ?>
                            {each $parents as $parent}

                            <option value="<?php echo $parent[$field['show_value']]; ?>" >
                                <?php if(isset($parent['parent'])){ echo str_repeat('--', $parent['lever']); } ?>
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
                    <script src="/3rdparty/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
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
                        setTimeout(function() {
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
                        },100);
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
                            <textarea id="{field[index]}" class="tinymce"  name="{field[index]}"></textarea>
                        </div>
                    </div>
                    <script type="text/javascript">
                        setTinymce();
                    </script>

                    {? elseif($field['type'] == 'selectoption'): ?}
                    <div class="form-group clearfix">
                        <label for="{field[index]}">{field[label]}</label>
                        <div style="float: left;width: 100%;" class="item">
                            <select class="form-control"  id="{field[index]}" name="{field[index]}">
                                {each $field['option'] as $key=>$val}
                                <option value="{key}">{val}</option>
                                {/each}
                            </select>
                        </div>
                    </div>

                    {? elseif($field['type'] == 'status'): ?}
                    <div class="form-group clearfix">
                        <label for="{field[index]}">{field[label]}</label>
                        <select class="form-control" id="{field[index]}" name="{field[index]}" placeholder="Chưa kích hoạt">
                            <option value="0">Chưa kích hoạt</option>
                            <option value="1">Đã kích hoạt</option>
                        </select>
                    </div>
                    {? endif ?}
                    <?php } ?>
                </div>
                <?php $i++; } ?>

        </div>


    </div>
    <?php } else { ?>


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
            if(isset($parents[0]['parent'])) {
                $parents = buildArr($parents, 'parent', 0);
                echo "<option value='0'>&nbsp;&nbsp;&nbsp;&nbsp;Danh mục gốc</option>";
            }else{
                echo "<option value='0'>Danh mục gốc</option>";
            }
            ?>
            {each $parents as $parent}

            <option value="<?php echo $parent[$field['show_value']]; ?>" >
                <?php if(isset($parent['parent'])){ echo str_repeat('--', $parent['lever']); } ?>
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
   <script src="/3rdparty/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
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
      setTimeout(function() {
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
      }, 100);
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
            <textarea id="{field[index]}" class="tinymce" name="{field[index]}"></textarea>
        </div>
    </div>
    <script type="text/javascript">
        setTinymce();
    </script>

    {? elseif($field['type'] == 'selectoption'): ?}
    <div class="form-group clearfix">
        <label for="{field[index]}">{field[label]}</label>
        <div style="float: left;width: 100%;" class="item">
            <select class="form-control"  id="{field[index]}" name="{field[index]}">
                {each $field['option'] as $key=>$val}
                <option value="{key}">{val}</option>
                {/each}
            </select>
        </div>
    </div>

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


<?php } ?>

  <div class="form-group">
  <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Cập nhật</button>
  <a class="btn btn-default" href="{url /admin}_{controller.module}/index"><span class="glyphicon glyphicon-refresh"></span> Quay lại</a>
  </div>
</form>
</div>
</div>