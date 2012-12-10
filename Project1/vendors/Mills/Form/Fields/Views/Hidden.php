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
     * Hidden
     */
	class Hidden extends Input
	{
		/**
		 * __construct
		 *
		 * @access public
		 * @param string Contains the name of this Hidden button
		 * @param string Contains the value of this Hidden button.
		 * @return void
		 */
        public function __construct($name = '', $value = '')
        {
            parent::__construct('hidden', $name, $value);
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