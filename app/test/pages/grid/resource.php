<div id="right">
	<dg.dataGrid id="dg" title="Resource Management" table="resource" width="500px" height="450px">
		<dg.dataGridItem field="id" width="20">Id</dg.dataGridItem>
		<dg.dataGridItem field="type" width="40">Type</dg.dataGridItem>
		<dg.dataGridItem field="subType" width="40">Sub Type</dg.dataGridItem>
		<dg.dataGridItem field="title" width="150">Title</dg.dataGridItem>
		<layout.toolbar id="dg_toolbar">
			<layout.toolbarItem action="$dg.add()" icon="add" />
			<layout.toolbarItem action="$dg.edit()" icon="edit" />
			<layout.toolbarItem action="$dg.del()" icon="remove" />
		</layout.toolbar>
		<wdw.dialog gridId="dg" width="700px" height="auto" title="Region">
			<frm.form gridId="dg">
				<frm.formItem type="hidden" name="id" required="false" label="" />
				<frm.formItem name="title" required="true" label="Title" />
				<frm.formItem name="type" required="false" label="Type" />
				<frm.formItem name="subType" required="true" label="Sub Type" />
				<frm.formItem name="directoryId" type="user-defined" required="false" label="Directory">
					<form.combobox id="cmbDirectoryId" name="directoryId"
						sql="select id as value, 
							title as label from `directory` order by parentId ASC"
				layout="category-select-list"></form.combobox>
				</frm.formItem>
				<frm.formItem name="params" type="user-defined" required="false" label="Params">
					<form.textarea name="params" width="600px" height="100px"></form.textarea>
				</frm.formItem>
			</frm.form>
		</wdw.dialog>
	</dg.dataGrid>
</div>