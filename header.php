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
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="stylesheet" type="text/css" href="//cloud.typography.com/6428112/749386/css/fonts.css" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!--[if lt IE 9]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">

		<nav id="site-navigation" class="main-nav span12 clear" role="navigation">
			<a href="#" class="menu-toggle"><span class="icon-menu"></span><span class="hide-text">Menu</span></a>
			<?php wp_nav_menu( array( 'theme_location' => 'main' ) ); ?>
		</nav><!-- #site-navigation -->
		
		<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		</div>

	</header><!-- #masthead -->

	<div id="content" class="site-content">
