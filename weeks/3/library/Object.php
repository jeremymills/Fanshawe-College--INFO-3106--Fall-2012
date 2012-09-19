<?php

defined('IN_APPLICATION') or exit;

class Object {
	public function toString() {
		return get_called_class() . '[' . spl_object_hash($this) . ']';
	}

	final public function __toString() {
		return $this->toString();
	}
	
}