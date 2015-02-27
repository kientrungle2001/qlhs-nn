<?php
function sw_get_current_weekday() {
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $weekday = date("l");
    $weekday = strtolower($weekday);
    switch($weekday) {
        case 'monday':
            $weekday = 'Thứ hai';
            break;
        case 'tuesday':
            $weekday = 'Thứ ba';
            break;
        case 'wednesday':
            $weekday = 'Thứ tư';
            break;
        case 'thursday':
            $weekday = 'Thứ năm';
            break;
        case 'friday':
            $weekday = 'Thứ sáu';
            break;
        case 'saturday':
            $weekday = 'Thứ bảy';
            break;
        default:
            $weekday = 'Chủ nhật';
            break;
    }
    return date('H:i d/m/Y').', '.$weekday;
}
?>
<div id="search">
	<div class="row">
		<div class="col-xs-6">
			<span class="date"><?=sw_get_current_weekday();?></span>
		</div>
		<div class="col-xs-6 form">
			<div class="pull-right margin-right-30">
				<form action="search" method="post">
					<span class="color-white">Tìm kiếm : </span><input type="text" /><span class="color-white user_name"> Xin chào ( {children all} )</span> 
					<a href="<?php echo BASE_URL?>/account/logout"><span>Thoát</span></a>
				</form>
			</div>
		</div>
	</div>
</div>