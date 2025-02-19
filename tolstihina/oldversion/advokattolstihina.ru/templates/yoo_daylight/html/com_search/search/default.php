<?php defined('_JEXEC') or die('Restricted access'); ?>

<?php

if (JRequest::getWord('type', '') == 'json' && JRequest::getWord('tmpl', '') == 'raw') :

	// include YOOsearch helper
	require_once (dirname(__FILE__).DS.'yoosearch.php');

	// set defaults
	$cat_limit  = 6;		
	$res_limit  = 6;		
	$char_limit = 100;		

	// get request var
	$search = JRequest::getString('searchword', '');
	$search = JString::strtolower($search);

	// load YOOsearch module
	$module = JModuleHelper::getModule('yoo_search');

	// search categories
	$cat_items  = array();
	if ($module) {

		// get module params
		$params	    = new JParameter($module->params);
		$cat_limit  = $params->get('cat_limit', 6);
		$res_limit  = $params->get('res_limit', 6);	
		$char_limit = $params->get('char_limit', 100);	
		
		$categories = YOOsearchHelper::getCategories($params->get('categories', ''));
		if (strlen($search) > 2 && is_array($categories)) {
			foreach ($categories as $category) {
				if (strpos($category['keywords'], $search) !== false) {
					unset($category['keywords']);
					$cat_items[] = $category;
				} 
			}
		}
	}

	// search results
	$res_items = array();
	if (!$this->error && count($this->results) > 0) {
		foreach ($this->results as $result) {
			$item          = array();
			$item['title'] = $result->title;
			$item['text']  = substr(YOOsearchHelper::stripText($result->text), 0, $char_limit);
			$item['text']  = substr_replace($item['text'], '...', strrpos($item['text'], ' '));
			$item['url']   = JRoute::_($result->href, false);
			$res_items[]   = $item;
		}
	}

	// limit result
	$cat_items = array_slice($cat_items, 0, $cat_limit);
	$res_items = array_slice($res_items, 0, $res_limit);

	echo YOOsearchHelper::encodeJson(array('categories' => $cat_items,  'results' => $res_items, 'count'=> count($this->results), 'error' => $this->error));

else :

?>

<?php if ( $this->params->get( 'show_page_title' ) ) : ?>
<div class="componentheading<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
	<?php echo $this->params->get( 'page_title' ); ?>
</div>
<?php endif; ?>

<?php echo $this->loadTemplate('form'); ?>
<?php if(!$this->error && count($this->results) > 0) :
	echo $this->loadTemplate('results');
else :
	echo $this->loadTemplate('error');
endif; ?>

<?php endif; ?>