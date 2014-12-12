	
	<div id="menu">
        <ul class="drop">
            <li><a href="/">trang chu</a></li>
        </ul>
        <?php $items = $data->getItems();
        $items = buildTree($items);
        show_menu($items);
        ?>

	</div>
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
	<div id="main">