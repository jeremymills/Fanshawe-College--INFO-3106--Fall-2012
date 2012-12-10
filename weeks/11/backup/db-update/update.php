<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

$mysqli = new mysqli('127.0.0.1', 'root', 'password', 'lamp1_example');
if( $mysqli->connect_error ) {
	trigger_error('Database connection error. Error: [ ' . $mysqli->connect_errno . ' ] ' . $mysqli->connect_error, E_USER_ERROR);
}

$query = $mysqli->query('SELECT * FROM students');

$students = array();
while( $row = $query->fetch_object() ) {
	$students[$row->student_id] = $row;
	
	$name = explode(' ', $students[$row->student_id]->name);
	$name = array_reverse($name);
	$name = implode(' ', $name);
	
	$students[$row->student_id]->name = $name;
}
$query->close();

foreach( $students as $student_id => $student )
{
	if( $mysqli->query('UPDATE students
		SET name = "' . $mysqli->real_escape_string($student->name) . '"
		WHERE student_id = ' . $student_id)
	)
	{
		print 'Student ID ' . $student_id . ' was updated successfully.<br />';
	}
}

$mysqli->close();