<?php
function AE($col, $val) {
	return array('equal', $col, $val);
}
function AC($table, $col = NULL) {
	if($col) return array('column', $table, $col);
	return array('column', $table);
}
function AStr($str) {
	return array('string', $str);
}
function AA() {
	$args = func_get_args();
	array_unshift($args,'and');
	return $args;
}
function AO() {
	$args = func_get_args();
	array_unshift($args,'or');
	return $args;
}
function AL ($col, $str){
	return array('like', $col, $str);
}
function ANL ($col, $str) {
	return array('notlike', $col, $str);
}
function AI($col, $arr) {
	return array('in', $col, $arr);
}
function ANI($col, $arr) {
	return array('notin', $col, $arr);
}
function ANULL($col) {
	return array('isnull', $col);
}
function ANNULL($col) {
	return array('isnotnull', $col);
}
function AGE($col, $val) {
	return array('gte', $col, $str);
}
function ALE($col, $val) {
	return array('lte', $col, $str);
}
function AGT($col, $val) {
	return array('gt', $col, $str);
}
function ALT($col, $val) {
	return array('lt', $col, $str);
}