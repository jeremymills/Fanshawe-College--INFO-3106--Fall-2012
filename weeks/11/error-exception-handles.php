<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

function exception_handler(\Exception $exception) {
	print '<strong>' . __METHOD__ . '</strong> --> ' . $exception . '<br />';
}
set_exception_handler('exception_handler');

function error_handler($errno, $errstr, $errfile, $errline, array $context = array()) {
	// print '<strong>' . __METHOD__ . '</strong> --> ' . print_r(func_get_args(), true) . '<br />';
	switch( $errno ) {
		case E_USER_NOTICE:
		case E_USER_WARNING:
			// print '<strong>' . __METHOD__ . '</strong> --> ' . print_r(func_get_args(), true) . '<br />';

			print $errstr . '<br />';

			break;

		case E_USER_ERROR:
		default:
			// print '<strong>I AM DEAD! ' . __METHOD__ . '</strong> --> ' . print_r(func_get_args(), true) . '<br />';

			print 'An unknown error has occured, please try later. If the problem persists, contact us.<br />';
			exit;
	}
}
set_error_handler('error_handler');

/* error_handler handles all trigger_error() calls */
/*
// example 1
// throw new Exception('This is an uncaught exception being thrown.');

// example 2 - catching & re-throwing exception
/*
try {
	throw new Exception('This is a caught exception being re-thrown.');
}
catch( Exception $exception ) {
	throw $exception;
} */

trigger_error('This is a warning error ...', E_USER_WARNING);
trigger_error('This is a notice error ...', E_USER_NOTICE);
trigger_error('This is a fatal error ...', E_USER_ERROR);

print 'Done';