<?php 

namespace Mills\Form\Fields\Views
{
defined('IN_LIBRARY') or exit;

	class Option extends \Mills\HTML\Views\Element
	{
		protected $_text = null;
	
		public function __construct($text = '', $value = '') {
			parent::__construct('option');
			
			$this->_text = new \Mills\HTML\Views\Text($text);
			$this->value($value);
		}//end __construct()
		
		//$option->text()->value('hello world');
		public function text() {
			return $this->_text;
		}//end text()
		
		public function value($value = null) {
			if( null === $value ) {
				if( isset($this->_attributes['value']) ) {
				
					return $this->_attributes['value'];
					
				}//end inner if
				
				return null;
				
			}//end if
			
			$this->_attributes['value'] = $value;
			return $this;
			
		}//end value()
		
		public function addChild(\Mills\HTML\Views\Element $child) {
			throw new \Exception('Hey! You cannot use this method. The only child allowed is of type text and is handled internally. Use Option::text() method.');
		}
		public function removeChild(\Mills\HTML\Views\Element $child) {
			throw new \Exception('Hey! You cannot use this method. The only child allowed is of type text and is handled internally. Use Option::text() method.');
		}
		
		protected function beforeRender() {
		
			/* We cheat here ... directly append _text onto _children without enforcing the type */			
			$this->_children[] = $this->_text;
			parent::beforeRender();
			
		}//end beforeRender()
		
		protected function defaultAttributes() {
			return array_merge(parent::defaultAttributes(), array(
				'value' => ''
			));
		}//end defaultAttributes()
		

	}//end class
}//end namespace