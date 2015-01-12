 <?php
 $email = pzk_request('email');
 $key = pzk_request('key');
 $key2 = md5($email.'nn123456');
			 if($key==$key2)
				{
					$id=_db()->useCB()->select('id')->from('mail')->where(array('mail',$email))->result_one();
					_db()->delete()->from('mail')->where('id='.$id['id'])->result();
				}
 //$delmail = $data->getDelMail($key,$email);
 ?>

    <div style="border-width: 1px;border-style: solid; border-color: #FF7357;  width:65%; ">
	<p align="center"><strong>Nhận tin qua email đã được hủy bỏ<br>
	Chúng tôi xin lỗi vì đã làm phiền bạn<br>
    <?php echo "http://".$_SERVER["SERVER_NAME"]; ?>
   </strong></p>   
    </div>