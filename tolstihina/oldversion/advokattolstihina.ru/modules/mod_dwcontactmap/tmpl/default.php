<?php
/**
 * Google Map for Joomla! contacts
 * 
 * @category   Contacts
 * @package    DWContactMap
 * @author     Ilya Vikharev {@link http://factory.docwriter.ru}
 * @copyright  2009-2010 DocWriter.Ru
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.03.0004
 * @link       http://factory.docwriter.ru
 * @since      File available since Release 1.00
 */
 
//--No direct access
defined('_JEXEC') or die('Direct access to this location is not allowed.');


?>
<div>
<?php if (ModDWContactMapHelper::isContact() and $params->get('gmap_id')) :?>
<?php
    $contactAddress = 
        str_replace("'", '',
                    ModDWContactMapHelper::getContactAddress(
                        ModDWContactMapHelper::getContactId()
                    ));
?>
<?php
    $document =& JFactory::getDocument();
    $document->addScript('http://maps.google.com/maps?file=api&amp;v=2&amp;key='
                         . $params->get('gmap_id'));
    
    $styles = $params->get('canvas_style');
    if ($styles != '') $styleString = "; $styles";
    
    $script = "
    var map = null;
    var geocoder = null;

    function initialize() {
      if (GBrowserIsCompatible()) {
        map = new GMap2(document.getElementById('dwcm_map_canvas'));
        geocoder = new GClientGeocoder();
        geocoder.getLatLng(
            '$contactAddress',
            function(point) {
                if (point) {
                    map.setCenter(point, 13);
                    var marker = new GMarker(point);
                    map.addOverlay(marker);
                    map.enableScrollWheelZoom();
                }
            }
        );
      }
    }
";
    $document->addScriptDeclaration($script);
?>
    <div id="dwcm_map_canvas" style="width: 100%; 
        height: <?php echo $params->get('height', 250); ?>px
        <?php echo $styleString?>">
        <p>
            <?php echo
                JText::sprintf('Google Map for %s goes here.', $contactAddress);
            ?>
        </p>
        <noscript>
            <p>
                <?php echo
                    JText::sprintf('JS_ALERT_MSG');
                ?>
            </p>
        </noscript>
    </div>
    <script type="text/javascript">//<![CDATA[
        initialize();
    //]]>
    </script>
<?php else :?>
    <p><?php echo JText::_('No map for this page.'); ?></p>
<?php endif;?>
</div>