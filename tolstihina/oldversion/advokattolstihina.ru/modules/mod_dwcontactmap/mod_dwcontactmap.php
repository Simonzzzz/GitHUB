<?php
/**
 * Google Map for Joomla! contacts
 * 
 * @category   Contacts
 * @package    DWContactMap
 * @author     Ilya Vikharev {@link http://factory.docwriter.ru}
 * @copyright  2009 DocWriter.Ru
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.00.0002
 * @link       http://factory.docwriter.ru
 * @since      File available since Release 1.00
 */
 
//--No direct access
defined('_JEXEC') or die('Direct access to this location is not allowed.');

// include the helper file
require_once(dirname(__FILE__) . DS . 'helper.php');

// include the template for display
require(JModuleHelper::getLayoutPath('mod_dwcontactmap'));