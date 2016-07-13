<?php
/**
 * @package	RokNavMenuExport
 * @version	1.3 December 19, 2009
 * @author	RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2009 RocketTheme, LLC
 * @license	http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * RokNavMenuExport uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
// Check to ensure this file is included in Joomla!
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );
jimport('joomla.filesystem.file');

/**
 * @package RokNavMenuExport
 * @subpackage Plugin
 */
class plgSystemRokNavMenuExport extends JPlugin
{
	var $_flag_file = '.export_navmenu_tmp';
	var $_guest_export_file = 'guest_joomla_menu.inc';
	var $_registered_export_file = 'reg_joomla_menu.inc';
	var $_header_export_file = 'joomla_menu_headers.inc';
	var $_session_key = 'export_ready';
	var $_session_namespace = 'roknavmenuexport';
	var $_readyToExport = false;
	var $_default_menu_params = "limit_levels=0\nstartLevel=0\nshowAllChildren=1\nclass_sfx=top\ncache=0\nmodule_cache=1";

	var $_renderMenuAfterTasks =
				array(
					'com_menus' =>
						array(
							'newItem',
							'save',
							'doCopy',
							'doMove',
							'publish',
							'unpublish',
							'orderup',
							'orderdown',
							'accesspublic',
							'accessregistered',
							'accessspecial',
							'setdefault',
							'remove',
							'doCopyMenu',
							'doDeleteMenu',
							'saveMenu',
							'addMenu',
                            'apply'
						),
					'com_plugins' =>
						array(
							'save',
							'publish'
						),
					'com_templates' =>
						array(
							'publish',
							'save'
						),
					'com_config' =>
						array(
							'save'
						)
				);


	/**
	 * Constructor
	 *
	 * For php4 compatability we must not use the __constructor as a constructor for plugins
	 * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
	 * This causes problems with cross-referencing necessary for the observer design pattern.
	 *
	 * @param	object	$subject	The object to observe
	 * @param	array	$config		An array that holds the plugin configuration
	 * @since	1.5
	 */
	function plgSystemRokNavMenuExport(& $subject, $config)
	{
		parent::__construct($subject, $config);
	}


	/**
	 * Catch the routed functions for
	 */
	function onAfterRoute() {
		global $mainframe;

		$option = JRequest::getString('option');
		if (!$mainframe->isAdmin() || !array_key_exists($option, $this->_renderMenuAfterTasks)) {
			return;
		}
		// get the task
		$task = JRequest::getString('task');

		//set if we need to export next render
		if (in_array($task, $this->_renderMenuAfterTasks[$option])) {
			$session = JFactory::getSession();
			$session->set($this->_session_key, true, $this->_session_namespace);

		}
	}

	function onAfterRender()
	{
		global $mainframe;
		$export_ready = false;

		// Are we on the admin side still?
		if ($mainframe->isAdmin()){
			$session = JFactory::getSession();
			//see if an export is needed
			if (!$session->has($this->_session_key, $this->_session_namespace)){
				return;
			}
			$export_ready = $session->get($this->_session_key, false, $this->_session_namespace);
			if(!$export_ready) {
				return;
			}
			//clear session var
			$session->clear($this->_session_key, $this->_session_namespace);

			//export needed drop the flag file for the front end
			$retval = JFile::write(JPATH_SITE.DS.$this->_flag_file, "");

			// call the front end to force the export
			$out = $this->_get_url_contents($mainframe->getSiteURL());
			return;
		}
		//are we on the the front and and is the flag file there?
		else if (!$mainframe->isAdmin() && JFile::exists(JPATH_SITE.DS.$this->_flag_file)){
			JFile::delete(JPATH_SITE.DS.$this->_flag_file);
			$document	= &JFactory::getDocument();
			$this->_cleanDocument($document);
			$output = $this->_renderModule(0, $this->params->get("highlighted_menu_item", null));
			$retval = JFile::write(JPATH_SITE.DS.$this->params->get("guest_menu_file", $this->_guest_export_file),$output);
			$output_registered = $this->_renderModule(1, $this->params->get("highlighted_menu_item", null));
			$retval = JFile::write(JPATH_SITE.DS.$this->params->get("reg_menu_file", $this->_registered_export_file), $output_registered);
			$header = $this->_renderHeader($document);
			$retval = JFile::write(JPATH_SITE.DS.$this->params->get("header_file", $this->_header_export_file), $header);
		}
	}

