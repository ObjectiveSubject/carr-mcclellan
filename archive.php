<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Carr McClellan
 */

get_header(); ?>

<div id="primary" class="content-area page-default">
	<header class="page-header">
		<div class="span12 aligncenter">
			<h1 class="page-title"><?php
			if ( is_category() ) :
				single_cat_title();

			elseif ( is_tag() ) :
				single_tag_title();

			elseif ( is_author() ) :
				printf( __( 'Author: %s', 'cmc' ), '<span class="vcard">' . get_the_author() . '</span>' );

			elseif ( is_day() ) :
				printf( __( 'Day: %s', 'cmc' ), '<span>' . get_the_date() . '</span>' );

			elseif ( is_month() ) :
				printf( __( 'Month: %s', 'cmc' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'cmc' ) ) . '</span>' );

			elseif ( is_year() ) :
				printf( __( 'Year: %s', 'cmc' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'cmc' ) ) . '</span>' );

			else :
				_e( 'Archives', 'cmc' );

			endif;
			?></h1>
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

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
