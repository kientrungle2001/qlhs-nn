

<div  id="editinfor"> 
                <div  class="layout_title"> THÔNG TIN CÁ NHÂN</div>
                <div class="clear"></div>    
                    <form id="formEditinfor" name="formEditinfor" method="post"action="/Profile/editinforPost" > 
                                                  
                                <br>
                                <label for="name">Họ và Tên</label> 
                                <input id="name" name="name" type="text" value=" <?php echo $data->getname();?>" autocomplete="OFF"/> 
                                <br>
                                <label for="birthday">Ngày sinh</label> 
                                <input id="birthday" name="birthday" type="date" value="<?php echo $data->getbirthday();?>" autocomplete="OFF" src=""/> 
                                <br>
                                <label for="address">Địa chỉ</label> 
                                <input id="address" name="address" type="text" value="<?php echo $data->getaddress();?>"autocomplete="OFF" src=""/> 
                                <br>
                                <label for="phone">Số điện thoại</label> 
                                <input id="phone" name="phone" value=" <?php echo $data->getphone();?>" type="tel" autocomplete="OFF" src=""/> 
                                <br>

                                <label for="idpassport">Số CMT hoặc hộ chiếu</label> 
                                <input id="idpassport" name="idpassport"  type="text"value="<?php echo $data->getidpassport();?>" autocomplete="OFF" src=""/> 
                                <br>
                                <label for="iddate">Ngày cấp</label> 
                                <input id="iddate" name="iddate"  type="date"value="<?php echo $data->getiddate();?>" autocomplete="OFF" src=""/> 
                                <br>
                                <label for="idplace">Nơi cấp</label> 
                                <input id="idplace" name="idplace"  type="text"value="<?php echo $data->getidplace();?>" autocomplete="OFF" src=""/> 
                                <br> 
                                <label for=""></label>
                                <button id="EditinforButton" type="submit">Cập nhật</button> 
                       
                    </form> 
        
 </div> 
                