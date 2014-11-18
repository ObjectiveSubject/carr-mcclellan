<?php

if ( ! function_exists( 'cmc_setup' ) ) :

	function cmc_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'main'      => __( 'Main Menu', 'cmc' ),
			'secondary' => __( 'Secondary Menu', 'cmc' ),
		) );

		// Page Excerpts
		add_post_type_support( 'page', 'excerpt' );

		// Switch default core markup for search form, comment form, and comments
		// to output valid HTML5
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Image sizes from v1.0 of theme
		add_image_size( 'miletone-thumb', 210, 130, true );
		add_image_size( 'attorney-thumb', 145, 145, true );
		add_image_size( 'attorney-detail', 284, 264, true );
		add_image_size( 'practice-chair', 71, 71, true );
		add_image_size( 'event-large', 690, 9999, false );
		add_image_size( 'event-medium', 450, 9999, false );
		add_image_size( 'news-medium', 190, 9999, false );

	}
endif; // cmc_setup
add_action( 'after_setup_theme', 'cmc_setup' );


/**
 * Enqueue scripts and styles.
 */
function cmc_scripts() {
	$postfix = ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_style( 'cmc-style', get_template_directory_uri() . "/css/style{$postfix}.css" );

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr-2.5.3.min.js' );
	wp_enqueue_script( 'core', get_template_directory_uri() . "/js/core{$postfix}.js", array( 'jquery' ), '1.0', true );
}

