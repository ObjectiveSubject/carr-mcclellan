<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Carr McClellan
 */


/**
 * Display navigation to next/previous set of posts when applicable.
 */
function carr_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'cmc' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous border-block top">
				<p class="block-label"><?php next_posts_link( __( '<span class="icon-arrow-left small"></span> Older posts', 'cmc' ) ); ?></p>
			</div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next border-block top">
				<p class="block-label"><?php previous_posts_link( __( 'Newer posts <span class="icon-arrow-right small"></span>', 'cmc' ) ); ?></p>
			</div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}


/**
 * Display navigation to next/previous post when applicable.
 */
function carr_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}

	$previous_date = '';
	$next_date = '';

	if ( $previous ) {
		$previous_date = get_the_date( 'M. j, Y', $previous->ID );
	}

	if ( $next ) {
		$next_date = get_the_date('M. j, Y', $next->ID);
	}

	?>

	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'cmc' ); ?></h1>
		<div class="nav-links">
			<?php if ($previous) : ?>
			<div class="nav-previous border-block top">
				<p class="block-label"><span class="icon-arrow-left small"></span>&nbsp;&nbsp;Previous</p>
				<p class="date ot-caps"><?php echo $previous_date; ?></p>
				<h3 class="last-item title font-text"><?php previous_post_link( '%link', _x( '%title', 'Previous post link', 'cmc' ) ); ?></h3>
			</div>
			<?php endif; if ($next) : ?>
			<div class="nav-next border-block top">
				<p class="block-label">Next&nbsp;&nbsp;<span class="icon-arrow-right small"></span></p>
				<p class="date ot-caps"><?php echo $next_date; ?></p>
				<h3 class="last-item title font-text"><?php next_post_link('%link', _x( '%title', 'Next post link', 'cmc' ) ); ?></h3>
			</div>
			<?php endif; ?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	
	<?php
}


/**
 * Generate sidebar sharing links for Posts/Articles
 */
function carr_share_links() {
	global $post;

	$permalink = get_the_permalink( $post->ID );
	$title = get_the_title( $post->title );
	?>

	<div class="border-block top social-share">
		<h3 class="block-label">Share</h3>
		<ul>
			<li><a href="https://twitter.com/share?url=<?php echo $permalink; ?>&text=<?php echo $title; ?>" class="social-icon icon-twitter"><span class="hide-text">Twitter</span></a></li>
			<li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $permalink; ?>&title=<?php echo $title; ?>&source=carrmcclellan.com" class="social-icon icon-linkedin"><span class="hide-text">Linkedin</span></a></li>
			<li><a href="http://www.facebook.com/share.php?u=<?php echo $permalink; ?>&title=<?php echo $title; ?>" class="social-icon icon-facebook"><span class="hide-text">Facebook</span></a></li>
		</ul>
	</div>

	<?php
}


/**
 * Sidebar for News & Events pages
 */
function carr_news_events_sidebar() {

	global $post;

	/*$attorneys = new WP_Query(array(
		'post_type' => 'attorneys',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page' => 80
	)); */

	global $wpdb;
	global $post;

// Originally sorting was done with menu_order and a plugin to rearrange in the backend
// This is a bit ugly, but uses a custom query to sort by the last_name post meta field

	$attorneys = "
	    SELECT wposts.*
	    FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
	    WHERE wposts.ID = wpostmeta.post_id
	    AND wpostmeta.meta_key = 'last_name'
	    AND wposts.post_type = 'attorneys'
		AND wposts.post_status = 'publish'
	    ORDER BY wpostmeta.meta_value ASC
	    LIMIT 80
	    ";

	$attorneys = $wpdb->get_results( $attorneys, OBJECT );

	?>
	<?php if ( ! is_home() ) : ?>
		<div class="view-all">
			<a class="button point-left" href="<?php echo esc_url( home_url( '/' ) ) . 'news-events/'; ?>">
				Back to all <br> News &amp; Events
				<span class="icon-arrow-left"></span>
			</a>
		</div>
	<?php endif; ?>

	<div class="border-block top sidebar-menu-block">
		<h3 class="block-label sidebar-menu-header">Categories <span class="icon-arrow-down"></span></h3>

		<ul class="categories sidebar-menu">
			<?php wp_list_categories( '&title_li=&depth=1' ); ?>
		</ul>
	</div>

	<div class="border-block top sidebar-menu-block">
		<h3 class="sidebar-menu-header">Attorneys <span class="icon-arrow-down"></span></h3>
		<ul class="attorneys sidebar-menu">

			<?php // while ( $attorneys->have_posts() ) : $attorneys->the_post(); ?>
			<?php foreach ( $attorneys as $post ) : ?>

				<?php

				$name = get_post_meta( $post->ID, 'first_name', true ) . ' ';
				$name .= get_post_meta( $post->ID, 'middle_initial', true ) . ' ';
				$name .= get_post_meta( $post->ID, 'last_name', true);

				?>

				<li class="">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>/news-events/attorney/<?php echo $post->post_name; ?>"><?php echo $name; ?></a>
				</li>

			<?php // endwhile; ?>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php
}


/**
 * Function to display a posts' date. Priority goes to the manual entry field,
 * then date picker, then original post date.
 *
 * @return bool|mixed|string Display date
 */
function carr_display_date() {
	global $post;

	if ( is_single() || is_front_page() ) {
		$date_string = 'F j, Y';
	} else {
		$date_string = 'M d, Y';
	}

	$display_date = get_post_meta( $post->ID, 'display_date', true );
	$display_date_manual = get_post_meta( $post->ID, 'display_date_manual', true );

	if ( $display_date_manual ) {
		$date = $display_date_manual;
	} elseif ( $display_date ) {
		$epoch_time = strtotime( $display_date );
		$date = date( $date_string, $epoch_time );
	} else {
		$date = get_the_date( $date_string );
	}

	return $date;
}