<div>
	<frm.form gridId="dg" action="<?php echo BASE_REQUEST . '/order/reportPost'; ?>">
		<frm.formItem type="date" name="startDate" required="false" label="Ngày bắt đầu">
			</frm.formItem>
		<frm.formItem type="date" name="endDate" required="false" label="Ngày kết thúc">
			</frm.formItem>
		<frm.formItem type="user-defined" name="send" required="false" label="">
			<input type="submit" value="Xem báo cáo" />
		</frm.formItem>
	</frm.form>
</div>