add_action( 'wp_enqueue_scripts', 'cmc_scripts' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom functions that for the admin area.
 */
require get_template_directory() . '/inc/admin.php';


/*----------------------------------------------------------
------------------------------------------------------------
From here down is stuff brought over from Carr McClellan 1.0
------------------------------------------------------------
------------------------------------------------------------
*/


/*******************************************************
 * Register Components
 */

/*******************************************************
 * -  Custom WYSIWYG for Pages
 */
function myformatTinyMCE( $in ) {
	$post = get_post( $post_id );
	if ( $post->post_type == 'page' ) {
		$in['theme_advanced_buttons1'] = 'formatselect,bold,italic,|,bullist,numlist,blockquote,link,unlink,pastetext,pasteword,removeformat,undo,redo';
		$in['theme_advanced_buttons2'] = '';
		$in['theme_advanced_buttons3'] = '';
		$in['theme_advanced_buttons4'] = '';
	}

	return $in;
}

//add_filter('tiny_mce_before_init', 'myformatTinyMCE' );

/*******************************************************
 * Register Custom Post Types
 */

// Articles
include( 'inc/reg_articles.php' );

// Attorneys
include( 'inc/reg_attorneys.php' );

// Practices
include( 'inc/reg_practices.php' );

// Industries
include( 'inc/reg_industries.php' );

// Milestones
include( 'inc/reg_milestones.php' );

// Posts Tagging of Attorneys
include( 'inc/posts_meta.php' );

include( 'inc/v_card.php' );


// Init all Meta Boxes
function admin_init() {

	// Attorneys
	add_meta_box( "attorneys_meta_options", "Attorney Information", "attorneys_meta_options", "attorneys" );

	// Industries
	add_meta_box( "industries_meta_options", "Related Practices", "industries_meta_options", "industries" );

	// Practices
	add_meta_box( "practices_meta_options", "Practice Information", "practices_meta_options", "practices" );
	add_meta_box( "practices_attorneys_meta_options", "Practicing Attorneys", "practices_attorneys_meta_options", "practices", "side" );

	// Articles
	add_meta_box( "articles_meta_options", "Article Information", "articles_meta_options", "articles" );
	add_meta_box( 'carr_post_options', 'Options', 'carr_post_options', 'articles', 'side' );


	// Posts
	add_meta_box( "posts_attorneys_meta_options", "Tag Attorneys", "posts_attorneys_meta_options", "post", "side" );
	add_meta_box( "posts_practices_meta_options", "Tag Practices", "posts_practices_meta_options", "post", "side" );
	add_meta_box( 'carr_post_options', 'Display Date', 'carr_post_options', 'post', 'side' );
	add_meta_box( 'carr_post_news_options', 'News Options', 'carr_post_news_options', 'post' );

	// Pages
	add_meta_box( "carr_page_sidebars", "Sidebars", "carr_page_sidebars", "page" );
}

/**
 * Queue up custom JavaScript and CSS for the admin section
 */
function carr_admin_scripts_styles() {
	$postfix = ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) ? '' : '.min';

	global $post;
	if ( $post && ( $post->post_type == 'post' ) && is_admin() ) {
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_style( 'jquery-ui-datepicker', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css' );
	}

	wp_enqueue_script( 'carr-admin-js', get_template_directory_uri() . "/js/admin{$postfix}.js", array( 'jquery' ), false, true );
	wp_enqueue_style( 'carr-admin-css', get_template_directory_uri() . "/css/admin{$postfix}.css" );

}

add_action( 'admin_enqueue_scripts', 'carr_admin_scripts_styles' );


/**
 * Retrieve the practices list and display
 */
function cmc_get_practices() {

	$practices = new WP_Query( array(
		'post_type'      => 'practices',
		'orderby'        => 'title',
		'order'          => 'ASC',
		'posts_per_page' => 100
	) );

	?>
	<div class="practices">

		<?php while ( $practices->have_posts() ) : $practices->the_post();
			global $post; ?>

			<article class="border-block square practice <?php echo esc_attr( $post->post_name ); ?>">
				<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
			</article>

		<?php endwhile; ?>

	</div>
<?php
}

/**
 * Retrieve a short list of attorneys and display
 */
function cmc_get_attorneys() {

	$attorneys_zone = z_get_zone_query( 'home-attorneys' );

	if ( $attorneys_zone->have_posts() ) {
		$attorneys = $attorneys_zone;
	} else {
		$attorneys = new WP_Query( array(
			'post_type'      => 'attorneys',
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'posts_per_page' => 3
		) );
	}

	?>
	<div class="attorneys">

		<?php while ( $attorneys->have_posts() ) : $attorneys->the_post(); ?>

			<?php
			global $post;
			$name = get_post_meta( $post->ID, 'first_name', true ) . ' ';
			$name .= get_post_meta( $post->ID, 'middle_initial', true ) . ' ';
			$name .= get_post_meta( $post->ID, 'last_name', true );

			$title     = get_post_meta( $post->ID, 'title', true );
			$sec_title = get_post_meta( $post->ID, 'secondary_title', true );
			?>

			<article class="border-block top-right-bottom square attorney">
				<a href="<?php the_permalink() ?>">
					<h3><?php echo $name; ?></h3>
	
					<p class="titles">
						<?php echo $title; ?>
						<?php if ( $title && $sec_title ) {
							echo '<br>';
						} ?>
						<?php echo $sec_title; ?>
					</p>
	
					<?php the_post_thumbnail( 'attorney-thumb', array( 'class' => 'alignleft png-bg' ) ); ?>
				</a>
			</article>

		<?php endwhile; ?>

	</div>
<?php
}

/**
 * Retrieve recent news and events
 */
function cmc_get_newsevents() {

	$news_events_zone = z_get_zone_query( 'home-news-events' );

	if ( $news_events_zone->have_posts() ) {
		$news_events = $news_events_zone;
	} else {
		$news_events = new WP_Query( array(
			'post_type'      => array( 'post' ),
			'orderby'        => 'date',
			'posts_per_page' => 6
		) );
	}

	$count = 1;

	?>
	<div class="news-events">

		<?php while ( $news_events->have_posts() ) : $news_events->the_post();
			global $post; ?>

			<?php if ( $count % 3 == 1 ) : ?>
			<section class="section-<?php echo ceil( $count / 3 ); ?>">
			<?php endif; ?>
				<article class="solid-block square news event child<?php echo $count; ?>">
					<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
					<a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
				</article>
			<?php if ( $count % 3 == 0 ) : ?>
				</section>
			<?php endif; ?>
			<?php $count ++; ?>
		<?php endwhile; ?>

	</div>
<?php
}

/**
 * Given a page slug and post type, return id
 *
 * @param $page_slug
 * @param $post_type
 *
 * @return null
 */
function carr_get_post_id_by_slug( $page_slug, $post_type ) {
	$attorney = get_posts( array(
		'name' => $page_slug,
		'post_type' => $post_type,
		'post_status' => 'publish'
	));

	if ( $attorney ) {
		return $attorney[0]->ID;
	} else {
		return null;
	}
}

/**
 * Custom query variables for the vcard
 *
 * @param $vars
 *
 * @return array
 */
function carr_add_query_vars( $vars ) {
	$vars[] = 'vcard';
	$vars[] = 'news_events';
	$vars[] = 'attorney';
	$vars[] = 'practice';

	return $vars;
}
add_filter( 'query_vars', 'carr_add_query_vars' );

/**
 * Custom paths for the vcard
 */
function carr_add_endpoint() {
	add_rewrite_rule( '^v-card/([^/\.]+)/?$', 'index.php?vcard=$matches[1]', 'top' );
	add_rewrite_rule( '^news-events/attorney/([^/\.]+)/?$', 'index.php?news_events=1&attorney=$matches[1]', 'top' );
	add_rewrite_rule( '^news-events/practice/([^/\.]+)/?$', 'index.php?news_events=1&practice=$matches[1]', 'top' );
}
add_action( 'init', 'carr_add_endpoint' );

/**
 * Output the vcard request
 */
function carr_news_events_terminals() {
	global $wp;
	global $post;

	if ( isset( $wp->query_vars['news_events'] ) ) {
		if ( isset( $wp->query_vars['attorney'] ) ) {
			include dirname( __FILE__ ) . '/posts-attorney.php';
			exit;
		}
		if ( isset( $wp->query_vars['practice'] ) ) {
			include dirname( __FILE__ ) . '/posts-practice.php';
			exit;
		}
	}
}
add_action( 'parse_request', 'carr_news_events_terminals', 1);

/**
 * Add Attorney posts to Zoninator
 */
function carr_add_zoninator_post_types() {
	add_post_type_support( 'attorneys', 'zoninator_zones' );
}
add_action( 'init', 'carr_add_zoninator_post_types' );

/**
 * Adds custom classes to the array of body classes.
 */
function carr_body_classes( $classes ) {
	global $post;
	foreach( $classes as &$str ){
		if( strpos( $str, "page-id-" ) > -1 ){
			$str = "page-" . $post->post_name;
		}
	}
	return $classes;
}
// add_filter( 'body_class', 'carr_body_classes' );

/**
 * Check if an In the News post has a clickthrough set and redirect there.
 *
 * @todo would it be better to change the permalink, rather than do a redirect?
 */
function carr_redirect() {
	global $post;
	$post_type = get_post_type();

	if ( is_single() && $post_type == 'post' ) {
		$clickthrough = get_post_meta( $post->ID, 'source_url', true );

		if ( $clickthrough ) {
			wp_redirect( $clickthrough );
			exit;
		}

		if ( has_category( 'in-the-news') ) {
			$news_type_select = get_post_meta($post->ID, "news_type_select", true );

			if ( 'pdf' == $news_type_select ) {
				$attachments = attachments_get_attachments();
				if ( $attachments ) {
					$pdf = $attachments[0]['location'];

					wp_redirect( $pdf );
					exit;
				}

			} elseif ( 'external' == $news_type_select ) {
				$source_url = get_post_meta($post->ID, "source_url", true );

				wp_redirect( $source_url );
				exit;
			}
		}
	}

	if ( is_single() && $post_type == 'industries' ) {
		$new_url = esc_url( home_url( '/' ) ) . 'industries/#' . $post->post_name;
		wp_redirect( $new_url );
	}
}
add_action( 'template_redirect', 'carr_redirect' );