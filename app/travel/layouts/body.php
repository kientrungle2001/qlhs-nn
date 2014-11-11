<link href="{turl styles.css}" rel="stylesheet" />
<div class="container">
	<div class="row">
			<div class="col-md-12">
				{children [id=header]}
				{children [id=menu]}
			</div>
	</div>
	<div class="row">
			
			<div class="col-md-2 col-lg-3">
				{children [id=searchbox]}
				{children [id=vietnamcategory]}
				{children [id=foreigncategory]}
			</div>
			<div class="col-md-10 col-lg-6 main-content">
				<div class="row">
					{children [id=slider]}
					{children [id=breakcrums]}
					{children [id=vietnameseTours]}
					{children [id=foreignTours]}
					{children [id=contact]}
					{children [id=detail]}
					<div class="col-sm-12">
						{children [id=feature]}
						{children [id=type]}
						{children [id=service]}
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				{children [id=support]}
				{children [id=vietnamfavorite]}
				{children [id=foreignfavorite]}
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
	{children [id=guide]}
	{children [id=links]}
	{children [id=footer]}
</div>
