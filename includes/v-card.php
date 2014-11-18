<?php
/**
 * Methods for generating an attorney v-card
 */

/**
 * Generate a v-card file based on an attorney ID
 *
 * @param $id
 */
function carr_generate_vcard( $id ) {

	require_once( 'v-card-class.php' );
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
}

/**
 * Output the vcard request
 */
function carr_vcard_content() {
	global $wp;
	global $post;

	if ( isset( $wp->query_vars['vcard'] ) ) {
		$vcard = $wp->query_vars['vcard'];

		$id = carr_get_post_id_by_slug( $vcard, 'attorneys' );

		carr_generate_vcard( $id );
		exit;
	}
}
add_action( 'parse_request', 'carr_vcard_content', 1);