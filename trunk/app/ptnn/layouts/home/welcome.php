<div id="welcome">
	<img src="/default/skin/ptnn/media/home.jpg" usemap="#login_Map"/>
	<map name="login_Map" id="login_Map" data-toggle="modal" data-target=".bs-example-modal-lg">
         <area shape="circle" coords="738,305,45" href="javascript:void(0)" title="Click vào để đăng nhập" id="login" class="mapping">
    </map>
    
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	  	<div class="modal-dialog modal-lg">
	    	<div class="modal-content">
		    		<div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        	<h4 class="modal-title" id="myModalLabel">Đăng Nhập - Đăng Ký</h4>
			      	</div>
			      	<div class="modal-body">
				    	<form id="loginForm" class="login form-horizontal" onsubmit="return login()" method="post">
				    		<div class="form-group margin-top-10">
				    			<div class="col-xs-2">
							  		<label class="login-title" for="userlogin">Đăng Nhập :</label>
							  	</div>
							  	<div class="col-xs-4 control-group">
							  		<input type="text" class="form-control" id="userlogin" name="userlogin" placeholder="Tên đăng nhập">
							  	</div>
							  	<div class="col-xs-4 control-group">
							  		<input type="password" class="form-control" id="userpassword" name="userpassword" placeholder="Mật khẩu">
							  	</div>
							  	<div class="col-xs-2">
							  		<button type="submit" id="usersubmit" class="btn btn-primary">Đăng Nhập</button>
							  	</div>
							</div>
				    	</form>

				    	<form id="loginFBForm" class="login form-horizontal" >
				    		<div class="form-group margin-top-10">
				    			<div class="col-xs-3">
							  		<label class="login-title" for="userlogin">Đăng nhập bằng tài khoản:</label>
							  	</div>
							  	<div class="col-xs-2 control-group">
							  		<img width="122px" height="42px" onclick="return LoginFB()" alt="Đăng nhập bằng tài khoản facebook" src="/3rdparty/uploads/img/facebook.png" data-toggle="tooltip" data-placement="top" title="Đăng nhập bằng tài khoản Facebook">
							  	</div>
							  	<div class="col-xs-2 control-group">
							  		<img width="117px" height="43px" onclick="return LoginGoogle()" src="/3rdparty/uploads/img/google.png" data-toggle="tooltip" data-placement="top" title="Đăng nhập bằng tài khoản Gmail">
							  	</div>
							  	<div class="col-xs-2	 control-group">
							  		<img width="98px" height="43px" onclick="return LoginYahoo()" src="/3rdparty/uploads/img/yahoo.png" data-toggle="tooltip" data-placement="top" title="Đăng nhập bằng tài khoản Yahoo">
							  	</div>
							</div>
				    	</form>
				    	
				    	<form id="registerForm" class="register form-horizontal margin-top-20" onsubmit="return register()">
				    		<div class="form-group margin-top-10">
				    			<div class="col-xs-2">
							  		<label class="login-title">Đăng Ký :</label>
							  	</div>
							  	<div class="col-xs-4 margin-top-10">
							  		<label for="username">Tên đăng nhập :</label> <span class="validate">(*)</span>
						    		<input type="text" class="form-control" id="username" name="username" placeholder="Tên đăng nhập" data-toggle="tooltip" data-placement="top" title="Tên đăng nhập tối thiểu phải 6 ký tự, không có ký tự đặc biệt">
						    	</div>
						    	<div class="col-xs-4 margin-top-10">
							  		<label for="email">Email :</label> <span class="validate">(*)</span>
						    		<input type="text" class="form-control" id="email" name="email" placeholder="Email" data-toggle="tooltip" data-placement="top" title="Email của bạn">
						    	</div>
						    	
						    	<div class="col-xs-2 margin-top-10">
                                    <label for="sex">Giới tính</label>
                                    <select id="sex" class="form-control" name="sex" data-toggle="tooltip" data-placement="top" title="Lựa chọn giới tính">
	                                    <option value="1" class="pd-5">Nam</option>
	                                    <option value="0" class="pd-5">Nữ</option>
                                    </select>
                                </div>
						    	<div class="clearfix"></div>
						    	<div class="col-xs-4 col-xs-offset-2 margin-top-10">
						    		<label for="password1">Mật khẩu :</label> <span class="validate">(*)</span>
						    		<input type="password" class="form-control" id="password1" name="password1" placeholder="Mật khẩu" data-toggle="tooltip" data-placement="top" title="Nhập gồm cả chữ cái và chữ số, ít nhất 1 chữ viết hoa, 1 chữ viết thường, 1 số và không chứa khoảng trắng"/>
						    	</div>
						    	
						    	<div class="col-xs-4 margin-top-10">
						    		<label>Ngày sinh :</label> <span class="validate">(*)</span>
						    		<div class="date clearfix">
						    			<div class="col-xs-4">
								    		<select id="day" class="form-control" title="Ngày" name="birthday_day" aria-label="Ngày" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
												<option selected="1">Ngày</option>
												<?php for($d = 1; $d <=31; $d++):?>
												<option value="<?=$d;?>"><?=$d;?></option>
												<?php endfor;?>
											</select>
										</div>
										<div class="col-xs-4">
											<select id="month" class="form-control col-xs-4" title="Tháng" name="birthday_month" aria-label="Tháng" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
												<option selected="1">Tháng</option>
												<?php for($m = 1; $m <= 12; $m++):?>
												<option value="<?=$m;?>">Tháng <?=$m?></option>
												<?php endfor;?>
											</select>
										</div>
										<div class="col-xs-4">
											<select id="year" class="form-control col-xs-4" title="Năm" name="birthday_year" aria-label="Năm" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
												<option selected="1">Năm</option>
												<?php 
												$y = date("Y");
												for($i = $y; $i > 1905; $i--):?>
												<option value="<?=$i;?>"><?=$i;?></option>
												<?php endfor;?>
											</select>
										</div>
									</div>
						    		<input type="hidden" id="birthday" class="birthday" name="birthday" value=""/>
						    	</div>
						    	
						    	<div class="col-xs-2 margin-top-10">
							  		<label for="phone">Điện thoại :</label> <span class="validate">(*)</span>
						    		<input type="text" class="form-control" id="phone" name="phone" placeholder="Điện thoại" data-toggle="tooltip" data-placement="top" title="Điện thoại phải là số">
						    	</div>
						    	<div class="clearfix"></div>
						    	<div class="col-xs-4 col-xs-offset-2 margin-top-10">
						    		<label for="captcha">Nhập mã bảo mật:</label>  <span class="validate">(*)</span>
						    		<div class="row"> 
							    		<div class="col-xs-5 margin-top-3">
							    			<img src="<?php echo "http://".$_SERVER["SERVER_NAME"]."/3rdparty/captcha/random_image.php";  ?> "/>
							    		</div>
							    		<div class="col-xs-7">
							    			<input  type="captcha" class="form-control" id="captcha" name="captcha" placeholder="captcha" value=""/>
							    		</div>
							    	</div>
						    	</div>
						    	<div class="col-xs-2 margin-top-33">
						    		<button type="submit" id="registerButton" onclick="return set_birthday()" class="btn btn-primary">Đăng Ký</button>
						    	</div>
						  	</div>
				    	</form>
				    	
				    	<div id="register_successful">
				    		<label class="login-title">Đăng ký thành công - vui lòng đăng nhập vào email để kích hoạt tài khoản</label>
				    	</div>
				    </div>
	    	</div>
	  	</div>
	</div>
