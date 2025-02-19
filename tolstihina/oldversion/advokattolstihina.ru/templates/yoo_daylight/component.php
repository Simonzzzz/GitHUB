<?php
/**
 * YOOtheme template
 *
 * @author yootheme.com
 * @copyright Copyright (C) 2007 - 2008 YOOtheme Ltd & Co. KG. All rights reserved.
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$template_baseurl = $this->baseurl . '/templates/' . $this->template;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
<jdoc:include type="head" />
<link rel="stylesheet" href="<?php echo $template_baseurl ?>/css/popups.css" type="text/css" />
</head>
<body class="contentpane">
	<jdoc:include type="message" />
	<jdoc:include type="component" />
</body>
</html>
