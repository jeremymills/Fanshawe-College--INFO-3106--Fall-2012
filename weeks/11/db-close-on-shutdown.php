<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

class my_mysqli extends mysqli {
	public function __construct() {
		parent::__construct('127.0.0.1', 'root', 'password');

		//throw new Exception('Throwing an exception');
	}
}

function shutdown_func() {
	global $mysqli;

	// if( $mysqli ) {
	if( $mysqli instanceof mysqli ) {
		$mysqli->close();
		print 'MySQLi is now closed.<br />';
	}
}
register_shutdown_function('shutdown_func');

try {
	$mysqli = new mysqli('127.0.0.1','root','password'); // new mysqli('127.0.0.1', 'root', 'adminroot');
	if( $mysqli->connect_error ) {
		trigger_error('MySQLi Error: ' . $mysqli->connect_error, E_USER_ERROR);
		print $mysqli->connect_error;
	}
}
catch( Exception $exception ) {
	print $exception->getMessage() . '<br />';
}