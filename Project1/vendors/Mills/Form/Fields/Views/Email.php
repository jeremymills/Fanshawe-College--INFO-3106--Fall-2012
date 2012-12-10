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
     * Email
     */
	class Email extends Input
	{
		/**
		 * __construct
		 *
		 * @access public
		 * @param string Contains the name of this field.
		 * @return void
		 */
        public function __construct($name = '', $value = '')
        {
            parent::__construct('email', $name, $value);
        }
        
		/**
		 * @see Input::defaultAttributes
		 */
        protected function defaultAttributes()
        {
            return array_merge(parent::defaultAttributes(), array(
                'maxlength' => '',
                'size' => ''
            ));
        }
	}
	
}