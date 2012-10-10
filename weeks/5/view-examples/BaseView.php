<?php

defined('IN_EXAMPLE') or exit;

require_once ROOT_PATH . 'View.php';

/* Option 2: To add variables that are available to all views
   can be done via the set_global methods. These variables are stored within a static collection. */

\McGowan\View::set_global(array(
	'var1' => 'Here is my var',
	'var2' => 'Here is my second variable',
	'var3' => 'Here is my third variable! Yay!'
));

class BaseView extends \McGowan\View {

	public function __construct($filename) {
		parent::__construct();
		
		$this->template_path(ROOT_PATH . 'templates');
		$this->template_file($filename);
		
		/* Option 1: To add variables available to all views can be done via
		   a base view class like this that your view classes are derived from. */
		/*
		$this->set(array(
			'var1' => 'Here is my var',
			'var2' => 'Here is my second variable',
			'var3' => 'Here is my third variable! Yay!'
		));
		*/
	}

}