<?php

defined('IN_EXAMPLE') or die('You do not have access');

require_once ROOT_PATH . 'BaseView.php';

class MyView extends BaseView {
	
	public function __construct() {
		parent::__construct('my-view.tmpl.php');
	}
	
	public function my_method() {
		return __METHOD__;
	}
	
}