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

					<?php get_template_part( 'content', 'page' ); ?>

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

			<hr>
			<article class="item">
				<h2 class="block-1"><a href="<?php echo get_page_link('36'); ?>">Newsletter</a></h2>
			</article>

			<article class="item article-events">
				<h2 class="block-1"><a href="<?php echo get_page_link('39'); ?>">Events</a></h2>
			</article>

			<article class="item">
				<h2 class="block-1"><a href="<?php echo get_permalink('41'); ?>">In the News</a></h2>
			</article>

			<article class="item">
				<h2 class="block-1"><a href="<?php echo get_permalink('34'); ?>">Blog</a></h2>
			</article>

		</main>
	</div>

<?php get_footer();