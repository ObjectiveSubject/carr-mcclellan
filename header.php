<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Carr McClellan
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>

<link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/images/icons/favicon.ico" />
<link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/images/icons/favicon@2x.png" />

<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/icons/icon-120x120.png" />
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/images/icons/icon-180x180.png" />
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/icons/icon-114x114.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/images/icons/icon-76x76.png" />
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/images/icons/icon-152x152.png" />
<link rel="apple-touch-icon" sizes="58x58" href="<?php echo get_template_directory_uri(); ?>/images/icons/icon-58x58.png" />

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="stylesheet" type="text/css" href="//cloud.typography.com/6428112/749386/css/fonts.css" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">
		<a class="search-link icon-search"><span class="hide-text">Search</span></a>

		<div class="search">
			<div class="search-popup">
				<form role="search" method="get" class="search-form" action="<?php echo site_url(); ?>">
					<label>
						<span class="screen-reader-text">Search for:</span>
						<input class="search-field" placeholder="Enter your search term" value="" name="s" title="Search for:" type="search">
					</label>
					<input class="search-submit" value="Search" type="submit">
				</form>
			</div>
		</div>

		<nav id="site-navigation" class="main-nav span12 clear main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="menu" aria-expanded="false"><?php _e( 'Menu', '_s' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'main' ) ); ?>
		</nav><!-- #site-navigation -->
		
		<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		</div>

	</header><!-- #masthead -->

	<div id="content" class="site-content">
