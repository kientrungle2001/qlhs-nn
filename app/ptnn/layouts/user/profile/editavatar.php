
<?php 
	$user= $data->loadAvatar();
?>

<div id="editavatar">
	<div class="layout_title"> THAY ĐỔI AVATAR</div>
	<div class="clear"></div>
	<div class="avatar">
		<img src="<?php echo $user->getAvatar(); ?>"alt="" width="100%" height="100%">
	</div>
	<div class="showmessage"> <p class="fontmessage"><?php echo $data->getMessage(); ?></p></div>
	<div class="clear"></div>
	<div class="show_note">
		<form action="/Profile/editavatarPost" method="post" enctype="multipart/form-data" runat="server">
    	<span class="show_note">Upload ảnh lên từ máy của bạn:Chỉ chấp nhận định dạng ảnh .JPG và .JPEGdung lượng ảnh tối đa 488kb.</span>

    	<input type="file" name="fileToUpload" id="fileToUpload">
    	<input type="submit" value="Upload Avatar" name="submit">
		</form>
	</div>

</div>
