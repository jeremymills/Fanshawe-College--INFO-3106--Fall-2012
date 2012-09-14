<?php
//ALWAYS include next two lines!!
ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

/**
 * print_ln
 * 
 * Prints the desired string.
 *
 * @access public
 * @param string Contains the string to print
 * @param bool Deteremines whether a new line is to be used.
 * @return void
 */
 function print_ln($line, $ln_break = true) {
	print $line;
	if( $ln_break ) {
		print '<br />';
	}
 }

print_ln('Hello World');





?>