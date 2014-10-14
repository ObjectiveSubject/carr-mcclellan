<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Carr McClellan
 */

if ( ! function_exists( 'cmc_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function cmc_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'cmc' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'cmc' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'cmc' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'cmc_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function cmc_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	$previous_date = get_the_date('M. j, Y', $previous->ID); $next_date = get_the_date('M. j, Y', $next->ID); ?>
	
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'cmc' ); ?></h1>
		<div class="nav-links">
			<? if ($previous) : ?>
			<div class="nav-previous border-block top">
				<p class="block-label"><span class="icon-arrow-left small"></span>&nbsp;&nbsp;Previous</p>
				<p class="date ot-caps"><? echo $previous_date; ?></p>
				<h3 class="last-item title font-text"><?php previous_post_link( '%link', _x( '%title', 'Previous post link', 'cmc' ) ); ?></h3>
			</div>
			<? endif; if ($next) : ?>
			<div class="nav-next border-block top">
				<p class="block-label">Next&nbsp;&nbsp;<span class="icon-arrow-right small"></span></p>
				<p class="date ot-caps"><? echo $next_date; ?></p>
				<h3 class="last-item title font-text"><?php next_post_link('%link', _x( '%title', 'Next post link', 'cmc' ) ); ?></h3>
			</div>
			<? endif; ?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	
	<?php
}
endif;