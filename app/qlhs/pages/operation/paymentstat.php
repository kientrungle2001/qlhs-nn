<edu.paymentstat>
	<wdw.dialog gridId="order" width="700px" height="auto" title="Hóa đơn">
		<frm.form gridId="order"> 
			<frm.formItem type="hidden" name="id" required="false" label="" />
			<frm.formItem type="user-defined" name="classId" required="true" validatebox="true" label="Lớp">
				<form.combobox name="classId"
						sql="select id as value, 
								name as label from `classes` where 1 order by name ASC"
							layout="category-select-list"></form.combobox>
			</frm.formItem>
			<frm.formItem type="user-defined" name="studentId" required="true" validatebox="true" label="Học sinh">
				<form.combobox name="studentId"
						sql="select id as value, 
								name as label from `student` where 1 order by name ASC"
							layout="category-select-list"></form.combobox>
			</frm.formItem>
			<frm.formItem type="user-defined" name="payment_periodId" required="true" validatebox="true" label="Kỳ thanh toán">
				<form.combobox name="payment_periodId"
						sql="select id as value, 
								name as label from `payment_period` where 1 order by name ASC"
							layout="category-select-list"></form.combobox>
			</frm.formItem>
			<frm.formItem type="text" name="amount" required="false" label="Số tiền" />
		</frm.form>
	</wdw.dialog>
</edu.paymentstat>