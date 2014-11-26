<link href="<?php echo pzk_element("page")->getTemplatePath("styles.css"); ?>" rel="stylesheet" />
<div class="container">
	<div class="row">
			<div class="col-md-12">
				<?php $data->displayChildren('[id=header]');?>
				<?php $data->displayChildren('[id=menu]');?>
			</div>
	</div>
	<div class="row">
			
			<div class="col-md-2 col-lg-3">
				<?php $data->displayChildren('[id=searchbox]');?>
				<?php $data->displayChildren('[id=vietnamcategory]');?>
				<?php $data->displayChildren('[id=foreigncategory]');?>
			</div>
			<div class="col-md-10 col-lg-6 main-content">
				<div class="row">
					<?php $data->displayChildren('[id=slider]');?>
					<?php $data->displayChildren('[id=breakcrums]');?>
					<?php $data->displayChildren('[id=vietnameseTours]');?>
					<?php $data->displayChildren('[id=foreignTours]');?>
					<?php $data->displayChildren('[id=contact]');?>
					<?php $data->displayChildren('[id=detail]');?>
					<div class="col-sm-12">
						<?php $data->displayChildren('[id=feature]');?>
						<?php $data->displayChildren('[id=type]');?>
						<?php $data->displayChildren('[id=service]');?>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<?php $data->displayChildren('[id=support]');?>
				<?php $data->displayChildren('[id=vietnamfavorite]');?>
				<?php $data->displayChildren('[id=foreignfavorite]');?>
			</div>
	</div>
	<!--div class="row my-box">
			<div class="col-sm-2"><a href="#">Du lịch Nha Trang</a></div>
			<div class="col-sm-2"><a href="#">Du lịch Nha Trang</a></div>
			<div class="col-sm-2"><a href="#">Du lịch Nha Trang</a></div>
			<div class="col-sm-2"><a href="#">Du lịch Nha Trang</a></div>
			<div class="col-sm-2"><a href="#">Du lịch Nha Trang</a></div>
			<div class="col-sm-2"><a href="#">Du lịch Nha Trang</a></div>
			<div class="col-sm-2"><a href="#">Du lịch Nha Trang</a></div>
			<div class="col-sm-2"><a href="#">Du lịch Nha Trang</a></div>
			<div class="col-sm-2"><a href="#">Du lịch Nha Trang</a></div>
			<div class="col-sm-2"><a href="#">Du lịch Nha Trang</a></div>
			<div class="col-sm-2"><a href="#">Du lịch Nha Trang</a></div>
			<div class="col-sm-2"><a href="#">Du lịch Nha Trang</a></div>
	</div-->
	<?php $data->displayChildren('[id=guide]');?>
	<?php $data->displayChildren('[id=links]');?>
	<?php $data->displayChildren('[id=footer]');?>
</div>
