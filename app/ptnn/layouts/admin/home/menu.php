<?php
    $level = pzk_session('adminLevel');
    if($level == 'Administrator'){
        $allmenu = _db()->useCB()->select('*')
            ->from('admin_menu')
            ->where(array('status',1))
            ->result();
    }else {
        $allmenu = _db()->useCB()->select('am.*, ala.*')
            ->from('admin_menu am')
            ->join('admin_level_action ala', 'am.admin_controller = ala.admin_action')
            ->where(array('admin_level',$level))
            ->where(array(array('column', 'am', 'status'),1))
            ->where(array(array('column', 'ala', 'status'),1))
            ->result();
    }
//debug($allmenu);
?>
<div id="menu">
	<ul class="drop">
		<li><a href="/admin_home/index">Bảng điều khiển</a></li>
    </ul>
    <?php
    $items = buildTree($allmenu);
    showAdminMenu($items);
    ?>
        <!--
        <li><a href="/admin_questions/index">Câu hỏi</a></li>
		<li><a href="/admin_category/index">Danh mục</a></li>
		<li><a href="/admin_questions/index">Câu hỏi</a></li>
        <li><a href="/admin_questiontype/index">Dạng câu hỏi</a></li>
        <?php if(pzk_session('adminLevel')=='admin') { ?>
		    <li><a href="/admin_mob/index">Add mob</a></li>
            <li><a href="/admin_adminlevel/index">Add level</a></li>
            <li><a href="/admin_menu/index">Add menu</a></li>
            <li><a href="/admin_levelaction/index">Add level action</a></li>
        <?php } ?>
		<li><a href="/admin_usertype/index">Nhóm người dùng</a></li>
		<li><a href="/admin_usertypecategorypermission/index">Hạn ngạch</a></li>
		<li><a href="/admin_game/index">Trò chơi</a></li>
		<li><a href="/admin_news/index">Tin Tức</a></li>
		<li><a href="/admin_banner/index">Quản lý banner</a></li>
		<li><a href="/admin_upload/index">upload</a></li>
		<li><a href="/admin_examination/index" style="border-right: none">Đề thi</a></li>
		-->

    <style>
        #menu {
            float: left;
            font: bold 12px Arial, Helvetica, Sans-serif;
            overflow: hidden;
        }

        #menu ul {
            margin:0;
            padding:0;
            list-style:none;
        }

        #menu ul li {
            float:left;
            white-space: nowrap;
        }

        #menu ul li a {
            float: left;
            text-decoration:none;
            background:#337ab7;
            border-left: 1px solid rgba(255, 255, 255, 0.05);
            border-right: 1px solid rgba(0,0,0,0.2);
        }

        #menu li ul {
            background:#337ab7;

            border-radius: 0 0 10px 10px;
            -moz-border-radius: 0 0 10px 10px;
            -webkit-border-radius: 0 0 10px 10px;
            left: -999em;
            margin: 50px 0 0;
            position: absolute;
            width: 160px;
            z-index: 9999;
        }

        #menu li ul a {
            background: none;
            border: 0 none;
            margin-right: 0;
            width: 160px;

        }

        #menu ul li a:hover,
        #menu ul li:hover > a {
            background: #DFF807;
        }

        #menu li ul a:hover,
        #menu ul li li:hover > a  {
            background: #DFF807;
        }



        #menu li:hover ul {
            left: auto;
        }


        #menu li li ul {
            margin: 0px 0 0 160px;
            -webkit-border-radius: 0 10px 10px 10px;
            -moz-border-radius: 0 10px 10px 10px;
            border-radius: 0 10px 10px 10px;
            visibility:hidden;
        }

        #menu li li:hover ul {
            visibility:visible;
        }

        #menu ul ul li:last-child > a {
            -moz-border-radius:0 0 10px 10px;
            -webkit-border-radius:0 0 10px 10px;
            border-radius:0 0 10px 10px;
        }

        #menu ul ul ul li:first-child > a {
            -moz-border-radius:0 10px 0 0;
            -webkit-border-radius:0 10px 0 0;
            border-radius:0 10px 0 0;
        }

    </style>
</div>
<div id="main">