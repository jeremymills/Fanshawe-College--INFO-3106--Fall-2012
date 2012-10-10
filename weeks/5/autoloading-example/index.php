<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

require_once './SplLoader.php';

$autoloader = new SplLoader(
	DIRECTORY_SEPARATOR,
	'.php',
	'\\',
	array( realpath('./vendors') )
);

print 'Hello World!<br />';

new \Package\MyClass();

new \Package\ChildPackageA\MyClass();
new \Package\ChildPackageA\GrandChildPackage\MyClass();

new \Package\ChildPackageB\MyClass();
new \Package\ChildPackageB\GrandChildPackage\MyClass();
