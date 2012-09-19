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

}