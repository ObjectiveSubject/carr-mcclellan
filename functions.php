<?php

if ( ! function_exists( 'cmc_setup' ) ) :

function cmc_setup() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'main' => __( 'Main Menu', 'cmc' ),
		'secondary' => __( 'Secondary Menu', 'cmc' ),
	) );

	// Page Excerpts
	add_post_type_support( 'page', 'excerpt' );

	// Switch default core markup for search form, comment form, and comments
	// to output valid HTML5
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
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
	wp_enqueue_style( 'cmc-style', get_stylesheet_uri() );

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr-2.5.3.min.js' );
	wp_enqueue_script( 'core', get_template_directory_uri() . '/js/core.js', array( 'jquery' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'cmc_scripts' );



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';



/*----------------------------------------------------------
------------------------------------------------------------
From here down is stuff brought over from Carr McClellan 1.0
------------------------------------------------------------
------------------------------------------------------------
*/


/*******************************************************
  Register Components
*/

/*******************************************************
-  Custom WYSIWYG for Pages
 */
function myformatTinyMCE($in) {
	$post = get_post($post_id);
	if ($post->post_type == 'page') {
		$in['theme_advanced_buttons1'] = 'formatselect,bold,italic,|,bullist,numlist,blockquote,link,unlink,pastetext,pasteword,removeformat,undo,redo';
		$in['theme_advanced_buttons2'] = '';
		$in['theme_advanced_buttons3'] = '';
		$in['theme_advanced_buttons4'] = '';
	}
	return $in;
}
//add_filter('tiny_mce_before_init', 'myformatTinyMCE' );

  // Remove Featured Image from Posts
  add_action('do_meta_boxes', 'remove_thumbnail_box');
  function remove_thumbnail_box() {
      remove_meta_box( 'postimagediv','post','side' );
      remove_meta_box( 'postimagediv','page','side' );
      remove_meta_box( 'multi_content','attorneys','side' );
  }





/*******************************************************
  Custom WP Login Logo
*/

  add_action("login_head", "my_login_head");
  function my_login_head() {
    echo "
    <style>
    body.login #login h1 a {
      background: url('".get_bloginfo('template_url')."/images/carr-login.png') no-repeat scroll center top transparent !important; background-size: 274px 63px; width: 274px; height: 63px; 

    }
    </style>
    ";
  }





/*******************************************************
  Register Custom Post Types
*/

  // Milestones
  include( 'inc/reg_milestones.php' );

  // Attorneys
  include( 'inc/reg_attorneys.php' );

  // Practices
  include( 'inc/reg_practices.php' );

  // Publications
  include( 'inc/reg_publications.php' );

  // Newsletters
  include( 'inc/reg_newsletters.php' );

  // Events
  include( 'inc/reg_events.php' );

  // News
  include( 'inc/reg_news.php' );

  // Posts Tagging of Attorneys
  include( 'inc/posts_meta.php' );



  // Init all Meta Boxes
  function admin_init(){

    // Milestones
    add_meta_box("milestones_meta_options", "Options", "milestones_meta_options", "milestones");

    // Attorneys
    add_meta_box("attorneys_meta_options", "Attorney Information", "attorneys_meta_options", "attorneys");

    // Practices
    add_meta_box("practices_meta_options", "Practice Information", "practices_meta_options", "practices");
    add_meta_box("practices_attorneys_meta_options", "Practicing Attorneys", "practices_attorneys_meta_options", "practices", "side");

    // Publications
    add_meta_box("publications_meta_options", "Publication Information", "publications_meta_options", "publications");

    // Newsletters
    add_meta_box("newsletters_meta_options", "Newsletter Information", "newsletters_meta_options", "newsletters");

    // Events
    add_meta_box("events_meta_options", "Event Information", "events_meta_options", "events");

    // News
    add_meta_box("news_meta_options", "News Information", "news_meta_options", "news");

    // Posts
    add_meta_box("posts_attorneys_meta_options", "Tag Attorneys", "posts_attorneys_meta_options", "post", "side");
    add_meta_box("posts_practices_meta_options", "Tag Practices", "posts_practices_meta_options", "post", "side");
  }


  // Register datepicker ui for properties
  function datepicker_js(){
      global $post;
      if( $post && ( $post->post_type == 'events' || $post->post_type == 'news' ) && is_admin() ) {
          wp_enqueue_script('jquery-ui-datepicker');
      }
  }
  add_action('admin_print_scripts', 'datepicker_js');

  // Register ui styles for properties
  function datepicker_css(){
      global $post;
      if( $post && ( $post->post_type == 'events' || $post->post_type == 'news' ) && is_admin() ) {
          wp_enqueue_style('jquery-ui', WP_CONTENT_URL . '/themes/carr_mcclellan/js/datepicker/css/jquery-ui-1.8.16.custom.css  ');
      }
  }
  add_action('admin_print_styles', 'datepicker_css');


