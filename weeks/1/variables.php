<?php
//variables characters always begin with $ and followed by anything but numbers
define('LNBREAK_HTML','<br /><br />');

$hello_world = 'Hello World';

echo $hello_world;
echo LNBREAK_HTML;

$hello = 'Hello';
$world = 'World';

echo $hello .' '. $world;
echo LNBREAK_HTML;

print "{$hello} {$world}";
echo LNBREAK_HTML;

for( $i = 0; $i < 10; $i++ )
{
	print $i . LNBREAK_HTML;
}

?>