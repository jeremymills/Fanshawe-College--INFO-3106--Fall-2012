<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

$array = array('hi', 'hello', 'bye', 'buh bye');

print '$array = ' . print_r($array, true) . '<br />';

$serArray = serialize($array);

print '$serArray = ' . $serArray . '<br />';