<?php

defined('IN_EXAMPLE') or exit;

require_once ROOT_PATH . 'BaseView.php';

class ElementView extends BaseView {
	protected $_name;
	protected $_attrs = array();
	protected $_inner = '';

	public function __construct($name) {
		parent::__construct('element.tmpl.php');
		$this->_name = $name;
	}
	
	public function name($name = null) {
		if( null === $name ) {
			return $this->_name;
		}
		
		$this->_name = $name;
		return $this;
	}
	
	public function attrs(array $attrs = null) {
		if( null === $attrs ) {
			return $this->_attrs;
		}
		
		$this->_attrs = $attrs;
		return $this;
	}
	
	public function attr($attr, $val = null, $default = null) {
		if( null === $val ) {
			return isset($this->_attrs[$attr]) ? $this->_attr[$attr] : $default;
		}
		
		$this->_attrs[$attr] = $val;
		return $this;
	}
	
	public function inner($val = null) {
		if( null === $val ) {
			return $this->_inner;
		}
		
		$this->_inner = $val;
		return $this;
	}
	
	public function render_attrs() {
		if( empty($this->_attrs) ) {
			return;
		}
		
		$attrs = '';
		foreach( $this->_attrs as $name => $value ) {
			$attrs .= ' ' . $name . '="' . $value . '"';
		}
		
		print $attrs;
	}
}