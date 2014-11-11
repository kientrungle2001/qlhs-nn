<div class="row">
<?php 
$request = pzk_request();
$xemthiencan = $request->get('xemthiencan');
$xemdiachi = $request->get('xemdiachi');
?>
<form id="diachi">
<input type="hidden" name="xemdiachi" value="1" />
<table class="table borderless table-centered">
	<tr>
		<th colspan="2">XEM ĐỊA CHI</th>
	</tr>
	<tr>
		<th>Nam</th>
		<th>Nữ</th>
	</tr>
	<tr>
		<td>
			<?php $yearModel = $data->getModel('year');
				$diachi = $yearModel->diachi();
			?>
			<select name="maleAge" class="form-control">
			{? foreach ($diachi as $index => $dc): ?}
				<option value="{index}">{dc}</option>
			{/each}
			</select>
		</td>
		<td>
			<select name="femaleAge" class="form-control">
			{? foreach ($diachi as $index => $dc): ?}
				<option value="{index}">{dc}</option>
			{/each}
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
if($xemdiachi) {
	$row = $yearModel->xemdiachi($request->get('maleAge'), $request->get('femaleAge'));
	if($row) {
		$kq = $yearModel->ketQuaDiaChi();
		$ketqua = $kq[$row['ketqua']];
	} else {
		$ketqua = 'Bình thường';
	}
	?>
<script type="text/javascript">
	$('#diachi select[name=maleAge]').val('{_REQUEST[maleAge]}');
	$('#diachi select[name=femaleAge]').val('{_REQUEST[femaleAge]}');
</script>
<h2>Kết Quả Xem Địa Chi: {ketqua}</h2>
<hr />
<?php
}
?>
<form id="thiencan">
<input type="hidden" name="xemthiencan" value="1" />
<table class="table borderless table-centered">
	<tr>
		<th colspan="2">XEM THIÊN CAN</th>
	</tr>
	<tr>
		<th>Nam</th>
		<th>Nữ</th>
	</tr>
	<tr>
		<td>
			<?php $yearModel = $data->getModel('year');
				$diachi = $yearModel->thiencan();
			?>
			<select name="maleAge" class="form-control">
			{? foreach ($diachi as $index => $dc): ?}
				<option value="{index}">{dc}</option>
			{/each}
			</select>
		</td>
		<td>
			<select name="femaleAge" class="form-control">
			{? foreach ($diachi as $index => $dc): ?}
				<option value="{index}">{dc}</option>
			{/each}
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
if($xemthiencan) {
	$row = $yearModel->xemthiencan($request->get('maleAge'), $request->get('femaleAge'));
	if($row) {
		$kq = $yearModel->ketQuaKetHon();
		$ketqua = $kq[$row['ketqua']];
	} else {
		$ketqua = 'Bình thường';
	}
	?>
<script type="text/javascript">
	$('#thiencan select[name=maleAge]').val('{_REQUEST[maleAge]}');
	$('#thiencan select[name=femaleAge]').val('{_REQUEST[femaleAge]}');
</script>
<h2>Kết Quả Xem Thiên Can: {ketqua}</h2>
<hr />
<?php
}?>
</div>