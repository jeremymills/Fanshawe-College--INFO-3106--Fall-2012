<?php

$ary = array();
/* In PHP 5.4 ... */
/* $ary = []; */

$ary = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
$ary[] = 11;
$ary[count($ary)] = 12;

print_r( $ary );

print '<br /><br />';

$map = array(
	'my-key' => 'my value here'
);
$map[0] = 'value with key of zero';
$map[] = 'another value';
$map['here-we-go'] = 'again';

print_r( $map );

print '<br /><br />';

$array = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);

print 'The size of an array can be deteremined using count. Example, $array = ' . count($array) . '<br />';

/* Does an element with a specific key exist? */
if( isset($array[0]) ) {
	print 'Index 0 does exist in $array' . '<br />';
}//end if
if( !isset($array['string-key']) ) {
	print 'Index string-key does not exist in $array<br /><br />';
}//end if

/* Remove/delete an element at a specific offset/index */
unset( $array[9] );
print_r( $array );
print '<br />';

unset( $array[4] );
print_r( $array );
print '<br />';

/* Check if a value exists ... */
if( in_array(4, $array) ) {
	print 'The value 4 does exist within our array. <br />';
}
else {
	print 'The value 4 does not exist within our array. <br />';
}
if( in_array(5, $array) ) {
	print 'The value 5 does exist within our array. <br />';
}
else {
	print 'The value 5 does not exist within our array. <br />';
}

$pos = array_search(4, $array);
print 'Index/position of value 4 is = ' . $pos . '<br />';

$pos = array_search(5, $array);
if( false === $pos ) {
print gettype($pos).'<br /><br />';	
}

$ary_string = array('a' => 1, 'b' => 2, 'c' => 3);

print_r( array_keys($ary_string) );
print '<br />';

print_r( array_values($ary_string) );
print '<br /><br />';

/* To string, from string ... */
$explode = explode(',', "here,is,my,comma,sep,string");

print_r( $explode );
print'<br />';

print implode(', ', $explode) . '<br />';

/* List Example */
$ary_string = array(1, 2, 3);

list($a, $b, $c) = $ary_string;

print '$a = ' . $a . '<br />';
print '$b = ' . $b . '<br />';
print '$c = ' . $c . '<br />';

$obj_from_array = (object) array('a' => 1, 'b' => 2, 'c' => 3);
print_r( $obj_from_array );