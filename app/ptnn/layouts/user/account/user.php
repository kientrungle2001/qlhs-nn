<style>
	#menu_user a:hover{color: #fffffd; font-weight:bold;}
	.menu_user{display: none; left: 50px; position: absolute; top: 16px;background:#1E55A8; color: #fffffd; width:100%; line-height: 23px; padding-left: 5px; padding-top:12px}
	.menu_user a{color: #fffffd;}
	.menu_user li{list-style-type: none;}
	.menu_user a:hover{color: #fffffd; font-weight:bold;}
</style>
<?php if(pzk_session('login')):?>
    <?php $data->loadData();?>
	<span id="menu_user"><a class="color-white" href="/profile/profileusercontent?member=<?=pzk_session('userId');?>"><b><?php if(empty($data->getName())) :?> <?=$data->getUsername()?> <?php else:?> <?=$data->getName()?> <?php endif;?> </b></a></span>
	<div class="menu_user color-white ">
		<ul>
		    <li><a href="#">Tài khoản hiện có :<?php if( $data->getAmount()==0) echo 0; else echo $data->getAmount(); ?>vnđ</a></li>
		    <li><a href="/profile/profileusercontent?member=<?=pzk_session('userId');  ?>">Vào trang cá nhân</a></li>
		    <li><a href="/payment/payment">Nạp tiền</a></li>
		</ul>
	</div>
<?php endif; ?>

<script>
	$('#menu_user').mouseover(function() {
		$('.menu_user').show();
	});
	$('#menu_user').mouseout(function() {
		$('.menu_user').hide();
	});
	$('.menu_user').mouseout(function() {
		$('.menu_user').hide();
	});
	$('.menu_user').mouseover(function() {
		$('.menu_user').show();
	});
</script>