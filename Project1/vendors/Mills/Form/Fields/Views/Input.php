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
     * Input
     *
     * Abstract class to represent all <input /> elements.
     */
	abstract class Input extends \Mills\HTML\Views\Element
	{
        /**
         * __construct
         *
         * @access public
         * @param string Contains the type of the <input /> element.
         * @param string Contains the name of the <input /> element.
         * @param string Contains the value of the <input /> element.
         * @return void
         */
        public function __construct($type = '', $name = '', $value = '')
        {
            parent::__construct('input', array());
            
            $this->type($type);
            $this->value($value);
            $this->attrName($name);
        }
        
        /**
         * type
         *
         * Accessor/setter for the type="" attribute.
         *
         * @access public
         * @param mixed
         * @return mixed
         */
        final public function type($value = null)
        {
            if( null === $value ) {
                return isset($this->_attributes['type']) ? $this->_attributes['type'] : '';
            }
            
            $this->_attributes['type'] = $value;
            return $this;
        }
        
        /**
         * attrName
         *
         * Accessor/setter for the name="" attribute.
         *
         * @access public
         * @param mixed
         * @return mixed
         */
        final public function attrName($value = null)
        {
            if( null === $value ) {
                return isset($this->_attributes['name']) ? $this->_attributes['type'] : '';
            }
            
            $this->_attributes['name'] = trim($value);
            return $this;
        }
        
        /**
         * value
         *
         * Accessor/setter for the value="" attribute.
         *
         * @access public
         * @param mixed
         * @return mixed
         */
        final public function value($value = null)
        {
            if( null === $value ) {
                return isset($this->_attributes['value']) ? $this->_attributes['value'] : '';
            }
            
            $this->_attributes['value'] = $value;
            return $this;
        }
        
        /**
         * @see Element::defaultAttribtues
         */
        protected function defaultAttributes()
        {
            return array_merge(parent::defaultAttributes(), array(
                'type' => '',
                'name' => '',
                'value' => ''
            ));
        }
	}
}