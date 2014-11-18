<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Carr McClellan
 */

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function carr_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged, $wp;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'cmc' ), max( $paged, $page ) );
	}

	$query_vars = $wp->query_vars;

	if ( isset( $query_vars['attorney'] ) ) {
		$attorney    = $query_vars['attorney'];
		$attorney_id = carr_get_post_id_by_slug( $attorney, 'attorneys' );
		$attorney_post = get_post( $attorney_id );

		$title .= ' | News &amp; Events | ' . $attorney_post->post_title;
	}

	if ( isset( $query_vars['practice'] ) ) {
		$practice    = $query_vars['practice'];
		$practice_id = carr_get_post_id_by_slug( $practice, 'practices' );
		$practice_post = get_post( $practice_id );

		$title .= ' | News &amp; Events | ' . $practice_post->post_title;
	}

	return $title;
}
add_filter( 'wp_title', 'carr_wp_title', 10, 2 );
