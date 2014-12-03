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
				<div class="page-subtitle"><?php the_post(); the_content(); ?></div>
			<?php endif; ?>
		</div>

		<video id="bgvideo" autoplay preload="auto" loop poster="<?php echo get_template_directory_uri(); ?>/images/bridge.jpg" width="100%">
<!-- 			<source src="http://ak5.picdn.net/shutterstock/videos/1220212/preview/stock-footage-sunset-golden-gate-bridge-time-lapse.mp4" type='video/mp4;codecs="avc1.42E01E, mp4a.40.2"' /> -->
			<source src="<?php echo get_template_directory_uri().'/images/bridge.mp4' ?>" type='video/mp4;codecs="avc1.42E01E, mp4a.40.2"' />
		</video>

	</header>

	<main id="main" class="site-main span12 aligncenter" role="main">

		<section class="news-events span10 aligncenter">
			<h3 class="front-page">News &amp; Events</h3>
			<a href="<?php echo get_bloginfo( 'url' ); ?>/news-events/" class="see-all">See All <span class="icon-arrow-right"></span></a>

			<?php carr_get_newsevents(); ?>
		</section>

		<section class="attorneys span10 aligncenter">
			
			<article class="border-block top-left-bottom meet-headline child1">
				<a href="<?php echo get_bloginfo( 'url' ); ?>/attorneys/">
					<h2>Meet our Attorneys</h2>
				</a>
			</article>
			<article class="border-block top-right-bottom meet-content child1">
				<?php
					$attorney_page_id = carr_get_post_id_by_slug( 'attorneys', 'page' );
					$attorney_page    = get_post( $attorney_page_id );
					$attorney_content = $attorney_page->post_content; // Don't apply the_content filter
				?>
				<h3 class="font-text"><?php echo $attorney_content; ?> <a href="<?php echo get_bloginfo( 'url' ); ?>/attorneys/" class="small">Meet our attorneys &raquo;</a></h3>
			</article>
		</section>

		<section class="practices span10 aligncenter">
			<h3 class="front-page">Our Practices</h3>
			<?php carr_get_practices(); ?>
		</section>

	</main><!-- #main -->

</div><!-- #primary -->

<?php get_footer(); ?>
