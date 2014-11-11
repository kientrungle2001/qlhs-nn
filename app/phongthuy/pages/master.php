<page id="page" title="Trang chu">
	<html.head id="head">
		<html.js src="<?php echo BASE_URL?>/3rdparty/jquery/jquery-1.7.1.min.js"></html.js>
		<html.js src="<?php echo BASE_URL?>/3rdparty/bootstrap/js/bootstrap.min.js"></html.js>
		<html.js src="<?php echo BASE_URL?>/js/components.js"></html.js>
		<html.css src="<?php echo BASE_URL?>/3rdparty/bootstrap/css/bootstrap.min.css" />
		<html.js src="<?php echo BASE_URL?>/xcss" />
		<html.css src="<?php echo BASE_URL?>/xcss/output/phongthuy.css" />
	</html.head>
	<html.body id="center">
		<div class="container">
			<div class="row" id="header">
				<div layout="header"/>
			</div>
			<div class="row" id="headerbar">
				<div layout="headerbar">
					<div layout="loginbar" />
					<div layout="adbar" />
				</div>
			</div>
			<div class="row" id="staticbar">
				<div layout="staticbar" />
			</div>
			<div class="row">
				<div class="col-sm-2 col-md-2 col-lg-2" id="left">
					<div layout="menu"></div>
				</div>
				<div class="col-sm-8 col-md-8 col-lg-8 main-content">
					<div class="row" id="content">
					</div>
				</div>
				<div class="col-sm-2 col-md-2 col-lg-2" id="sidebar">
					<div layout="sidebar"></div>
				</div>
			</div>
			<div class="row">
					<div class="col-md-12" id="footer">
						<div layout="footer">
						</div>
					</div>
			</div>
		</div>
	</html.body>
</page>