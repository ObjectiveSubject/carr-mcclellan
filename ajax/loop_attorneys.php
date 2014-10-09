<?php
// Our include
define('WP_USE_THEMES', false);
require_once('../../../../wp-load.php');

// Our variables
$postType = (isset($_GET['postType'])) ? $_GET['postType'] : 'attorneys';
$args = array(
	'post_type' => $postType,
	'posts_per_page' => 1
);
$loop = new WP_Query($args);
 
// our loop
if ($loop->have_posts()) {
	while ($loop->have_posts()){ $loop->the_post();
		include_once( 'single-attorney.php' );
	}
}

wp_reset_query(); ?>