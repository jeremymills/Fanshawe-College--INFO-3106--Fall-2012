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
     * textarea
     *
     * TextArea class to represent all <textarea /> elements.
     */
	class TextArea extends \Mills\HTML\Views\Element
	{
        /**
         * __construct
         *
         * @access public
         * @param string Contains the rows of the <textarea /> element.
		 * @param string Contains the cols of the <textarea /> element.
         * @param string Contains the name of the <textarea /> element.
         * @param string Contains the value of the <textarea /> element.
         * @return void
         */
        public function __construct($name = '', $rows = '', $cols = '', $text = '')
        {
            parent::__construct('textarea', array());
            
			$this->attrName($name);
            $this->rows($rows);
			$this->cols($cols);
			$this->_text = new \Mills\HTML\Views\Text($text);
			
			$this->template_path(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR);
			$this->template_file('textarea.tmpl.php');
        }
        
        /**
         * rows
         *
         * Accessor/setter for the rows="" attribute.
         *
         * @access public
         * @param mixed
         * @return mixed
         */
        final public function rows($value = null)
        {
            if( null === $value ) {
                return isset($this->_attributes['rows']) ? $this->_attributes['rows'] : '';
            }
            
            $this->_attributes['rows'] = $value;
            return $this;
        }
        
		/**
         * cols
         *
         * Accessor/setter for the cols="" attribute.
         *
         * @access public
         * @param mixed
         * @return mixed
         */
        final public function cols($value = null)
        {
            if( null === $value ) {
                return isset($this->_attributes['cols']) ? $this->_attributes['cols'] : '';
            }
            
            $this->_attributes['cols'] = $value;
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
                return isset($this->_attributes['name']) ? $this->_attributes['rows'] : '';
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
        
		
		
		public function text() {
			return $this->text;
		}//end text()
		
		public function addChild(\Mills\HTML\Views\Element $child) {
			throw new \Exception('Hey! You cannot use this method. The only child allowed is of type text and is handled internally. Use TextArea::text() method.');
		}
		public function removeChild(\Mills\HTML\Views\Element $child) {
			throw new \Exception('Hey! You cannot use this method. The only child allowed is of type text and is handled internally. Use TextArea::text() method.');
		}
		
		protected function beforeRender() {
		
			// We cheat here ... directly append _text onto _children without enforcing the type
			$this->_children[] = $this->_text;
			
			parent::beforeRender();
			
		}//end beforeRender()
		
		
		
		
		
        /**
         * @see Element::defaultAttribtues
         */
        protected function defaultAttributes()
        {
            return array_merge(parent::defaultAttributes(), array(
				'rows' => '',
				'cols' => ''
            ));
        }
	}
}