
<link rel="stylesheet" href="<?php echo BASE_URL ?>/default/skin/ptnn/css/style.css">
<div style=" border-width: 1px;border-style: solid; border-color: #FF7357;  width:100%; " id="register"> 
                <div align="center" id="steps" style=" padding-bottom: 10px;border-width: 1px;border-style: solid; border-color: #FF7357;  background-color: #fff;  width:100%;">
                  <p > <strong >THÔNG TIN CÁ NHÂN</strong></p>
                </div>
                    
                    <form id="formRegister" name="formRegister" method="post"action="/User/registerPost" > 
                                                  
                                <br>
                                <label for="name">Họ và Tên</label> 
                                <input id="name" name="name" type="text" autocomplete="OFF"/> 
                                <br>
                                <label for="brithday">Ngày sinh</label> 
                                <input id="brithday" name="brithday" type="date" autocomplete="OFF" src=""/> 
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
                                <button id="registerButton" type="submit">Cập nhật</button> 
                       
                    </form> 
        
 </div> 
                