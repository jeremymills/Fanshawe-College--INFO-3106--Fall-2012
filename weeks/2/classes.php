<?php
//ALWAYS include next two lines!!
ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

require_once './classes_include.php';// will stop at first sign of file error

//include_once './classes_include.php';// will keep trying everthing if file error

//include_once './classes_include.php'; //file only gets included once

/* Base Class Specific */
$base_class = new MyBaseClass();
$base_class->myMethod();
/*
$base_class->myProtectedMethod();// won't run ... not visible
$base_class->myPrivateMethod(); // won't run ... not visible
*/
print '<br />';
//print_r($base_class);

//unset($base_class);
print '<br /><br />';

$child = new MyChildClass();
MyChildClass::myStaticMethod();

print '<br /><br />';
print '<br /><br />';

myFuncInterface($base_class);
myFuncInterface($child); //still works, why?

myFuncBaseClass($base_class); //base class instance
myFuncBaseClass($child);//still works, why?

myFuncChildClass($child);
myFuncChildClass($base_class);// doesn't work, why?


