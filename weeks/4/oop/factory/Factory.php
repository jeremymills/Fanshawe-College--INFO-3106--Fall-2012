<?php
/**
 *
 *
 *
 */
abstract class factory {
	
	public static function create($class = null) {
		if( !$class ) {
			//handle null value here
			print __METHOD__ . '::' . __LINE__ . '<br />';
			$class = get_called_class();
			if( $class == 'Factory' ) {
				throw new Exception('Cannot create an instance of Factory class.');
			}//end inner if
		}//end if
		else {
			print __METHOD__ . '::' . __LINE__ . '<br />';
		}
		
		if( !class_exists($class) ) {
			throw new Exception(sprintf('%1$s does not exist.', $class));
		}//end if
		
		return new $class;
	}//end create()
	
	/**
	 * DO NOT allow the instantiation of this class.
	 */
	//final private function __construct() { }
	//final private function __destruct() { }
	
}