/*******************************************************
  Theme Options Page
*/

  function themeoptions_admin_menu() {
    add_menu_page("Theme Options", "Theme Options", 'manage_options', basename(__FILE__), 'themeoptions_page');
  }

  function themeoptions_page() {
    if ( $_POST['update_themeoptions'] == 'true' ) { themeoptions_update(); }
      $about_carr = get_option('about_carr');
      $email_signup = get_option('email_signup');

      $about_carr = str_replace("\'","'",$about_carr);
      $about_carr = str_replace('\"','"',$about_carr);
    ?>

    <script type="text/javascript">
      jQuery(document).ready(function($) {
        tinyMCE.init({
          plugins : "paste wplink",
          theme_advanced_buttons1 : "bold,italic,separator,numlist,bullist,separator,link,unlink,separator,pasteword,pastetext",
          theme_advanced_buttons2 : "",
          theme_advanced_buttons3 : "",
          mode : "specific_textareas",
          editor_selector : /(about_carr)/,
          theme_advanced_toolbar_location : "top",
          theme_advanced_toolbar_align : "left",
          theme_advanced_resizing : true,
          theme_advanced_resizing_max_height : 240,
          menubar : false
        });
      });

    </script>

    <div class="wrap">
      <div id="icon-themes" class="icon32"><br /></div>
      <h2>Theme Options</h2>
      <form method="POST" action="">
        <input type="hidden" name="update_themeoptions" value="true" />
        <table class="form-table">
          <tbody>
            <tr valign="top">
              <th scope="row">
                <label for="about_carr">
                  <strong>About Carr</strong><br />
                  <small>(Text the bottom of each page.)</small>
                </label>
              </th>
              <td>
                <textarea class="about_carr" name="about_carr" style="width: 310px;height:130px;"><?php echo $about_carr; ?></textarea>
              </td>
            </tr>
            <tr valign="top">
              <th scope="row">
                <label for="email_signup">
                  <strong>Email Sign Up</strong><br />
                  <small>(Text the bottom of each page.)</small>
                </label>
              </th>
              <td>
                <textarea name="email_signup" style="width: 310px;height:50px;"><?php $email_signup = str_replace('\"', '"', $email_signup); echo $email_signup; ?></textarea>
              </td>
            </tr>
          </tbody>
        </table>

        <p style="margin-top:30px;"><input type="submit" value="Update Options" class="button-primary" /></p>
      </form>

    </div>
    <?php
  }

  function themeoptions_update() {

    update_option('about_carr',   $_POST['about_carr']);
    update_option('email_signup',   $_POST['email_signup']);
  }
  add_action('admin_menu', 'themeoptions_admin_menu');

/**
 * Retrieve the practices list and display
 */
function cmc_get_practices() {

	$practices = new WP_Query( array(
		'post_type' => 'practices',
		'orderby' => 'title',
		'order' => 'ASC',
		'posts_per_page' => 100
	));

?>
	<div class="practices">

	<?php while ( $practices->have_posts() ) : $practices->the_post(); global $post; ?>

		<article class="practice <?php echo esc_attr( $post->post_name ); ?>">
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

	$attorneys = new WP_Query(array(
		'post_type' => 'attorneys',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page' => 3
	));

	?>
	<div class="attorneys">

		<?php while ( $attorneys->have_posts() ) : $attorneys->the_post(); ?>

			<?php
				global $post;
				$name = get_post_meta( $post->ID, 'first_name', true ) . ' ';
				$name .= get_post_meta( $post->ID, 'middle_initial', true ) . ' ';
				$name .= get_post_meta( $post->ID, 'last_name', true);

				$title = get_post_meta( $post->ID, 'title', true );
				$sec_title = get_post_meta( $post->ID, 'secondary_title', true );
			?>

			<article class="border-block top-right-bottom square attorney">
				<h3><a href="<?php the_permalink() ?>"><?php echo $name; ?></a></h3>

				<p class="titles">
					<?php echo $title; ?>
					<?php if ( $title && $sec_title ) echo '<br>'; ?>
					<?php echo $sec_title; ?>
				</p>

				<?php the_post_thumbnail('attorney-thumb', array( 'class' => 'alignleft png-bg' ) ); ?>
			</article>

		<?php endwhile; ?>

	</div>
<?php
}

/**
 * Retrieve recent news and events
 */
function cmc_get_newsevents() {

	$practices = new WP_Query( array(
		'post_type' => array( 'post', 'event' ),
		'orderby' => 'date',
		'posts_per_page' => 6
	));

	?>
	<div class="news-events">

		<?php while ( $practices->have_posts() ) : $practices->the_post(); global $post; ?>

			<article class="practice <?php echo esc_attr( $post->post_name ); ?>">
				<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
				<a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
			</article>

		<?php endwhile; ?>

	</div>
<?php
}