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
				if ( $categories_list ) {
						printf( '<span class="cat-links">' . __( 'Posted in %1$s', 'cmc' ) . '</span>', $categories_list );
				}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'cmc' ) );
		if ( $tags_list ) {
						printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'cmc' ) . '</span>', $tags_list );
					}
	}
}
endif;

function cmc_share_links() {
	global $post;

	$permalink = get_the_permalink( $post->ID );
	$title = get_the_title( $post->title );
	?>

	<div class="border-block top social-share">
		<h3 class="block-label">Share</h3>
		<ul>
			<?php // @TODO These need some work and more testing ?>
			<li><a href="https://twitter.com/share?url=<?php echo $permalink; ?>&title=<?php echo $title; ?>" class="social-icon icon-twitter"><span class="hide-text">Twitter</span></a></li>
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

	$attorneys = new WP_Query(array(
		'post_type' => 'attorneys',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page' => 80
	));

	?>
	<?php if ( ! is_home() ) : ?>
		<div class="view-all">
			<a class="button point-left" href="<?php echo esc_url( home_url( '/' ) ) . 'news-events/'; ?>">
				Back to all <br> News &amp; Events
				<span class="icon-arrow-left"></span>
			</a>
		</div>
	<?php endif; ?>

	<div class="border-block top">
		<h3 class="block-label">Categories</h3>

		<ul class="categories">
			<?php wp_list_categories( '&title_li=&depth=1' ); ?>
		</ul>
	</div>

	<div class="border-block top">
		<h3>Attorneys</h3>
		<ul class="attorneys">

			<?php while ( $attorneys->have_posts() ) : $attorneys->the_post(); ?>

				<?php

				$name = get_post_meta( $post->ID, 'first_name', true ) . ' ';
				$name .= get_post_meta( $post->ID, 'middle_initial', true ) . ' ';
				$name .= get_post_meta( $post->ID, 'last_name', true);

				?>

				<li class="">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>/news-events/attorney/<?php echo $post->post_name; ?>"><?php echo $name; ?></a>
				</li>

			<?php endwhile; ?>
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

	/* Kirk's string for timestamps on Archive/Category pages
	 * <h4 class="timestamp"><span class="month"><?php the_time('M. '); ?></span><span class="day-year"><?php the_time('d, Y'); ?></span></h4>
	 */

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