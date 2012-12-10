<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

date_default_timezone_set('America/Toronto');

$time = time();

print 'UNIX Timestamp: ' . $time . '<br />';
print 'mktime: ' . mktime(12, 1, 0, 2, 22, 1980) . '<br />';

print date('Y-m-d', $time) . '<br />';
print date('Y-m-d', strtotime('2012-11-16'));