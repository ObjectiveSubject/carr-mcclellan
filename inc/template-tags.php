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

if ( ! function_exists( 'cmc_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function cmc_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( 'Posted on %s', 'post date', 'cmc' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( 'by %s', 'post author', 'cmc' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

}
endif;

if ( ! function_exists( 'cmc_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function cmc_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'cmc' ) );
		if ( $categories_list && cmc_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( 'Posted in %1$s', 'cmc' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'cmc' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'cmc' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'cmc' ), __( '1 Comment', 'cmc' ), __( '% Comments', 'cmc' ) );
		echo '</span>';
	}

	edit_post_link( __( 'Edit', 'cmc' ), '<span class="edit-link">', '</span>' );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function cmc_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'cmc_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'cmc_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so cmc_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so cmc_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in cmc_categorized_blog.
 */
function cmc_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'cmc_categories' );
}
add_action( 'edit_category', 'cmc_category_transient_flusher' );
add_action( 'save_post',     'cmc_category_transient_flusher' );
