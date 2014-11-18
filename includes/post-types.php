<?php
/**
 * Register custom post types used in theme
 */

/*********************************************************
 * Register Custom Post Type
 */

add_action( 'init', 'articles_register' );
function articles_register() {
	$args = array(
		'label'           => __( 'Articles' ),
		'singular_label'  => __( 'Article' ),
		'public'          => true,
		'show_ui'         => true,
		'capability_type' => 'post',
		'hierarchical'    => false,
		'rewrite'         => true,
		'supports'        => array( 'title', 'editor' ),
		'menu_icon'       => 'dashicons-media-text'
	);
	register_post_type( 'articles', $args );


	register_taxonomy(
		'publications',
		'articles',
		array(
			'label'        => 'Article Type',
			'sort'         => true,
			'args'         => array( 'orderby' => 'term_order' ),
			//'rewrite' => array('slug' => 'pub_type'),
			'rewrite'      => array( 'slug' => 'articles' ),
			'hierarchical' => true
		)
	);

}

/*********************************************************
 * Register Custom Post Type
 */

add_action( 'init', 'attorneys_register' );

function attorneys_register() {
	$args = array(
		'label'          => __( 'Attorneys' ),
		'singular_label' => __( 'Attorney' ),
		'public'         => true,
		'show_ui'        => true,
		//'capability_type' => 'post',
		'hierarchical'   => false,
		//'rewrite' => true,
		'supports'       => array( 'title', 'thumbnail' ),
		'menu_icon'       => 'dashicons-businessman'
	);
	register_post_type( 'attorneys', $args );
}

// Disable Autosave ** Edit - Modified save_attorneys_meta() to fix autosave
//
//add_action('admin_print_scripts', 'disable_autosave');
function disable_autosave() {
	global $post;
	if ( get_post_type( $post->ID ) === 'attorneys' ) {
		wp_deregister_script( 'autosave' );
	}
}

/*********************************************************
Register Custom Post Type
 */

add_action( 'init', 'industries_register' );
function industries_register() {
	$args = array(
		'label' => __('Industries'),
		'singular_label' => __('Industry'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => true,
		'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'menu_icon'       => 'dashicons-hammer'
	);
	register_post_type( 'industries' , $args );
}


/*********************************************************
 * Register Custom Post Type
 */

add_action( 'init', 'milestones_register' );
function milestones_register() {
	$args = array(
		'label'           => __( 'Firm History' ),
		'singular_label'  => __( 'Milestones' ),
		'public'          => false,
		'show_ui'         => true,
		'capability_type' => 'post',
		'hierarchical'    => false,
		'rewrite'         => true,
		'supports'        => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'menu_icon'       => 'dashicons-clock'
	);
	register_post_type( 'milestones', $args );
}

/*********************************************************
 * Register Custom Post Type
 */


add_action( 'init', 'practices_register' );
function practices_register() {
	$args = array(
		'label'          => __( 'Practices' ),
		'singular_label' => __( 'Practice' ),
		'public'         => true,
		'show_ui'        => true,
		'hierarchical'   => false,
		'rewrite'        => true,
		'supports'       => array( 'title', 'editor' ),
		'menu_icon'      => 'dashicons-portfolio'
	);
	register_post_type( 'practices', $args );
}