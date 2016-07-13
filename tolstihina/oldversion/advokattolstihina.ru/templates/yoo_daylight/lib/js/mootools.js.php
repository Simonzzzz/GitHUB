<?php 

define('DS', DIRECTORY_SEPARATOR);
define('PATH_ROOT', dirname(__FILE__).DS);

// load YOOtools
require_once(dirname(dirname(__FILE__)).DS.'php'.DS.'yootools.php');

// init vars
$yootools = &YOOTools::getInstance();

// set response header
$yootools->setHeader('js');

// mootools
include(PATH_ROOT.'mootools/mootools-release-1.11.js');

?>