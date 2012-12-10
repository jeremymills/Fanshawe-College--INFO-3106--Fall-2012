<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

$config = array();
if( file_exists('config.php') ) {
	include 'config.php';
	$config = is_array($config) ? $config : array();
}

print_r( $config );