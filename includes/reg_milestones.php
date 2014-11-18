<?php


/*********************************************************
 * Custom Column Headers
 */

add_filter( "manage_edit-milestones_columns", "milestones_edit_columns" );

function milestones_edit_columns( $columns ) {
	$columns = array(
		"cb"    => "<input type=\"checkbox\" />",
		"title" => "Title"
	);

	return $columns;
}