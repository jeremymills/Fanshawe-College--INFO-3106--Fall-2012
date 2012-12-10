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
     * Button
     *
     * Class used to present <input type="button" />
     */
	class Button extends Input
	{
        /**
         * __construct
         *
         * @access public
         * @param string Contains the name of this button.
		 * @param string Contains the value of this button.
         * @return void
         */
        public function __construct($name = '', $value = '')
        {
            parent::__construct('button', $name, $value);
        }
        
        /**
         * @see Input::defaultAttributes
         *
         */
        protected function defaultAttributes()
        {
            return array_merge(parent::defaultAttributes(), array());
        }
	}
	
}