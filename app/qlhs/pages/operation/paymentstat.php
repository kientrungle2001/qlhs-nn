<div>
	<div style="float:left; width: 220px;">
		<dg.dataGrid id="dgsubject" title="" table="subject" width="200px" height="115px" pagination="false" rownumbers="false">
			<dg.dataGridItem field="id" width="20">Id</dg.dataGridItem>
			<dg.dataGridItem field="name" width="140">Môn học</dg.dataGridItem>
			
			<layout.toolbar id="dgsubject_toolbar" style="display: none;">
				<layout.toolbarItem action="$dgsubject.detail(function(row) { jQuery('#searchSubject').val(row.id); 
					searchClasses();  });" icon="sum" />
				<layout.toolbarItem action="$dgsubject.detail(function(row) { jQuery('#searchSubject').val(''); 
					searchClasses();  });" icon="reload" />	
				<layout.toolbarItem action="$dgsubject.add()" icon="add" />
				<layout.toolbarItem action="$dgsubject.edit()" icon="edit" />
				<layout.toolbarItem action="$dgsubject.del()" icon="remove" />
			</layout.toolbar>
		</dg.dataGrid>
		<dg.dataGrid id="dglevel" title="" table="level" width="200px" height="145px" pagination="false" rownumbers="false">
			<dg.dataGridItem field="id" width="20">Id</dg.dataGridItem>
			<dg.dataGridItem field="name" width="140">Trình độ</dg.dataGridItem>
			
			<layout.toolbar id="dglevel_toolbar" style="display: none;">
				<layout.toolbarItem action="$dglevel.detail(function(row) { jQuery('#searchLevel').val(row.id); 
					searchClasses();  });" icon="sum" />
				<layout.toolbarItem action="$dglevel.detail(function(row) { jQuery('#searchLevel').val(''); 
					searchClasses();  });" icon="reload" />
			</layout.toolbar>
		</dg.dataGrid>
		<dg.dataGrid id="dg" title="" table="classes&filters[status]=1" width="200px" height="500px" pagination="false" pageSize="50">
			<dg.dataGridItem field="id" width="40">Id</dg.dataGridItem>
			<dg.dataGridItem field="name" width="120">Tên lớp</dg.dataGridItem>
			
			<layout.toolbar id="dg_toolbar">
				<hform id="dg_search">
					<form.combobox 
							id="searchSubject" name="subjectId"
							sql="select id as value, 
									name as label from `subject` order by name ASC"
							layout="category-select-list"></form.combobox>
					<form.combobox 
							id="searchLevel" name="level"
							sql="select distinct(level) as value, level as label from classes order by label asc"
							layout="category-select-list"></form.combobox>
					<layout.toolbarItem action="searchClasses()" icon="search" />
					<layout.toolbarItem action="$dg.detail(function(row) { 
						jQuery.ajax({url: '{url /demo/paymentStatTab}?classId='+row.id, success: function(resp) {
							jQuery('#paymentstatDetail').html(resp);
							jQuery.parser.parse('#paymentstatDetail');
						}});  
					});" icon="sum" />
				</hform>
			</layout.toolbar>
		</dg.dataGrid>
		<script type="text/javascript">
			function searchClasses() {
				pzk.elements.dg.search({
					'fields': {
						'subjectId': '#searchSubject', 
						'level': '#searchLevel'
					}
				});
			}
		</script>
	</div>
	<div style="float:left; width: 600px;">
		<div id="paymentstatDetail"></div>
		<!--edu.paymentstat>
		</edu.paymentstat-->
	</div>
	<div class="clear" />
</div>