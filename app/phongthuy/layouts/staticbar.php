<div class="col-md-12">
<?php 
$chat_users = pzk_element('chatdb')->select('count(*) as c')->from('chat_users')->result_one();
$chat_users = $chat_users['c'];
$newsletter_subscribers = _db()->select('count(*) as c')->from('newsletter_subscriber')->result_one();
$newsletter_subscribers = $newsletter_subscribers['c'];

$profile_studiers = _db()->select('count(*) as c')->from('profile_studier')->result_one();
$profile_studiers = $profile_studiers['c'];

$profile_users = _db()->useCB()->select('count(*) as c')->from('profile_profile')->where(array('type', 'User'))->result_one();
$profile_users = $profile_users['c'];
$total_hits = pzk_filevar('total_hits');
pzk_filevar('total_hits', 1 + $total_hits);
$today_hits = pzk_filevar('today_hits' . date('dmY', time()));
pzk_filevar('today_hits' . date('dmY', time()), 1 + $today_hits);
?>
<div class="row">
	<div class="col-md-2 middle home-section"><a href="/">Trang chủ</a></div>
	<div class="col-md-8">
		<div class="row">
			<div class="col-md-2 double"><a href="http://forum.phongthuy.vn">Diễn đàn</a><span>&nbsp;</span></div>
			<div class="col-md-2 double"><a href="http://phongthuyhoangtra.vn/Chat2/">Phòng chat</a><span>{chat_users}</span></div>
			<div class="col-md-2 double"><a href="#">Tổng truy cập</a><span>{total_hits}</span></div>
			
			<div class="col-md-2 double"><a href="/user/register">Truy cập / ngày</a><span>{today_hits}</span></div>
			<div class="col-md-2 double"><a href="/user/register">ĐK thành viên</a><span>{profile_users}</span></div>
			<div class="col-md-2 double lastcol"><a href="/newsletter/subscribe">ĐK nhận tin mới</a><span>{newsletter_subscribers}</span></div>
		</div>
	</div>
	<div class="col-md-2 double"><a href="/user/study">ĐK học phong thủy</a><span>{profile_studiers}</span></div>
</div>
</div>