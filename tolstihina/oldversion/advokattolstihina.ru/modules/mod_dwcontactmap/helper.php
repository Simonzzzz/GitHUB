<?php
/**
 * Google Map for Joomla! contacts
 * 
 * @category   Contacts
 * @package    DWContactMap
 * @author     Ilya Vikharev {@link http://factory.docwriter.ru}
 * @copyright  2009 DocWriter.Ru
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.02.0003
 * @link       http://factory.docwriter.ru
 * @since      File available since Release 1.00
 */
 
//--No direct access
defined('_JEXEC') or die('Direct access to this location is not allowed.');

/**
 * Helper class for DWContactMap
 */
class ModDWContactMapHelper {
    
    /**
     * Check if current page is contact details page.
     * @return boolean
     */
    function isContact () {
    
        $result = null;
        
        $result = (JRequest::getVar('option') == 'com_contact')
                   && (JRequest::getVar('view') == 'contact');
        
        return $result;
    } // end isContact
    
    /**
     * Returns Event List item ID from request data.
     * @return integer Event List item ID
     */
    function getContactId () {
        
        $result = null;
        
        if (self::isContact()) {
            $result = JRequest::getInt('id');
        }
        
        return $result;
    } // end getContactId
    
    /**
     * Retruns contact address string as "<Street addr> <City>
     * <State> <Country>".
     * @param int $contactId event ID for current page
     * @param string &$row reference to data object
     * @return integer
     */
    function getContactAddress($contactId) {
    
        $result = null;
        
        if (self::isContact()) {
            $row = self::_getContactRecord($contactId);
            
            $result = "{$row->address} {$row->suburb} {$row->state} {$row->country}";
        }
        
        return $result;
    } // end getContactAddress
    
    /**
     * Returns contact data.
     * @param integer $contactId Contact ID
     * @return object contact data item
     */
    function _getContactRecord ($contactId) {
        
        $result = null;
    
        // get a reference to the database
        $db = &JFactory::getDBO();
 
        // Get event data
        $query = "SELECT `address`, `suburb`, `state`, `country` FROM `#__contact_details` WHERE `id` = '$contactId'";
        $db->setQuery($query);
        $result = $db->loadObject();
        
        return $result;
    } // end _getContactRecord
    
    /**
     * Returns Google Maps ID from EventList settings.
     * @return string Google Maps ID
     */
    function getGmapID () {
        
        return $result;
    } // end getGmapID
    
} //end ModDWContactMapHelper