<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

// $mysqli = new mysqli('127.0.0.1', 'root', 'adminroot');
$mysqli = new mysqli('127.0.0.1', 'root', 'password', 'lamp1_example');
if( $mysqli->connect_error ) {
	trigger_error('Database connection error. Error: [ ' . $mysqli->connect_errno . ' ] ' . $mysqli->connect_error, E_USER_ERROR);
}

print 'Connected to the database successfully.';

$mysqli->close();