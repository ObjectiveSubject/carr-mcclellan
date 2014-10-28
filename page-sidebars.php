<?php
/**
 * Template Name: Page with Sidebars
 */

get_header();

$post_sidebar_1 = get_post_meta( $post->ID, 'post_sidebar_1', true );
$post_sidebar_2 = get_post_meta( $post->ID, 'post_sidebar_2', true );
?>

	<div id="primary" class="content-area page-default">
	
		<header class="page-header">
			<div class="span12 aligncenter">
				<h1 class="page-title"><?php the_title(); ?></h1>
			</div>
		</header>

		<main id="main" class="site-main span12 aligncenter" role="main">

			<aside class="aside aside-left span2 push-left">
				<!-- <div class="border-block top"></div> -->
				<?php echo apply_filters( 'the_content', $post_sidebar_1 ); ?>
			</aside>

			<section class="span8 push-left">
				<?php while ( have_posts() ) : the_post(); ?>

					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->

				<?php endwhile; // end of the loop. ?>
			</section>

			<aside class="aside aside-right span2">
				<!-- <div class="border-block top"></div> -->
				<?php echo apply_filters( 'the_content', $post_sidebar_2 ); ?>
			</aside>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
