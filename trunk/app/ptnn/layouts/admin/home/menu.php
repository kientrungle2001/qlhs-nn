<?php
    $level = pzk_session('adminLevel');
    if($level == 'Administrator'){
        $allmenu = _db()->useCB()->select('*')
            ->from('admin_menu')
            ->where(array('status',1))
            ->result();
    }else {
        $allmenu = _db()->useCB()->select('am.*, ala.*')
            ->from('admin_menu am')
            ->join('admin_level_action ala', 'am.admin_controller = ala.admin_action')
            ->where(array('admin_level',$level))
            ->where(array(array('column', 'ala', 'action_type'),1))
            ->where(array(array('column', 'am', 'status'),1))
            ->where(array(array('column', 'ala', 'status'),1))
           ->result();
    }
?>
<div id="menu">
	<ul class="drop">
		<li><a href="/admin_home/index">Bảng điều khiển</a></li>
    </ul>
    <?php
    $items = buildTree($allmenu);
    showAdminMenu($items);
    ?>
</div>
<div id="main">