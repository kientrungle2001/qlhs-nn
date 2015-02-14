    <div style="padding:5px;border:1px solid #ddd">
	<!--
        {ifpermission student/search}<a href="{url /student/search}" class="easyui-linkbutton" data-options="plain:true">Tìm kiếm</a>{/if}
	-->
		{ifpermission demo/paymentstat}<a href="{url /demo/paymentstat}" class="easyui-linkbutton" data-options="plain:true">Bảng thanh toán</a>{/if}
		{ifpermission demo/muster}<a href="{url /demo/muster}" class="easyui-linkbutton" data-options="plain:true">Điểm danh</a>{/if}
		{ifpermission student/order}<a href="{url /student/order}" class="easyui-linkbutton" data-options="plain:true">Hóa đơn</a>{/if}
		{ifpermission order/report}<a href="{url /order/report}" class="easyui-linkbutton" data-options="plain:true">Báo cáo Hóa đơn</a>{/if}
		{ifpermission student/index}<a href="{url /student}" class="easyui-linkbutton" data-options="plain:true">Học sinh</a>{/if}
		{ifpermission course/student}<a href="{url /course/student}" class="easyui-linkbutton" data-options="plain:true">Xếp lớp</a>{/if}
		{ifpermission course/index}
		<a href="{url /course}" class="easyui-linkbutton" data-options="plain:true">Lớp học</a>
		{/if}
		{ifpermission course/schedule}
		<a href="{url /course/schedule}" class="easyui-linkbutton" data-options="plain:true">Lịch học</a>
		{/if}
		<a href="#" class="easyui-menubutton" data-options="plain:true,menu:'#qltrt'">Quản lý trung tâm</a>
		{ifpermission order/createbill}<a href="{url /order/createbill}" class="easyui-linkbutton" data-options="plain:true">Tạo HĐC 1</a>{/if}
		{ifpermission order/createbill2}<a href="{url /order/createbill2}" class="easyui-linkbutton" data-options="plain:true">Tạo HĐC 2</a>{/if}
		{ifpermission order/billing}<a href="{url /order/billing}" class="easyui-linkbutton" data-options="plain:true">Hóa đơn chi</a>{/if}
		{ifpermission demo/report}<a href="{url /demo/report}" class="easyui-linkbutton" data-options="plain:true">Báo cáo</a>{/if}
		{ifpermission profile/index}<a href="{url /profile}" class="easyui-linkbutton" data-options="plain:true">Người dùng</a>{/if}
		{ifpermission profile/type}<a href="{url /profile/type}" class="easyui-linkbutton" data-options="plain:true">Quyền hạn</a>{/if}
		{ifpermission profile/grant}<a href="{url /profile/grant}" class="easyui-linkbutton" data-options="plain:true">Phân quyền</a>{/if}
		{ifpermission demo/logout}<a href="{url /demo/logout}" class="easyui-linkbutton" data-options="plain:true">Đăng xuất</a>{/if}
	</div>
	<div id="qltrt" style="width:100px;">
		{ifpermission course/index}
		<div>
			<a href="{url /course}" class="easyui-linkbutton" data-options="plain:true">Khóa học</a>
		</div>
		{/if}
		{ifpermission course/schedule}
		<div>
			<a href="{url /course/schedule}" class="easyui-linkbutton" data-options="plain:true">Lịch học</a>
		</div>
		{/if}
		{ifpermission offschedule/index}
		<div>
			<a href="{url /offschedule}" class="easyui-linkbutton" data-options="plain:true">Lịch nghỉ</a>
		</div>
		{/if}
		{ifpermission teacher/index}
		<div>
			<a href="{url /teacher}" class="easyui-linkbutton" data-options="plain:true">Giáo viên</a><br />
		</div>
		{/if}
		<!--
		<div>
			<a href="{url /demo/teaching}" class="easyui-linkbutton" data-options="plain:true">Giảng dạy</a><br />
		</div>
		-->
		{ifpermission subject/index}
		<div>
			<a href="{url /subject}" class="easyui-linkbutton" data-options="plain:true">Môn học</a><br />
		</div>
		{/if}
		{ifpermission room/index}
		<div>
			<a href="{url /room}" class="easyui-linkbutton" data-options="plain:true">Phòng học</a><br />
		</div>
		{/if}
		{ifpermission paymentperiod/index}
		<div>
			<a href="{url /paymentperiod}" class="easyui-linkbutton" data-options="plain:true">Kỳ thanh toán</a>
		</div>
		{/if}
    </div>