</div>
<script>

	 function LoginFB(){
        window.location = "/Account/loginfacebook";
        //window.onload = "/Account/loginfacebook";

      }
	function login(){
		
		var userlogin 		= $('#userlogin').val();
		var userpassword	= $('#userpassword').val();
		
		$.ajax({
			url:'../Account/loginPost',
			data:{
				userlogin: userlogin,
				userpassword:userpassword,
			}, 
			success:function(result){
				
				if(result !=""){
					if(result == -1){
						window.location = BASE_URL;
					}else if(result == 0){
						alert("Tài khoản của bạn đăng bị khóa hoặc chưa kích hoạt");
					}else if(result == 1){
						alert("Mật khẩu đăng nhập chưa đúng");
					}else if(result == 2){
						alert("Tên đăng nhập chưa đúng");
					}else if(result == 3){
						alert("Bạn phải nhập đầy đủ tên đăng nhập và mật khẩu");
					}else{
						alert("False");
					}
				}
				return false;
			}
		});
		
		return false;
	}

	function register(){
		
		var username 	= $('#username').val();
		var email 		= $('#email').val();
		var sex			= $('#sex').val();
		var password1	= $('#password1').val();
		var birthday	= $('#birthday').val();
		var phone		= $('#phone').val();
		var captcha		= $('#captcha').val();
		
		$.ajax({
			url:'../Account/registerPost',
			data:{
				username: 		username,
				email: 			email,
				sex: 			sex,
				password1: 		password1,
				birthday: 		birthday,
				phone: 			phone,
				captcha:		captcha
			}, 
			success:function(result){
				
				if(result !=""){
					if(result == -1){
						alert("Tên đăng nhập đã tồn tại trên hệ thống");
					}else if(result == 0){
						alert("Email đã tồn tại trên hệ thống");
					}else if(result == 1){
						$("#registerForm").hide();
						$("#register_successful").show();
					}else if(result == 2){
						alert("Mã bảo mật chưa đúng");
					}else{
						alert("False");
					}
				}
				return false;
			}
		});
		return false;
	}
	
	function set_birthday(){
		var day 	= $("#day").val();
		var month 	= $("#month").val();
		var year 	= $("#year").val();

		var birthday = day+'/'+month+'/'+year;

		$("#birthday").val(birthday);
	}
	
	$(function () {
	  	$('[data-toggle="tooltip"]').tooltip()
	});
	
	$(document).ready(function () {
		
		$('#loginForm').validate({
		    rules: {
		        userlogin: {
		            minlength: 3,
		            required: true
		        },
		        userpassword: {
		            required: true,
		            minlength: 6,
		            password:true
		        },
		    },
			messages: {
				userlogin: {
                    required: "Yêu cầu nhập tên đăng nhập",
                    minlength: "",
                },
                userpassword: {
                    required: 	"Yêu cầu nhập mật khẩu",
                    minlength: 	"",
                    password:	""
                },
            }
		});
		
        $("#registerForm").validate({
            rules: {
                
                username: {
                    required: true,
                    minlength: 5,
                    username:true
                   
                },
                name: {
                    required: true,
                    minlength: 5
                    
                },
                password1: {
                    required: true,
                    minlength: 6,
                    password:true
                },
                email: {
                    required: true,
                    email: true
                },
                birthday_day:{
                	required: true,
                	min:1,
                	max:31
                },
                birthday_month:{
                	required: true,
                	min:1,
                	max:12
                },
                birthday_year:{
                	required: true,
                	min:1905,
                },
                phone:{
                	required: true,
                	number:true,
                },
                captcha: "required"
            },
            messages: {
                
                username: {
                    required: "Yêu cầu nhập tên đăng nhập",
                    minlength: "Tên đăng nhập tối thiểu phải 6 ký tự",
                    username:" Tên đăng nhập chưa đúng"
                    
                },
                password1: {
                    required: 	"Yêu cầu nhập mật khẩu đầy đủ",
                    minlength: 	"Mật khẩu tối thiểu phải 6 ký tự ",
                    password:	"Mật khẩu chưa phù hợp"
                },
                email: "Email chưa đúng định dạng",
                birthday_day:"",
                birthday_month:"",
                birthday_year:"",
                phone:"",
                captcha: ""
            }
        });
	});
</script>