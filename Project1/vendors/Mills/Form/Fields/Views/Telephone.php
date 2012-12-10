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
     * Telephone
     */
	class Telephone extends Input
	{
		/**
		 * __construct
		 *
		 * @access public
		 * @param string Contains the name of this Telephone button
		 * @param string Contains the value of this Telephone button.
		 * @return void
		 */
        public function __construct($name = '', $value = '')
        {
            parent::__construct('telephone', $name, $value);
        }
        
		/**
		 * @see: Input::defaultAttribtues
		 */
        protected function defaultAttributes()
        {
            return array_merge(parent::defaultAttributes(), array(
				'maxlength' => '10'
			));
        }
	}
	
}