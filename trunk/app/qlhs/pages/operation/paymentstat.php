<div>
	<div style="float:left; width: 220px;">
		<dg.dataGrid id="dgsubject" title="" table="subject" width="200px" height="115px" pagination="false" rownumbers="false">
			<dg.dataGridItem field="id" width="20">Id</dg.dataGridItem>
			<dg.dataGridItem field="name" width="140">Môn học</dg.dataGridItem>
			
			<layout.toolbar id="dgsubject_toolbar" style="display: none;">
				<layout.toolbarItem action="$dgsubject.detail(function(row) { jQuery('#searchSubject').val(row.id); 
					$dg.search({'fields': {'teacherId' : '#searchTeacher', 'subjectId': '#searchSubject' }});  });" icon="sum" />
				<layout.toolbarItem action="$dgsubject.detail(function(row) { jQuery('#searchSubject').val(''); 
					$dg.search({'fields': {'teacherId' : '#searchTeacher', 'subjectId': '#searchSubject' }});  });" icon="reload" />	
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
					$dg.search({'fields': {'teacherId' : '#searchTeacher', 'subjectId': '#searchSubject', 'level': '#searchLevel' }});  });" icon="sum" />
				<layout.toolbarItem action="$dglevel.detail(function(row) { jQuery('#searchLevel').val(''); 
					$dg.search({'fields': {'teacherId' : '#searchTeacher', 'subjectId': '#searchSubject', 'level': '#searchLevel' }});  });" icon="reload" />
			</layout.toolbar>
		</dg.dataGrid>
	</div>
	<div style="float:left; width: 600px;">
		<edu.paymentstat>
		</edu.paymentstat>
	</div>
	<div class="clear" />
</div>