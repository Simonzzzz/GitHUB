<?php 

define('DS', DIRECTORY_SEPARATOR);
define('PATH_ROOT', dirname(__FILE__).DS);

// load YOOtools
require_once(dirname(dirname(__FILE__)).DS.'php'.DS.'yootools.php');

// init vars
$yootools = &YOOTools::getInstance();

// set response header
$yootools->setHeader('js');

// load js
include(PATH_ROOT.'addons/base.js');
include(PATH_ROOT.'addons/accordionmenu.js');
include(PATH_ROOT.'addons/fancymenu.js');
include(PATH_ROOT.'addons/dropdownmenu.js');
include(PATH_ROOT.'yoo_tools.js');

?>