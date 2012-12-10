<?php
/**
 * Mills\Form\Fields\Views
 */
namespace Mills\Form\Fields\Views
{
	/**
	 * @ignore
	 */
	defined('IN_LIBRARY') or exit;
	
    /**
     * reset
     */
	class Reset extends Input
	{
		/**
		 * __construct
		 *
		 * @access public
		 * @param string Contains the name of this reset button
		 * @param string Contains the value of this reset button.
		 * @return void
		 */
        public function __construct($name = '')
        {
            parent::__construct('reset', $name);
        }
        
		/**
		 * @see: Input::defaultAttribtues
		 */
        protected function defaultAttributes()
        {
            return array_merge(parent::defaultAttributes(), array());
        }
	}
	
}