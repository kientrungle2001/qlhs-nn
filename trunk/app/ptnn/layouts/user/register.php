
<link rel="stylesheet" href="<?php echo BASE_URL ?>/default/skin/ptnn/css/style.css">
<script language="javascript" src="../3rdparty/Validate/lib/jquery.js"></script>
<script src="../3rdparty/Validate/dist/jquery.validate.js"></script>
<script>
 
    $().ready(function() {
        
        // validate signup form on keyup and submit
        $("#formRegister").validate({
            rules: {
                
                username: {
                    required: true,
                    minlength: 5
                },
                name: {
                    required: true,
                    minlength: 5
                },
                password: {
                    required: true,
                    minlength: 6
                },
                confirm_password: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password1"
                },
                email: {
                    required: true,
                    email: true
                },
                
                agree: "required"
            },
            messages: {
                
                username: {
                    required: "Yêu cầu nhập tên đăng nhập",
                    minlength: "Tên đăng nhập tối thiểu phải 6 ký tự"
                },
                password: {
                    required: "Yêu cầu nhập mật khẩu đầy đủ",
                    minlength: "Mật khẩu tối thiểu phải 6 ký tự "
                },
                confirm_password: {
                    required: "Yêu cầu nhập lại mật khẩu ở trên",
                    minlength: "Mật khẩu tối thiểu là 6 ký tự",
                    equalTo: "Yêu cầu nhập lại mật khẩu ở trên"
                },
                email: "Email chưa đúng định dạng",
                agree: " Bạn chưa đồng ý với điều khoản của NextNobels. Để đăng ký bạn phải chấp nhận các điều khoản"
            }
        });
    });
       

</script>
    <style>
    #formRegister {
        width: 500px;
    }
    #formRegister label {
        width: 250px;
    }
    #formRegister label.error {
        margin-left: 10px;
        width: auto;
        display: inline;
        color: red;
        font-style: italic;
        font-size: 12px;
         font-weight: normal;

    }
    #formRegister label.error, #formRegister input.submit {
        margin-left: 253px;
    }
    
    </style>
<div style=" border-width: 1px;border-style: solid; border-color: #FF7357;  width:100%; " id="register"> 
                <div align="center" id="steps" style=" padding-bottom: 10px;border-width: 1px;border-style: solid; border-color: #FF7357;  background-color: #fff;  width:100%;">
                  <p > <strong >ĐĂNG KÝ THÀNH VIÊN</strong></p>
                </div>
                    
                    <form id="formRegister" name="formRegister" method="post"action="/User/registerPost" > 
                        <fieldset class="step" style="padding-bottom: 20px;padding-top: 20px;"> 
                            <legend>Thông tin tài khoản</legend>
                           
                                <label for="username">Tên đăng nhập</label> 
                                
                                <input type="text" id="username" name="username" minlength="5"  value="" /> 
                                <br>
                                <label for="password1">Mật khẩu</label> 
                                <input id="password1" name="password"  type="password"  value="" /> 
                                <br>
                                <label for="confirm_password">Xác nhận lại mật khẩu</label> 
                                <input id="confirm_password" name="confirm_password"  type="password"  value="" /> 
                                <br>
                                <label for="email">Email</label> 
                                <input id="email" name="email" type="email"placeholder="info@gmail.com"  value="" /> 
                                <br>
                        </fieldset> 
                        <fieldset class="step"style="padding-bottom: 20px;padding-top: 20px;"> 
                            <legend>Thông tin cá nhân</legend> 
                                <br>
                                <label for="name">Họ và Tên</label> 
                                <input id="name" name="name" type="text"minlength="5"  autocomplete="OFF"/> 
                                <br>
                                <label for="birthday">Ngày sinh</label> 
                                <input id="birthday" name="birthday" type="date"  autocomplete="OFF" src=""/> 
                                <br>
                                <label for="sex">Giới tính</label> 
                                <select style="width:150px;height:24px;"id="sex" name="sex">
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
                                <p></p>

                                <label for="address">Địa chỉ</label> 
                                <input id="address" name="address" type="text"   autocomplete="OFF" src=""/> 
                                <br>
                                <label for="phone">Số điện thoại</label> 
                                <input id="phone" name="phone" placeholder="eg: 0987876789" type="tel"  autocomplete="OFF" src=""/> 
                                <br>

                                <label for="idpassport">Số CMT hoặc hộ chiếu</label> 
                                <input id="idpassport" name="idpassport"  type="text" autocomplete="OFF" src=""/> 
                                <br>
                                <label for="iddate">Ngày cấp</label> 
                                <input id="iddate" name="iddate"  type="date" autocomplete="OFF" src=""/> 
                                <br>
                                <label for="idplace">Nơi cấp</label> 
                                <input id="idplace" name="idplace"  type="text"  autocomplete="OFF" src=""/> 
                                <br> 
                        </fieldset>                       
                        
                        <fieldset class=""style="padding-bottom: 20px;padding-top: 20px;"> 
                            <legend>Xác nhận</legend> 
                                <br>
                                    <input style="float:left;height: 18px;width:18px;padding-left:0px;" type="checkbox" class="checkbox" id="agree" name="agree">    
                                    <label style="float:left;"for="agree">Tôi đồng ý với các điều khoản trên</label>
                                    
                                <br>
                                         
                                       <p align="center"> <button id="registerButton" type="submit">Đăng Ký</button> <p>
                          
                        </fieldset> 
                    </form> 
        
 </div> 
                