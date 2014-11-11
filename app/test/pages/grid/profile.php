<div id="right">
	<tree.treeGrid id="dg" title="Profile Management" table="profile" width="500px" height="450px" treeField="username">
		<dg.dataGridItem field="id" width="20">Id</dg.dataGridItem>
		<dg.dataGridItem field="username" width="150">Username</dg.dataGridItem>
		<dg.dataGridItem field="type" width="40">Type</dg.dataGridItem>
		<dg.dataGridItem field="subType" width="40">Sub Type</dg.dataGridItem>
		<layout.toolbar id="dg_toolbar">
			<layout.toolbarItem action="$dg.add()" icon="add" />
			<layout.toolbarItem action="$dg.edit()" icon="edit" />
			<layout.toolbarItem action="$dg.del()" icon="remove" />
		</layout.toolbar>
		<wdw.dialog gridId="dg" width="700px" height="auto" title="Profile Management">
			<frm.form gridId="dg">
				<frm.formItem type="hidden" name="id" required="false" label="" />
				<frm.formItem name="type" required="true" label="Type" />
				<frm.formItem name="subType" required="true" label="Sub Type" />
				<frm.formItem name="fullName" required="true" label="Full Name" />
				<frm.formItem name="username" required="true" label="Username" />
				<frm.formItem name="password" required="true" label="Password" />
				<frm.formItem name="parentId" type="user-defined" required="true" label="Parent Id">
					<form.combobox id="cmbDirectory" name="parentId"
						sql="select id as value, 
							username as label from `profile` order by parentId ASC"
				layout="category-select-list"></form.combobox>
				</frm.formItem>
			</frm.form>
		</wdw.dialog>
	</tree.treeGrid>
</div>