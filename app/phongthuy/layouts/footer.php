<?php $items = _db()->useCache(900)->useCB()->select('*')->from('catalog_category')->where(array('and', array('parentId', 0), array('status', 1)))->orderBy('ordering asc')->result();?>
<div class="row">
<div class="col-md-2">
</div>
<div class="col-md-8">
<div class="row">
{each $items as $item}
	<div class="col-xs-6 col-sm-4 col-md-4 col-lg-3">
	<a href="/{item[alias]}" style="padding: 5px; display: block;">
	{? 
	$title = strip_tags($item['title']); 
	$replacements = array(
		'Bài Viết về Phong Thủy' => 'Bài Viết...',
		'Gửi Câu Hỏi về Phong Thủy' => 'Gửi Câu Hỏi',
		'Thiết kế Phong Thủy Các loại Công Trình' => 'Các Công Trình PT',
		'Xem Phong Thủy Cho Các Công Trình' => 'Địa Điểm Xem PT',
		'Trung Tâm Nghiên Cứu Tiềm Năng Con Người' => 'Trung Tâm NCTNCN',
		'Xem Phong Thủy Lấy Mệnh Theo Năm' => 'Mệnh Theo Năm',
		'Xem Kim Lâu Xem Hoang Ốc' => 'Xem KimLâu-HoangỐc',
		'Xem Tháng Cưới' => 'Xem Tháng Cưới'
	);
	foreach($replacements as $search => $replace) {
		$title = str_replace($search, $replace, $title);
	}
	?}
	{? echo $title; ?}</a>
	</div>
{/each}
</div>
<div class="copyright">
Hoàng Trà giữ bản quyền nội dung trên website này
</div>
<table class="footer-contact">
<!--tr>
<td>THÔNG TIN LIÊN HỆ :</td><td> 		 &nbsp;Công Ty CP Kiến Trúc Sư Phong Thủy Hoàng Trà			</td>
</tr-->
<!--tr>
<td>Giám Đốc :</td><td> 		 &nbsp;Hoàng Trà			</td>
</tr-->
<!--tr>
<td>Website :</td><td> 		 &nbsp;PhongThuyHoangTra.vn			</td>
</tr-->
<!--tr>
<td>Địa Chỉ :</td><td> 		 &nbsp;Số 6/115 Nguyễn Khang - Cầu Giấy - Hà Nội			</td>
</tr>
<tr>
<td>Email :</td><td> 		 &nbsp;PhongThuyHoangTra.vn			</td>
</tr>
<tr>
<td>Điện Thoại :</td><td> 		 &nbsp;0916 299611			</td>
</tr-->
<!--tr>
<td>Tài Khoản :</td><td> 		 &nbsp;1400205057948 tại Ngân Hàng Nông Nghiệp và PTNT - Chi Nhánh Láng Hạ			</td>
</tr-->
</table>
</div>
<div class="col-md-2">
</div>
</div>