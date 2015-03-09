<script language="javascript" src="../3rdparty/Validate/lib/jquery.js"></script>
<script src="../3rdparty/Validate/dist/jquery.validate.js"></script>
 <script>
 $(document).ready(function () {
         $("#formAddinforG").validate({
            rules: {
                
                frm_addg_username: {
                    required: true,
                    minlength: 5,
                    username:true
                   
                },
                
                frm_addg_password: {
                    required: true,
                    minlength: 6,
                    password:true
                },
                frm_addg_email: {
                    required: true,
                    email: true
                },
                frm_addg_day:{
                    required: true,
                    min:1,
                    max:31
                },
                frm_addg_month:{
                    required: true,
                    min:1,
                    max:12
                },
                frm_addg_year:{
                    required: true,
                    min:1905,
                },
                frm_addg_phone:{
                    required: true,
                    number:true,
                }
            },
            messages: {
                
                frm_addg_username: {
                    required: "Yêu cầu nhập tên đăng nhập",
                    minlength: "Tên đăng nhập tối thiểu phải 6 ký tự",
                    username:" Tên đăng nhập chưa đúng"
                    
                },
                frm_addg_password: {
                    required:   "Yêu cầu nhập mật khẩu đầy đủ",
                    minlength:  "Mật khẩu tối thiểu phải 6 ký tự ",
                    password:   "Mật khẩu chưa phù hợp"
                },
                frm_addg_email: "Email chưa đúng định dạng",
                frm_addg_day:"",
                frm_addg_month:"",
                frm_addg_year:"",
                frm_addg_phone:""
                
            }
        });
     });
</script>
<div  class="addinfor"> 
                <div  class="layout_title">BỔ XUNG THÔNG TIN CÁ NHÂN</div>
                <div class="clear"></div>  
                <div class="message_note" style="padding-top:10px; padding-bottom: 10px;">
                    Bạn đang đăng nhập bằng tài khoản Facebook. <br> 
                    Sau khi bổ xung thông tin cá nhân chúng tôi sẽ cung cấp Tài khoản đăng nhập và mật khẩu vào email của bạn <br>
                    Lần sau bạn có thể sử dụng tên đăng nhập và mật khẩu này để đăng nhập trực tiếp vào NextNobels
                </div>
                <div class="clear"></div>    
                   
                    <form id="formAddinforG" class="register form-horizontal margin-top-20" method="post"action="/Profile/addinforgooglePost">
                            <div class="form-group margin-top-10">
                                
                                <div class="col-xs-4 margin-top-10">
                                    <label for="username">Tên đăng nhập (*) :</label>
                                    <input type="text" class="form-control" id="frm_addg_username" name="frm_addg_username" placeholder="Tên đăng nhập" data-toggle="tooltip" data-placement="top" title="Tên đăng nhập tối thiểu phải 6 ký tự, không có ký tự đặc biệt">
                                </div>
                                <div class="col-xs-4 col-xs-offset-2 margin-top-10" style="margin-left:0px !important;">
                                    <label for="password1">Mật khẩu (*):</label>
                                    <input type="password" class="form-control" id="frm_addg_password" name="frm_addg_password" placeholder="Mật khẩu" data-toggle="tooltip" data-placement="top" title="Mật khẩu gồm cả chữ cái và chữ số, ít nhất 1 chữ viết hoa, 1 chữ viết thường, 1 số và không chứa khoảng trắng"/>
                                </div>
                                
                               
                                <div class="clearfix" style="padding-bottom:10px;"></div>
                                <div class="col-xs-4 margin-top-10">
                                    <label for="username">Địa chỉ :</label>
                                    <input type="text" class="form-control" id="frm_addg_address" name="frm_addg_address" placeholder="Địa chỉ" data-toggle="tooltip" data-placement="top" >
                                </div>
                                
                                 <div class="col-xs-4 margin-top-10">
                                    <label for="username">Ngày sinh (*) :</label>
                                    <input type="date" class="form-control" id="frm_addg_birthday" value="<?php echo $data->getbirthday();?>" name="frm_addg_birthday" value=" <?php echo $data->getbirthday();?>" placeholder="Họ và Tên" data-toggle="tooltip" data-placement="top" title="Ngày tháng năm sinh">
                                </div>
                                
                                <div class="col-xs-2 margin-top-10">
                                    <label for="phone">Điện thoại (*) :</label>
                                    <input type="text" class="form-control" id="frm_addg_phone" name="frm_addg_phone" placeholder="Điện thoại" data-toggle="tooltip" data-placement="top" title="Điện thoại phải là số">
                                </div>
                                <div class="clearfix"></div>
                                
                                <div class="col-xs-8 margin-top-10">
                                    <label for="username"></label>
                                    <div class="show_ok"><span><?php echo $data->getMessage(); ?></span></div>
                                    <div class="show_error"><span><?php echo $data->getError(); ?></span></div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-xs-2 margin-top-33 " style="margin-top: 10px;" >
                                    <button type="submit" id="frm_addg_Button"  class="btn btn-primary">Cập Nhật</button>
                                </div>
                            </div>
                        </form>
                        
 </div> 
<script>
    
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>                