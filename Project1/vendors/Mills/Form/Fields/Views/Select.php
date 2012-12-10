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
     * Select
     *
     * Abstract class to represent all <Select /> elements.
     */
	class Select extends \Mills\HTML\Views\Element
	{
        /**
         * __construct
         *
         * @access public
         * @param string Contains the name of the <Select /> element.
         * @param array Contains an array of Option element to be used as children.
         * @return void
         */
        public function __construct($name = '', array $option = array() ) {
            
			parent::__construct('select');

            $this->attrName($name);
			
			foreach( $option as $option ) {
				$this->addChild($option);
			}//end foreach()
        }//end __construct()
		
		public function addChild(\Mills\HTML\Views\Element $option) {
		
			if( !($option instanceof Option) ) {
				throw new \Exception('You can only add children of type Option');
			}
			return parent::addChild($option);
			
		}//end addChild()
		public function removeChild(\Mills\HTML\Views\Element $option) {
			
			if( !($option instanceof Option) ) {
				throw new \Exception('Only children of type Option exist, therefore, you cannot remove the specified type');
			}
			return parent::removeChild($option);
			
		}//end removeChild()
        
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
        }//end attrName()
        
        /**
         * @see Element::defaultAttribtues
         */
        protected function defaultAttributes()
        {
            return array_merge(parent::defaultAttributes(), array(
                'name' => '',
				'size' => '',
				'multiple' => '',
				'autofocus' => '',
				'disabled' => '',
				'form' => ''
            ));
        }//end defaultAttributes()
	}//class
}//end namespace