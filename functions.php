<?php
/**
 * Carr McClellan functions and definitions
 */

// Useful global constants
define( 'CARR_VERSION', '0.1' );
define( 'CARR_PATH', dirname( __FILE__ ) . '/' );

include CARR_PATH . 'includes/admin.php';
include CARR_PATH . 'includes/meta-boxes.php';
include CARR_PATH . 'includes/meta-boxes-articles.php';
include CARR_PATH . 'includes/meta-boxes-attorneys.php';
include CARR_PATH . 'includes/meta-boxes-industries.php';
include CARR_PATH . 'includes/meta-boxes-practices.php';
include CARR_PATH . 'includes/post-types.php';
include CARR_PATH . 'includes/template-tags.php';
include CARR_PATH . 'includes/v-card.php';

/**
 * Set up theme defaults and register supported WordPress features.
 */
function carr_setup() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'main'      => __( 'Header - Main', 'cmc' ),
		'footer_main' => __( 'Footer - Main', 'cmc' ),
		'footer_secondary' => __( 'Footer - Secondary', 'cmc' ),
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
}
add_action( 'after_setup_theme', 'carr_setup' );


/**
 * Enqueue scripts and styles.
 */
function carr_scripts() {
	$postfix = ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_style( 'cmc-style', get_template_directory_uri() . "/css/style{$postfix}.css" );

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr-2.5.3.min.js' );
	wp_enqueue_script( 'core', get_template_directory_uri() . "/js/core{$postfix}.js", array( 'jquery' ), '1.0', true );
}

add_action( 'wp_enqueue_scripts', 'carr_scripts' );


/**
 * Queue up custom JavaScript and CSS for the admin section
 */
function carr_admin_scripts_styles() {
	$postfix = ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) ? '' : '.min';

	global $post;
	if ( $post && in_array( $post->post_type, array( 'post', 'articles' ) ) && is_admin() ) {
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
function carr_get_practices() {

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
function carr_get_attorneys() {

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
function carr_get_newsevents() {

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