<?php
/**
 * Register custom post types used in theme
 */

/**
 * Register Articles custom post type
 */
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
}

add_action( 'init', 'articles_register' );


/**
 * Register Attorneys custom post type
 */
function attorneys_register() {
	$args = array(
		'label'          => __( 'Attorneys' ),
		'singular_label' => __( 'Attorney' ),
		'public'         => true,
		'show_ui'        => true,
		'hierarchical'   => false,
		'supports'       => array( 'title', 'thumbnail' ),
		'menu_icon'      => 'dashicons-businessman'
	);
	register_post_type( 'attorneys', $args );
}

add_action( 'init', 'attorneys_register' );


/**
 * Register Industries custom post type
 */
function industries_register() {
	$args = array(
		'label'           => __( 'Industries' ),
		'singular_label'  => __( 'Industry' ),
		'public'          => true,
		'show_ui'         => true,
		'capability_type' => 'post',
		'hierarchical'    => false,
		'rewrite'         => true,
		'supports'        => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'menu_icon'       => 'dashicons-hammer'
	);
	register_post_type( 'industries', $args );
}

add_action( 'init', 'industries_register' );


/**
 * Register Practices custom post type
 */
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

add_action( 'init', 'practices_register' );


/**
 * Register Firm History (Milestones) custom post type
 */
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

add_action( 'init', 'milestones_register' );