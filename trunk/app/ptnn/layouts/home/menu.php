
<div id="menu">
        <ul class="drop">
            <li><a href="/">Trang Chủ</a></li>
		</ul>
        <?php $items = $data->getItems();
        $items = buildTree($items);
        show_menu($items);
        ?>

<div id='ads-right'>
<div style='margin:0 0 5px 0; padding:0;width:308px;position:fixed; right:24px; top:201px;'>
<a href="http://bit.ly/13TbkET" target='_blank'><img border='0' height='192' src='http://i207.photobucket.com/albums/bb162/emdaxa/nextnobel.jpg' width='308'/></a>
</div></div>
	</div>
    <div id='ads-right'>
<div style='margin:0 0 5px 0; padding:0;width:308px;position:fixed; right:24px; top:393px;'>
<a href="http://bit.ly/1ANIj7y" target='_blank'><img border='0' height='192' src='http://i207.photobucket.com/albums/bb162/emdaxa/phai.jpg' width='308'/></a>
</div></div>
    </div>
    <div id='ads-right'>
<div style='margin:0 0 5px 0; padding:0;width:308px;position:fixed; left:-24px; top:393px;'>
<a href="http://bit.ly/1xD167J" target='_blank'><img border='0' height='192' src='http://i207.photobucket.com/albums/bb162/emdaxa/trai.jpg' width='308'/></a>
</div></div>
    </div>
    <div id='ads-right'>
<div style='margin:0 0 5px 0; padding:0;width:192px;position:fixed; right:667px; top:450px;'>
<a href="http://bit.ly/1ANIzU8" target='_blank'><img border='0' height='308' src='http://i207.photobucket.com/albums/bb162/emdaxa/center.jpg' width='308'/></a>
</div></div>
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