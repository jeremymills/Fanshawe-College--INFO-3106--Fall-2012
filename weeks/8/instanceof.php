<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

class ParentClass {

	public function do_op(MyClass $class)
	{
		print 'Hello World';
	}

}

class ChildClass extends ParentClass {

	// public function do_op(MyClass $class) {
	public function do_op(MySecondClass $class) {
		/* Example using get_class() - doesn't work for all cases */
		/* $class_name = get_class($class);
		if( 'MySecondClass' != $class_name ) {
			throw new Exception('Class is not an instance of MySecondClass');
		} */

		/* instanceof works for all cases */
		if( !$class instanceof MySecondClass ) {
			throw new Exception('Class is not an instance of MySecondClass');
		}

		print get_class($class) . '<br />';
		parent::do_op($class);
	}

}

class MyClass { }
class MySecondClass extends MyClass { }
class MyThirdClass extends MySecondClass { }

$child_class = new ChildClass;

$my_class = new MyClass;
$my_second_class = new MySecondClass;
$my_third_class = new MyThirdClass;

try {

	$child_class->do_op($my_second_class);
	$child_class->do_op($my_third_class);

	// $child_class->do_op($my_class);
}
catch( Exception $ex ) {
	print $ex;
}
