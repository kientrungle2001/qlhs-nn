<form role="form" method="post" action="{url /admin_newletter/sendPost}">
  <input type="hidden" name="id" value="" />
  <div class="form-group">
    <label for="title">Tiêu đề</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tiêu đề" >
  </div>
  <div class="form-group">
    <label for="brief">Nội dung</label>
    <input type="text" class="form-control" id="content" name="content" placeholder="Nhập nội dung" >
  </div>
  <button type="submit" class="btn btn-primary">Gửi thư</button>
  <a href="{url /admin_newletter/index}">Quay lại</a>
</form>
<script type="text/javascript">
        tinymce.init({
            selector: "#content",
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