<?php


/* Custom Meta Box
------------------------------------------------------*/

add_action('save_post', 'save_posts_attorneys_meta');

function posts_attorneys_meta_options(){
	global $post;
	$custom = get_post_custom($post->ID);
	$post_attorneys = get_post_meta($post->ID, 'post_attorneys', true); ?>

		<div style="background:#fff;border:1px solid #ddd; padding:10px; height:140px;overflow-x;hidden; overflow-y:scroll;">
			<ul style="margin:0px;">
				<?php
					$get_attorneys = get_posts(array(
							'post_type' => 'attorneys',
							'meta_key' => 'last_name',
							'orderby' => 'meta_value',
							'order' => 'ASC',
							'numberposts' => 100
					));
					
					foreach ( $get_attorneys as $attorney ) {
						$name = $attorney->post_title;
						$id = $attorney->ID;
						$checked = '';
						$checked = ( is_array($post_attorneys) && in_array($id, $post_attorneys) ) ? 'checked="checked"' : '';
						echo '<li>';
						echo '<input type="checkbox" name="post_attorneys[]" value="' . $id . '" ' . $checked . '/> ' . $name;
						echo '</li>';
					}
				?>
			</ul>
		</div>
		
<?php }
	
function save_posts_attorneys_meta(){
	global $post;
	if(isset($_POST["post_attorneys"])) update_post_meta($post->ID, "post_attorneys", $_POST["post_attorneys"]);
}

	
	
add_action('save_post', 'save_posts_practices_meta');

function posts_practices_meta_options(){
	global $post;
	$custom = get_post_custom($post->ID);
	$post_practices = get_post_meta($post->ID, 'post_practices', true); ?>

	<div style="background:#fff;border:1px solid #ddd; padding:10px; height:140px;overflow-x;hidden; overflow-y:scroll;">
		<ul style="margin:0px;">
			<?php
				$get_practices = get_posts(array(
						'post_type' => 'practices',
						//'meta_key' => 'last_name',
						//'orderby' => 'meta_value',
						'order' => 'ASC',
						'numberposts' => 100
				));
				
				foreach ( $get_practices as $practices ) {
					$name = $practices->post_title;
					$id = $practices->ID;
					$checked = '';
					$checked = (is_array($post_practices) && in_array($id, $post_practices)) ? 'checked="checked"' : '';
					echo '<li>';
					echo '<input type="checkbox" name="post_practices[]" value="' . $id . '" ' . $checked . '/> ' . $name;
					echo '</li>';
				} ?>
		</ul>
	</div>
	
<?php }

function save_posts_practices_meta(){
	global $post;
	if(isset($_POST["post_practices"])) update_post_meta($post->ID, "post_practices", $_POST["post_practices"]);
}

add_action( 'edit_form_after_title', 'carr_subtitle' );

function carr_subtitle( $post ) {
	if ( ! in_array( get_post_type( $post ), array( 'page' ) ) ) {
		return;
	}

	$post_subtitle = get_post_meta( $post->ID, 'post_subtitle',true );
	?>
	<div class="edit-form-section">
		<label for="post_subtitle">Subtitle:</label>

		<input name="post_subtitle" id="post_subtitle" class="widefat" value="<?php echo $post_subtitle; ?>">
		<?php wp_nonce_field( 'save', 'carr_page_meta' ); ?>
	</div>
<?php
}

add_action( 'save_post', 'save_post_subtitle', 15, 2 );

function save_post_subtitle( $post_id, $post ) {
	// Bail if doing autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }

	// Bail if nonce isn't set
	if ( ! isset( $_POST['carr_page_meta'] ) || ! wp_verify_nonce( $_POST['carr_page_meta'], 'save' ) ) { return; }

	// Bail if the user isn't allowed to edit the post
	if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }

	// Bail if not a page
	// if ( 'attorneys' !== $post->post_type ) { return; }

	if ( isset( $_POST["post_subtitle"] ) ) {
		update_post_meta( $post->ID, "post_subtitle", $_POST["post_subtitle"] );
	}
}


function carr_page_sidebars( $post ) {
	if ( ! in_array( get_post_type( $post ), array( 'page' ) ) ) {
		return;
	}

	$post_sidebar_1 = get_post_meta( $post->ID, 'post_sidebar_1',true );
	$post_sidebar_2 = get_post_meta( $post->ID, 'post_sidebar_2',true );
	?>
	<div class="edit-form-section">
		<label for="post_sidebar_1">Sidebar 1:</label>

		<?php wp_editor( $post_sidebar_1, 'post_sidebar_1' ); ?>

		<label for="post_sidebar_2">Sidebar 2:</label>

		<?php wp_editor( $post_sidebar_2, 'post_sidebar_2' ); ?>


		<?php wp_nonce_field( 'save', 'carr_post_sidebars' ); ?>
	</div>
<?php
}

add_action( 'save_post', 'save_page_sidebar', 15, 2 );

function save_page_sidebar( $post_id, $post ) {
	// Bail if doing autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }

	// Bail if nonce isn't set
	if ( ! isset( $_POST['carr_post_sidebars'] ) || ! wp_verify_nonce( $_POST['carr_post_sidebars'], 'save' ) ) { return; }

	// Bail if the user isn't allowed to edit the post
	if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }

	// Bail if not a page
	// if ( 'attorneys' !== $post->post_type ) { return; }

	if ( isset( $_POST["post_sidebar_1"] ) ) {
		update_post_meta( $post->ID, "post_sidebar_1", $_POST["post_sidebar_1"] );
	}
	if ( isset( $_POST["post_sidebar_2"] ) ) {
		update_post_meta( $post->ID, "post_sidebar_2", $_POST["post_sidebar_2"] );
	}
}