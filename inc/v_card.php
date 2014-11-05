<?php
/**
 * Methods for generating an attorney v-card
 */

function carr_get_attorney_id_by_slug( $page_slug ) {
	$attorney = get_posts( array(
		'name' => $page_slug,
		'post_type' => 'attorneys',
		'post_status' => 'publish'
	));

	if ( $attorney ) {
		return $attorney[0]->ID;
	} else {
		return null;
	}
}

function carr_generate_vcard( $id ) {

	require_once( 'v_card_class.php' );
	$vc = new vcard();

	$vc->data['first_name']      = get_post_meta( $id, 'first_name', true );
	$vc->data['last_name']       = get_post_meta( $id, 'last_name', true );
	$vc->data['additional_name'] = get_post_meta( $id, 'middle_initial', true );

	$vc->data['company'] = 'Carr McClellan P.C.'; // replace with blog name?
	$vc->data['title']   = get_post_meta( $id, 'title', true );

	$vc->data['work_address']     = '216 Park Road'; // Replace these with something in admin?
	$vc->data['work_city']        = 'Burlingame';
	$vc->data['work_state']       = 'CA';
	$vc->data['work_postal_code'] = '94010';

	$phone = get_post_meta( $id, 'phone', true );
	$fax   = get_post_meta( $id, 'fax', true );


	$vc->data['office_tel'] = ( $phone ) ? $phone : '(650) 342-9600';
	$vc->data['fax_tel']    = ( $fax ) ? $fax : '(650) 342-7685';

	$vc->data['email1'] = get_post_meta( $id, 'email', true );

	$vc->data['url'] = 'http://www.carr-mcclellan.com';

	$vc->data['filename'] = $vc->data['first_name'] . '-' . $vc->data['last_name'];

	$vc->download();

	return;

	// var_dump( $vc->data );
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

	return $vars;
}
add_filter( 'query_vars', 'carr_add_query_vars' );

/**
 * Custom paths for the vcard
 */
function carr_add_endpoint() {
	add_rewrite_rule( '^v-card/([^/\.]+)/?$', 'index.php?vcard=$matches[1]', 'top' );
}
add_action( 'init', 'carr_add_endpoint' );

/**
 * Output the vcard request
 */
function carr_vcard_content() {
	global $wp;
	global $post;

	if ( isset( $wp->query_vars['vcard'] ) ) {
		$vcard = $wp->query_vars['vcard'];

		$id = carr_get_attorney_id_by_slug( $vcard );

		carr_generate_vcard( $id );
		exit;
	}
}
add_action( 'parse_request', 'carr_vcard_content', 1);