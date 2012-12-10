<?php

ini_set('display_errors','on');
error_reporting(E_ALL | E_STRICT);


$mysqli = new mysqli('127.0.0.1', 'root', 'password', 'lamp1_ex');
if( $mysqli->connect_error ) {
	trigger_error('An error has occured while connecting to the datbase. Error: [ ' . $mysqli->connect_errno . ' ] ' . $mysqli->connect_error, E_USER_ERROR);
}//end if

$query = $mysqli->query("SELECT * FROM students");

if( $query ) {
	$students = array();
	/*while( $row = $query->fetch_object() ) {
	 $students[$row->id] = $row;
	}//end while
	print '<br /><br />';
	//==================================
	/* OR */
	$students = $query->fetch_all(MYSQLI_ASSOC);
	foreach( $students as $student ) {
		print_r($student);
		print '<br />';
	}
	
	
	
	$query->close();
}//end if

$mysqli->close();