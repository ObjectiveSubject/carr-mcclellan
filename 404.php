<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Carr McClellan
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<div class="span12 aligncenter">
						<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'cmc' ); ?></h1>
					</div>
				</header><!-- .page-header -->

				<main id="main" class="site-main span12 aligncenter clear" role="main">

					<section class="entry-content span8 aligncenter">
						<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search below?', 'cmc' ); ?></p>

						<?php get_search_form(); ?>

					</section>
				</main><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
