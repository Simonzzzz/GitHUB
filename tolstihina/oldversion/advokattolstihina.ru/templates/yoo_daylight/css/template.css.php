<?php 

define('DS', DIRECTORY_SEPARATOR);
define('PATH_ROOT', dirname(__FILE__).DS);

// load YOOtools
require_once(dirname(dirname(__FILE__)).DS.'lib'.DS.'php'.DS.'yootools.php');

// init vars
$yootools = &YOOTools::getInstance();
$color    = $yootools->getCurrentColor();

// set response header
$yootools->setHeader('css');

// reset styling
$yootools->loadCSS(PATH_ROOT.'reset.css');

// layout styling
$yootools->loadCSS(PATH_ROOT.'layout.css');
echo $yootools->getCSS();

// general tag styling
$yootools->loadCSS(PATH_ROOT.'typography.css');

// menu styling
$yootools->loadCSS(PATH_ROOT.'menus.css');

// module styling
$yootools->loadCSS(PATH_ROOT.'modules.css');

// joomla core styling
$yootools->loadCSS(PATH_ROOT.'joomla.css');

// third party extensions styling
$yootools->loadCSS(PATH_ROOT.'extensions.css');

// color styling
if ($color != '' && $color != 'default') {
	$yootools->loadCSS(PATH_ROOT.$color.DS.$color.'-layout.css');
}

// ie browser
$is_ie7 = $yootools->isIe(7);
$is_ie6 = $yootools->isIe(6);

if ($is_ie7 || $is_ie6) {
	$yootools->loadCSS(PATH_ROOT.'iehacks.css');	
}

if ($is_ie7) {
	$yootools->loadCSS(PATH_ROOT.'ie7hacks.css');	
} else if ($is_ie6) {
	$yootools->loadCSS(PATH_ROOT.'ie6hacks.css');	
}

// custom styling
// $yootools->loadCSS(PATH_ROOT.'custom.css');

?>