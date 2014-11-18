<?php
/**
 * Functions to change admin area components
 */

/**
 * Remove unused menus from the Dashboard
 */
function carr_remove_menus() {
	remove_menu_page( 'link-manager.php' );
	remove_menu_page( 'edit-comments.php' );
}

add_action( 'admin_menu', 'carr_remove_menus' );

/**
 * Move "Media" further down in sidebar
 */
function carr_move_media_menu() {
	global $menu;

	$menu[24] = $menu[10];
	unset( $menu[10] );
}

add_action( 'admin_menu', 'carr_move_media_menu' );


/**
 * Custom column headers for Firm History (Milestones)
 */
function milestones_edit_columns( $columns ) {
	$columns = array(
		"cb"    => "<input type=\"checkbox\" />",
		"title" => "Title"
	);

	return $columns;
}

add_filter( 'manage_edit-milestones_columns', 'milestones_edit_columns' );


/**
 * Custom column headers for Industries
 */
function industries_edit_columns( $columns ) {
	$columns = array(
		"cb"    => "<input type=\"checkbox\" />",
		"title" => "Industry Title",
	);

	return $columns;
}

add_filter( "manage_edit-industries_columns", "industries_edit_columns" );
