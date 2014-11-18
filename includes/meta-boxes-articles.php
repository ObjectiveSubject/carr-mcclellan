<?php

/*********************************************************
 * Custom Meta Box
 */

add_action( 'save_post', 'save_articles_meta', 15, 2 );

function articles_meta_options() {
	global $post;

	// @todo This could be refactored to use something other than pub_, but would require db migration
	$pub_attorneys = get_post_meta( $post->ID, 'pub_attorneys', true );
	$pub_practices = get_post_meta( $post->ID, 'pub_practices', true );
	?>

	<table class="form-table">
		<tr>
			<th style="width: 20%;"><label for="pub_attorneys">Attorneys</label></th>
			<td>
				<?php
				$loop = new WP_Query( array(
					'post_type'      => 'attorneys',
					'meta_key'       => 'last_name',
					'orderby'        => 'meta_value',
					'order'          => 'ASC',
					'posts_per_page' => 100
				) );
				while ( $loop->have_posts() ) {
					$loop->the_post();
					$custom = get_post_custom( $post->ID );
					$name   = $custom["last_name"][0] . ', ';
					$name .= $custom["first_name"][0] . ' ';
					$name .= $custom["middle_initial"][0];
					$id      = $post->ID;
					$checked = ( is_array( $pub_attorneys ) && in_array( $id, $pub_attorneys ) ) ? 'checked="checked"' : '';

					echo '<input type="checkbox" name="pub_attorneys[]" value="' . $id . '" ' . $checked . '/> ' . $name . '<br />';
				}
				?>
			</td>
		</tr>
		<tr>
			<th style="width: 20%;"><label for="pub_practices">Practices</label></th>
			<td>
				<?php
				$loop = new WP_Query( array(
					'post_type'      => 'practices',
					//'meta_key' => 'last_name',
					'orderby'        => 'title',
					'order'          => 'ASC',
					'posts_per_page' => 100
				) );
				while ( $loop->have_posts() ) {
					$loop->the_post();
					$id      = $post->ID;
					$checked = ( is_array( $pub_practices ) && in_array( $id, $pub_practices ) ) ? 'checked="checked"' : '';

					echo '<input type="checkbox" name="pub_practices[]" value="' . $id . '" ' . $checked . '/> ' . get_the_title() . '<br />';
				}
				?>
			</td>
		</tr>
		<?php wp_nonce_field( 'save', 'carr_articles' ); ?>
	</table>

<?php
}


function save_articles_meta( $post_id, $post ) {
	// Bail if doing autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Bail if nonce isn't set
	if ( ! isset( $_POST['carr_articles'] ) || ! wp_verify_nonce( $_POST['carr_articles'], 'save' ) ) {
		return;
	}

	// Bail if the user isn't allowed to edit the post
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Bail if not an asset
	if ( 'articles' !== $post->post_type ) {
		return;
	}

	if ( isset( $_POST["pub_attorneys"] ) ) {
		update_post_meta( $post->ID, "pub_attorneys", $_POST["pub_attorneys"] );
	}
	if ( isset( $_POST["pub_practices"] ) ) {
		update_post_meta( $post->ID, "pub_practices", $_POST["pub_practices"] );
	}
}
