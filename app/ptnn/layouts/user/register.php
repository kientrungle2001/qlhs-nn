
<link rel="stylesheet" href="<?php echo BASE_URL ?>/default/skin/ptnn/css/style.css">
<script language="javascript" src="../3rdparty/Validate/lib/jquery.js"></script>
<script src="../3rdparty/Validate/dist/jquery.validate.js"></script>
    <script>
    $.validator.setDefaults({
        submitHandler: function() {
            alert("submitted!");
        }
    });

    $().ready(function() {
        // validate the comment form when it is submitted
        $("#commentForm").validate();

        // validate signup form on keyup and submit
        $("#signupForm").validate({
            rules: {
                firstname: "required",
                lastname: "required",
                username: {
                    required: true,
                    minlength: 2
                },
                password: {
                    required: true,
                    minlength: 5
                },
                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true
                },
                topic: {
                    required: "#newsletter:checked",
                    minlength: 2
                },
                agree: "required"
            },
            messages: {
                firstname: "Please enter your firstname",
                lastname: "Please enter your lastname",
                username: {
                    required: "Please enter a username",
                    minlength: "Your username must consist of at least 2 characters"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                confirm_password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo: "Please enter the same password as above"
                },
                email: "Please enter a valid email address",
                agree: "Please accept our policy"
            }
        });

        // propose username by combining first- and lastname
        $("#username").focus(function() {
            var firstname = $("#name").val();
            var lastname = $("#lastname").val();
            if (firstname && lastname && !this.value) {
                this.value = firstname + "." + lastname;
            }
        });

        //code to hide topic selection, disable for demo
        var newsletter = $("#newsletter");
        // newsletter topics are optional, hide at first
        var inital = newsletter.is(":checked");
        var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
        var topicInputs = topics.find("input").attr("disabled", !inital);
        // show when newsletter is checked
        newsletter.click(function() {
            topics[this.checked ? "removeClass" : "addClass"]("gray");
            topicInputs.attr("disabled", !this.checked);
        });
    });
    </script>
<div style=" border-width: 1px;border-style: solid; border-color: #FF7357;  width:100%; " id="register"> 
                <div align="center" id="steps" style=" padding-bottom: 10px;border-width: 1px;border-style: solid; border-color: #FF7357;  background-color: #fff;  width:100%;">
                  <p > <strong >ĐĂNG KÝ THÀNH VIÊN</strong></p>
                </div>
                    
                    <form id="formRegister" name="formRegister" method="post"action="/User/registerPost" > 
                        <fieldset class="step" style="padding-bottom: 20px;padding-top: 20px;"> 
                            <legend>Thông tin tài khoản</legend> 
                           
                                <label for="username">Tên đăng nhập</label> 
                                <input type="text" id="username" name="username" value="" /> 
                                <br>
                                <label for="password">Mật khẩu</label> 
                                <input id="password" name="password"  type="password" value="" /> 
                                <br>
                                <label for="confirmpassword">Xác nhận lại mật khẩu</label> 
                                <input id="confirmpassword" name="confirmpassword" type="password" value="" /> 
                                <br>
                                <label for="email">Email</label> 
                                <input id="email" name="email" type="email"placeholder="info@gmail.com" value="" /> 
                                <br>
                        </fieldset> 
                        <fieldset class="step"style="padding-bottom: 20px;padding-top: 20px;"> 
                            <legend>Thông tin cá nhân</legend> 
                                <br>
                                <label for="name">Họ và Tên</label> 
                                <input id="name" name="name" type="text" autocomplete="OFF"/> 
                                <br>
                                <label for="birthday">Ngày sinh</label> 
                                <input id="birthday" name="birthday" type="date" autocomplete="OFF" src=""/> 
                                <br>
                                <label for="add ress">Địa chỉ</label> 
                                <input id="address" name="address" type="text" autocomplete="OFF" src=""/> 
                                <br>
                                <label for="phone">Số điện thoại</label> 
                                <input id="phone" name="phone" placeholder="eg: 0987876789" type="tel" autocomplete="OFF" src=""/> 
                                <br>

                                <label for="idpassport">Số CMT hoặc hộ chiếu</label> 
                                <input id="idpassport" name="idpassport"  type="text" autocomplete="OFF" src=""/> 
                                <br>
                                <label for="iddate">Ngày cấp</label> 
                                <input id="iddate" name="iddate"  type="date" autocomplete="OFF" src=""/> 
                                <br>
                                <label for="idplace">Nơi cấp</label> 
                                <input id="idplace" name="idplace"  type="text" autocomplete="OFF" src=""/> 
                                <br> 
                        </fieldset>                       
                        
                        <fieldset class="step"style="padding-bottom: 20px;padding-top: 20px;"> 
                            <legend>Xác nhận</legend> 
                                  Tôi chấp nhận các điều khoản khi sử dụng website ptnn.vn
                                         
                                        <button id="registerButton" type="submit">Đăng Ký</button> 
                          
                        </fieldset> 
                    </form> 
        
 </div> 
                