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
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'cmc' ); ?></p>

					<?php get_search_form(); ?>

					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

					<div class="widget widget_categories">
						<h2 class="widget-title"><?php _e( 'Most Used Categories', 'cmc' ); ?></h2>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
					</div><!-- .widget -->

					<?php
						/* translators: %1$s: smiley */
						$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'cmc' ), convert_smilies( ':)' ) ) . '</p>';
						the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
					?>

					<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

				</main><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
