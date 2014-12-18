
 
  <link rel="stylesheet" media="screen" href="screen.css">
  <style>
      label 
      {
        width:200px;
      }
      input[type="radio"] {
        
          margin-bottom: 10px;
          width: 17px;
      }
      #ttNganluong {
    background: url("http://ptnn.vn/default/images/thecao/napthe.png") no-repeat scroll 0 0 transparent;
    border: 0 none;
    cursor: pointer;
    display: inline-block;
    height: 30px;
    
    text-indent: -3000px;
    vertical-align: middle;
    width: 122px;
}
    </style>

 
</head>
    <div style="border-width: 1px;border-style: solid; border-color: #FF7357;  width:100%; ">
    <div> 
    <p align="center"><strong> Nạp Tiền</strong></p>
    </div> 
    <form method="post" id="formPayment" action="/User/paymentPost" >
     <br> 
      <label for="login">Nhập số tiền:</label>
      <input type="text" name="amount" id="amount"size="4" >
      <br>
      <label for="">Hình thức nạp thẻ</label>
      <br>
      <input type="radio" name="payment" id="payment" value="nganluong">Nạp tiền qua cổng thanh toán Ngân Lượng<br>
      <input type="radio" name="payment" id="payment" value="baokim">Nạp tiền qua cổng thanh toán Bảo Kim <br>
      <input type="radio" name="payment" id="payment" value="theocao">Nạp tiền dùng thẻ cào Ngân Lượng<br>
      <input type="radio" name="payment" id="payment" value="theocao">Nạp tiền dùng thẻ của Nextnobels<br>
    
    <label for="">&nbsp;</label>
    
      <button type="submit" class="payment-button">Thanh toán</button>
   
  </form>
<form name="napthe" action="/User/paycardPost" method="post">
<div  style="border: 1px solid #444444;  margin: 0 auto;  padding: 10px;  width:100%;">
<div style="color:#444444;margin-top:10px;font-size:14px" align="center">
  Nạp thẻ cào điện thoại
</div>

<table align="center">
  
  <tr>
      <td colspan="3">
          <table>
              <tr>
          <td style="padding-left:0px;padding-top:5px" align="right" ><img  src="http://ptnn.vn/default/images/thecao/mobifone.jpg" /></td>
                    <td style="padding-left:10px;padding-top:5px"><img  src="http://ptnn.vn/default/images/thecao/vinaphone.jpg" /></td>
                     <td style="padding-top:5px;padding-left:5px" align="left"><img  src="http://ptnn.vn/default/images/thecao/viettel.jpg" width="100" height="35" /></td>
                     <td style="padding-top:5px;padding-left:5px" align="left"><img width="100" height="35" src="http://ptnn.vn/default/images/thecao/vtc.jpg"></td>
                     <td style="padding-top:5px;padding-left:5px" align="left"><img width="100" height="35" src="http://ptnn.vn/default/images/thecao/gate.jpg"></td>
                </tr>
                <tr>
          <td align="center" style="padding-bottom:0px;">
                        <input type="radio" name="typecard" checked="true" value="VMS" id="92"  />
                    </td>
                    <td align="center" style="padding-bottom:0px;padding-left:5px">
                        <input type="radio"  name="typecard" value="VNP" id="93" />
                    </td>
                     <td align="center" style="padding-bottom:0px;padding-right:0px">
                        <input type="radio"  name="typecard" value="VIETTEL" id="107" />
                    </td>
                    <td align="center" style="padding-right:10px">
            <input type="radio" id="121" value="VCOIN" name="typecard">
          </td>
          
                    <td align="center" style="padding-bottom:0px;padding-right:0px">
                         <input type="radio" id="120" value="GATE" name="typecard">
                    </td>
          
                </tr>
            </table>
        </td>
    </tr>
    
    <tr>
        <td align="right" style="padding-bottom:10px">Số Seri :</td>
        <td colspan="2"><input type="text" id="txtSeri" name="txtSeri" style="height:25px;width:200px" /></td>
    </tr>
     <tr>
        <td align="right">Mã số thẻ : </td>
        <td colspan="2">
          <input type="text" id="txtPin" name="txtPin" style="height:25px;width:200px" />
            
        </td>
    </tr>
   
  <tr>
        <td colspan="3" align="center" style="padding-top:10px;padding-right:20px;">
        <input type="submit" id="ttNganluong" name="NLNapThe" value="Nạp Thẻ"  /> 
     </td>
    </tr> 
</table>

</div>
</form>
  </div>

