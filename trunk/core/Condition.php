<?php
// test 1
function assertEquals($var1, $var2) {
	if($var1 === $var2) {
		echo 'OK. Passed.<br />';
	} else {
		echo 'Wrong!<br />';
	}
}
$operations = array('column', 'string', 'equal', 'and', 'or', 'like', 'notlike');

function buildCondition($cond) {
	global $operations;
	if(is_array($cond)) {
		$op = $cond[0];
		if(in_array($op, $operations)) {
			$func = 'mf_'.$op;
			array_shift($cond);
			return call_user_func_array($func, $cond);
		} else {
			if(count($cond)>=2) {
				return call_user_func_array('mf_equal', $cond);
			}
		}
	} else {
		return $cond;
	}
}

function mf_column($col, $col2 = null) {
	if(!$col2)
		return '`' . @mysql_real_escape_string($col) . '`';
	return '`' . @mysql_real_escape_string($col) . '`.`' . @mysql_real_escape_string($col2) . '`';
}
function mf_string($str) {
	return '\'' . @mysql_real_escape_string($str) . '\'';
}
function mf_equal($exp1, $exp2) {
	if(is_string($exp1)) {
		$exp1 = array('column', $exp1);
	}
	if(is_string($exp2)) {
		$exp2 = array('string', $exp2);
	}
	return buildCondition($exp1) .'=' . buildCondition($exp2);
}

function mf_like($exp1, $exp2) {
	if(is_string($exp1)) {
		$exp1 = array('column', $exp1);
	}
	if(is_string($exp2)) {
		$exp2 = array('string', $exp2);
	}
	return buildCondition($exp1) .' like ' . buildCondition($exp2);
}

function mf_notlike($exp1, $exp2) {
	if(is_string($exp1)) {
		$exp1 = array('column', $exp1);
	}
	if(is_string($exp2)) {
		$exp2 = array('string', $exp2);
	}
	return buildCondition($exp1) .' not like ' . buildCondition($exp2);
}

function mf_exp($op) {
	$args = func_get_args();
	$op = $args[0];
	array_shift($args);
	$conds = array();
	foreach($args as $exp) {
		$conds[] = buildCondition($exp);
	}
	return implode(' '.$op.' ', $conds);
}

function mf_and() {
	$args = func_get_args();
	array_unshift($args, 'and');
	return call_user_func_array('mf_exp', $args);
}

function mf_or() {
	$args = func_get_args();
	array_unshift($args, 'or');
	return call_user_func_array('mf_exp', $args);
}