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
	 * Element
	 *
	 * Used to represent any HTML element.
	 */
	class Element extends \Mills\View
	{
		protected $_name = '';
		protected $_attributes = array();
		protected $_is_empty = false;
		protected $_children = array();
	
		/**
		 * __construct
		 *
		 * @access public
		 * @param array
		 * @return void
		 */
		public function __construct($name = '', array $data = array())
		{
			parent::__construct(null, $data);
			
			$this->template_path(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR);
			$this->template_file('element.tmpl.php');
			
			$this->_attributes = $this->defaultAttributes();
			
			$this->name($name);
		}
		
		/**
		 * name
		 *
		 * Accessor/setter for the element name.
		 * Ex: <{element name goes here} /> => <input />
		 *
		 * @access public
		 * @param mixed
		 * @return mixed
		 */
		final public function name($value = null)
		{
			if( null === $value )
			{
				return $this->_name;
			}
			
			$this->_name = trim($value);
			return $this;
		}
		
		/**
		 * isEmpty
		 *
		 * Accessor/setter method for the is empty property. Used to determine
		 * whether or not this element, when rendered, is a closed element with no children (ex: <input />)
		 * or has children and not empty (ex: <select> <option> ... </option> </select> ).
		 *
		 * @access public
		 * @param mixed
		 * @return mixed
		 */
		final public function isEmpty($value = null)
		{
			if( null === $value ) {
				return $this->_is_empty;
			}
			
			$this->_is_empty = (bool) $value;
			return $this;
		}
		
		/**
		 * addChild
		 * 
		 * @access public
		 * @param Element Contains the element object to add.
		 * @return bool
		 */
		public function addChild(Element $child)
		{
			$this->_children[] = $child;
			return $this;
		}
		
		/**
		 * removeChild
		 * 
		 * @access public
		 * @param Element Contains the element object to remove.
		 * @return bool
		 */
		public function removeChild(Element $child)
		{
			if( false !== ($key = array_search($child, $this->_children)) )
			{
				unset($this->_children[$key]);
				return true;
			}
			
			return false;
		}
		
		/**
		 * hasChildren
		 *
		 * Tests if this element has children or not.
		 *
		 * @access public
		 * @param void
		 * @return bool
		 */
		final public function hasChildren()
		{
			return !$this->isEmpty() && !empty($this->_children);
		}
		
		/**
		 * children
		 *
		 * Accessor for the array of child elements.
		 *
		 * @access public
		 * @param void
		 * @return array
		 */
		final public function children()
		{
			return $this->_children;
		}
		
		/**
		 * attr
		 *
		 * Accessor/setter for a single attribute for this element.
		 *
		 * @access public
		 * @param string Contains the attribute name.
		 * @param mixed
		 * @return mixed
		 */
		public function attr($attr, $value = null)
		{
			if( null === $value )
			{
				return isset($this->_attributes[$attr]) ? $this->_attributes[$attr] : null;
			}
			
			$this->_attributes[$attr] = $value;
			return $this;
		}
		
		/**
		 * @see View::beforeRender
		 */
		protected function beforeRender()
		{
			/* Build the string of attributes */
			$attributes = array();
			foreach( $this->_attributes as $name => $value ) {
				if( empty($value) ) {
					continue;
				}
				
				if( is_array($value) ) {
					$value = implode(' ', $value);
				}
				
				$attributes[] = $name . '="' . $value . '"';
			}
			$attributes = implode(' ', $attributes);
			
			/* Create the variable attributes for our element.tmpl.php */
			$this->set('attributes', $attributes);
		}
		
		/**
		 * defaultAttributes
		 *
		 * Returns an array of default attributes available for this
		 * element.
		 *
		 * @access protected
		 * @param void
		 * @return array
		 */
		protected function defaultAttributes()
		{
			return array(
				'id' 	=> '',
				'class' => array(),
				'style' => '',
				'title' => ''
			);
		}
	}
}