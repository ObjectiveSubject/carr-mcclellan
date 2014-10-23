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

			<?php get_template_part( 'content', 'page' ); ?>

		<?php endwhile; // end of the loop. ?>
	</header>

	<main id="main" class="site-main span12 aligncenter" role="main">

		<h2>News &amp; Events</h2>
		<a href="">See All</a>

		<h2>Meet Our Attorneys</h2>
		<a href="">See All</a>

		<h2>Our Practices</h2>
		<?php cmc_get_practices(); ?>

	</main><!-- #main -->

</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
