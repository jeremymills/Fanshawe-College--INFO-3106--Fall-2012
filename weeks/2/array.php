<?php

$my_array = array(1, 2, 3, 4, 5);
// $my_array = array( 0 => 1, 1 => 2, ... );

$my_array[] = 6;
// $my_array[5] = 6;

$my_array[] = 7;
$my_array[] = 8;
$my_array[] = 9;
$my_array[] = 10;

// our array now is like that of line 4 (commented line),
// where the key of each item is the element value - 1.

for( $i = 0; $i < count($my_array); ++$i )
{
  print $my_array[$i] . ', ';
}
print '<br />';

// "Alter" the values of each element
for( $i = 0; $i < count($my_array); ++$i )
{
  $my_array[$i] = $i + 10;
}

// Using print, print/dump this recursively.
print_r( $my_array );

/* Example for Chris Tully */
/* $print_r_value = print_r( $my_array, true );
$print_r_value = str_replace(array('=>'), array(' --> '), $print_r_value);

print $print_r_value . '<br />'; */






