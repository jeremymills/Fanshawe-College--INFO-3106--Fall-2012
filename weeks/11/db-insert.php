<?php

ini_set('display_errors','on');
error_reporting(E_ALL | E_STRICT);


$mysqli = new mysqli('127.0.0.1', 'root', 'password', 'lamp1_ex');

if( $mysqli->connect_error ) {
	trigger_error('An error has occured while connecting to the datbase. Error: [ ' . $mysqli->connect_errno . ' ] ' . $mysqli->connect_error, E_USER_ERROR);
}//end if


$student_names = array (
	'Christopher Tully', 
	'Michael Cameron', 
	'Jaide Haynes', 
	'Nick Hiebert', 
	'Carlie Hiel', 
	'Andrew Noble', 
	'Insu Mun'
);

foreach( $student_names as $student_name ) {
	
	if( $mysqli->query('INSERT INTO students (name) 
		VALUES("'. $mysqli->real_escape_string($student_name) . '")') ) {
		
		print 'Student ' . $student_name . ' has the ID = ' . $mysqli->insert_id . '<br />';
		
	}//end if

}//end foreach

print 'Done!';

$mysqli->close();