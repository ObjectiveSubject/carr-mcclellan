<?php
/*********************************************************
Custom Meta Box
 */

add_action( 'save_post', 'save_industries_meta', 15, 2 );

function industries_meta_options(){
	global $post;

	$areas_practice = get_post_meta($post->ID, 'areas_practice', true);
	?>

	<tr>
		<td>
			<div style="background:#fff;border:1px solid #ccc;padding:10px;">
				<?php
				$loop = new WP_Query(array(
					'post_type' => 'practices',
					'orderby' => 'title',
					'order' => 'ASC',
					'posts_per_page' => 100
				));
				while ( $loop->have_posts() ) {
					$loop->the_post();
					$id = $post->ID;
					$custom = get_post_custom($id);
					$name = get_the_title();
					$cust_name = str_replace(',','', $name);
					$cust_name = str_replace('&','', $cust_name);
					$selected = ( is_array($areas_practice) && in_array($id, $areas_practice)) ? 'checked="checked"' : '';
					echo '<input type="checkbox" class="areas" name="areas_practice[]"';
					echo 'value="' . $id . '" ' . $selected . '/> ' . $name . ' <br />';
				}
				?>
			</div>
		</td>
	</tr>

	<?php wp_nonce_field( 'save', 'carr_industries' ); ?>
	</table>

<?php
}

function save_industries_meta( $post_id, $post ) {
	// Bail if doing autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }

	// Bail if nonce isn't set
	if ( ! isset( $_POST['carr_industries'] ) || ! wp_verify_nonce( $_POST['carr_industries'], 'save' ) ) { return; }

	// Bail if the user isn't allowed to edit the post
	if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }

	// Bail if not an asset
	if ( 'industries' !== $post->post_type ) { return; }

	global $post;

	if ( isset( $_POST["areas_practice"] ) ) {
		update_post_meta( $post->ID, "areas_practice", $_POST["areas_practice"] );
	} else {
		update_post_meta( $post->ID, "areas_practice", '' );
	}

}
