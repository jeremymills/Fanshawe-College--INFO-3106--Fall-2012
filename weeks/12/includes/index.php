<?php

ini_set('display_errors','on');
error_reporting(E_ALL | E_STRICT);

define('ABS_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);

print __FILE__ . '<br />';

// include 'inc-me.php';
include ABS_PATH . 'inc/inc-one.php';