<h2>Xem mệnh</h2>
<form>
<table>
	<tr>
		<td>Năm sinh</td>
		<td><input type="text" name="yob" value="{_REQUEST[yob]}" /></td>
	</tr>
	<tr>
		<td>Giới tính</td>
		<td>
		<input type="radio" name="gender" value="1" /> Nam
		<input type="radio" name="gender" value="2" /> Nữ
		<script>
		setTimeout(function(){
			
			if('{_REQUEST[gender]}') {
				$('input[name=gender][value={_REQUEST[gender]}]').attr('checked', 'checked');
			} else {
				$('input[name=gender][value=1]').attr('checked', 'checked');
			}
		}, 100);
		</script>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" value="Xem mệnh" /></td>
	</tr>
</table>
</form>
<?php 
$request = pzk_element('request');
$yob = $request->get('yob');
if($yob) {
$item = _db()->useCB()->select('*')->from('review_menh')->where(array('yob', $yob))->result_one();
if($item) { ?>
<p>
	Năm {yob}: {item[title]}
</p>
<?php
}
$total = 4;
for($i = 0; $i < 4; $i++) {
	$n = $yob[$i];
	$total += $n;
}
$sodu = $total % 9;
$gender = $request->get('gender');
// nam
if($gender == '1') {
	if($sodu < 6) {
		$sodu = 6 - $sodu;
	} else {
		$sodu = 15 - $sodu;
	}
	if($sodu == 5) {
		$sodu = 2;
	}
} else {
	if ($sodu == 5) {
		$sodu = 8;
	}
}
if($sodu == 0) {
	$sodu = 9;
}
$bieudo = _db()->useCB()->select('*')->from('review_bieudo')->where(array('sodu', $sodu))->result_one();
if ($bieudo) { ?>
<h2>Trạch Mệnh</h2>
{bieudo[brief]}
<?php
}
$namhientai = date('Y', time());
$tuoiam = $namhientai + 1 - $yob;
$sodu9 = $tuoiam % 9;
$sodu6 = $tuoiam % 6;
?>
<!--
Tuổi: {tuoiam} - Số dư mệnh: {sodu} - Số dư tuổi kim lâu: {sodu9} - Số dư hoang ốc: {sodu6}<br />
-->
<?php 
}
?>
{children all}