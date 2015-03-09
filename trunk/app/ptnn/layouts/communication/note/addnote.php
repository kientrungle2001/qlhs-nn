
<div id="profilefriend_right">
    <div class="prf_title">Chào mừng bạn đã ghé thăm góc học tập của tôi</div>
    <div class="prf_clear" style="width: 100%; height: 30px;"></div>

    <div class="prf_title" style="width:30%;">Ghi chép cá nhân</div>
     <div class="prf_clear" style="width: 100%; height: 30px;"></div>
   
<div class="center_info_cus clear">
    <div class="list_test_cen_title_page">
        <img class="list_test_cen_icon_title" src="/images/pr_list_title_icon.png">
        <div class="list_test_cen_wrap_head_title">
             <b>THÊM GHI CHÉP MỚI</b>                                   
        </div>

    </div>

        <form name="form1" method="post" action="">
        <div class="pne_pr_row">
            Tiêu đề: <input class="res_input" type="text" name="titlenote" id="note_title" value="">
        </div>
        <div id="blog_images_frame" style="clear: both;"></div>
        Nội dung: 
        <div class="form_add_note pne_ck_area">            
            
            <textarea id="addnote" name="contentnote" class="pne_ck_area_box" ></textarea>            
        </div>
        <input class="pne_st1_r_file_bt" type="button" id="note_back" value="Quay lại">
        <input class="pne_st1_r_file_bt" type="button" name="note_finish" id="note_finish" value="Hoàn thành">
        <input class="pne_st1_r_file_bt" type="button" id="note_reset" value="Làm lại">
<!--        <a href="javascript:;"><div class="pne_st1_r_file_bt">Làm lại</div></a>-->
    </form>
   
    <script type="text/javascript" src="../3rdparty/tinymce/js/tinymce/tinymce.min.js"></script>
  <script type="text/javascript">
        tinymce.init({
            selector: "#addnote",
            forced_root_block : "",
            force_br_newlines : true,
            force_p_newlines : false,
            relative_url: false,
            remove_script_host: false,
            plugins: [
                "lists  image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen media",
                "insertdatetime media table contextmenu paste responsivefilemanager textcolor"
            ],

            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | styleselect formatselect fontselect fontsizeselect | forecolor backcolor",
            entity_encoding : "raw",
            relative_urls: false,
            external_filemanager_path: "/3rdparty/Filemanager/filemanager/",
            filemanager_title:"Quản lý file upload" ,
            external_plugins: { "filemanager" :"/3rdparty/Filemanager/filemanager/plugin.min.js"},
            height: 100
        });
    </script>
    <script>
    $('#note_finish').click(function(){
      var notetitle= $('#note_title').val();
      var notecontent= tinyMCE.get('addnote').getContent();
     
       $.ajax({
            url:'../note/PostUserNote',
            data:{
              notetitle: notetitle,
              notecontent:notecontent }, 
            success:function(result){
              
              window.location = "/note/viewnote?member=<?php echo pzk_request('member'); ?>";
                         
            }
          });
    });
    $('#note_reset').click(function()
    {
      $('#note_title').val('');
      tinyMCE.get('addnote').setContent('');
    });
    $('#note_back').click(function()
    {
      window.location="/note/viewnote?member=<?php echo pzk_request('member'); ?>";
    });
    </script>   
</div>




  </div>