
<div id="menu">
        <ul class="drop">
            <li><a href="/">Trang Chủ</a></li>
			<li><a href="http://localhost/ptnn/app/ptnn2/index.php">Diễn đàn</a></li>
		</ul>
        <?php $items = $data->getItems();
        $items = buildTree($items);
        show_menu($items);
        ?>
</div>
     <style>
        #menu ul {
            margin:0;
            padding:0;
            list-style:none;
        }

        #menu ul.drop li {
            float:left;
        	list-style-type: none;
        	height: 43px;
        }
        
		#menu ul li a:last-child { border-right: none;}
        #menu ul li a {
            float: left;
            text-decoration:none;
       		margin-top: 8px;
            border-right: 1px solid #F7E308;
        	height: 27px;
        }

        #menu li ul {
            left: -999em;
            margin-top: 43px;
            position: absolute;
            width: 250px;
            z-index: 9999;
        }
		
        #menu li ul li {
            background: #EC44A8;
        	border-bottom:1px solid #F7E308;
        }
        
        #menu li ul a {
            margin-right: 0;
            width: 250px;
        }

        #menu ul li:hover,
        #menu ul li:hover > a,
        #menu li ul a:hover,
        #menu ul li li:hover > a  {
            color: #FFF100;
        }
        #menu li:hover ul {
            left: auto;
        }
		
        #menu li li ul {
            margin: 0px 0 0  251px;
            visibility:hidden;
        }
        #menu li li:hover ul {
            visibility:visible;
        }
    </style>
	<div id="main">