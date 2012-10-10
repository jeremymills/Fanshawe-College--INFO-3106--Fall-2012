<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

echo "Hello world using the echo language construct!<br />";

// short syntax option for printing - not recommended
/* <?= "hello world"; ?> */

// Printing numbers 0 to 9, comma sep.
for( $i = 0; $i < 10; ++$i ) {
  print $i . ', '; // string concat long form
  // print "{$i}, "; // string concat 'short' form
}
print '<br />';

// Print numbers 0 to 9, comma sep, no last comma
for( $i = 0; $i < 10; ++$i ) {
  
  print $i;
  if( $i < 9 )
  {
    print ', ';
  }
}
print '<br />';

// Build string variable of 0 to 9, comma sep, no last comma
$string = '';
for( $i = 0; $i < 10; ++$i ) {
  
  // $string = $string . $i . ', ';
  $string .= $i . ', ';
}
print $string . '<br />';

// Trim string here so that no end comma is present.
print rtrim($string, ', ') . '<br />';

// Josh's thoughts - lets see
$j_string = '';
$counter = 0;
for( $i = 0; $i < 10; ++$i ) {
  
  $j_string .= $i;
  if( $i < 9 && ++$counter ) // this counter - used as an example
  {
    $j_string .= ', ';
  }
}
print $j_string . ' --> ' . ($counter) . '<br />';

// String concat using tern. operator 
$string = '';
for( $i = 0; $i < 10; ++$i )
{
  $string .= $i . (9 > $i ? ', ' : '');
}
print 'T-OP: ' . $string . '<br />';

// Another control structure for looping ...
$i = 0;
while( $i < 10 )
{
  print $i;
  if( 9 > $i ) // not recommended, please USE curly backets :)
    print ', ';
  
  ++$i;
}
print '<br />';