<div id="right">
	<tree.treeGrid id="dg" title="Profile Resource Management" table="profile_resource" width="500px" height="450px" treeField="title">
		<dg.dataGridItem field="id" width="20">Id</dg.dataGridItem>
		<dg.dataGridItem field="title" width="40">Title</dg.dataGridItem>
		<dg.dataGridItem field="type" width="40">Type</dg.dataGridItem>
		<dg.dataGridItem field="subType" width="40">Sub Type</dg.dataGridItem>
		<dg.dataGridItem field="profileId" width="40">Profile Id</dg.dataGridItem>
		<dg.dataGridItem field="resourceId" width="40">Resource Id</dg.dataGridItem>
		<dg.dataGridItem field="parentId" width="40">Parent Id</dg.dataGridItem>
		<layout.toolbar id="dg_toolbar">
			<layout.toolbarItem action="$dg.add()" icon="add" />
			<layout.toolbarItem action="$dg.edit()" icon="edit" />
			<layout.toolbarItem action="$dg.del()" icon="remove" />
		</layout.toolbar>
		<wdw.dialog gridId="dg" width="700px" height="auto" title="Region">
			<frm.form gridId="dg">
				<frm.formItem type="hidden" name="id" required="false" label="" />
				<frm.formItem name="title" required="false" label="Title" />
				<frm.formItem name="type" required="false" label="Type" />
				<frm.formItem name="subType" required="true" label="Sub Type" />
				<frm.formItem name="parentId" type="user-defined" required="false" label="Parent">
					<form.combobox id="cmbParenId" name="parentId"
						sql="select id as value, 
							title as label from `profile_resource` order by parentId ASC"
				layout="category-select-list" />
				</frm.formItem>
				<frm.formItem name="profileId" type="user-defined" required="false" label="Profile">
					<form.combobox id="cmbProfileId" name="profileId"
						sql="select id as value, 
							username as label from `profile` order by parentId ASC"
				layout="category-select-list" />
				</frm.formItem>
				<frm.formItem name="resourceId" type="user-defined" required="false" label="Resource">
					<form.combobox id="cmbResourceId" name="resourceId"
						sql="select id as value, 
							title as label from `resource` order by id ASC"
				layout="category-select-list" />
				</frm.formItem>
				<frm.formItem name="params" type="user-defined" required="false" label="Params">
					<form.textarea name="params" width="600px" height="100px"></form.textarea>
				</frm.formItem>
			</frm.form>
		</wdw.dialog>
	</tree.treeGrid>
</div>