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
 * @return void
 */
 function print_ln($line) {
	print $line . '<br />';
 }

print_ln('Hello World');





?>