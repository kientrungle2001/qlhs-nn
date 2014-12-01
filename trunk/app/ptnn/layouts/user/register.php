<style>
  label{
    float: left;
    width: 200px;
  }
input {
  margin-bottom: 10px;
}
</style>
<form method="post" action="/User/registerPost" >
   
       
      <label for="name">Ful Name:</label>
      <input type="text" name="name" id="name" value="">
      <br>
      
       
      <label for="username">User:</label>
      <input type="text" name="username" id="username" value="">
    
      <br>
    
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" value="">
      <br>
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" value="">
      <br>
    <label for="">&nbsp;</label>

      <button type="submit" class="register-button">Register</button>
    
  </form>