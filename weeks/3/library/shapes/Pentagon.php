<?php

defined('IN_APPLICATION') or exit;
require_once 'Shape.php';

class Pentagon extends Shape {
	public function __construct() {
		parent::__construct();
	}
	
	public function getName() {
		return 'Pentagon';
	}
	
	public function getNumberOfSides() {
		return 5;
	}

}