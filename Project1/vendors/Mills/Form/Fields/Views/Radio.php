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
     * Radio
     */
	class Radio extends Input
	{
		/**
		 * __construct
		 *
		 * @access public
		 * @param string Contains the name of this radio button
		 * @param string Contains the value of this radio button.
		 * @return void
		 */
        public function __construct($name = '', $value = '')
        {
            parent::__construct('radio', $name, $value);
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