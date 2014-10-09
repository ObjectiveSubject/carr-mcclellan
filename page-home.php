<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Carr McClellan
 */

get_header(); ?>

	<div id="primary" class="content-area">
	
		<?php while ( have_posts() ) : the_post(); ?>
		
		<header class="page-header">
			<div class="centered">
				<?php get_template_part('t-site-branding'); ?>
				<h1 class="page-title">We Make<br/>It Happen</h1>
				<div class="page-subtitle"><?php the_content(); ?></div>
			</div>
		</header>
		
		<main id="main" class="site-main" role="main">
			
				<?php get_template_part( 'content', 'page' ); ?>

		</main><!-- #main -->

		<?php endwhile; // end of the loop. ?>

	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
