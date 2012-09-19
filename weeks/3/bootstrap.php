<?php
//ALWAYS include next two lines!!
ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

defined('IN_APPLICATION') or exit;

require_once 'library/Object.php';
/* include shape files, No need to include 
shape.php as it is included in these files */
require_once 'library/shapes/Square.php';
require_once 'library/shapes/Triangle.php';
require_once 'library/shapes/Pentagon.php';
