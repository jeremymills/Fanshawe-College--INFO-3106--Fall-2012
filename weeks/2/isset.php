<?php
//ALWAYS include next two lines!!
ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

//build an array of data, mixed key types
$array = array(2, 5, 10, 'hello' => 'world');

print_r( $array );
print '<br />';

$array['bye'] = 'world';

if( isset($array['bye']) ) {
	print 'Bye exists<br />';
}
else {
	print 'Bye does not exist';
}
print '<br />';

print $array['foo']; //demo of why isset() is used

print '<br />';

unset($array['hello']);//removes element at specified key [hello]
print_r($array);

print '<br />';
print '<br />';

unset($array); //delete the entire array

if( isset($array) ) {
	print 'Array variable exists<br />';
}
else {
	print 'Array variable does not exist<br />';
}



?>