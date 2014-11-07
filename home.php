<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Carr McClellan
 */

get_header(); ?>

<div id="primary" class="content-area page-default">
	<header class="page-header">
		<div class="span12 aligncenter">
			<h1 class="page-title">News & Events</h1>
		</div>
	</header>

	<main id="main" class="site-main span12 aligncenter" role="main">
		<aside class="aside aside-left span2 push-left">
			<div class="border-block top">
				<h3 class="block-label">Categories</h3>

				<ul class="categories">
					<?php wp_list_categories( '&title_li=&depth=1' ); ?>
				</ul>

			</div>
		</aside>

		<section class="span9 push-right">
			<?php if ( have_posts() ) : ?>
				<?php $color_class = 'odd'; ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<article class="border-block top-right-bottom square blog-post <?php echo $color_class; ?>">
						<h4 class="timestamp"><?php the_time('M. d, Y'); ?></h4>
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					</article>

					<?php
					if ( 'even' == $color_class ) {
						$color_class = 'odd';
					} else {
						$color_class = 'even';
					}
					?>

				<?php endwhile; ?>

				<?php cmc_paging_nav(); ?>

			<?php else : ?>

				<article>
					<p>No posts found</p>
				</article>

			<?php endif; ?>
		</section>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
