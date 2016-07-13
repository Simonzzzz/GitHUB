<?php
/**
 * YOOLayout setup
 *
 * @author		yootheme.com
 * @copyright	Copyright (C) 2007 - 2008 YOOtheme Ltd & Co. KG. All rights reserved.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

$yootools = &YOOTools::getInstance();

// set top module variations
$yootools->setModulePosition('top-equal', array(
		1 => array('width100'),
		2 => array('width50', 'width50'),
		3 => array('width33', 'width33', 'width33'),
		4 => array('width25', 'width25', 'width25', 'width25'),
		5 => array('width20', 'width20', 'width20', 'width20', 'width20')
	));
	
$yootools->setModulePosition('top-goldenratio', array(
		1 => array('width100'),
		2 => array('width65', 'width35'),
		3 => array('width54', 'width23', 'width23'),
		4 => array('width45', 'width18', 'width18', 'width18'),
		5 => array('width40', 'width15', 'width15', 'width15', 'width15')
	));
	
// set bottom module variations
$yootools->setModulePosition('bottom-equal', array(
		1 => array('width100'),
		2 => array('width50', 'width50'),
		3 => array('width33', 'width33', 'width33'),
		4 => array('width25', 'width25', 'width25', 'width25'),
		5 => array('width20', 'width20', 'width20', 'width20', 'width20')
	));
	
$yootools->setModulePosition('bottom-goldenratio', array(
		1 => array('width100'),
		2 => array('width65', 'width35'),
		3 => array('width54', 'width23', 'width23'),
		4 => array('width45', 'width18', 'width18', 'width18'),
		5 => array('width40', 'width15', 'width15', 'width15', 'width15')
	));

// set maintop module variations
$yootools->setModulePosition('main-top-equal', array(
		1 => array('width100'),
		2 => array('width50', 'width50'),
		3 => array('width33', 'width33', 'width33')
	));
	
$yootools->setModulePosition('main-top-goldenratio', array(
		1 => array('width100'),
		2 => array('width65', 'width35'),
		3 => array('width54', 'width23', 'width23'),
	));
	
// set mainbottom module variations
$yootools->setModulePosition('main-bottom-equal', array(
		1 => array('width100'),
		2 => array('width50', 'width50'),
		3 => array('width33', 'width33', 'width33')
	));
	
$yootools->setModulePosition('main-bottom-goldenratio', array(
		1 => array('width100'),
		2 => array('width65', 'width35'),
		3 => array('width54', 'width23', 'width23'),
	));
	
// set contenttop module variations
$yootools->setModulePosition('content-top-equal', array(
		1 => array('width100'),
		2 => array('width50', 'width50'),
		3 => array('width33', 'width33', 'width33')
	));
	
$yootools->setModulePosition('content-top-goldenratio', array(
		1 => array('width100'),
		2 => array('width65', 'width35'),
		3 => array('width50', 'width25', 'width25')
	));
	
// set contentbottom module variations
$yootools->setModulePosition('content-bottom-equal', array(
		1 => array('width100'),
		2 => array('width50', 'width50'),
		3 => array('width33', 'width33', 'width33')
	));
	
$yootools->setModulePosition('content-bottom-goldenratio', array(
		1 => array('width100'),
		2 => array('width65', 'width35'),
		3 => array('width50', 'width25', 'width25')
	));

// set css-class for layoutstyle
if ($this->countModules('left')) {
	if ($this->params->get('layout') == 'left') {
		$this->params->set('leftcolumn', 'left');
	} else {
		$this->params->set('leftcolumn', 'right');
	}
}

// set css-class for rightbackground
if ($this->countModules('right') && !class_exists('JEditor')) {
	$this->params->set('rightcolumn', 'showright');
}

// set color
if ($yootools->getCurrentColor() != "default") {
	$yootools->setParam('color', $yootools->getCurrentColor());
}

// set item color (depending on active item)
$itemcolor = $yootools->getParam('item1Color', '');
if ($itemnum = $yootools->getActiveMenuItemNumber('mainmenu', 0)) {
	$itemcolor = $this->params->get('item' . $itemnum . 'Color');
}
$yootools->setParam('itemColor', $itemcolor);

// set tools color
$yootools->setParam('tools', array());

// set template url
$yootools->setParam('tplurl', $this->baseurl . '/templates/' . $this->template);

?>