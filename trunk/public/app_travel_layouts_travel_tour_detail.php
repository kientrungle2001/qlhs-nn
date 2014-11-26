<?php $tour = $data->getTour(); ?>
<div class="feature-tour-list my-box">
	<div class="row">
	<div class="col-sm-12">
		<div class="tour-box">
			<strong><a href="<?php echo BASE_REQUEST . '/tour'; ?>/detail/<?php echo @$tour['id'];?>"><?php echo @$tour['title'];?></a></strong>
			<div class="row">
				<div class="col-sm-12">
					<div class="tour-image">
						<img src="<?php echo pzk_element("page")->getTemplatePath("images/t1.jpg"); ?>" style="width: 100%" />
					</div>
					<div class="tour-description">
						Giá: 3.000.000đ<br />
						Thời gian: 4 ngày 3 đêm<br />
						Phương tiện: Ô tô<br />
						Khách sạn: 2-3 sao<br />
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		<ul id="tourDetail" class="nav nav-tabs" role="tablist">
		  <li class="active"><a href="#program">Chương trình tour</a></li>
		  <li><a href="#guide">Thông tin hướng dẫn</a></li>
		  <li><a href="#price">Giá tour</a></li>
		  <li><a href="#contact">Đặt tour</a></li>
		</ul>
		<div id="tourDetailContent" class="tab-content">
		  <div class="tab-pane fade active in" id="program">
			<div class="row">
				<div class="col-sm-12"><?php echo @$tour['content'];?></div>
			</div>
		  </div>
		  <div class="tab-pane fade" id="guide">
			<div class="row">
				<div class="col-sm-12"><?php echo @$tour['guide'];?></div>
			</div>
		  </div>
		  <div class="tab-pane fade" id="price">
			<div class="row">
				<div class="col-sm-12"><?php echo @$tour['pricetable'];?></div>
			</div>
		  </div>
		  <div class="tab-pane fade" id="contact">
			<div class="row">
				<div class="col-sm-12">
			<div id="formcontact">
				Công ty cổ phần truyền thông Việt Thái Bình<br />
	Các văn phòng chính: <br /><br />
	Hà Nội: <br />
	Địa chỉ: số 12 Trần Khát Chân, Hai Bà Trưng, Hà Nội<br />
	Điện thoại: +84 912 231 456<br />
	Hồ Chí Minh: <br />
	Địa chỉ: số 12 Trần Khát Chân, Hai Bà Trưng, Hà Nội<br />
	Điện thoại: +84 912 231 456<br />
	<hr style="width: 50%; text-align: center;" />
	Thông tin của bạn<br />
	<table>
		<tr>
			<td>Họ và tên(*): </td><td><input name="fullName" /></td>
		</tr>
		<tr>
			<td>Địa chỉ(*): </td><td><input name="address" /></td>
		</tr>
		<tr>
			<td>Số điện thoại(*): </td><td><input name="phone" /></td>
		</tr>
		<tr>
			<td>Email(*): </td><td><input name="email" /></td>
		</tr>
	</table>
	<hr style="width: 50%; text-align: center;" />
	Thông tin booking<br />
	<table>
		<tr>
			<td>Ngày khởi hành(*): </td><td><input name="departureDate" /></td>
		</tr>
		<tr>
			<td>Số người lớn(*): </td><td><input name="adults" /></td>
		</tr>
		<tr>
			<td>Số trẻ em (4-11 tuổi): </td><td><input name="children" /></td>
		</tr>
		<tr>
			<td>Số trẻ em (dưới 4 tuổi): </td><td><input name="smallchildren" /></td>
		</tr>
		<tr>
			<td>Khách sạn: </td><td><input name="hotel" /></td>
		</tr>
		<tr>
			<td>Phương thức thanh toán: </td><td>
				<select type="payment_method">
					<option value="checkmo">Tiền mặt</option>
					<option value="banktransfer">Chuyển khoản</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Yêu cầu khác: </td><td><textarea name="request"></textarea></td>
		</tr>
		<tr>
			<td>&nbsp;</td><td><button class="btn btn-primary">Gửi</button></td>
		</tr>
	</table>
			</div>
				</div>
			</div>
		  </div>
		</div>
		<script type="text/javascript">
		$('#tourDetail a').click(function (e) {
		  e.preventDefault()
		  $(this).tab('show')
		});
		</script>
	</div>
	</div>
</div>