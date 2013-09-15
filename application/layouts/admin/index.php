<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8">
		<title>Ilch <?php echo VERSION; ?> - Admincenter</title>
		<meta name="description" content="Ilch - Login">
		<link href="<?php echo $this->staticUrl('css/bootstrap.min.css'); ?>" rel="stylesheet">
		<link href="<?php echo $this->staticUrl('css/global.css'); ?>" rel="stylesheet">
		<link href="<?php echo $this->staticUrl('css/admin/main.css'); ?>" rel="stylesheet">
		<script src="<?php echo $this->staticUrl('js/jquery-1.7.min.js'); ?>"></script>
		<script src="<?php echo $this->staticUrl('js/bootstrap.js'); ?>"></script>
		<script src="<?php echo $this->staticUrl('js/admin/functions.js'); ?>"></script>

	</head>
	<body>
		<div class="topmenu">
			<div class="leftmenu">
				<div class="navbar">
					<div class="navbar-inner navbar-sidebar">
						<span class="brand">Ilch 2.0</span>
						<ul class="nav pull-right">
							<li class="dropdown">
								 <a href="#" id="search" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-search"></i> Suche<b class="caret"></b></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="rightmenu">
				<div class="navbar">
					<div class="navbar-inner navbar-app">
						<ul class="nav">
							<li>
								<a href="<?php echo $this->url(array('module' => 'admin', 'controller' => 'index', 'action' => 'index')); ?>">
									<i class="icon-home"></i> <?php echo $this->trans('home'); ?>
								</a>
							</li>
							<li>
								<a href="<?php echo $this->url(array('module' => 'admin', 'controller' => 'navigation', 'action' => 'index')); ?>">
									<i class="icon-th-list"></i> <?php echo $this->trans('navigation'); ?>
								</a>
							</li>
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo $this->url(array('controller' => 'modules', 'controller' => 'index', 'action' => 'index')); ?>">
									<i class="icon-lock"></i> <?php echo $this->trans('modules'); ?>
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<?php
										foreach($this->get('modules') as $module)
										{
											echo '<li>
													<a href="'.$this->url(array('module' => $module->getKey(), 'controller' => 'index', 'action' => 'index')).'">
														<img style="padding-right: 5px;" src="'.$this->staticUrl('img/'.$module->getKey().'/'.$module->getIconSmall()).'" />'
														.$module->getName($this->getTranslator()->getLocale()).'</a>
												</li>';
										}
									?>
								</ul>
							</li>
							<li>
								<a href="<?php echo $this->url(array('module' => 'admin', 'controller' => 'layouts', 'action' => 'index')); ?>">
									<i class="icon-picture"></i> <?php echo $this->trans('layouts'); ?>
								</a>
							</li>
							<li>
								<a href="<?php echo $this->url(array('module' => 'admin', 'controller' => 'settings', 'action' => 'index')); ?>">
									<i class="icon-wrench"></i> <?php echo $this->trans('system'); ?>
								</a>
							</li>
						</ul>
						<div class="btn-group pull-right">
							<a class="btn" href="<?php echo $this->url(); ?>" title="neues Fenster öffnen" target="_blank"><i class="icon-share"></i></a>
							<a href="#" data-toggle="dropdown" class="btn dropdown-toggle">
								<i class="icon-user"></i> <?php echo $this->getUser()->getName(); ?>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="#">Profil</a></li>
								<li class="divider"></li>
								<li>
									<a href="<?php echo $this->url(array('module' => 'admin', 'controller' => 'login', 'action' => 'logout'))?>">
										<i class="icon-off"></i> <?php echo $this->trans('logout');?>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="app">
				<?php
					$contentFullClass = 'app_right_full';

					if(($this->getRequest()->getControllerName() !== 'index' && $this->getRequest()->getModuleName() == 'admin') || $this->getRequest()->getModuleName() !== 'admin')
					{
						$contentFullClass = '';
				?>
					<div class="app_left">
						<i class="icon-chevron-left toggleSidebar slideLeft"></i>
						<div id="sidebar_content">
							<ul class="nav nav-tabs nav-stacked">
								<li class="nav-header">
									Navigation
								</li>
								<?php
									foreach($this->get('menu') as $menu)
									{
										echo '<li><a href="#">Library</a></li>';
									}
								?>
							</ul>
							<img class="watermark" src="<?php echo $this->staticUrl('img/ilch_logo_sw.png'); ?>" />
						</div>
					</div>
				<?php
					}
				?>

			<div class="app_right <?php echo $contentFullClass?>">
				<i class="toggleSidebar slideRight"></i>
				<?php echo $this->getContent(); ?>
			</div>
			<div class="content_savebox">
				<button class="btn">Save</button>
			</div>
		</div>

		<script>
			$('.toggleSidebar').on('click', toggleSidebar);
		</script>
	</body>
</html>