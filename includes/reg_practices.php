<?php

/*********************************************************
 * Custom Meta Box
 */

add_action( "admin_init", "admin_init" );
add_action( 'save_post', 'save_practices_meta', 15, 2 );

function practices_meta_options() {
	global $post;

	$tagline          = get_post_meta( $post->ID, "tagline", true );
	$description      = get_post_meta( $post->ID, "description", true );
	$chair_id         = get_post_meta( $post->ID, "chair_id", true );
	$attorney_title   = get_post_meta( $post->ID, "attorney_title", true );
	$chair_id_2       = get_post_meta( $post->ID, "chair_id_2", true );
	$attorney_title_2 = get_post_meta( $post->ID, "attorney_title_2", true );
	$practices_url    = get_post_meta( $post->ID, "practices_url", true );
	$rep_matters      = get_post_meta( $post->ID, "rep_matters", true );
	$industry_hidden  = get_post_meta( $post->ID, "industry_hidden", true );
	$industry         = get_post_meta( $post->ID, 'industry', true );

	?>

	<table class="form-table">

		<tr>
			<th style="width: 20%;"><label for="tagline">Tagline</label></th>
			<td>
				<textarea class="" name="tagline" style="width: 97%;height:50px;"><?php echo $tagline; ?></textarea>
				<!-- <input type="text" class="text_input" name="tagline" value="<?php echo $tagline; ?>" style="width:97%" /> -->
			</td>
		</tr>
		<tr style="display:none;">
			<th style="width: 20%;"><label for="description">Description</label></th>
			<td>
				<textarea name="description" style="width: 97%;height:140px;"><?php echo $description; ?></textarea>
			</td>
		</tr>

		<tr>
			<th style="width: 20%;"><label for="chair_id">Attorney 1</label></th>
			<td>
				<select name="chair_id">
					<option value=''>None</option>
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
						$name   = get_post_meta( $post->ID, "last_name", true ) . ', ';
						$name .= get_post_meta( $post->ID, "first_name", true ) . ' ';
						$name .= get_post_meta( $post->ID, "middle_initial", true );
						$id       = $post->ID;
						$selected = ( $chair_id == $id ) ? 'selected="selected"' : '';
						echo '<option value="' . $id . '" ' . $selected . '>' . $name . '</option>';
					}
					?>
				</select>
				<select name="attorney_title">
					<option value="Practice Contact" <?php echo ( $attorney_title == 'Practice Contact' ) ? 'selected="selected"' : ''; ?>>Practice Contact</option>
					<option value="Practice Chair" <?php echo ( $attorney_title == 'Practice Chair' ) ? 'selected="selected"' : ''; ?>>Practice Chair</option>
				</select>
			</td>
		</tr>
		<tr>
			<th style="width: 20%;"><label for="chair_id_2">Attorney 2</label></th>
			<td>
				<select name="chair_id_2">
					<option value=''>None</option>
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
						$name = get_post_meta( $post->ID, "last_name", true ) . ', ';
						$name .= get_post_meta( $post->ID, "first_name", true ) . ' ';
						$name .= get_post_meta( $post->ID, "middle_initial", true );
						$id       = $post->ID;
						$selected = ( $chair_id_2 == $id ) ? 'selected="selected"' : '';
						echo '<option value="' . $id . '" ' . $selected . '>' . $name . '</option>';
					}
					?>
				</select>
				<select name="attorney_title_2">
					<option value="Practice Contact" <?php echo ( $attorney_title_2 == 'Practice Contact' ) ? 'selected="selected"' : ''; ?>>Practice Contact</option>
					<option value="Practice Chair" <?php echo ( $attorney_title_2 == 'Practice Chair' ) ? 'selected="selected"' : ''; ?>>Practice Chair</option>
				</select>
			</td>
		</tr>

		<tr>
			<th style="width: 20%;"><label for="rep_matters">Representative Matters</label></th>
			<td>
				<?php wp_editor( $rep_matters, 'rep_matters' ); ?>
			</td>
		</tr>

		<tr>
			<th style="width: 20%;"><label for="industry">Industries</label></th>
			<td>
				<div style="height:90px;overflow:scroll;background:#fff;border:1px solid #ccc;padding:10px;">
					<?php
					$loop = new WP_Query( array(
						'post_type'      => 'industries',
						'orderby'        => 'title',
						'order'          => 'ASC',
						'posts_per_page' => 100
					) );
					while ( $loop->have_posts() ) {
						$loop->the_post();
						$id        = $post->ID;
						$custom    = get_post_custom( $id );
						$name      = get_the_title();
						$cust_name = str_replace( ',', '', $name );
						$cust_name = str_replace( '&', '', $cust_name );
						$selected  = ( is_array( $industry ) && in_array( $id, $industry ) ) ? 'checked="checked"' : '';
						echo '<input type="checkbox" class="areas" name="industry[]"';
						echo 'value="' . $id . '" ' . $selected . '/> ' . $name . ' <br />';
					}
					?>
				</div>
				<input type="hidden" class="text_input" name="areas_practice_hidden" value="<?php echo $industry_hidden; ?>" size="30" />
			</td>
		</tr>

		<?php wp_nonce_field( 'save', 'carr_practices' ); ?>
	</table>

