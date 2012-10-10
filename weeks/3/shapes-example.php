<?php

define('IN_APPLICATION', true);
require_once 'bootstrap.php';

print 'Hello World from Shapes<br />';

$square = new Square(array(10));

print $square . '<br />';
print 'Square\'s dimensions are: ';
foreach( $square->getDimensions() as $side_length ) {
  print $side_length . ', ';
}
print '<br />';

/* $pentagon = new Pentagon(array(5, 5, 4, 5, 5));
print $pentagon . '<br />';
print 'Pentagon\'s dimensions are: ';
foreach( $pentagon->getDimensions() as $side_length ) {
	print $side_length . ', ';
}
print '<br />'; */

$triangle = new Triangle(array(2, 3));
print $triangle . '<br />';
print 'Triangle\'s dimensions are: ';
foreach( $triangle->getDimensions() as $side_length ) {
	print $side_length . ', ';
}
print '<br />';