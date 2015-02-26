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
			<h1 class="page-title">We Make<br/>It Happen</h1>
			<div class="page-subtitle"><?php the_post(); the_content(); ?></div>

			<?php if ( $home_featured->have_posts() ) : $home_featured->the_post(); ?>
				<div class="featured">
					<div class="label">Featured</div>

					<h1 class="page-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					<?php if (get_the_excerpt()) : ?>
					<div class="page-subtitle"><?php the_excerpt(); ?></div>
					<?php endif; ?>

					<?php if ( in_category( 'events' ) ) : ?>
						<a class="button" href="<?php the_permalink(); ?>">Event Registration</a>
						<?php else : ?>
						<a class="button" href="<?php the_permalink(); ?>">Continue reading <span class="icon icon-arrow-right"></span></a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>

<!-- 		<div id="bgvideo-wrap"> -->
			<!-- <div class="overlay"></div> -->
			<video id="bgvideo" preload="auto" loop="loop">
				<source src="<?php echo site_url() . '/wp-content/uploads/videos/bridgeSD_v2.mp4.mp4' ?>" type='video/mp4;codecs="avc1.42E01E, mp4a.40.2"' />
				<source src="<?php echo site_url() . '/wp-content/uploads/videos/bridgeSD_v2.webmhd.webm' ?>" type='video/webm;codecs="vp8, vorbis"' />
			</video>
<!-- 		</div> -->

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
