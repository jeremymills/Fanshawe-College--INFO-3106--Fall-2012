<?php
//variables characters always begin with $ and followed by anything but numbers
define('LINE','<br /><br />');

$hello_world = 'Hello World';

echo $hello_world;
echo LINE;

$hello = 'Hello';
$world = 'World';

echo $hello .' '. $world;
echo LINE;

print "{$hello} {$world}";
echo LINE;

for( $i = 0; $i < 10; $i++ )
{
	print $i . LINE;
}

?>