<?php
/**
 * YOOtheme breadcrumbs
 *
 * @author		yootheme.com
 * @copyright	Copyright (C) 2008 YOOtheme Ltd. & Co. KG. All rights reserved.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<span class="breadcrumbs pathway">
<?php for ($i = 0; $i < $count; $i ++) :

	// clean subtitle from breadcrumb
	if ($pos = strpos($list[$i]->name, '||')) {
		$name = trim(substr($list[$i]->name, 0, $pos));
	} else {
		$name = $list[$i]->name;
	}
	
	// if not the last item in the breadcrumbs add the separator
	if ($i < $count -1) {
		if(!empty($list[$i]->link)) {
			echo '<a href="'.$list[$i]->link.'" class="pathway">'.$name.'</a>';
		} else {
			echo $name;
		}
		echo ' '.$separator.' ';
	} else { // when $i == $count -1
	    echo $name;
	}
endfor; ?>
</span>