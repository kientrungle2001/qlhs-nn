<div class="row">
<form id="thangcuoi">
<input type="hidden" name="xemthangcuoi" value="1" />
<table class="table borderless table-centered">
	<tr>
		<th colspan="2">XEM THÁNG CƯỚI</th>
	</tr>
	<tr>
		<th>Tuổi Nữ</th>
		<th>Tháng Cưới (Âm Lịch)</th>
	</tr>
	<tr>
		<td style="width:50%">
			<?php $yearModel = $data->getModel('year');
				$diachi = $yearModel->diachi();
			?>
			<select name="femaleAge" class="form-control">
			{? foreach ($diachi as $index => $dc): ?}
				<option value="{index}">{dc}</option>
			{/each}
			</select>
		</td>
		<td style="width:50%">
			<select name="month" class="form-control">
				<?php for($i = 1; $i <= 12; $i++) { ?>
				<option value="{i}">{i}</option>
				<?php } ?>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="2" class="submit-button">
			<input type="submit" value="Kết Quả" class="form-control btn btn-default" />
		</td>
	</tr>
</table>
</form>
<hr />
<?php
$request = pzk_request();
$xemthangcuoi = $request->get('xemthangcuoi');
if($xemthangcuoi) {
	$row = $yearModel->xemthangcuoi($request->get('femaleAge'), $request->get('month'));
	if($row) {
		$kq = $yearModel->ketQuaThangCuoi();
		$ketqua = $kq[$row['ketqua']];
	} else {
		$ketqua = 'Bình thường';
	}
	?>
<script type="text/javascript">
	$('#thangcuoi select[name=femaleAge]').val('{_REQUEST[femaleAge]}');
	$('#thangcuoi select[name=month]').val('{_REQUEST[month]}');
</script>
<h2>Kết Quả Xem Tháng Cưới: {ketqua}</h2>
<?php
} ?>
</div>