<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width">
		<?php wp_head(); ?>
	</head>
	<body>
		<div  class="wrapper">
			<header>
				<div class="header-top clearfix">
					<a href="<?php echo home_url(); ?>" class="logo"><?php bloginfo('name'); ?></a>
					<nav class="topmenu">
						<div class="menu-button">MENU</div>
						<?php wp_nav_menu( array(
							'theme_location'  => 'top',
							'menu'            => '',
							'container'       => null,
							'container_class' => 'menu-{menu-slug}-container',
							'container_id'    => '',
							'menu_class'      => 'menu',
							'menu_id'         => '',
							'echo'            => true,
							'fallback_cb'     => 'wp_page_menu',
							'before'          => '',
							'after'           => '',
							'link_before'     => '',
							'link_after'      => '',
							'items_wrap'      => '<ul>%3$s</ul>',
							'depth'           => 0,
							'walker'          => '',
						) ); ?>
					</nav>
				</div>
				<?php if (!is_page() && is_active_sidebar('sidebar-top') ) : ?>
					<div class="header-bottom">
						<?php dynamic_sidebar('sidebar-top'); ?>
					</div>
				<?php endif; ?>
			</header>
			<div  class="content-wrapper clearfix">