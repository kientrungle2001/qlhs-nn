<div>
<div style="float:left; width: 220px;">
	<dg.dataGrid id="dgsubject" title="Quản lý môn học" table="subject" width="200px" height="200px" pagination="false" rownumbers="false">
		<dg.dataGridItem field="id" width="20">Id</dg.dataGridItem>
		<dg.dataGridItem field="name" width="140">Môn học</dg.dataGridItem>
		
		<layout.toolbar id="dgsubject_toolbar">
			<layout.toolbarItem action="$dgsubject.detail(function(row) { jQuery('#searchSubject').val(row.id); 
				$dg.search({'fields': {'teacherId' : '#searchTeacher', 'subjectId': '#searchSubject' }});  });" icon="sum" />
			<layout.toolbarItem action="$dgsubject.detail(function(row) { jQuery('#searchSubject').val(''); 
				$dg.search({'fields': {'teacherId' : '#searchTeacher', 'subjectId': '#searchSubject' }});  });" icon="reload" />	
			<layout.toolbarItem action="$dgsubject.add()" icon="add" />
			<layout.toolbarItem action="$dgsubject.edit()" icon="edit" />
			<layout.toolbarItem action="$dgsubject.del()" icon="remove" />
		</layout.toolbar>
		<wdw.dialog gridId="dgsubject" width="700px" height="auto" title="Môn học">
			<frm.form gridId="dgsubject">
				<frm.formItem type="hidden" name="id" required="false" label="" />
				<frm.formItem name="name" required="true" validatebox="true" label="Môn học" />
			</frm.form>
		</wdw.dialog>
	</dg.dataGrid>
	
	<dg.dataGrid id="dgteacher" title="Quản lý giáo viên" table="teacher" width="200px" height="450px" pagination="true" rownumbers="false" pageSize="50">
		<dg.dataGridItem field="id" width="20">Id</dg.dataGridItem>
		<dg.dataGridItem field="name" width="140">Tên giáo viên</dg.dataGridItem>
		<!--dg.dataGridItem field="phone" width="100">Số điện thoại</dg.dataGridItem>
		<dg.dataGridItem field="school" width="160">Trường</dg.dataGridItem>
		<dg.dataGridItem field="address" width="80">Địa chỉ</dg.dataGridItem>
		<dg.dataGridItem field="salary" width="80">Lương</dg.dataGridItem-->
		
		<layout.toolbar id="dgteacher_toolbar">
			<layout.toolbarItem action="$dgteacher.detail(function(row) { jQuery('#searchTeacher').val(row.id); 
				$dg.search({'fields': {'teacherId' : '#searchTeacher', 'subjectId': '#searchSubject' }});  });" icon="sum" />
			<layout.toolbarItem action="$dgteacher.detail(function(row) { jQuery('#searchTeacher').val(''); 
				$dg.search({'fields': {'teacherId' : '#searchTeacher', 'subjectId': '#searchSubject' }});  });" icon="reload" />	
			<layout.toolbarItem action="$dgteacher.add()" icon="add" />
			<layout.toolbarItem action="$dgteacher.edit()" icon="edit" />
			<layout.toolbarItem action="$dgteacher.del()" icon="remove" />
		</layout.toolbar>
		<wdw.dialog gridId="dgteacher" width="700px" height="auto" title="Giáo viên">
			<frm.form gridId="dgteacher">
				<frm.formItem type="hidden" name="id" required="false" label="" />
				<frm.formItem name="name" required="true" validatebox="true" label="Tên giáo viên" />
				<frm.formItem name="phone" required="false" label="Số điện thoại" />
				<frm.formItem name="school" required="false" label="Trường" />
				<frm.formItem name="address" required="false" label="Địa chỉ" />
				<frm.formItem name="salary" required="false" label="Lương" />
			</frm.form>
		</wdw.dialog>
	</dg.dataGrid>
