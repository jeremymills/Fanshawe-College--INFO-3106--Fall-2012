<?php

defined('IN_EXAMPLE') or exit;

require_once ROOT_PATH . 'View.php';

class BaseView extends \McGowan\View {

	public function __construct($filename) {
		parent::__construct();
		
		$this->template_path(ROOT_PATH . 'templates');
		$this->template_file($filename);
	}

}