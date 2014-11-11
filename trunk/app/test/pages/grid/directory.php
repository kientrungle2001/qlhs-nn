<div id="right">
	<tree.treeGrid id="dg" title="Directory Management" table="directory" width="500px" height="450px" treeField="title">
		<dg.dataGridItem field="id" width="20">Id</dg.dataGridItem>
		<dg.dataGridItem field="title" width="150">Title</dg.dataGridItem>
		<dg.dataGridItem field="type" width="40">Type</dg.dataGridItem>
		<dg.dataGridItem field="subType" width="40">Sub Type</dg.dataGridItem>
		<layout.toolbar id="dg_toolbar">
			<layout.toolbarItem action="$dg.add()" icon="add" />
			<layout.toolbarItem action="$dg.edit()" icon="edit" />
			<layout.toolbarItem action="$dg.del()" icon="remove" />
		</layout.toolbar>
		<wdw.dialog gridId="dg" width="700px" height="auto" title="Directory Management">
			<frm.form gridId="dg">
				<frm.formItem type="hidden" name="id" required="false" label="" />
				<frm.formItem name="title" required="true" label="Title" />
				<frm.formItem name="type" required="true" label="Type" />
				<frm.formItem name="subType" required="true" label="Sub Type" />
				<frm.formItem name="parentId" type="user-defined" required="true" label="Parent Id">
					<form.combobox id="cmbDirectory" name="parentId"
						sql="select id as value, 
							title as label from `directory` order by parentId ASC"
				layout="category-select-list"></form.combobox>
				</frm.formItem>
			</frm.form>
		</wdw.dialog>
	</tree.treeGrid>
</div>