<?php
//ALWAYS include next two lines!!
ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

echo 'Hello world using the echo language construct!<br />';
//short syntax option for ptinting - not recommended
/* <?="Hello World"; ?> */

//printing numbers 0 - 9, comma sep.
for( $i = 0; $i < 10; ++$i) {
	echo $i . ', '; //string concat long form

	/*	echo "{$i}, "; //string concat short form */
}
echo '<br />';

//print numbers 0 - 9, comma sep. no last comma
for( $i = 0; $i < 10; ++$i) {

	echo $i;
	if( $i < 9 ) {
		echo ', ';
	}
}
echo '<br />';

//build string variable of numbers 0 - 9, comma sep. no last comma and print string variable
$string = '';
for( $i = 0; $i < 10; ++$i) {

	$string .= $i . ', ';
/*	if( $i < 9 ) {
		$string .= ', ';
	}
*/
}
echo $string . '<br />';

echo 'Trim string here using rtrim() so that no end comma is present.' . '<br />';
echo rtrim($string, ', ') . '<br />';

//new thoughts
$string = '';
for( $i = 0; $i < 10; ++$i) {

	$string .= $i . (9 > $i ? ', ': '');
}
echo 'Using Ternary Operator' . '<br />' . $string . '<br />';

echo 'While() loop control structure for looping..' . '<br />';
$i = 0;
while( $i < 10 ) {
	echo $i;
	if( 9 > $i) {
		echo ', ';
	}
	
	++$i;
}


?>
