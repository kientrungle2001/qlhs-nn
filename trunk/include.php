<?php
function product_price($priceFloat) {
	$symbol = 'đ';
	$symbol_thousand = '.';
	$decimal_place = 0;
	$price = number_format($priceFloat, $decimal_place, '', $symbol_thousand);
	return $price.$symbol;
}

function explodetrim($delim, $str) {
	$arr = explode($delim, $str);
	foreach($arr as $i => $e) {
		$arr[$i] = trim($e);
	}
	return $arr;
}

set_error_handler(function($errno, $errstr, $errfile, $errline, array $errcontext) {
    // error was suppressed with the @-operator
    if (0 === error_reporting()) {
        return false;
    }
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});
require_once 'core/URI.php';
require_once 'core/Object.php';
require_once 'core/Object/LightWeight.php';
require_once 'core/Object/Smarty.php';
require_once 'core/Store.php';
require_once 'core/Parser.php';
require_once 'core/Controller.php';
require_once 'lib/thumb.php';