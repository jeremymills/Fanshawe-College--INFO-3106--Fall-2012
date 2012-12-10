<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

/*Serialization - In simple terms, it is sorting "data" in a string form allowing
for it to persiste and be re-used at a later date and time without full 
re-construction/initializing */

class MyClass implements Serializable{
    public $_public = 1;
    protected $_protected = 2;
    private $_private = 3;
    
    public function serialize(){
        $data = array('public' => $this->_public, 'private' => $this->_private);
        return serialize($data);
    }
    
    public function unserialize($serData){
        $data = unserialize($serData);
        $this->_public = $data['public'];
        $this->_private = $data['private'];
    }
}

$o = new MyClass();

print 'serialized object: ' . serialize($o);