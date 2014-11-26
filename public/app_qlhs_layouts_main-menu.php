    <div style="padding:5px;border:1px solid #ddd">
	<!--
        <?php if ( @pzk_element('permission')->check('student', 'search') ) : ?><a href="<?php echo BASE_REQUEST . '/student/search'; ?>" class="easyui-linkbutton" data-options="plain:true">Tìm kiếm</a><?php endif; ?>
	-->
		<?php if ( @pzk_element('permission')->check('demo', 'paymentstat') ) : ?><a href="<?php echo BASE_REQUEST . '/demo/paymentstat'; ?>" class="easyui-linkbutton" data-options="plain:true">Bảng thanh toán</a><?php endif; ?>
		<?php if ( @pzk_element('permission')->check('demo', 'muster') ) : ?><a href="<?php echo BASE_REQUEST . '/demo/muster'; ?>" class="easyui-linkbutton" data-options="plain:true">Điểm danh</a><?php endif; ?>
		<?php if ( @pzk_element('permission')->check('student', 'order') ) : ?><a href="<?php echo BASE_REQUEST . '/student/order'; ?>" class="easyui-linkbutton" data-options="plain:true">Hóa đơn</a><?php endif; ?>
		<?php if ( @pzk_element('permission')->check('order', 'report') ) : ?><a href="<?php echo BASE_REQUEST . '/order/report'; ?>" class="easyui-linkbutton" data-options="plain:true">Báo cáo Hóa đơn</a><?php endif; ?>
		<?php if ( @pzk_element('permission')->check('student', 'index') ) : ?><a href="<?php echo BASE_REQUEST . '/student'; ?>" class="easyui-linkbutton" data-options="plain:true">Học sinh</a><?php endif; ?>
		<?php if ( @pzk_element('permission')->check('course', 'student') ) : ?><a href="<?php echo BASE_REQUEST . '/course/student'; ?>" class="easyui-linkbutton" data-options="plain:true">Xếp lớp</a><?php endif; ?>
		<?php if ( @pzk_element('permission')->check('course', 'index') ) : ?>
		<a href="<?php echo BASE_REQUEST . '/course'; ?>" class="easyui-linkbutton" data-options="plain:true">Lớp học</a>
		<?php endif; ?>
		<?php if ( @pzk_element('permission')->check('course', 'schedule') ) : ?>
		<a href="<?php echo BASE_REQUEST . '/course/schedule'; ?>" class="easyui-linkbutton" data-options="plain:true">Lịch học</a>
		<?php endif; ?>
		<a href="#" class="easyui-menubutton" data-options="plain:true,menu:'#qltrt'">Quản lý trung tâm</a>
		<?php if ( @pzk_element('permission')->check('order', 'createbill') ) : ?><a href="<?php echo BASE_REQUEST . '/order/createbill'; ?>" class="easyui-linkbutton" data-options="plain:true">Tạo hóa đơn chi</a><?php endif; ?>
		<?php if ( @pzk_element('permission')->check('order', 'billing') ) : ?><a href="<?php echo BASE_REQUEST . '/order/billing'; ?>" class="easyui-linkbutton" data-options="plain:true">Hóa đơn chi</a><?php endif; ?>
		<?php if ( @pzk_element('permission')->check('demo', 'report') ) : ?><a href="<?php echo BASE_REQUEST . '/demo/report'; ?>" class="easyui-linkbutton" data-options="plain:true">Báo cáo</a><?php endif; ?>
		<?php if ( @pzk_element('permission')->check('profile', 'index') ) : ?><a href="<?php echo BASE_REQUEST . '/profile'; ?>" class="easyui-linkbutton" data-options="plain:true">Người dùng</a><?php endif; ?>
		<?php if ( @pzk_element('permission')->check('profile', 'type') ) : ?><a href="<?php echo BASE_REQUEST . '/profile/type'; ?>" class="easyui-linkbutton" data-options="plain:true">Quyền hạn</a><?php endif; ?>
		<?php if ( @pzk_element('permission')->check('profile', 'grant') ) : ?><a href="<?php echo BASE_REQUEST . '/profile/grant'; ?>" class="easyui-linkbutton" data-options="plain:true">Phân quyền</a><?php endif; ?>
		<?php if ( @pzk_element('permission')->check('demo', 'logout') ) : ?><a href="<?php echo BASE_REQUEST . '/demo/logout'; ?>" class="easyui-linkbutton" data-options="plain:true">Đăng xuất</a><?php endif; ?>
	</div>
	<div id="qltrt" style="width:100px;">
		<?php if ( @pzk_element('permission')->check('course', 'index') ) : ?>
		<div>
			<a href="<?php echo BASE_REQUEST . '/course'; ?>" class="easyui-linkbutton" data-options="plain:true">Khóa học</a>
		</div>
		<?php endif; ?>
		<?php if ( @pzk_element('permission')->check('course', 'schedule') ) : ?>
		<div>
			<a href="<?php echo BASE_REQUEST . '/course/schedule'; ?>" class="easyui-linkbutton" data-options="plain:true">Lịch học</a>
		</div>
		<?php endif; ?>
		<?php if ( @pzk_element('permission')->check('offschedule', 'index') ) : ?>
		<div>
			<a href="<?php echo BASE_REQUEST . '/offschedule'; ?>" class="easyui-linkbutton" data-options="plain:true">Lịch nghỉ</a>
		</div>
		<?php endif; ?>
		<?php if ( @pzk_element('permission')->check('teacher', 'index') ) : ?>
		<div>
			<a href="<?php echo BASE_REQUEST . '/teacher'; ?>" class="easyui-linkbutton" data-options="plain:true">Giáo viên</a><br />
		</div>
		<?php endif; ?>
		<!--
		<div>
			<a href="<?php echo BASE_REQUEST . '/demo/teaching'; ?>" class="easyui-linkbutton" data-options="plain:true">Giảng dạy</a><br />
		</div>
		-->
		<?php if ( @pzk_element('permission')->check('subject', 'index') ) : ?>
		<div>
			<a href="<?php echo BASE_REQUEST . '/subject'; ?>" class="easyui-linkbutton" data-options="plain:true">Môn học</a><br />
		</div>
		<?php endif; ?>
		<?php if ( @pzk_element('permission')->check('room', 'index') ) : ?>
		<div>
			<a href="<?php echo BASE_REQUEST . '/room'; ?>" class="easyui-linkbutton" data-options="plain:true">Phòng học</a><br />
		</div>
		<?php endif; ?>
		<?php if ( @pzk_element('permission')->check('paymentperiod', 'index') ) : ?>
		<div>
			<a href="<?php echo BASE_REQUEST . '/paymentperiod'; ?>" class="easyui-linkbutton" data-options="plain:true">Kỳ thanh toán</a>
		</div>
		<?php endif; ?>
    </div>