</div>
<div style="float:left; width: 500px;">
<dg.dataGrid id="dg" title="Quản lý lớp học" scriptable="true" table="classes" width="500px" height="500px" rownumbers="false" pageSize="50">
	<dg.dataGridItem field="id" width="40">Id</dg.dataGridItem>
	<dg.dataGridItem field="name" width="120">Tên lớp</dg.dataGridItem>
	<dg.dataGridItem field="subjectName" width="120">Môn học</dg.dataGridItem>
	<!--dg.dataGridItem field="level" width="120">Trình độ</dg.dataGridItem-->
	<dg.dataGridItem field="teacherName" width="120">Giáo viên</dg.dataGridItem>
	<!--dg.dataGridItem field="teacher2Name" width="120">Giáo viên 2</dg.dataGridItem-->
	<!--dg.dataGridItem field="roomName" width="100">Phòng</dg.dataGridItem-->
	<dg.dataGridItem field="startDate" width="160">Ngày bắt đầu</dg.dataGridItem>
	<dg.dataGridItem field="endDate" width="160">Ngày kết thúc</dg.dataGridItem>
	<dg.dataGridItem field="amount" width="100">Học phí</dg.dataGridItem>
	<dg.dataGridItem field="status" width="40">TT</dg.dataGridItem>
	
	<layout.toolbar id="dg_toolbar">
		<hform id="dg_search">
			<form.combobox 
					id="searchTeacher" name="teacherId"
					sql="select id as value, 
							name as label from `teacher` order by name ASC"
					layout="category-select-list"></form.combobox>
			<form.combobox 
					id="searchSubject" name="subjectId"
					sql="select id as value, 
							name as label from `subject` order by name ASC"
					layout="category-select-list"></form.combobox>
			<layout.toolbarItem action="$dg.search({'fields': {'teacherId' : '#searchTeacher', 'subjectId': '#searchSubject' }})" icon="search" />
			<layout.toolbarItem action="$dg.add()" icon="add" />
			<layout.toolbarItem action="$dg.edit()" icon="edit" />
			<layout.toolbarItem action="$dg.del()" icon="remove" />
			<layout.toolbarItem action="$dg.detail(function(row) { jQuery('#searchClass2').val(row.id); $dg2.search({'fields': {'classId' : '#searchClass2' }});  });" icon="sum" />
		</hform>
	</layout.toolbar>
	<wdw.dialog gridId="dg" width="700px" height="auto" title="Lớp học">
		<frm.form gridId="dg">
			<frm.formItem type="hidden" name="id" required="false" label="" />
			<frm.formItem name="name" required="true" validatebox="true" label="Tên lớp" />
			<frm.formItem type="user-defined" name="subjectId" required="false" label="Môn học">
				<form.combobox name="subjectId"
						sql="select id as value, 
								name as label from `subject` where 1 order by name ASC"
							layout="category-select-list"></form.combobox>
			</frm.formItem>
			<frm.formItem name="level" required="true" validatebox="true" label="Trình độ" />
			<frm.formItem type="user-defined" name="teacherId" required="false" label="Giáo viên">
				<form.combobox name="teacherId"
						sql="select id as value, 
								name as label from `teacher` where 1 order by name ASC"
							layout="category-select-list"></form.combobox>
			</frm.formItem>
			<frm.formItem type="user-defined" name="teacher2Id" required="false" label="Giáo viên 2">
				<form.combobox name="teacher2Id"
						sql="select id as value, 
								name as label from `teacher` where 1 order by name ASC"
							layout="category-select-list"></form.combobox>
			</frm.formItem>
			<frm.formItem type="user-defined" name="roomId" required="false" label="Phòng">
				<form.combobox name="roomId"
						sql="select id as value, 
								name as label from `room` where 1 order by name ASC"
							layout="category-select-list"></form.combobox>
			</frm.formItem>
			<frm.formItem name="startDate" type="date" required="false" label="Ngày bắt đầu">
			</frm.formItem>
			<frm.formItem name="endDate" type="date" required="false" label="Ngày kết thúc">
			</frm.formItem>
			<frm.formItem name="amount" required="false" label="Học phí">
			</frm.formItem>
			<frm.formItem name="status" required="true" validatebox="true" label="Trạng thái" />
		</frm.form>
	</wdw.dialog>
</dg.dataGrid>
</div>
<div style="float:left; margin-left: 20px; margin-top: 20px; width: auto;">
	<div layout="form/schedule">
	
	<layout.toolbarItem action="$dg.actOnSelected({
		'url': '{url /dtable/addschedule}', 
		'gridField': 'classId', 
		'fields': {
			'startDate': 'input[name=startDate]',
			'endDate' : 'input[name=endDate]',
			'weekday' : '#weekday',
			'studyTime' : '#studyTime'
		}
	}); $dg2.reload();" icon="ok" />
	</div>
	<div>
		<dg.dataGrid id="dg2" title="Quản lý lịch học" table="schedule" 
			width="400px" height="350px" singleSelect="false" noClickRow="true"  rownumbers="false" pageSize="50">
			<dg.dataGridItem field="id" width="80">Id</dg.dataGridItem>
			<dg.dataGridItem field="className" width="120">Tên lớp</dg.dataGridItem>
			<dg.dataGridItem field="studyDate" width="160">Ngày học</dg.dataGridItem>
			<!--dg.dataGridItem field="studyTime" width="160">Giờ học</dg.dataGridItem>
			<dg.dataGridItem field="status" width="100">Trạng thái</dg.dataGridItem-->
			
			<layout.toolbar id="dg2_toolbar">
				<hform id="dg2_search">
					<form.combobox 
							id="searchClass2" name="classId"
							sql="select id as value, 
									name as label from `classes` where status=1 order by name ASC"
							layout="category-select-list"></form.combobox>
						<layout.toolbarItem action="$dg2.search({'fields': {'classId' : '#searchClass2' }})" icon="search" />
						<layout.toolbarItem action="$dg2.del()" icon="remove" />
				</hform>
			</layout.toolbar>
			
		</dg.dataGrid>
	</div>
</div>
<div class="clear" />
</div>