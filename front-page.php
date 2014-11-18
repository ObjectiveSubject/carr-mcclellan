<?php
/**
 * The template for the home page
 */

get_header();

$home_featured = z_get_zone_query( 'home-featured' );

?>

<div id="primary" class="content-area">

	<header class="page-header">
		<div class="centered">
			<?php if ( $home_featured->have_posts() ) : $home_featured->the_post(); ?>
				<div class="featured">
					<h4 class="date"><?php echo carr_display_date(); ?></h4>

					<h1 class="page-title"><?php the_title(); ?></h1>
					<div class="page-subtitle"><?php the_excerpt(); ?></div>

					<?php if ( in_category( 'events' ) ) : ?>
						<a class="button" href="<?php the_permalink(); ?>">Event Registration</a>
					<?php endif; ?>
				</div>
			<?php else : ?>
				<h1 class="page-title">We Make<br/>It Happen</h1>
				<div class="page-subtitle"><?php the_content(); ?></div>

				<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<div class="entry-content">
							<?php the_content(); ?>
						</div><!-- .entry-content -->

					</article><!-- #post-## -->

				<?php endwhile; // end of the loop. ?>
			<?php endif; ?>
		</div>
	</header>

	<main id="main" class="site-main span12 aligncenter" role="main">

		<section class="news-events span10 aligncenter">
			<h3 class="front-page">News &amp; Events</h3>
			<a href="<?php echo get_bloginfo( 'url' ); ?>/news-events/" class="see-all">See All <span class="icon-arrow-right"></span></a>

			<?php carr_get_newsevents(); ?>
		</section>

		<section class="attorneys span10 aligncenter">
			<h3 class="front-page">Meet Our Attorneys</h3>
			<a href="<?php echo get_bloginfo( 'url' ); ?>/attorneys/" class="see-all">See All <span class="icon-arrow-right"></span></a>

			<?php carr_get_attorneys(); ?>

		</section>

		<section class="practices span10 aligncenter">
			<h3 class="front-page">Our Practices</h3>
			<?php carr_get_practices(); ?>
		</section>

	</main><!-- #main -->

</div><!-- #primary -->

<?php get_footer(); ?>
