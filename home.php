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
			<h1 class="page-title">Blog</h1>
		</div>
	</header>

	<main id="main" class="site-main span12 aligncenter" role="main">
		<aside class="aside aside-left span2 push-left">
			<div class="border-block top">
				<h3 class="block-label">Categories</h3>

					<ul>
						<?php wp_list_categories( '&title_li=' ); ?>
					</ul>

			</div>
		</aside>

		<section class="span9 push-right">
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>
					<article class="border-block top-right-bottom square">
						<h4 class="timestamp"><?php the_time('F j, Y'); ?></h4>
						<h3><?php the_title(); ?></h3>
					</article>

				<?php endwhile; ?>

				<?php cmc_paging_nav(); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>
		</section>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>