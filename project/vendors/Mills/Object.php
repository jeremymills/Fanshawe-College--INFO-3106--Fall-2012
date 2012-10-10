<?php
/**
 * Mills
 */
namespace Mills
{
    /**
     * @ignore
     */
    defined('IN_LIBRARY') or exit;
    
    /**
     * Object
     */
    class Object
    {
        final public function __toString()
        {
            return $this->toString();
        }
        
        public function toString()
        {
            return sprintf('%1$s [%2$s]', get_class($this), spl_object_hash($this));
        }
    }
}