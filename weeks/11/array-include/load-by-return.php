<?php

define('IN_APPLICATION', true);

$config = include 'config-one.php';

//connect to database ...

//delete password from $config array
//unset($config['db_pass']);

print_r( $config );