	/**
	 * Render the module output
	 */
	function _renderModule($check_access_level = 0, $highlighted_menu_item = null) {
        global $gantry;
		// get the params.ini from the template if its there
		global $mainframe;
		$menu = &JSite::getMenu();
		$document	= &JFactory::getDocument();
		//$this->_cleanDocument($document);
		$renderer	= $document->loadRenderer( 'module' );
		$options	 = array( 'style' => "raw" );
		$module	 = JModuleHelper::getModule( 'mod_roknavmenu' );

		// Get the information on which type of menu to work with from template params.ini
		$template = &JSite::getTemplate();
		$template_params_file = JPATH_ROOT.DS.'templates'.DS.$template.DS."params.ini";
		if (JFile::exists($template_params_file)) {
			$content = file_get_contents($template_params_file);
			$template_params = new JParameter($content);

		}

        if (!is_object($gantry)) {  // old style template
            $variable_include_file = JPATH_ROOT.DS.'templates'.DS.$template.DS."menus".DS.'menu_variables.php';


            if (JFile::exists($variable_include_file)){
                include $variable_include_file;
            }
            $menu_type 				= $template_params->get("menuType", "moomenu");
            $menu_name 				= $template_params->get("menuName", "mainmenu");
            $url_type 				= $this->params->get('url_type');

            // get the module params to pass fpr the menu type
            $menu_params_file = JPATH_ROOT.DS.'templates'.DS.$template.DS."menus".DS.$menu_type.".ini";
            $default_menu_params_file = JPATH_PLUGINS.DS.'system'.DS.'roknavmenuexport'.DS.$menu_type.".ini";
            $evaled_mpcontent = '';
            $menu_params_content = '';
            // Try the Template params
            if (JFile::exists($menu_params_file)) {
                $menu_params_content = file_get_contents($menu_params_file);
            }
            //Try the default params
            else if (JFile::exists($default_menu_params_file)) {
                $menu_params_content = file_get_contents($default_menu_params_file);
            }
            eval("\$evaled_mpcontent = \"$menu_params_content\";");
            $module->params	 = $evaled_mpcontent."\ncheck_access_level=$check_access_level\nmenutype=$menu_name\n";
        }
        else { // Gantry Template
            $prefix = 'menu-type';
            $selected_menu = $gantry->get($prefix);
            $menu_params = $gantry->getParams($prefix."-".$selected_menu, true);
            $passed_params = array("check_access_level=".$check_access_level);
            foreach($menu_params as $param_name => $param_value){
                $passed_params[] = $param_name."=".$param_value['value'];
            }
            $string_params = implode("\n", $passed_params);
            $module->params	 = &$string_params;
        }
		// Set the Active Menu Item to show
		if ($highlighted_menu_item != null) {
			$menu->setActive($highlighted_menu_item);
		}
		return $renderer->render( $module, $options );
	}

	/**
	 * Call a URL
	 */
	function _get_url_contents($url){
        $crl = curl_init();
        $timeout = 5;
        curl_setopt ($crl, CURLOPT_URL,$url);
        curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt ($crl, CURLOPT_USERAGENT,"Mozilla/4.0");
		if(!empty( $_SERVER['PHP_AUTH_USER']) && !empty($_SERVER['PHP_AUTH_PW'])){
        	curl_setopt($crl,CURLOPT_USERPWD,$_SERVER['PHP_AUTH_USER'] . ":" . $_SERVER['PHP_AUTH_PW']);
		}
        $ret = curl_exec($crl);
        curl_close($crl);
        return $ret;
	}

	function _cleanDocument(&$document) {
		$document->_style = array();
		$document->_scripts =array();
		$document->_styleSheets = array();
		$document->_script = array();

	}

    /**
	 * Generates the head html and return the results as a string
	 *
	 * @access public
	 * @return string
	 */
	function _renderHeader(&$document ) {

		// get line endings
		$lnEnd = $document->_getLineEnd();
		$tab = $document->_getTab();

		$tagEnd	= ' />';

		$strHtml = '';

		// Generate stylesheet links
		foreach ($document->_styleSheets as $strSrc => $strAttr )
		{
			$strHtml .= $tab . '<link rel="stylesheet" href="'.$strSrc.'" type="'.$strAttr['mime'].'"';
			if (!is_null($strAttr['media'])){
				$strHtml .= ' media="'.$strAttr['media'].'" ';
			}
			if ($temp = JArrayHelper::toString($strAttr['attribs'])) {
				$strHtml .= ' '.$temp;;
			}
			$strHtml .= $tagEnd.$lnEnd;
		}

		// Generate stylesheet declarations
		foreach ($document->_style as $type => $content)
		{
			$strHtml .= $tab.'<style type="'.$type.'">'.$lnEnd;

			// This is for full XHTML support.
			if ($document->_mime == 'text/html' ) {
				$strHtml .= $tab.$tab.'<!--'.$lnEnd;
			} else {
				$strHtml .= $tab.$tab.'<![CDATA['.$lnEnd;
			}

			$strHtml .= $content . $lnEnd;

			// See above note
			if ($document->_mime == 'text/html' ) {
				$strHtml .= $tab.$tab.'-->'.$lnEnd;
			} else {
				$strHtml .= $tab.$tab.']]>'.$lnEnd;
			}
			$strHtml .= $tab.'</style>'.$lnEnd;
		}

		// Generate script file links
		foreach ($document->_scripts as $strSrc => $strType) {
			$strHtml .= $tab.'<script type="'.$strType.'" src="'.$strSrc.'"></script>'.$lnEnd;
		}

		// Generate script declarations
		foreach ($document->_script as $type => $content)
		{
			$strHtml .= $tab.'<script type="'.$type.'">'.$lnEnd;

			// This is for full XHTML support.
			if ($document->_mime != 'text/html' ) {
				$strHtml .= $tab.$tab.'<![CDATA['.$lnEnd;
			}

			$strHtml .= $content.$lnEnd;

			// See above note
			if ($document->_mime != 'text/html' ) {
				$strHtml .= $tab.$tab.'// ]]>'.$lnEnd;
			}
			$strHtml .= $tab.'</script>'.$lnEnd;
		}

		return $strHtml;

	}
}