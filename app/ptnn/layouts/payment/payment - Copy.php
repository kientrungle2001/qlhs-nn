
 
  <link rel="stylesheet" media="screen" href="screen.css">
  <style>
      label 
      {
        width:200px;
      }
      input {
          margin-bottom: 10px;
      }
    </style>

 
</head>
    <div style="border-width: 1px;border-style: solid; border-color: #FF7357;  width:80%; ">
    <div> 
    <p align="center"><strong> Nạp Tiền</strong></p>
    </div> 
    <form method="post" id="formPayment" action="/User/paymentPost" >
     <br> 
      <label for="login">Nhập số tiền:</label>
      <input type="text" name="amount" id="amount"size="4" >
      <br>
      <label for="">Hình thức thanh toán</label>
      <br>
      <input type="radio" name="payment" id="payment" value="nganluong">Thanh toán qua Ngân Lượng<br>
      <input type="radio" name="payment" id="payment" value="baokim">Thanh toán qua Bảo Kim <br>
      <input type="radio" name="payment" id="payment" value="theocao">Thanh toán thẻ cào <br>
    
    <label for="">&nbsp;</label>
    
      <button type="submit" class="payment-button">Thanh toán</button>
   
  </form>
  </div>
