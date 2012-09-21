<?php

defined('IN_APPLICATION') or exit;

abstract class Shape extends Object {
	protected $_dimensions = null;

	public function __construct(array $dimensions) {
		$this->setDimensions($dimensions);
	}

	abstract public function getName();
	abstract public function getNumberOfSides();
	
	/**
	 * set Dimensions
	 * 
	 * Modifies the current dimensions array.
	 * Dimensions should be stored so that the "top" or the first element
	 * is the first right dimension.
	 *
	 * Example: Given this -> array(10, 10, 10, 10) and class is type Square,
	 * each four sides must have the same length. Element at position 0 = top.
	 *
	 * Example: Given this - > array(4, 6, 3) and class type is Triangle,
	 * the first right side of the triangle is element at position 0 = 4.
	 *
	 * @access public
	 * @param array Contains the new dimensions to set.
	 * @return array Returns old dimensions if set.
	 */
	
	abstract public function setDimensions(array $dimensions);
		
	final public function getDimensions() {
		return $this->_dimensions;
	}
	
	final public function getNumberOfDimensions() {
		return $this->getNumberOfSides();
	}
	
	public function toString() {
		return $this->getName() . ' [Sides ' . $this->getNumberOfSides() . ']';
	}
	
}