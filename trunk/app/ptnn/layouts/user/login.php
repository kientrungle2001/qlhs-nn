<?php
    if(pzk_session('login')){

    
   ?>
    <?php
      echo pzk_session('username');
      
      ?>
      <br>
      <a href="/user/logout">dang xuat </a>

   <?php } else{
    
    ?>
   <style>
      label{
          float: left;
          width: 200px;
      }
      input {
          margin-bottom: 10px;
      }
    </style>
    <form method="post" action="/User/loginPost" >
    
      <?php 
        echo @$data->getError();
       $request = pzk_element('request');
       ?>
     <br> 
      <label for="login">User:</label>
      <input type="text" name="login" id="login" value="<?php echo $request->get('login') ;  ?>">
      <br>

    
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" value="">
    
      <br>
    <label for="">&nbsp;</label>
      <button type="submit" class="login-button">Login</button>
   
  </form>
  <?php 
}
  ?>