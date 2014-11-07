<?php
/**
 * Template Name: News & Events
**/
	get_header();
?>

	<div id="primary" class="content-area">

		<header class="page-header">
			<div class="centered">
				<h1 class="page-title">Current event</h1>
				<div class="page-subtitle"><?php the_content(); ?></div>
			</div>

			<?php while ( have_posts() ) : the_post(); ?>

				<main id="main" class="site-main span12 aligncenter" role="main">

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<div class="entry-content">
							<?php the_content(); ?>
						</div><!-- .entry-content -->

					</article><!-- #post-## -->

				</main><!-- #main -->

			<?php endwhile; // end of the loop. ?>
		</header>


		<main id="main" class="site-main span12 aligncenter" role="main">
			<section class="news-events span10 aligncenter">
				<h2 class="front-page">News &amp; Events</h2>
				<a href="<?php echo get_bloginfo( 'url' ); ?>/news-events/" class="see-all">See All <span class="icon-arrow-right"></span></a>

				<?php cmc_get_newsevents(); ?>
			</section>

			<section class="attorneys span10 aligncenter">
				<h2 class="front-page">Meet Our Attorneys</h2>
				<a href="<?php echo get_bloginfo( 'url' ); ?>/attorneys/" class="see-all">See All <span class="icon-arrow-right"></span></a>

				<?php cmc_get_attorneys(); ?>

			</section>

			<section class="attorneys span10 aligncenter">
				<h2 class="front-page">Our Practices</h2>
				<?php cmc_get_practices(); ?>
			</section>

		</main>
	</div>

<?php get_footer();