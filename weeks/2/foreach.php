<?php
//ALWAYS include next two lines!!
ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

$array = array();
for( $i = 9; $i < 19; ++$i ) {
	$array[] = $i;
}

print_r( $array ); //dump to screen for visual.
print '<br />';

$array['my-key'] = 'my-value';

print_r( $array );//dump to screen
print '<br />';


//print the array's keys and values
foreach( $array as $key => $value ) {
	print $key . ' -> ' . $value . '<br />';
}
print '<br />';

$array_keys = array_keys($array);

print_r( $array );
print '<br />' . '<br />';
print_r( $array_keys );
/*
for( $i = 0; $i < count($array_keys); ++$i) {
	print $array[$array_keys[$i]] . '<br />';
}*/




?>