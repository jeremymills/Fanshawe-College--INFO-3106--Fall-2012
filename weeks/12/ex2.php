<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);

$serArray = 'a:4:{i:0;s:2:"hi";i:1;s:5:"hello";i:2;s:3:"bye";i:3;s:7:"buh bye";}';

print '$serArray = ' . $serArray . '<br />';

$array = unserialize($serArray);

print '$array = ' . print_r( $array, true ) . '<br />';

//PSA - store serialized file array for specific file being attached