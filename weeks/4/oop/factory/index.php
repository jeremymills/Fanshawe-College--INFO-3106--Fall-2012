<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

require_once 'Factory.php';
require_once 'MyClass.php';
require_once 'MyClass2.php';

$my_class = MyClass::Factory();

unset ($my_class);
$my_class = Factory::create('MyClass2');

unset($my_class);
$my_class = MyClass::create();

MyClass::create();