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

		<section class="news-events span10 aligncenter">
			<h2 class="front-page">News &amp; Events</h2>
			<a href="<?php echo get_bloginfo( 'url' ); ?>/news-events/" class="see-all">See All</a>

			<?php cmc_get_newsevents(); ?>
		</section>

		<section class="attorneys span10 aligncenter">
			<h2 class="front-page">Meet Our Attorneys</h2>
			<a href="<?php echo get_bloginfo( 'url' ); ?>/attorneys/" class="see-all">See All</a>

			<?php cmc_get_attorneys(); ?>

		</section>

		<section class="practices span10 aligncenter">
			<h2 class="front-page">Our Practices</h2>
			<?php cmc_get_practices(); ?>
		</section>

	</main><!-- #main -->

</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
