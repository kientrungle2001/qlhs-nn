<dg.dataGrid id="dg" title="Quản lý phòng học" table="room" width="800px" height="450px">
	<dg.dataGridItem field="id" width="80">Id</dg.dataGridItem>
	<dg.dataGridItem field="name" width="120">Tên phòng</dg.dataGridItem>
	<dg.dataGridItem field="size" width="80">Cỡ</dg.dataGridItem>
	
	<layout.toolbar id="dg_toolbar">
		<layout.toolbarItem action="$dg.add()" icon="add" />
		<layout.toolbarItem action="$dg.edit()" icon="edit" />
		<layout.toolbarItem action="$dg.del()" icon="remove" />
	</layout.toolbar>
	<wdw.dialog gridId="dg" width="700px" height="auto" title="Phòng học">
		<frm.form gridId="dg">
			<frm.formItem type="hidden" name="id" required="false" label="" />
			<frm.formItem name="name" required="true" validatebox="true" label="Tên phòng" />
			<frm.formItem name="size" required="false" label="Cỡ" />
		</frm.form>
	</wdw.dialog>
</dg.dataGrid>