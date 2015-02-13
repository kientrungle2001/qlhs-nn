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
				    	<form id="loginForm" class="login form-horizontal" action="/Account/loginPost" method="post">
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
				    	
				    	<form id="registerForm" class="register form-horizontal margin-top-20" name="formRegister" method="post" action="/Account/registerPost">
				    		<div class="form-group margin-top-10">
				    			<div class="col-xs-2">
							  		<label class="login-title">Đăng Ký :</label>
							  	</div>
							  	<div class="col-xs-4 margin-top-10">
							  		<label for="username">Tên đăng nhập :</label> <span class="validate">(*)</span>
						    		<input type="text" class="form-control" id="username" name="username" placeholder="Tên đăng nhập" data-toggle="tooltip" data-placement="top" title="Tên đăng nhập tối thiểu phải 6 ký tự">
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
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10</option>
												<option value="11">11</option>
												<option value="12">12</option>
												<option value="13">13</option>
												<option value="14">14</option>
												<option value="15">15</option>
												<option value="16">16</option>
												<option value="17">17</option>
												<option value="18">18</option>
												<option value="19">19</option>
												<option value="20">20</option>
												<option value="21">21</option>
												<option value="22">22</option>
												<option value="23">23</option>
												<option value="24">24</option>
												<option value="25">25</option>
												<option value="26">26</option>
												<option value="27">27</option>
												<option value="28">28</option>
												<option value="29">29</option>
												<option value="30">30</option>
												<option value="31">31</option>
											</select>
										</div>
										<div class="col-xs-4">
											<select id="month" class="form-control col-xs-4" title="Tháng" name="birthday_month" aria-label="Tháng" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
												<option selected="1">Tháng</option>
												<option value="1">Tháng 1</option>
												<option value="2">Tháng 2</option>
												<option value="3">Tháng 3</option>
												<option value="4">Tháng 4</option>
												<option value="5">Tháng 5</option>
												<option value="6">Tháng 6</option>
												<option value="7">Tháng 7</option>
												<option value="8">Tháng 8</option>
												<option value="9">Tháng 9</option>
												<option value="10">Tháng 10</option>
												<option value="11">Tháng 11</option>
												<option value="12">Tháng 12</option>
											</select>
										</div>
										<div class="col-xs-4">
											<select id="year" class="form-control col-xs-4" title="Năm" name="birthday_year" aria-label="Năm" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
												<option selected="1">Năm</option>
												<option value="2015">2015</option>
												<option value="2014">2014</option>
												<option value="2013">2013</option>
												<option value="2012">2012</option>
												<option value="2011">2011</option>
												<option value="2010">2010</option>
												<option value="2009">2009</option>
												<option value="2008">2008</option>
												<option value="2007">2007</option>
												<option value="2006">2006</option>
												<option value="2005">2005</option>
												<option value="2004">2004</option>
												<option value="2003">2003</option>
												<option value="2002">2002</option>
												<option value="2001">2001</option>
												<option value="2000">2000</option>
												<option value="1999">1999</option>
												<option value="1998">1998</option>
												<option value="1997">1997</option>
												<option value="1996">1996</option>
												<option value="1995">1995</option>
												<option value="1994">1994</option>
												<option value="1993">1993</option>
												<option value="1992">1992</option>
												<option value="1991">1991</option>
												<option value="1990">1990</option>
												<option value="1989">1989</option>
												<option value="1988">1988</option>
												<option value="1987">1987</option>
												<option value="1986">1986</option>
												<option value="1985">1985</option>
												<option value="1984">1984</option>
												<option value="1983">1983</option>
												<option value="1982">1982</option>
												<option value="1981">1981</option>
												<option value="1980">1980</option>
												<option value="1979">1979</option>
												<option value="1978">1978</option>
												<option value="1977">1977</option>
												<option value="1976">1976</option>
												<option value="1975">1975</option>
												<option value="1974">1974</option>
												<option value="1973">1973</option>
												<option value="1972">1972</option>
												<option value="1971">1971</option>
												<option value="1970">1970</option>
												<option value="1969">1969</option>
												<option value="1968">1968</option>
												<option value="1967">1967</option>
												<option value="1966">1966</option>
												<option value="1965">1965</option>
												<option value="1964">1964</option>
												<option value="1963">1963</option>
												<option value="1962">1962</option>
												<option value="1961">1961</option>
												<option value="1960">1960</option>
												<option value="1959">1959</option>
												<option value="1958">1958</option>
												<option value="1957">1957</option>
												<option value="1956">1956</option>
												<option value="1955">1955</option>
												<option value="1954">1954</option>
												<option value="1953">1953</option>
												<option value="1952">1952</option>
												<option value="1951">1951</option>
												<option value="1950">1950</option>
												<option value="1949">1949</option>
												<option value="1948">1948</option>
												<option value="1947">1947</option>
												<option value="1946">1946</option>
												<option value="1945">1945</option>
												<option value="1944">1944</option>
												<option value="1943">1943</option>
												<option value="1942">1942</option>
												<option value="1941">1941</option>
												<option value="1940">1940</option>
												<option value="1939">1939</option>
												<option value="1938">1938</option>
												<option value="1937">1937</option>
												<option value="1936">1936</option>
												<option value="1935">1935</option>
												<option value="1934">1934</option>
												<option value="1933">1933</option>
												<option value="1932">1932</option>
												<option value="1931">1931</option>
												<option value="1930">1930</option>
												<option value="1929">1929</option>
												<option value="1928">1928</option>
												<option value="1927">1927</option>
												<option value="1926">1926</option>
												<option value="1925">1925</option>
												<option value="1924">1924</option>
												<option value="1923">1923</option>
												<option value="1922">1922</option>
												<option value="1921">1921</option>
												<option value="1920">1920</option>
												<option value="1919">1919</option>
												<option value="1918">1918</option>
												<option value="1917">1917</option>
												<option value="1916">1916</option>
												<option value="1915">1915</option>
												<option value="1914">1914</option>
												<option value="1913">1913</option>
												<option value="1912">1912</option>
												<option value="1911">1911</option>
												<option value="1910">1910</option>
												<option value="1909">1909</option>
												<option value="1908">1908</option>
												<option value="1907">1907</option>
												<option value="1906">1906</option>
												<option value="1905">1905</option>
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
				    </div>
	    	</div>
	  	</div>
	</div>
</div>
<script>
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
		/*
		$('#loginForm').validate({
		    rules: {
		        userlogin: {
		            minlength: 2,
		            required: true
		        },
		        userpassword: {
		            required: true,
		            minlength: 6,
		            password:true
		        },
		        agree: "required",
	            captcha: "required"
		    },
			messages: {
				userlogin: {
                    required: "Yêu cầu nhập tên đăng nhập",
                    minlength: "Tên đăng nhập tối thiểu phải 6 ký tự",
                    username:" Tên đăng nhập chưa đúng"
                },
                userpassword: {
                    required: 	"Yêu cầu nhập mật khẩu đầy đủ",
                    minlength: 	"Mật khẩu tối thiểu phải 6 ký tự ",
                    password:	"Yêu cầu nhập đúng mật khẩu"
                },
            }
		});
		*/
		
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
                agree: "required",
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
                agree: " Bạn chưa đồng ý với điều khoản của NextNobels. Để đăng ký bạn phải chấp nhận các điều khoản",
                captcha: "Bạn hãy nhập mã bảo mật giống với hình bên cạnh"
            }
        });
	});
</script>