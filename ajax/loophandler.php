<?php
// Our include
define('WP_USE_THEMES', false);
require_once('../../../../wp-load.php');

// Our variables
$numPosts = (isset($_GET['numPosts'])) ? $_GET['numPosts'] : 1;
$page = (isset($_GET['pageNumber'])) ? $_GET['pageNumber'] : 1;
$postType = (isset($_GET['postType'])) ? $_GET['postType'] : 'post';

$args = array(
	'posts_per_page' => $numPosts,
	'paged'          => $page,
	'post_type'      => $postType
);
$loop = new WP_Query($args);
 
// our loop
if ($loop->have_posts()) {
	while ($loop->have_posts()){ $loop->the_post();
		//get_template_part( 'content', get_post_format() );
		echo get_the_title() . ' - ';
	}
}

wp_reset_query(); ?>