<?php

defined('IN_APPLICATION') or exit;
require_once 'Shape.php';

class Triangle extends Shape {
	public function __construct() {
		parent::__construct();
	}
	
	public function getName() {
		return 'Triangle';
	}
	
	public function getNumberOfSides() {
		return 3;
	}

}