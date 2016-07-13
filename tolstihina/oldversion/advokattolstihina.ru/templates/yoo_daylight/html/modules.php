<?php
/**
* YOOtheme module chrome
*
* @author    yootheme.com
* @copyright Copyright (C) 2007 YOOtheme Ltd. & Co. KG. All rights reserved.
* @license	 GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

/*
 * Module chrome for rendering yoo module
 */
function modChrome_yoo($module, &$params, &$attribs) {
	
	// init vars
	$id        = $module->id;
	$position  = $module->position;
	$showtitle = $module->showtitle;
	$content   = $module->content;
	$suffix    = $params->get('moduleclass_sfx', '');
	$order     = isset($attribs['order']) ? intval($attribs['order']) : null;
	$badge     = '';
	$color     = '';

	// create title
	$pos   = JString::strpos($module->title, ' ');
	$title = ($pos !== false) ? JString::substr($module->title, 0, $pos).'<span class="color">'.JString::substr($module->title, $pos).'</span>' : $module->title;

	// preserve module content, to fix current joomla 1.5.3 issue
    static $mod_content = array();
	isset($mod_content[$id]) ? $content = $mod_content[$id] : $mod_content[$id] = $content;
	
	// only render module if order is matching
	if ($order !== null) {
		$modules =& JModuleHelper::getModules($position);
		if (!(isset($modules[$order]) && $modules[$order]->id == $id)) {
			return;
		}
	}

	// set badge if exists
	$suffix = ereg_replace(' +',' ', $suffix); // trim all whitespaces
	$split = explode(' ', $suffix);
	$suffix = $split[0];
	if (count($split) == 2) {
		$badge = "badge-" . $split[1];
	}

	// set default module types
	if ($suffix == '') {
		if ($module->position == 'top') $suffix = 'transwhite';
		if (($module->position == 'top-equal') || ($module->position == 'top-goldenratio')) $suffix = 'transwhite';
		if ($module->position == 'left') $suffix = 'paper';
		if ($module->position == 'right') $suffix = 'dotted';
		if (($module->position == 'main-top-equal') || ($module->position == 'main-top-goldenratio')) $suffix = 'border';
		if (($module->position == 'content-top-equal') || ($module->position == 'content-top-goldenratio')) $suffix = 'border';
		if (($module->position == 'content-bottom-equal') || ($module->position == 'content-bottom-goldenratio')) $suffix = 'border';
		if (($module->position == 'main-bottom-equal') || ($module->position == 'main-bottom-goldenratio')) $suffix = 'border';
		if (($module->position == 'bottom-equal') || ($module->position == 'bottom-goldenratio')) $suffix = 'transblack';
		if ($module->position == 'bottom') $suffix = 'transblack';
	}

	// force module type
	if ($module->position == 'header')  $suffix = 'blank';
	if ($module->position == 'toolbar') $suffix = 'blank';

	// legacy compatibility
	if ($suffix == '-blank') $suffix = 'blank';
	if ($suffix == '_menu')  $suffix = 'menu';

	// set module skeleton using the suffix
	switch ($suffix) {
	
		case 'transwhite':
			$skeleton = '1-3c-1';
			$suffix   = 'mod-' . $suffix;
			break;
	
		case 'transblack':
			$skeleton = '1-3c-1';
			$suffix   = 'mod-' . $suffix;
			break;
	
		case 'border':
			$skeleton = '1-div-e';
			$suffix   = 'mod-' . $suffix;
			break;
	
		case 'dotted':
			$skeleton = '1-div-e';
			$suffix   = 'mod-' . $suffix;
			break;
			
		case 'paper':
			$skeleton = '0-3-3';
			$suffix   = 'mod-' . $suffix;
			break;

		case 'postit':
			$skeleton = '0-3-3';
			$suffix   = 'mod-' . $suffix;
			break;
			
		case 'polaroid':
			$skeleton = '0-3ne-3';
			$suffix   = 'mod-' . $suffix;
			break;
			
		case 'menu':
			$suffix = ($module->position == 'right') ? "mod-dotted" : "mod-paper";
			$skeleton = '0-3-3';
			$suffix   = $suffix . ' mod-menu';
			break;

		case 'blank':
			$suffix   = 'mod-blank';
			
		default:
			$skeleton = 'not defined';
	}

	// output module
	switch ($skeleton) {
		case '3c-3c-3c':
			/*
			 * module skeleton with 3-3-3 div structure wrapped in containers
			 */
			?>
			<div class="<?php echo $suffix; ?>">
				<div class="module">
					<?php if ($badge != '') : ?>
						<div class="<?php echo $badge ?>"></div>
					<?php endif; ?>
					<div class="module-container-t">
						<div class="module-tl"></div>
						<div class="module-tr"></div>
						<div class="module-t"></div>
					</div>
					
					<div class="module-l">
						<div class="module-l-ie6"></div>
						<div class="module-r-ie6"></div>
						<div class="module-r">
							<div class="module-m deepest">
								<div class="ie6">
									<?php if ($showtitle) : ?>
									<h3 class="module"><span class="module-2"><span class="module-3"><?php echo $title; ?></span></span></h3>
									<?php endif; ?>
									<?php echo $content; ?>
								</div>
							</div>
						</div>
					</div>
						
					<div class="module-container-b">
						<div class="module-bl"></div>
						<div class="module-br"></div>
						<div class="module-b"></div>
					</div>
				</div>
			</div>
			<?php 
			break;
			
		case '3c-1c-3c':
			/*
			 * module skeleton with 3-1-3 div structure wrapped in containers
			 */
			?>
			<div class="<?php echo $suffix; ?>">
				<div class="module">
					<div class="module-container-t">
						<div class="module-tl"></div>
						<div class="module-tr"></div>
						<div class="module-t"></div>
					</div>
					
					<div class="module-container-m">
						<div class="module-m deepest">
							<div class="ie6">
								<?php if ($showtitle) : ?>
								<h3 class="module"><span class="module-2"><span class="module-3"><?php echo $title; ?></span></span></h3>
								<?php endif; ?>
								<?php echo $content; ?>
							</div>
						</div>
					</div>
						
					<div class="module-container-b">
						<div class="module-bl"></div>
						<div class="module-br"></div>
						<div class="module-b"></div>
					</div>
				</div>
			</div>
			<?php 
			break;

		case '3c-1-3c':
			/*
			 * module skeleton with 3-1-3 div structure wrapped in containers
			 */
			?>
			<div class="<?php echo $suffix; ?>">
				<div class="module">
					<?php if ($badge != '') : ?>
						<div class="<?php echo $badge ?>"></div>
					<?php endif; ?>
				
					<div class="module-container-t">
						<div class="module-tl"></div>
						<div class="module-tr"></div>
						<div class="module-t"></div>
					</div>

					<div class="module-m deepest">
						<?php if ($showtitle) : ?>
						<h3 class="module"><span class="module-2"><span class="module-3"><?php echo $title; ?></span></span></h3>
						<?php endif; ?>
						<?php echo $content; ?>
					</div>

					<div class="module-container-b">
						<div class="module-bl"></div>
						<div class="module-br"></div>
						<div class="module-b"></div>
					</div>
				</div>
			</div>
			<?php 
			break;

		case '1-3c-1':
			/*
			 * module skeleton with 1-3-1 div structure wrapped in containers
			 */
			?>
			<div class="<?php echo $suffix; ?>">
				<div class="module">
					<?php if ($badge != '') : ?>
						<div class="<?php echo $badge ?>"></div>
					<?php endif; ?>
					<div class="module-t">
					</div>
					
					<div class="module-l">
						<div class="module-l-ie6"></div>
						<div class="module-r-ie6"></div>
						<div class="module-r">
							<div class="module-m deepest">
								<div class="ie6">
									<?php if ($showtitle) : ?>
									<h3 class="module"><span class="module-2"><span class="module-3"><?php echo $title; ?></span></span></h3>
									<?php endif; ?>
									<?php echo $content; ?>
								</div>
							</div>
						</div>
					</div>
						
					<div class="module-b">
					</div>
				</div>
			</div>
			<?php 
			break;
			
		case '1-3-3':
			/*
			 * module skeleton with 1-3-3 div structure wrapped in containers
			 */
			?>
			<div class="<?php echo $suffix; ?>">
				<div class="module">
					<?php if ($badge != '') : ?>
						<div class="<?php echo $badge ?>"></div>
					<?php endif; ?>
					<div class="module-t">
					</div>
					
					<div class="module-l">
						<div class="module-l-ie6"></div>
						<div class="module-r-ie6"></div>
						<div class="module-r">
							<div class="module-m deepest">
								<div class="ie6">
									<?php if ($showtitle) : ?>
									<h3 class="module"><span class="module-2"><span class="module-3"><?php echo $title; ?></span></span></h3>
									<?php endif; ?>
									<?php echo $content; ?>
								</div>
							</div>
						</div>
					</div>
						
					<div class="module-container-b">
						<div class="module-bl"></div>
						<div class="module-br"></div>
						<div class="module-b"></div>
					</div>
				</div>
			</div>
			<?php 
			break;
			
		case '0-3-3':
			/*
			 * module skeleton with 0-3-3 div structure wrapped in containers
			 */
			?>
			<div class="<?php echo $suffix; ?>">
				<div class="module">
					<?php if ($badge != '') : ?>
						<div class="<?php echo $badge ?>"></div>
					<?php endif; ?>
					
					<div class="module-l">
						<div class="module-l-ie6"></div>
						<div class="module-r-ie6"></div>
						<div class="module-r">
							<div class="module-m deepest">
								<div class="ie6">
									<?php if ($showtitle) : ?>
									<h3 class="module"><span class="module-2"><span class="module-3"><?php echo $title; ?></span></span></h3>
									<?php endif; ?>
									<div class="floatbox">
										<?php echo $content; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
						
					<div class="module-container-b">
						<div class="module-bl"></div>
						<div class="module-br"></div>
						<div class="module-b"></div>
					</div>
				</div>
			</div>
			<?php 
			break;

		case '0-3ne-3':
			/*
			 * module skeleton with 0-3ne-3 div structure wrapped in containers
			 */
			?>
			<div class="<?php echo $suffix; ?>">
				<div class="module">
					<?php if ($badge != '') : ?>
						<div class="<?php echo $badge ?>"></div>
					<?php endif; ?>
					
					<div class="badge-tape"></div>	
					
					<div class="module-2">
						<div class="module-3 deepest">
							<div class="module-4">
								<?php echo $content; ?>
							</div>
						</div>
						<?php if ($showtitle) : ?>
							<h3 class="module"><span class="module-2"><span class="module-3"><?php echo $title; ?></span></span></h3>
						<?php endif; ?>
					</div>
						
					<div class="module-container-b">
						<div class="module-bl"></div>
						<div class="module-br"></div>
						<div class="module-b"></div>
					</div>
				</div>
			</div>
			<?php 
			break;

		case '1-separator-transparent':
			/*
			 * module skeleton with transparent separator image
			 */
			?>
			<div class="<?php echo $suffix; ?>">
				<div class="module deepest">
					<div class="module-r-ie6"></div>
					<?php if ($showtitle) : ?>
					<h3 class="module"><span class="module-2"><span class="module-3"><?php echo $title; ?></span></span></h3>
					<?php endif; ?>
					<?php echo $content; ?>
				</div>
			</div>
			<?php 
			break;

		case '4-div-t':
			/*
			 * 5 div skeleton with transparent header tab
			 */
			?>
			
			<div class="<?php echo $suffix; ?>">
				<div class="module">
					<div class="module-2">
						<div class="module-3">
							<div class="module-4">
								<div class="module-5 deepest">
									<?php if ($showtitle) : ?>
									<div class="header-container-1">
										<div class="header-container-2">
											<div class="header-l"></div>
											<div class="header-r"></div>
											<h3 class="module"><?php echo $title; ?></h3>
										</div>
									</div>
									<?php endif; ?>
									<div style="overflow: hidden;">
										<?php echo $content; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php 
			break;

		case '4-div-e':
			/*
			 * 4 div skeleton with extra div (IE6 transparency fix / MatchDivHeight padding)
			 */
			?>
			
			<div class="<?php echo $suffix; ?>">
				<div class="module <?php echo $color; ?>">
					<?php if ($badge != '') : ?>
						<div class="<?php echo $badge ?>"></div>
					<?php endif; ?>
					<div class="module-2">
						<div class="module-3">
							<div class="module-4 deepest">
								<div class="module-5">
									<?php if ($showtitle) : ?>
									<h3 class="module"><span class="module-2"><span class="module-3"><?php echo $title; ?></span></span></h3>
									<?php endif; ?>
									<?php echo $content; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php 
			break;

		case '4-div':
			/*
			 * 4 div skeleton
			 */
			?>
			
			<div class="<?php echo $suffix; ?>">
				<div class="module <?php echo $color; ?>">
					<?php if ($badge != '') : ?>
						<div class="<?php echo $badge ?>"></div>
					<?php endif; ?>
					<div class="module-2">
						<div class="module-3">
							<div class="module-4 deepest">
								<?php if ($showtitle) : ?>
								<h3 class="module"><span class="module-2"><span class="module-3"><?php echo $title; ?></span></span></h3>
								<?php endif; ?>
								<?php echo $content; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php 
			break;
			
		case '2-div-e':
			/*
			 * 2 div skeleton with extra div (IE6 transparency fix / MatchDivHeight padding)
			 */
			?>
			<div class="<?php echo $suffix; ?>">
				<div class="module">
					<?php if ($badge != '') : ?>
						<div class="<?php echo $badge ?>"></div>
					<?php endif; ?>
					<div class="module-2 deepest">
						<div class="module-3">
							<?php if ($showtitle) : ?>
							<h3 class="module"><span class="module-2"><span class="module-3"><?php echo $title; ?></span></span></h3>
							<?php endif; ?>
							<?php echo $content; ?>
						</div>
					</div>
				</div>
			</div>
			<?php 
			break;
			
		case '1-div-h':
			/*
			 * 1 div skeleton with transparent header
			 */
			?>
			<div class="<?php echo $suffix; ?>">
				<div class="module deepest">
					<?php if ($badge != '') : ?>
						<div class="<?php echo $badge ?>"></div>
					<?php endif; ?>
					<div class="header-container">
						<div class="header-l"></div>
						<div class="header-r"></div>
						<h3 class="module"><?php echo $title; ?></h3>
					</div>
					<?php echo $content; ?>
				</div>
			</div>
			<?php 
			break;

		case '1-div-e':
			/*
			 * 1 div skeleton with extra div (IE6 transparency fix / MatchDivHeight padding)
			 */
			?>
			<div class="<?php echo $suffix; ?>">
				<div class="module deepest">
					<?php if ($badge != '') : ?>
						<div class="<?php echo $badge ?>"></div>
					<?php endif; ?>
					<div class="module-2">
						<?php if ($showtitle) : ?>
						<h3 class="module"><span class="module-2"><span class="module-3"><?php echo $title; ?></span></span></h3>
						<?php endif; ?>
						<?php echo $content; ?>
					</div>
				</div>
			</div>
			<?php 
			break;

		case '1-div':
			/*
			 * 1 div skeleton
			 */
			?>
			<div class="<?php echo $suffix; ?>">
				<div class="module deepest">
					<?php if ($badge != '') : ?>
						<div class="<?php echo $badge ?>"></div>
					<?php endif; ?>
					<?php if ($showtitle) : ?>
					<h3 class="module"><span class="module-2"><span class="module-3"><?php echo $title; ?></span></span></h3>
					<?php endif; ?>
					<?php echo $content; ?>
				</div>
			</div>
			<?php 
			break;
		
		default:
			/*
			 * not defined
			 */
			?>
			<div class="<?php echo $suffix; ?>">
				<div class="module deepest">
					<?php if ($showtitle) : ?>
					<h3 class="module"><?php echo $title; ?></h3>
					<?php endif; ?>
					<?php echo $content; ?>
				</div>
			</div>
			<?php 
			break;
	}
}

?>