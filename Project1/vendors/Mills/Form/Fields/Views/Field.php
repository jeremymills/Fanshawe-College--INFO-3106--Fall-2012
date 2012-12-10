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
	 * Field
	 *
	 * Used to represent both a label and the actual input (<input />, <select />, etc.)
	 * element combination. Additionally, this also wraps both elements
	 * within a 'wrapper' for denoting that it is a field.
	 */
	class Field extends \Mills\HTML\Views\Element
	{
		protected $_label = null;
		protected $_element = null;
		
		/**
		 *	__construct
		 *
		 *	@access public
		 *	@param string Contains the title of this field (value to live within <label>).
		 *	@param Element Contains the element class of this field type.
		 */
		public function __construct($title = '', \Mills\HTML\Views\Element $element = null)
		{
			parent::__construct('div');
			
			$this->_label = new \Mills\HTML\Views\Label($title);
			$this->_element = $element;
		}
		
		/**
		 * label
		 *
		 * Accessor for the individual Label element.
		 *
		 * @access public
		 * @param void
		 * @return Label
		 */
		public function label()
		{
			return $this->_label;
		}
		
		/**
		 * field
		 *
		 * Accessor for the individual input field.
		 *
		 * @access public
		 * @param void
		 * @return Element
		 */
		public function field()
		{
			return $this->_element;
		}
		
		/**
		 * addChild
		 *
		 * Throws exception. Do not allow for children to be added.
		 */
		final public function addChild(\Mills\HTML\Views\Element $element)
		{
			throw new \Exception('Field elements cannot have added children in this implementation other then the label and field type.');
		}
		
		/**
		 * removeChild
		 *
		 * Throws exception. Do not allow for children to be removed.
		 */
		final public function removeChild(\Mills\HTML\Views\Element $element)
		{
			throw new \Exception('Field elements cannot have added children in this implementation other then the label and field type.');
		}
		
		/**
		 * @see Element::beforeRender
		 */
		protected function beforeRender()
		{
			/* Do not render the label if the inner text value is empty. */
			$label_val = $this->_label->text()->value();
			if( !empty($label_val) ) {
				parent::addChild($this->_label);
			}
			
			parent::addChild($this->_element);
			parent::beforeRender();
		}
	}
	
}