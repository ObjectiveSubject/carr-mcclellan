<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Carr McClellan
 */

get_header(); ?>

	<div id="primary" class="content-area page-default <?php echo 'page-'.$post->post_name; ?>">
	
		<header class="page-header">
			<div class="span12 aligncenter">
				<h1 class="page-title"><?php the_title(); ?></h1>
			</div>
		</header>
		
		<main id="main" class="site-main span12 aligncenter" role="main">

			<section id="content">
				<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<div class="entry-content">
							<?php the_content(); ?>
						</div><!-- .entry-content -->

					</article><!-- #post-## -->

				<?php endwhile; // end of the loop. ?>
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
