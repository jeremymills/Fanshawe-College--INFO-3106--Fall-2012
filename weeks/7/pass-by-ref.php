<?php
/**
 * Example of pass-by-reference in PHP.
 */
 
 ini_set('display_errors', 'on');
 error_reporting(E_ALL | E_STRICT);
 
function by_val($var){
	$var = 'Bye World';
	return $var;
}

function by_ref(&$var) {
	$var = 'Bye World';
	return $var;
}

function &return_by_ref() {
	static $var = null;
	if( null === $var ) {
		$var = array();
	}
	else {
		print_r( $var );
		print '<br />';
	}
	
	return $var;
}
 
/* String variable */
$variable = 'Hello World';
print $variable . '<br />';

print by_val($variable) . '<br />';
print $variable . '<br />';

print by_ref($variable) . '<br />';
print $variable . '<br />';



$my_array = &return_by_ref();

$my_array[] = 1;
$my_array[] = 2;
$my_array[] = 3;

return_by_ref();


















