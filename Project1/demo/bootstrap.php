<?php
/* Define header guard */
defined('IN_DEMO') or exit;

/* Turn error reporting on to the highest level */
ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

/* Define the absolute path to the library */
define('LIBRARY_PATH', realpath('../') . DIRECTORY_SEPARATOR . 'vendors' . DIRECTORY_SEPARATOR);

/* Include the library bootstrap */
require_once LIBRARY_PATH . 'bootstrap.php';

/* Add our includes directory to the autoloader lookup */
$autoloader->addIncludePath(ROOT_PATH . 'includes');