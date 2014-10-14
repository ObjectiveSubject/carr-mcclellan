<?php

if ( ! function_exists( 'cmc_setup' ) ) :

function cmc_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Carr McClellan, use a find and replace
	 * to change 'cmc' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'cmc', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'main' => __( 'Main Menu', 'cmc' ),
		'secondary' => __( 'Secondary Menu', 'cmc' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

}
endif; // cmc_setup
add_action( 'after_setup_theme', 'cmc_setup' );



/**
 * Enqueue scripts and styles.
 */
function cmc_scripts() {
	wp_enqueue_style( 'cmc-style', get_stylesheet_uri() );
	
	//wp_enqueue_script( 'modernizr', 'http://cdn.jsdelivr.net/modernizr/latest/modernizr.min.js' );
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr-2.5.3.min.js' );

	wp_deregister_script('jquery');
	//wp_enqueue_script( 'jquery', '//cdn.jsdelivr.net/jquery/1.11.1/jquery.min.js', array(), false, true );
	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery-1-11-1.min.js', array(), false, true );
	wp_enqueue_script( 'core', get_template_directory_uri() . '/js/core.js', array('jquery'), '1.0', true );
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


/*******************************************************
  Custom WYSIWYG for Pages
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
  add_filter('tiny_mce_before_init', 'myformatTinyMCE' );

  function carr_load_tiny_mce() {
    wp_tiny_mce( false ); // true gives you a stripped down version of the editor
  }
  function carr_load_admin_scripts() {
    wp_enqueue_script(array('jquery', 'editor', 'media-upload'));
  }
  add_action('admin_enqueue_scripts', 'carr_load_admin_scripts');

/*******************************************************
  Register Components
*/

  // Page Excerpts
  add_post_type_support( 'page', 'excerpt' );


  // Add Support for Featured Image
  add_theme_support( 'post-thumbnails' );


  // Remove Featured Image from Posts
  add_action('do_meta_boxes', 'remove_thumbnail_box');
  function remove_thumbnail_box() {
      remove_meta_box( 'postimagediv','post','side' );
      remove_meta_box( 'postimagediv','page','side' );
      remove_meta_box( 'multi_content','attorneys','side' );
  }




/*********************************************************
    Custom Image Sizes
*/
  add_image_size( 'miletone-thumb', 210, 130, true );
  add_image_size( 'membership-thumb', 210, 90, true );
  add_image_size( 'attorney-thumb', 145, 145, true );
  add_image_size( 'attorney-detail', 284, 264, true );
  add_image_size( 'practice-chair', 71, 71, true );
  add_image_size( 'event-large', 690, 9999, false );
  add_image_size( 'event-medium', 450, 9999, false );
  add_image_size( 'news-medium', 190, 9999, false );





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
  include('functions/reg_milestones.php');

  // Memberships
  include('functions/reg_memberships.php');

  // Attorneys
  include('functions/reg_attorneys.php');

  // Practices
  include('functions/reg_practices.php');

  // Publications
  include('functions/reg_publications.php');

  // Newsletters
  include('functions/reg_newsletters.php');

  // Events
  include('functions/reg_events.php');

  // News
  include('functions/reg_news.php');

  // Posts Tagging of Attorneys
  include('functions/posts_meta.php');



  // Init all Meta Boxes
  function admin_init(){

    // Milestones
    add_meta_box("milestones_meta_options", "Options", "milestones_meta_options", "milestones");

    // Memeberships
    add_meta_box("memberships_meta_options", "Options", "memberships_meta_options", "memberships");

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
      if($post->post_type == 'events' || $post->post_type == 'news' && is_admin()) {
          wp_enqueue_script('jquery-ui-datepicker');
      }
  }
  add_action('admin_print_scripts', 'datepicker_js');

  // Register ui styles for properties
  function datepicker_css(){
      global $post;
      if($post->post_type == 'events' || $post->post_type == 'news' && is_admin()) {
          wp_enqueue_style('jquery-ui', WP_CONTENT_URL . '/themes/carr_mcclellan/js/datepicker/css/jquery-ui-1.8.16.custom.css');
      }
  }
  add_action('admin_print_styles', 'datepicker_css');


/*******************************************************
  Custom Fields
*/
	// include_once('../../plugins/advanced-custom-fields/acf.php');
	
	// Page Meta
  include('functions/page_meta.php');


/*******************************************************
  Custom RSS Feeds
*/

  add_feed('business_commercial_litigation', 'rss_1');
    function rss_1(){custom_feed(261);}
  add_feed('civil_litigation_dispute_resolution', 'rss_2');
    function rss_2(){custom_feed(263);}
  add_feed('corporate_business', 'rss_3');
    function rss_3(){custom_feed(264);}
  add_feed('creditors_rights_bankrupsy', 'rss_4');
    function rss_4(){custom_feed(265);}
  add_feed('employment', 'rss_5');
    function rss_5(){custom_feed(266);}
  add_feed('estate_planning_trust_wealth_transfer', 'rss_6');
    function rss_6(){custom_feed(268);}
  add_feed('exempt_organizations', 'rss_7');
    function rss_7(){custom_feed(269);}
  add_feed('healthcare', 'rss_8');
    function rss_8(){custom_feed(270);}
  add_feed('intellectual_property', 'rss_9');
    function rss_9(){custom_feed(271);}
  add_feed('litigation', 'rss_10');
    function rss_10(){custom_feed(288);}
  add_feed('real_estate', 'rss_11');
    function rss_11(){custom_feed(272);}
  add_feed('taxation', 'rss_12');
    function rss_12(){custom_feed(273);}
  add_feed('trust_estate_fiduciary', 'rss_13');
    function rss_13(){custom_feed(274);}


  function custom_feed($id){
    global $post;
    header('Content-Type: ' . feed_content_type('rss-http') . '; charset=' . get_option('blog_charset'), true);
    $more = 1;
    echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>'; ?>
    <rss version="0.92">
      <channel>
        <title><?php bloginfo_rss('name'); wp_title_rss(); ?></title>
        <link><?php bloginfo_rss('url') ?></link>
        <description><?php bloginfo_rss('description') ?></description>
        <lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
        <docs>http://backend.userland.com/rss092</docs>
        <language><?php echo get_option('rss_language'); ?></language>
    <?php
      do_action('rss_head');

      // Get all Publications
      $loop_pub = new WP_Query(array(
          'post_type' => 'publications',
          'orderby' => 'date',
          'order' => 'DESC',
          'posts_per_page' => 100
        ));
      while ( $loop_pub->have_posts() ) :
        $loop_pub->the_post();
        $practices_array = get_post_meta($post->ID, 'pub_practices', 'single');

        // Filter by Practice
        if(in_array($id, $practices_array)) :
    ?>

      <item>
        <title><?php the_title_rss() ?></title>
        <description><![CDATA[<?php the_excerpt_rss() ?>]]></description>
        <link><?php the_permalink_rss() ?></link>
        <?php do_action('rss_item'); ?>
      </item>

    <?php endif; endwhile; ?>

      </channel>
    </rss>
    <?php
  }







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


?>