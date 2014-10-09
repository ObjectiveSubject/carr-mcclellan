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

	<div id="primary" class="content-area high-level-page">

		<header class="page-header">
			<div class="span12 aligncenter">
				<h1 class="page-title"><?php the_title(); ?></h1>
			</div>
		</header>

		<main id="main" class="site-main span12 aligncenter clear" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
			
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
					<div class="entry-content">
						<?php the_content(); ?>
						
						<h2>Forms</h2>
						
						<form class="form">
							<input type="text" name="text_input" placeholder="text input"/>
							<input type="email" name="email_input" placeholder="email input"/>
							<input type="tel" name="tel_input" placeholder="tel input"/>
							<textarea rows="7" cols="10" placeholder="textarea" name="textarea"></textarea>
							<input type="submit" class="button" />
						</form>
						
					</div><!-- .entry-content -->

					<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'cmc' ),
							'after'  => '</div>',
						) );
					?>
				
					<footer class="entry-footer">
						<?php edit_post_link( __( 'Edit', 'cmc' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-footer -->
				</article><!-- #post-## -->


			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
