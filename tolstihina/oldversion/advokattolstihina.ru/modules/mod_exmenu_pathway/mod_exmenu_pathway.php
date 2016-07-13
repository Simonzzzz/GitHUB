<?php
/**
* @version 1.0.1
* @author Daniel Ecer (CSS modifications)
* @package exmenu_pathway_1.0.1
* @copyright (C) 2005-2006 Daniel Ecer (de.siteof.de)
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Notice: some parts are based on the default mainmenu module.
* Beside this it were havily redesigned to separate module from view (though no template engine is used but each view could of course). 
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// requested module allows to include other modules without immediately displaying them
if (!isset($requestedModule)) {
	$requestedModule	= 'exmenu_pathway';
}

if (!defined( '_EXTENDED_MENU_PATHWAY_INCLUDED_' )) {
	/** ensure that functions are declared only once */
	define( '_EXTENDED_MENU_PATHWAY_INCLUDED_', 1 );

	/** we use classes/constants of the Extended Menu */
	if (!defined('EXTENDED_MENU_HOME')) {
		define('EXTENDED_MENU_HOME', dirname(__FILE__).'/exmenu');
	}
	if (file_exists(constant('EXTENDED_MENU_HOME').'/exmenu.class.php')) {
		require_once(constant('EXTENDED_MENU_HOME').'/exmenu.class.php');
	}

	class ExtendedMenuPathwayModule {
		
		var $params;
		var $parseAccessKeys;
		var $modulePosition;
		var $classSuffix;
		var $hideFirst;
		var $pathwayStyle;

		function showModule(&$params) {
			$instance					=& new ExtendedMenuPathwayModule();
			$instance->init($params);
			echo $instance->renderAsString();
		}
		
		function init(&$params) {
			$this->params			=& $params;
			$params->def('pathway_module_position', '');
			$params->def('parse_access_key', (defined('EXTENDED_MENU_ACCESS_KEYS_STRIP_MARKUP') ? constant('EXTENDED_MENU_ACCESS_KEYS_STRIP_MARKUP') : 0));
			$this->modulePosition	= $params->get('pathway_module_position');
			$this->parseAccessKeys	= $params->get('parse_access_key');
			$this->classSuffix		= $params->get('class_sfx', '');
			$this->pathwayStyle		= $params->get('pathway_style', '');
			$this->hideFirst		= intval($params->get('hide_first', '0')) == 1;
		}
		
		function _processPathwayOutput($output) {
			if (class_exists('ExtendedMenuLoaderFactory')) {
				$menuLoader						=& ExtendedMenuLoaderFactory::getNewMenuLoader('');
			} else if (class_exists('MenuLoader')) {
				$menuLoader						=& new MenuLoader();
			} else {
				return $output;		// extended menu not available
			}
			$a = preg_split('((>)|(<))', $output, -1, PREG_SPLIT_DELIM_CAPTURE);
			$ignoreNext	= FALSE;
			foreach(array_keys($a) as $k) {
				if (($ignoreNext) || ($a[$k] == '<')) {
					$ignoreNext	= !$ignoreNext;
					continue;
				}
				$menuLoader->parseAccessKey($a[$k], $this->parseAccessKeys);
			}
			return join('', $a);
		}
		
		function parsePathwayOutput($output) {
			$matches	= array();
			$result		= array();
			$output		= preg_replace('#<span class="pathway">(.*)</span>#s', '\1', $output);
			$pattern	= '#(<img.*?\>)|(<a.*?<\/a>)|([^<>]*)#s';
			if (preg_match_all($pattern, $output, $matches)) {
				foreach($matches[0] as $match) {
					$match	= trim($match);
					if (($match != '') && (strpos($match, '<img') !== 0)) {
						$result[]	= $match;
					}
				}
			}
			return $result;
		}
		
		function getFlatListPathway($pathwayList) {
			$result	= '<ul class="pathway'.$this->classSuffix.'">';
			foreach($pathwayList as $entry) {
				$result	.= '<li>';
				$result	.= str_replace('&amp;amp;', '&amp;', ampReplace($entry));
				$result	.= '</li>';
			}
			$result	.= '</ul>';
			return $result;
		}
		
		function getDefaultHtmlPathway($pathwayList) {
			global $mosConfig_absolute_path, $mosConfig_live_site, $mainframe;
			$imgPath		=  'templates/'.$mainframe->getTemplate().'/images/arrow.png';
			if (file_exists($mosConfig_absolute_path.'/'.$imgPath)) {
				$separator	= '<img src="'.$mosConfig_live_site.'/'.$imgPath.'" border="0" alt="arrow" />';
			} else {
				$separator		= 'images/M_images/arrow.png';
				if (file_exists($mosConfig_absolute_path.'/'.$imgPath)){
					$separator		= '<img src="'.$mosConfig_live_site.'/'.$imgPath.'" alt="arrow" />';
				} else {
					$separator		= '&gt;';
				}
			}
			$separator		= ' '.$separator.' ';
			$result		= '<span class="pathway'.$this->classSuffix.'">';
			$isFirst		= TRUE;
			foreach($pathwayList as $entry) {
				if ($isFirst) {
					$isFirst		= FALSE;
				} else {
					$result	.= $separator;
				}
				$result	.= str_replace('&amp;amp;', '&amp;', ampReplace($entry));
			}
			$result	.= '</span>';
			return $result;
		}
		
		function renderAsString() {
			ob_start();
			if ($this->modulePosition != '') {
				mosLoadModules($this->modulePosition, -1);
			} else {
				mosPathway();
			}
			$result	= ob_get_contents();
			ob_end_clean();
			if ($this->parseAccessKeys > 0) {
				$result	= $this->_processPathwayOutput($result);
			}
			if (($this->pathwayStyle != '') && ($this->pathwayStyle != 'unchanged')) {
				$list	= $this->parsePathwayOutput($result);
				if (($this->hideFirst) && (count($list) > 0)) {
					array_shift($list);
				}
				switch($this->pathwayStyle) {
					case 'list_flat':
						$result	= $this->getFlatListPathway($list);
						break;
					case 'default_html':
						$result	= $this->getDefaultHtmlPathway($list);
						break;
				}
			}
			return $result;
		}
	}

}

if ((isset($params)) && ($requestedModule == 'exmenu_pathway')) {
	ExtendedMenuPathwayModule::showModule($params);
}

?>