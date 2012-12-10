<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

$mysqli = new mysqli('127.0.0.1', 'root', 'password', 'lamp1_example');
if( $mysqli->connect_error ) {
	trigger_error('Database connection error. Error: [ ' . $mysqli->connect_errno . ' ] ' . $mysqli->connect_error, E_USER_ERROR);
}

$student_names = array('Aaron McGowan', 'Billy Anne', 'Bobby Joe', 'Christopher Columbus');
foreach( $student_names as $student_name ) {
	if( $mysqli->query('INSERT INTO students (name) VALUES ("' . $mysqli->real_escape_string($student_name) . '")') ) {
		print $student_name . ' was added to the database with an ID of: ' . $mysqli->insert_id . '<br />';
	}
	else
	{
		print 'Unable to insert ' . $student_name . ' to the database.<br />';
	}
}

$mysqli->close();