<?php
//ALWAYS include next two lines!!
ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

define('IN_APPLICATION', true);
require_once 'bootstrap.php';
print '<br />';

print 'Hello World from Shapes <br /><br />';

$square = new Square();
$pentagon = new Pentagon();
$triangle = new Triangle();

print $square . '<br />';
print $pentagon . '<br />';
print $triangle . '<br />';
