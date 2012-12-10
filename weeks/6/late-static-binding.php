<?php

abstract class Base {

	public static function method() {
		print get_called_class();
	}
}

abstract class Child extends Base {
	
}

Base::method();
print '<br />';
Child::method();
print '<br />';

