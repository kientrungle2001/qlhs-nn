<script language="javascript" src="../3rdparty/Validate/lib/jquery.js"></script>
<script src="../3rdparty/Validate/dist/jquery.validate.js"></script>

 <script>
  $().ready(function() 
  {
   $("#formEditpassword").validate(
   {
      rules: 
      {
        frm_editpass_oldpassword: 
        {
          required: true,
          minlength: 6,
          password:true
        },
        frm_editpass_newpassword: 
        {
          required: true,
          minlength: 6,
          password:true
        },
        frm_editpass_confirmpassword: 
        {
          required: true,
          equalTo: "#frm_editpass_newpassword"
        }
      },
      messages:
       {
          frm_editpass_oldpassword: 
          {
             required: "Mật khẩu cũ không được bỏ trống",
             minlength: "Mật khẩu tối thiểu 6 ký tự",
             password: "Mật khẩu chưa đúng định dạng"
          },

           frm_editpass_newpassword: 
          {
             required: "Mật khẩu mới không được bỏ trống",
             minlength: "Mật khẩu tối thiểu là 6 ký tự",
             password: "Mật khẩu chưa đúng định dạng"
          },
           frm_editpass_confirmpassword: 
          {
            equalTo: "Mật khẩu phải trùng với mật khẩu mới"
          }
        }
    });
  });
   
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>
<style>
      label{
          
          width: 200px;
      }
      input {
          margin-bottom: 10px;
      }
      #formEditpassword label.error {
        
        width: auto;
        display: block;
        color: red;
        font-style: italic;
        font-size: 12px;
        font-weight: normal;
      
    }
    </style>

    <div class="addinfor">
    <div class="layout_title">  THAY ĐỔI MẬT KHẨU </div>
    <div> 
    <form method="post" id="formEditpassword" action="/Profile/editpasswordPost" >
    
      <?php 
        echo @$data->getError();
       $request = pzk_element('request');
       ?>
     <br> 
     <p style="padding-left:10px;" class="message_note">Để thay đổi mật khẩu bạn vui lòng điền đầy đủ các thông tin bên dưới</p>
    <div class="col-xs-4 col-xs-offset-2 margin-top-10" style="margin-left:0px !important;">
      <label for="oldpassword">Mật khẩu cũ (*):</label>
      <input type="password" class="form-control" id="frm_editpass_oldpassword" name="frm_editpass_oldpassword" placeholder="Mật khẩu cũ" data-toggle="tooltip" data-placement="top" title="Mật khẩu gồm cả chữ cái và chữ số, ít nhất 1 chữ viết hoa, 1 chữ viết thường, 1 số và không chứa khoảng trắng"/>
    </div>
     
    <div class="col-xs-4 col-xs-offset-2 margin-top-10" style="margin-left:0px !important;">
      <label for="newpassword">Mật khẩu mới (*):</label>
      <input type="password" class="form-control" id="frm_editpass_newpassword" name="frm_editpass_newpassword" placeholder="Mật khẩu mới" data-toggle="tooltip" data-placement="top" title="Mật khẩu mới phải gồm cả chữ cái và chữ số, ít nhất 1 chữ viết hoa, 1 chữ viết thường, 1 số và không chứa khoảng trắng"/>
    </div>
     <div class="clearfix" style="padding-bottom:10px;"></div>
    <div class="col-xs-4 col-xs-offset-2 margin-top-10" style="margin-left:0px !important;">
      <label for="confirmpassword">Xác nhận mật khẩu mới (*):</label>
      <input type="password" class="form-control" id="frm_editpass_confirmpassword" name="frm_editpass_confirmpassword" placeholder="Nhập lại mật khẩu mới" data-toggle="tooltip" data-placement="top" title="Nhập lại mật khẩu"/>
    </div>
    <div class="clearfix" style="padding-bottom:10px;"></div>
      <div class="col-xs-2 margin-top-33 " style="margin-top: 10px;" >
      <button type="submit"  class="btn btn-primary">Cập Nhật</button>
    </div>
  </form>
  </div>
  </div>