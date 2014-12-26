<div id="menu">
	<ul class="drop">
		<li><a href="/admin_home/index">Bảng điều khiển</a></li>
		<li><a href="/admin_category/index">Danh mục</a></li>
		<li><a href="/admin_questions/index">Câu hỏi</a></li>
        <li><a href="/admin_questiontype/index">Dạng câu hỏi</a></li>
        <?php if(pzk_session('adminLevel')=='admin') { ?>
		    <li><a href="/admin_mob/index">Add mob</a></li>
            <li><a href="/admin_adminlevel/index">Add level</a></li>
            <li><a href="/admin_levelaction/index">Add level action</a></li>
        <?php } ?>
		<li><a href="/admin_usertype/index">Nhóm người dùng</a></li>
		<li><a href="/admin_usertypecategorypermission/index">Hạn ngạch</a></li>
		<li><a href="/admin_game/index">Trò chơi</a></li>
		<li><a href="/admin_mails/index">Test Mails</a></li>
		<li><a href="/admin_news/index">Tin Tức</a></li>
		<li><a href="/admin_banner/index">Quản lý banner</a></li>
		<li><a href="/admin_examination/index" style="border-right: none">Đề thi</a></li>
		
	</ul>
</div>
<div id="main">