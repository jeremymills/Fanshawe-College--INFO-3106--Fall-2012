<?php

ini_set('display_errors','on');
error_reporting(E_ALL | E_STRICT);


$mysqli = new mysqli('127.0.0.1', 'root', 'password', 'lamp1_ex');

if( $mysqli->connect_error ) {
	trigger_error('An error has occured while connecting to the datbase. Error: [ ' . $mysqli->connect_errno . ' ] ' . $mysqli->connect_error, E_USER_ERROR);
}//end if




print 'Successful connection!';

$mysqli->close();