<?php
/**
 * Mills\HTML
 */
namespace Mills\HTML\Views {
	/**
	 * @ignore
	 */
	defined('IN_LIBRARY') or exit;
	
	/**
	 * Text
	 */
	class Text extends \Mills\View
	{
		private $_value = '';
	
		/**
		 * __construct
		 *
		 * @access public
		 * @param array
		 * @return void
		 */
		public function __construct($value = '')
		{
			parent::__construct(null, array());
			
			$this->template_path(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR);
			$this->template_file('text.tmpl.php');
			
			$this->value($value);
		}
		
		public function value($value = null)
		{
			if( null === $value ) {
				return $this->_value;
			}
			
			$this->_value = $value;
			return $this;
		}
		
		protected function beforeRender()
		{
			$this->set('text', $this->_value);
			
			parent::beforeRender();
		}
	}
}