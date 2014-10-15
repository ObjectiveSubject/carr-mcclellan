<?php
/**
 * The template for the home page
 */

get_header(); ?>

<div id="primary" class="content-area">

	<header class="page-header">
		<div class="centered">
			<?php get_template_part('t-site-branding'); ?>
			<h1 class="page-title">We Make<br/>It Happen</h1>
			<div class="page-subtitle"><?php the_content(); ?></div>
		</div>

		<?php while ( have_posts() ) : the_post(); ?>

			<main id="main" class="site-main span12 aligncenter" role="main">

				<?php get_template_part( 'content', 'page' ); ?>

			</main><!-- #main -->

		<?php endwhile; // end of the loop. ?>
	</header>

</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
