<?php

defined('IN_APPLICATION') or exit;
require_once 'Shape.php';

class Square extends Shape {
	public function __construct() {
		parent::__construct();
	}
	
	public function getName() {
		return 'Square';
	}
	
	public function getNumberOfSides() {
		return 4;
	}
	
	public function setDimensions(array $dimensions) {
		$dimensions_count = count($dimensions);
		
		if( 0 == $dimensions_count ) {
			throw new Exception('Cannot have empty array of dimensions when setting.');
		}
		if( 1 === $dimensions_count ) {
		  for( $i = 0; $i < $this->getNumberOfDimensions(); ++$i ) {
			$this->_dimensions[] = $dimensions[0];
			}
		}
		else if( 4 === $dimensions_count ) {
			$value = $dimensions[0];
			for ($i = 1; $i < $this->getNumberOfDimensions(); ++$i) {
				if( $value !== $dimensions[$i] ) {
				throw new Exception('All sides of a square must have identical lengths.');
				}
			}
			$this->_dimensions = $dimensions;
		}
		else {
			throw new Exception('You must specify one or all four side dimensions of the square.');
		}
		
	}

}