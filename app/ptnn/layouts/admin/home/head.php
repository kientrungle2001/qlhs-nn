	<script type="text/javascript" src="<?php echo BASE_URL ?>/default/skin/ptnn/js_admin/main.js"></script>
	<link rel="stylesheet" href="<?php echo BASE_URL ?>/default/skin/ptnn/css_admin/style.css" />
	
    {children all}<!--lay tat ca cac con cua hear cho vao layout-->
    <div id="header">
        <div class="row margin-top-10">
            <div class="col-xs-2">
                <img src="<?php echo BASE_URL ?>/default/skin/ptnn/media_admin/logo.png"/>
            </div>
            <div class="col-xs-8">
                <h4><a href="home/index">CÔNG TY CP GIÁO DỤC PHÁT TRIỂN TRÍ TUỆ VÀ SÁNG TẠO NEXTNOBELS</a></h4>
                <h4>Quản trị hệ thống luyện viết văn miêu tả và phát triển ngôn ngữ</h4>
            </div>
            <div class="col-xs-2">
                <div class="margin-top-10"><span><b>Xin chào :</b> <?=pzk_session('adminUser')?> </span> <a href="/admin_login/logout"><b>(Thoát)</b></a></div>
            </div>
        </div>
    </div>