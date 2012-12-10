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
	 * Label
	 */
	class Label extends Element
	{
		private $_text = '';
	
		/**
		 * __construct
		 *
		 * @access public
		 * @param array
		 * @return void
		 */
		public function __construct($title = '', array $data = array())
		{
			parent::__construct('label', $data);
			$this->_text = new Text($title);
		}
		
		public function text()
		{
			return $this->_text;
		}
		
		public function addChild(Element $child)
		{
			throw new \Exception('Children of type Label must be of type Text.');
		}
		
		public function removeChild(Element $child)
		{
			throw new \Exception('Only type Text is a valid child of type Label');
		}
		
		protected function beforeRender()
		{
			$this->_children[] = $this->_text;
			
			parent::beforeRender();
		}
		
		protected function defaultAttributes()
		{
			return array_merge(parent::defaultAttributes(), array('for' => ''));
		}
	}
}