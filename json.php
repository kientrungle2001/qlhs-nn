<?php
if(isset($_REQUEST['json'])) {
	$arr = json_decode($_REQUEST['json'], true);
	$arr['name'] = 'Ten toi la: ' . $arr['name'];
	echo json_encode($arr);
} else {
	$arr = array(
		'name' => 'Kien',
		'phone' => '01647867486',
		'friends' => array('Nghia', 'Truc', 'Phuc', 'Nguyet')
	);
	echo json_encode($arr);
}