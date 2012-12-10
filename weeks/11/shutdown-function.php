<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

function my_shutdown() {

	print '<br />' . __METHOD__ . '<br />';

}
register_shutdown_function('my_shutdown');

print 'Hello World!<br />';

trigger_error('A random error has occurred', E_USER_ERROR);

print 'Here is some text to be printed...<br /><Br />';

// my_shutdown();