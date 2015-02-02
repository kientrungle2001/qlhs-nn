   <style>
    
    </style>
    <div id="editsign">
    <div class="layout_title">  THAY ĐỔI CHỮ KÝ </div>
    <div class="clear"></div> 
    <div>
    <form method="post" action="/Profile/editsignPost" >   
    
     <br> 
      <label for="sign">Chữ ký hiện tại:</label><br>
      <lable style="float:left;"><?php echo $data->getSign(); ?></lable>
      <br>    
      <label for="newsign">Chữ ký mới:</label>
      <textarea name="newsign" id="newsign"class="form-control" rows="3" value=""></textarea>
      <br>
    <label for="">&nbsp;</label>
      <button type="submit" class="sign-button">Cập nhật</button>
   
  </form>
  </div>
  </div>

