   <style>
    
    </style>
    <div id="editavatar">
    <div> 
    <p align="center"><strong> Thay đổi chữ ký</strong></p>
    </div> 
    <form method="post" action="/User/editsignPost" >   

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

