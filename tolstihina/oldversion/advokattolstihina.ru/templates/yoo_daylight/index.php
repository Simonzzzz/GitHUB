<?php
/**
 * YOOtheme template
 *
 * @author yootheme.com
 * @copyright Copyright (C) 2008 YOOtheme Ltd & Co. KG. All rights reserved.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

include_once(JPATH_ROOT . "/templates/" . $this->template . '/lib/php/yootools.php');
include_once(JPATH_ROOT . "/templates/" . $this->template . '/lib/php/yoolayout.php');

$template_baseurl = $this->baseurl . '/templates/' . $this->template;

JHTML::_('behavior.mootools');

// set title
$this->setTitle($mainframe->getCfg('sitename') . ' - ' . $this->getTitle());

// add template javascript to JDocumentHTML
if ($this->params->get('loadJavascript')) {
	$yootools->addJavaScript($this);
}

// add template css to JDocumentHTML
$yootools->addCSS($this);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
<jdoc:include type="head" />
<link rel="apple-touch-icon" href="<?php echo $template_baseurl ?>/apple_touch_icon.png" />
</head>

<body id="page" class="yoopage <?php echo $yootools->getCurrentStyle(); ?> <?php echo $this->params->get('leftcolumn'); ?> <?php echo $this->params->get('rightcolumn'); ?> <?php echo $itemcolor; ?> <?php echo $yootools->getCurrentToolsColor(); ?>">

	<?php if($this->countModules('absolute')) : ?>
	<div id="absolute">
		<jdoc:include type="modules" name="absolute" />
	</div>
	<?php endif; ?>

	<div id="page-body">
		<div class="wrapper floatholder">

			<div id="header">

				<div id="toolbar">
					<div class="floatbox ie_fix_floats">

						<?php if($this->params->get('date')) : ?>
						<div id="date">
							<?php echo JHTML::_('date', 'now', JText::_('DATE_FORMAT_LC')) ?>
						</div>
						<?php endif; ?>

						<?php if($this->countModules('topmenu')) : ?>
						<div id="topmenu">
							<jdoc:include type="modules" name="topmenu" />
						</div>
						<?php endif; ?>

						<?php if($this->params->get('styleswitcherFont') || $this->params->get('styleswitcherWidth')) : ?>
						<div id="styleswitcher">
							<?php if($this->params->get('styleswitcherWidth')) : ?>
							<a id="switchwidthfluid" href="javascript:void(0)" title="Fluid width"></a>
							<a id="switchwidthwide" href="javascript:void(0)" title="Wide width"></a>
							<a id="switchwidththin" href="javascript:void(0)" title="Thin width"></a>
							<?php endif; ?>
							<?php if($this->params->get('styleswitcherFont')) : ?>
							<a id="switchfontlarge" href="javascript:void(0)" title="Increase font size"></a>
							<a id="switchfontmedium" href="javascript:void(0)" title="Default font size"></a>
							<a id="switchfontsmall" href="javascript:void(0)" title="Decrease font size"></a>
							<?php endif; ?>
						</div>
						<?php endif; ?>

						<jdoc:include type="modules" name="toolbar" style="yoo" />

					</div>
				</div>

				<?php if($this->countModules('menu')) : ?>
				<div id="menu">
					<jdoc:include type="modules" name="menu" />
				</div>
				<?php endif; ?>

				<?php if($this->countModules('logo')) : ?>
				<div id="logo">
					<jdoc:include type="modules" name="logo" />
				</div>
				<?php endif; ?>

				<?php if($this->countModules('search')) : ?>
				<div id="search" class="yootools-black">
					<jdoc:include type="modules" name="search" />
				</div>
				<?php endif; ?>

				<?php if ($this->countModules('banner')) : ?>
				<div id="banner">
					<jdoc:include type="modules" name="banner" />
				</div>
				<?php endif; ?>

			</div>
			<!-- header end -->

			<?php if ($this->countModules('top + top-equal + top-goldenratio')) : ?>
			<div id="top">
				<div class="floatbox ie_fix_floats">

					<?php if($this->countModules('top')) : ?>
					<div class="topblock width100 float-left">
						<jdoc:include type="modules" name="top" style="yoo" />
					</div>
					<?php endif; ?>

					<?php if ($pos = $yootools->getModulePosition(array('top-equal', 'top-goldenratio'))) : ?>
						<?php while ($param = $yootools->renderModulePosition($pos)) : ?>
							<div class="topbox <?php echo $param['width'].' '.$param['separator']; ?> float-left">
								<jdoc:include type="modules" name="<?php echo $param['name']; ?>" style="yoo" order="<?php echo $param['order']; ?>" />
							</div>
						<?php endwhile; ?>
					<?php endif; ?>

				</div>
			</div>
			<!-- top end -->
			<?php endif; ?>

			<div id="middle">
				<div class="background">

					<?php if($this->countModules('left')) : ?>
					<div id="left">
						<div id="left_container" class="clearfix">
							<jdoc:include type="modules" name="left" style="yoo" />
						</div>
					</div>
					<!-- left end -->
					<?php endif; ?>

					<div id="main">
						<div id="main_container" class="clearfix">

							<?php if ($this->countModules('main-top-equal + main-top-goldenratio')) : ?>
							<div id="maintop" class="floatbox">

								<?php if ($pos = $yootools->getModulePosition(array('main-top-equal', 'main-top-goldenratio'))) : ?>
									<?php while ($param = $yootools->renderModulePosition($pos)) : ?>
										<div class="maintopbox <?php echo $param['width'].' '.$param['separator']; ?> float-left">
											<jdoc:include type="modules" name="<?php echo $param['name']; ?>" style="yoo" order="<?php echo $param['order']; ?>" />
										</div>
									<?php endwhile; ?>
								<?php endif; ?>

							</div>
							<!-- maintop end -->
							<?php endif; ?>

							<div id="mainmiddle" class="floatbox">

								<?php if($this->countModules('right') && !class_exists('JEditor')) : ?>
								<div id="right">
									<div id="right_container" class="clearfix">
										<jdoc:include type="modules" name="right" style="yoo" />
									</div>
								</div>
								<!-- right end -->
								<?php endif; ?>

								<div id="content">
									<div id="content_container" class="clearfix">

										<?php if ($this->countModules('content-top-equal + content-top-goldenratio')) : ?>
										<div id="contenttop" class="floatbox">

											<?php if ($pos = $yootools->getModulePosition(array('content-top-equal', 'content-top-goldenratio'))) : ?>
												<?php while ($param = $yootools->renderModulePosition($pos)) : ?>
													<div class="contenttopbox <?php echo $param['width'].' '.$param['separator']; ?> float-left">
														<jdoc:include type="modules" name="<?php echo $param['name']; ?>" style="yoo" order="<?php echo $param['order']; ?>" />
													</div>
												<?php endwhile; ?>
											<?php endif; ?>

										</div>
										<!-- contenttop end -->
										<?php endif; ?>

										<?php if ($this->countModules('breadcrumb')) : ?>
										<div id="breadcrumb">
											<jdoc:include type="modules" name="breadcrumb" />
										</div>
										<?php endif; ?>

										<div class="floatbox">
											<jdoc:include type="message" />
											<jdoc:include type="component" />
										</div>

										<?php if ($this->countModules('content-bottom-equal + content-bottom-goldenratio')) : ?>
										<div id="contentbottom" class="floatbox">

											<?php if ($pos = $yootools->getModulePosition(array('content-bottom-equal', 'content-bottom-goldenratio'))) : ?>
												<?php while ($param = $yootools->renderModulePosition($pos)) : ?>
													<div class="contentbottombox <?php echo $param['width'].' '.$param['separator']; ?> float-left">
														<jdoc:include type="modules" name="<?php echo $param['name']; ?>" style="yoo" order="<?php echo $param['order']; ?>" />
													</div>
												<?php endwhile; ?>
											<?php endif; ?>

										</div>
										<!-- mainbottom end -->
										<?php endif; ?>

									</div>
								</div>
								<!-- content end -->

							</div>
							<!-- mainmiddle end -->

							<?php if ($this->countModules('main-bottom-equal + main-bottom-goldenratio')) : ?>
							<div id="mainbottom" class="floatbox">

								<?php if ($pos = $yootools->getModulePosition(array('main-bottom-equal', 'main-bottom-goldenratio'))) : ?>
									<?php while ($param = $yootools->renderModulePosition($pos)) : ?>
										<div class="mainbottombox <?php echo $param['width'].' '.$param['separator']; ?> float-left">
											<jdoc:include type="modules" name="<?php echo $param['name']; ?>" style="yoo" order="<?php echo $param['order']; ?>" />
										</div>
									<?php endwhile; ?>
								<?php endif; ?>

							</div>
							<!-- mainbottom end -->
							<?php endif; ?>

						</div>
					</div>
					<!-- main end -->

				</div>
			</div>
			<!-- middle end -->

			<?php if ($this->countModules('bottom + bottom-equal + bottom-goldenratio')) : ?>
			<div id="bottom">
				<div class="floatbox ie_fix_floats">

					<?php if ($pos = $yootools->getModulePosition(array('bottom-equal', 'bottom-goldenratio'))) : ?>
						<?php while ($param = $yootools->renderModulePosition($pos)) : ?>
							<div class="bottombox <?php echo $param['width'].' '.$param['separator']; ?> float-left">
								<jdoc:include type="modules" name="<?php echo $param['name']; ?>" style="yoo" order="<?php echo $param['order']; ?>" />
							</div>
						<?php endwhile; ?>
					<?php endif; ?>

					<?php if($this->countModules('bottom')) : ?>
					<div class="bottomblock width100 float-left">
						<jdoc:include type="modules" name="bottom" style="yoo" />
					</div>
					<?php endif; ?>

				</div>
			</div>
			<!-- bottom end -->
			<?php endif; ?>

			<div id="footer">
				<a class="anchor" href="#page">&nbsp;</a>
				<jdoc:include type="modules" name="footer" />
				<table cellpadding="0" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <td align="left" bgcolor="#E9F4E8" height="109" width="3%">&nbsp;</td>
            <td align="left" bgcolor="#E9F4E8" height="109" width="34%"><span style="color: #0db14b; font-family: 'Times New Roman';"> <span style="font-size: 13px;">© </span> </span> <span style="color: #0db14b; font-family: 'Times New Roman';" lang="ru"> <span style="font-size: 13px;">2010-2011 Ирина    Толстихина<br />Разработка сайта - </span> «<a href="http://evolutiond.ru">Эволюция в дизайне</a>»</span></td>
            <td align="left" bgcolor="#E9F4E8" height="109" width="84"><span style="font-size: 14px;"><img src="images/tel.png" alt="позвонить" align="left" border="0" height="54" hspace="5" width="69" /></span></td>
            <td align="left" bgcolor="#E9F4E8" height="109" width="185"><span style="font-size: 14px;">&nbsp;</span><span style="color: #0db14b;"><span style="font-size: 14px;">+7    911 137 27 28<br /> &nbsp;+7 904 644 39 59</span></span></td>
            <td align="left" bgcolor="#E9F4E8" height="109" width="86"><span style="color: #0db14b; text-decoration: underline;"> <span style="font-size: 14px;"> <img src="images/post.png" alt="написать" align="left" border="0" height="54" hspace="5" width="76" /></span></span></td>
            <td align="left" bgcolor="#E9F4E8" height="109" width="205"><span style="color: #0db14b;"> <a title="Написать" href="mailto:tolstina@mail.ru"> <span style="text-decoration: underline; color: #0db14b;"> <span style="font-size: 14px;">tolstina@mail.ru</span></span></a></span></td>
            <td align="left" bgcolor="#E9F4E8" height="109" width="94">
<!--LiveInternet counter--><script type="text/javascript"><!--
document.write("<a href='http://www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t44.15;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random()+
"' alt='' title='LiveInternet' "+
"border='0' width='31' height='31'><\/a>")
//--></script><!--/LiveInternet--></td>
        </tr>
    </tbody>
</table>
			</div>
			<!-- footer end -->

		</div>
	</div>

</body>
</html>