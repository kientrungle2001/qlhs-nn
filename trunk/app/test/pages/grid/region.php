<div id="right">
	<dg.dataGrid id="dg" title="Region Management" table="region" width="500px" height="450px">
		<dg.dataGridItem field="id" width="20">Id</dg.dataGridItem>
		<dg.dataGridItem field="page" width="60">Page</dg.dataGridItem>
		<dg.dataGridItem field="region" width="40">Region</dg.dataGridItem>
		<dg.dataGridItem field="type" width="40">Type</dg.dataGridItem>
		<dg.dataGridItem field="ordering" width="40">Ordering</dg.dataGridItem>
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
				<frm.formItem name="ordering" required="true" label="Ordering" />
				<frm.formItem name="type" type="user-defined" required="false" label="Type">
					<select name="type">
						<option value="raw">Raw</option>
						<option value="object">Object</option>
					</select>
				</frm.formItem>
				<frm.formItem name="page" type="user-defined" required="false" label="Page">
					<select name="page">
						<option value="">Empty</option>
						<option value="home">Home</option>
						<option value="home.index">Index</option>
						<option value="home.register">Register</option>
						<option value="home.product">Product</option>
						<option value="home.service">Service</option>
						<option value="home.history">History</option>
						<option value="home.contact">Contact</option>
						<option value="home.directory">Directory</option>
					</select>
				</frm.formItem>
				<frm.formItem name="region" type="user-defined" required="false" label="Region">
					<select name="region">
						<option value="menu">Menu</option>
						<option value="right">Right</option>
						<option value="keywords">Keywords</option>
						<option value="description">Description</option>
					</select>
				</frm.formItem>
				<frm.formItem name="style" type="user-defined" required="false" label="Style">
					<form.textarea name="style" width="600px" height="100px"></form.textarea>
				</frm.formItem>
				<frm.formItem name="code" type="user-defined" required="false" label="Code">
					<form.textarea name="code" width="600px" height="100px"></form.textarea>
				</frm.formItem>
				<frm.formItem name="layout" required="false" label="Layout" />
			</frm.form>
		</wdw.dialog>
	</dg.dataGrid>
</div>