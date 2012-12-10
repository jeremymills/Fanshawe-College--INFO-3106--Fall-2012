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
     * url
     */
	class URL extends Input
	{
		/**
		 * __construct
		 *
		 * @access public
		 * @param string Contains the name of this url button
		 * @param string Contains the value of this url button.
		 * @return void
		 */
        public function __construct($name = '')
        {
            parent::__construct('url', $name);
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