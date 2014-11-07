<?php
/**
 * The template for displaying search results pages.
 *
 * @package Carr McClellan
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'cmc' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * The template part for displaying results in search pages.
				 *
				 * Learn more: http://codex.wordpress.org/Template_Hierarchy
				 *
				 * @package Carr McClellan
				 */
				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

						<?php if ( 'post' == get_post_type() ) : ?>
							<div class="entry-meta">
								<?php cmc_posted_on(); ?>
							</div><!-- .entry-meta -->
						<?php endif; ?>
					</header><!-- .entry-header -->

					<div class="entry-summary">
						<?php the_excerpt(); ?>
					</div><!-- .entry-summary -->

					<footer class="entry-footer">
						<?php cmc_entry_footer(); ?>
					</footer><!-- .entry-footer -->
				</article><!-- #post-## -->


			<?php endwhile; ?>

			<?php cmc_paging_nav(); ?>

		<?php else : ?>

			<article>
				<p>No posts found</p>
			</article>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
