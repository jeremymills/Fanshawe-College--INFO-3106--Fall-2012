<?php
/**
 * MyClass
 *
 * Provide a description of the class here..
 */
class MyClass extends Factory {
	/**
	 * factory
	 *
	 * Description of the method
	 * 
	 * @access public
	 * @param void
	 * @return MyClass Returns a new instance of MyClass.
	 */
	public static function factory() {
		print __METHOD__ . '::' . __LINE__ . '<br />';
	
		return new MyClass();
	}//end factory()
	
	protected function __construct() {
		print __METHOD__ . '::' . __LINE__ . '<br />';
	}//end __construct()
	
	public function __destruct() {
		print __METHOD__ . '::' . __LINE__ . '<br />';
	}//end __destruct()
}//end class
//LOOK OVER SPLSUBJECT SPLOBSERVER,$observer




/*
UML

MyListener/MyObserver						My Subject
---------------------						--------------
+notify(MySubject):void						+attach(MyListener)	:void
											+detach(MyListener)	:void
_listening_to -> MySubject-set				+notify(void)		:void
during attach
											
class Sub {
	protected $_listener = array();

	public function attach( MyListener, $listener) {
		$this. -> _listener[] = $listener;
	}
}
detach -> 	loop over array
			compare array to instance
*foreach loop*^^^

foreach( _listeners
		as $k => $listeners) {}
unset(_listeners[$k]);
			
*/
