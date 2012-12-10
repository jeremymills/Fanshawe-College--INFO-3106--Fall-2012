<?php

define('IN_LIBRARY', true);

define('LIBRARY_ROOT_PATH', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
define('LIBRARY_PHPEXT', '.php');

if( !defined('LIBRARY_IGNORE_AUTOLOAD') ) {
    require_once LIBRARY_ROOT_PATH . 'SplLoader' . LIBRARY_PHPEXT;
    $autoloader = new SplLoader(
		DIRECTORY_SEPARATOR,
		LIBRARY_PHPEXT,
		'\\',
		array(LIBRARY_ROOT_PATH)
	);
}