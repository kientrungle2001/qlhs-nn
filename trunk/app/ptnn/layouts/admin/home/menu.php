<?php
    $level = pzk_session('adminLevel');
    if($level == 'Administrator'){
        $allmenu = _db()->useCB()->select('*')
            ->from('admin_menu')
            ->where(array('status',1))
            ->result();
    }else {
        $query = _db()->useCB()->select('am.*, ala.admin_level_id, ala.admin_action, ala.admin_level, ala.status, ala.action_type')
            ->from('admin_menu am')
            ->join('admin_level_action ala', 'am.admin_controller = ala.admin_action')
            ->where(array('admin_level',$level))
            ->where(array(array('column', 'ala', 'action_type'),1))
            ->where(array(array('column', 'am', 'status'),1))
            ->where(array(array('column', 'ala', 'status'),1));
        //echo $query->getQuery();
       // $query->where(array(array('in', 'am', 'status'),$arrIds));
        //$query->where(array('in', 'am.id', $arrIds));
        $allmenu = $query->result();
        //$allmenu = array_merge($a, $rootmenu);

    }
    //debug($allmenu);
?>
<div id="menu">
	<ul class="drop">
		<li><a href="/admin_home/index">Bảng điều khiển</a></li>
    </ul>
    <?php
    $items = buildTree($allmenu);
    //debug($items);
    showAdminMenu($items);
    ?>
</div>
<div id="main">