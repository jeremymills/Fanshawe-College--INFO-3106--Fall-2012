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
     * Checkbox
     *
     * Class used to present <input type="checkbox" />
     */
	class Checkbox extends Input
	{
        /**
         * __construct
         *
         * @access public
         * @param string Contains the name="" value for this element.
         * @return void
         */
        public function __construct($name = '')
        {
            parent::__construct('checkbox', $name);
        }
        
        /**
         * @see Input::defaultAttributes
         *
         * Adds specific attributes for the <input /> with type="" value of text.
         */
        protected function defaultAttributes()
        {
            return array_merge(parent::defaultAttributes(), array(
                'checked' => ''
            ));
        }
	}
	
}