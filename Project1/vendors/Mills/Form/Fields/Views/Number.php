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
     * number
     */
	class Number extends Input
	{
		/**
		 * __construct
		 *
		 * @access public
		 * @param string Contains the name of this number button
		 * @param string Contains the value of this number button.
		 * @return void
		 */
        public function __construct($name = '', $value = '')
        {
            parent::__construct('number', $name, $value);
        }
        
		/**
		 * @see: Input::defaultAttribtues
		 */
        protected function defaultAttributes()
        {
            return array_merge(parent::defaultAttributes(), array(
			'min' => '1890',
			'max' => '2012'
			));
        }
	}
	
}