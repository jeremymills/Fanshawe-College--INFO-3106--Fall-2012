<?php

defined('IN_APPLICATION') or exit;

abstract class Shape extends Object {

	public function __construct() {
	
	}

	abstract public function getName();
	abstract public function getNumberOfSides();
		
	public function toString() {
		return $this->getName() . '[Sides ' . $this->getNumberOfSides() . ']';
	}
	
}