<?php
}


function save_practices_meta( $post_id, $post ) {

	// Bail if doing autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Bail if nonce isn't set
	if ( ! isset( $_POST['carr_practices'] ) || ! wp_verify_nonce( $_POST['carr_practices'], 'save' ) ) {
		return;
	}

	// Bail if the user isn't allowed to edit the post
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Bail if not an asset
	if ( 'practices' !== $post->post_type ) {
		return;
	}

	if ( isset( $_POST["tagline"] ) ) {
		update_post_meta( $post->ID, "tagline", $_POST["tagline"] );
	}
	if ( isset( $_POST["description"] ) ) {
		update_post_meta( $post->ID, "description", $_POST["description"] );
	}
	if ( isset( $_POST["attorney_title"] ) ) {
		update_post_meta( $post->ID, "attorney_title", $_POST["attorney_title"] );
	}
	if ( isset( $_POST["attorney_title_2"] ) ) {
		update_post_meta( $post->ID, "attorney_title_2", $_POST["attorney_title_2"] );
	}
	if ( isset( $_POST["chair_id"] ) ) {
		update_post_meta( $post->ID, "chair_id", $_POST["chair_id"] );
	}
	if ( isset( $_POST["chair_id_2"] ) ) {
		update_post_meta( $post->ID, "chair_id_2", $_POST["chair_id_2"] );
	}
	if ( isset( $_POST["practices_url"] ) ) {
		update_post_meta( $post->ID, "practices_url", $_POST["practices_url"] );
	}
	if ( isset( $_POST["rep_matters"] ) ) {
		update_post_meta( $post->ID, "rep_matters", $_POST["rep_matters"] );
	}

	if ( isset( $_POST["industry"] ) ) {
		update_post_meta( $post->ID, "industry", $_POST["industry"] );
	} else {
		update_post_meta( $post->ID, "industry", '' );
	}
}

add_action( 'save_post', 'save_practices_attorneys_meta', 15, 2 );

function practices_attorneys_meta_options() {
	global $post;
	$custom              = get_post_custom( $post->ID );
	$practices_attorneys = get_post_meta( $post->ID, 'practices_attorneys', true );
	?>

	<div style="background:#fff;border:1px solid #ddd; padding:10px; height:140px;overflow-x;hidden; overflow-y:scroll;">
		<ul style="margin:0px;">
			<?php
			$get_attorneys = get_posts( array(
				'post_type'   => 'attorneys',
				'meta_key'    => 'last_name',
				'orderby'     => 'meta_value',
				'order'       => 'ASC',
				'numberposts' => 100
			) );

			foreach ( $get_attorneys as $attorney ) {
				$name    = $attorney->post_title;
				$id      = $attorney->ID;
				$checked = ( is_array( $practices_attorneys ) && in_array( $id, $practices_attorneys ) ) ? 'checked="checked"' : '';
				echo '<li>';
				echo '<input type="checkbox" name="practices_attorneys[]" value="' . $id . '" ' . $checked . '/> ' . $name;
				echo '</li>';
			}
			?>
		</ul>
		<?php wp_nonce_field( 'save', 'carr_practices_attorneys' ); ?>
	</div>

<?php
}


function save_practices_attorneys_meta( $post_id, $post ) {
	// Bail if doing autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Bail if nonce isn't set
	if ( ! isset( $_POST['carr_practices_attorneys'] ) || ! wp_verify_nonce( $_POST['carr_practices_attorneys'], 'save' ) ) {
		return;
	}

	// Bail if the user isn't allowed to edit the post
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Bail if not an asset
	if ( 'practices' !== $post->post_type ) {
		return;
	}

	if ( isset( $_POST['practices_attorneys'] ) ) {
		update_post_meta( $post->ID, 'practices_attorneys', $_POST['practices_attorneys'] );
	}
}