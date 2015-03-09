<script language="javascript" src="../3rdparty/Validate/lib/jquery.js"></script>
<script src="../3rdparty/Validate/dist/jquery.validate.js"></script>
 <script>
 $(document).ready(function () {
         $("#formEditinfor").validate({
            rules: {
                
                frm_editinfor_username: {
                    required: true,
                    minlength: 5,
                    username:true
                   
                },
                
                frm_editinfor_password: {
                    required: true,
                    minlength: 6,
                    password:true
                },
                frm_editinfor_email: {
                    required: true,
                    email: true
                },
                frm_editinfor_day:{
                    required: true,
                    min:1,
                    max:31
                },
                frm_editinfor_month:{
                    required: true,
                    min:1,
                    max:12
                },
                frm_editinfor_year:{
                    required: true,
                    min:1905,
                },
                frm_editinfor_phone:{
                    required: true
                }
            },
            messages: {
                
                frm_editinfor_username: {
                    required: "Yêu cầu nhập tên đăng nhập",
                    minlength: "Tên đăng nhập tối thiểu phải 6 ký tự",
                    username:" Tên đăng nhập chưa đúng"
                    
                },
                frm_editinfor_password: {
                    required:   "Yêu cầu nhập mật khẩu đầy đủ",
                    minlength:  "Mật khẩu tối thiểu phải 6 ký tự ",
                    password:   "Mật khẩu chưa phù hợp"
                },
                frm_editinfor_email: "Email chưa đúng định dạng",
                frm_editinfor_day:"",
                frm_editinfor_month:"",
                bfrm_editinfor_year:"",
                frm_editinfor_phone:""
                
            }
        });
     });
</script>
<div  class="addinfor"> 
                <div  class="layout_title">SỬA THÔNG TIN CÁ NHÂN</div>
                
                
                <div class="clear"></div>    
                   
                    <form id="formEditinfor" class="register form-horizontal margin-top-20" method="post"action="/Profile/editinforPost">
                            <div class="form-group margin-top-10">
                                
                                <div class="col-xs-4 margin-top-10">
                                    <label for="username">Họ và Tên :</label>
                                    <input type="text" class="form-control" id="frm_editinfor_name" name="frm_editinfor_name" value=" <?php echo $data->getname();?>" placeholder="Họ và Tên" data-toggle="tooltip" data-placement="top" title="Họ và Tên">
                                </div>
                                
                                
                                <div class="col-xs-2 margin-top-10">
                                    <label for="sex">Giới tính</label>
                                    <select  class="form-control" id="frm_editinfor_sex" name="frm_editinfor_sex" data-toggle="tooltip" data-placement="top" title="Lựa chọn giới tính">
                                        <option value="1" class="pd-5">Nam</option>
                                        <option value="0" class="pd-5">Nữ</option>
                                    </select>
                                </div>
                                <div class="col-xs-2">
                                    <label for="phone">Điện thoại (*) :</label>
                                    <input type="text" class="form-control" id="frm_editinfor_phone" name="frm_editinfor_phone" value=" <?php echo $data->getphone();?>" placeholder="Điện thoại" data-toggle="tooltip" data-placement="top" title="Điện thoại phải là số">
                                </div>
                                <div class="clearfix" style="padding-bottom:10px;"></div>
                                <div class="col-xs-4 ">
                                    <label for="username">Địa chỉ (*) :</label>
                                    <input type="text" class="form-control" id="frm_editinfor_address" name="frm_editinfor_address" value="<?php echo $data->getaddress();?>" placeholder="Địa chỉ" data-toggle="tooltip" data-placement="top" title="Địa chỉ của bạn">
                                </div>
                                 <div class="col-xs-4 margin-top-10">
                                    <label for="username">Ngày sinh (*) :</label>
                                    <input type="date" class="form-control" id="frm_editinfor_birthday" value="<?php echo $data->getbirthday();?>" name="frm_editinfor_birthday" value=" <?php echo $data->getbirthday();?>" placeholder="Họ và Tên" data-toggle="tooltip" data-placement="top" title="Ngày tháng năm sinh">
                                </div>
                                
                                
                                
                                <div class="clearfix"></div>
                                
                                <div class="col-xs-8 margin-top-10">
                                    <label for="username"></label>
                                    <div class="show_ok"><span><?php echo $data->getMessage(); ?></span></div>
                                    <div class="show_error"><span><?php echo $data->getError(); ?></span></div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-xs-2 margin-top-33 " style="margin-top: 10px;" >
                                    <button type="submit" id="frm_editinfor_Button" onclick="return set_birthday()" class="btn btn-primary">Cập Nhật</button>
                                </div>
                            </div>
                        </form>
                        
 </div> 
<script>
 
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>                