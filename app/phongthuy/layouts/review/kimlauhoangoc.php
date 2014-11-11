<h2>Xem kim lâu hoang ốc</h2>
<form>
<table>
	<tr>
		<td>
			<table>
				<tr>
					<td>Năm sinh</td>
					<td><input type="text" name="yob" style="width: 71px;" value="{_REQUEST[yob]}" /></td>
				</tr>
				<tr>
					<td>Năm cần xem</td>
					<td><input type="text" name="yon" style="width: 71px;" value="{_REQUEST[yon]}" /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input type="submit" value="Xem ngay" /></td>
				</tr>
			</table>
		</td>
		<td>
			<?php 
			$request = pzk_element('request');
			$yob = $request->get('yob');
			if($yob) {
				$total = 4;
				for($i = 0; $i < 4; $i++) {
					$n = $yob[$i];
					$total += $n;
				}
				$yon = $request->get('yon');
				$tuoiam = $yon + 1 - $yob;
				$sodu9 = $tuoiam % 9;
				$sodu6 = $tuoiam % 6;
				$kimlau = false;
				$hoangoc = false;
				if(in_array($sodu9, array(1, 3, 6, 8))) {
					$kimlau = 'true';
				}
				if(in_array($sodu6, array(3, 5, 0))) {
					$hoangoc = 'true';
				}
				?>
			<table>
				<tr>
					<td>Tuổi:</td>
					<td>{tuoiam}</td>
				</tr>
				<tr>
					<td>Kim lâu:</td>
					<td>{ifvar kimlau=true}Phạm{else}Không phạm{/if}</td>
				</tr>
				<tr>
					<td>Hoang ốc:</td>
					<td>{ifvar hoangoc=true}Phạm{else}Không phạm{/if}</td>
				</tr>
			</table>
			<?php 
			}?>
			
		</td>
	</tr>
</table>
</form>
{children all}