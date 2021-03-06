<?php

/**
 * Add meta boxes
 */
function setup_meta_boxes() {

	// Attorneys
	add_meta_box( "attorneys_meta_options", "Attorney Information", "attorneys_meta_options", "attorneys" );

	// Industries
	add_meta_box( "industries_meta_options", "Related Practices", "industries_meta_options", "industries" );

	// Practices
	add_meta_box( "practices_meta_options", "Practice Information", "practices_meta_options", "practices" );
	add_meta_box( "practices_attorneys_meta_options", "Practicing Attorneys", "practices_attorneys_meta_options", "practices", "side" );

	// Articles
	add_meta_box( "articles_meta_options", "Article Information", "articles_meta_options", "articles" );
	add_meta_box( 'carr_post_options', 'Options', 'carr_post_options', 'articles', 'side' );

	// Posts
	add_meta_box( "posts_attorneys_meta_options", "Tag Attorneys", "posts_attorneys_meta_options", "post", "side" );
	add_meta_box( "posts_practices_meta_options", "Tag Practices", "posts_practices_meta_options", "post", "side" );
	add_meta_box( 'carr_post_options', 'Display Date', 'carr_post_options', 'post', 'side' );
	add_meta_box( 'carr_post_news_options', 'News Options', 'carr_post_news_options', 'post' );

	// Pages
	add_meta_box( "carr_page_sidebars", "Sidebars", "carr_page_sidebars", "page" );
}

add_action( 'add_meta_boxes', 'setup_meta_boxes' );


/**
 * Meta Box to display Attorneys that can be tagged
 */
function posts_attorneys_meta_options() {
	global $post;
	$custom         = get_post_custom( $post->ID );
	$post_attorneys = get_post_meta( $post->ID, 'post_attorneys', true ); ?>

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
				$checked = '';
				$checked = ( is_array( $post_attorneys ) && in_array( $id, $post_attorneys ) ) ? 'checked="checked"' : '';
				echo '<li>';
				echo '<input type="checkbox" name="post_attorneys[]" value="' . $id . '" ' . $checked . '/> ' . $name;
				echo '</li>';
			}
			?>
		</ul>
		<?php wp_nonce_field( 'save', 'carr_post_attorneys' ); ?>
	</div>

<?php
}

/**
 * Save Attorneys associated with post
 *
 * @param $post_id
 * @param $post
 */
function save_posts_attorneys_meta( $post_id, $post ) {

	// Bail if doing autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Bail if nonce isn't set
	if ( ! isset( $_POST['carr_post_attorneys'] ) || ! wp_verify_nonce( $_POST['carr_post_attorneys'], 'save' ) ) {
		return;
	}

	// Bail if the user isn't allowed to edit the post
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Bail if not a page
	if ( 'post' !== $post->post_type ) {
		return;
	}

	if ( isset( $_POST["post_attorneys"] ) ) {
		update_post_meta( $post->ID, "post_attorneys", $_POST["post_attorneys"] );
	}
}

add_action( 'save_post', 'save_posts_attorneys_meta', 15, 2 );


/**
 * Meta Box to display Pratices that can be tagged
 */
function posts_practices_meta_options() {
	global $post;
	$custom         = get_post_custom( $post->ID );
	$post_practices = get_post_meta( $post->ID, 'post_practices', true ); ?>

	<div style="background:#fff;border:1px solid #ddd; padding:10px; height:140px;overflow-x;hidden; overflow-y:scroll;">
		<ul style="margin:0px;">
			<?php
			$get_practices = get_posts( array(
				'post_type'   => 'practices',
				//'meta_key' => 'last_name',
				//'orderby' => 'meta_value',
				'order'       => 'ASC',
				'numberposts' => 100
			) );

			foreach ( $get_practices as $practices ) {
				$name    = $practices->post_title;
				$id      = $practices->ID;
				$checked = '';
				$checked = ( is_array( $post_practices ) && in_array( $id, $post_practices ) ) ? 'checked="checked"' : '';
				echo '<li>';
				echo '<input type="checkbox" name="post_practices[]" value="' . $id . '" ' . $checked . '/> ' . $name;
				echo '</li>';
			} ?>
		</ul>
		<?php wp_nonce_field( 'save', 'carr_post_practices' ); ?>
	</div>

<?php
}

/**
 * Save Practices associated with post
 */
function save_posts_practices_meta( $post_id, $post ) {

	// Bail if doing autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Bail if nonce isn't set
	if ( ! isset( $_POST['carr_post_practices'] ) || ! wp_verify_nonce( $_POST['carr_post_practices'], 'save' ) ) {
		return;
	}

	// Bail if the user isn't allowed to edit the post
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Bail if not a page
	if ( 'post' !== $post->post_type ) {
		return;
	}

	if ( isset( $_POST["post_practices"] ) ) {
		update_post_meta( $post->ID, "post_practices", $_POST["post_practices"] );
	}
}
add_action( 'save_post', 'save_posts_practices_meta', 15, 2 );

/**
 * Used for the display date box
 *
 * @param $post
 *
 * @todo rename to be more semantic
 */
function carr_post_options( $post ) {
	if ( ! in_array( get_post_type( $post ), array( 'post', 'articles' ) ) ) {
		return;
	}

	$original_event_date = get_post_meta( $post->ID, 'date', true );
	$display_date        = get_post_meta( $post->ID, 'display_date', true );
	$display_date_manual = get_post_meta( $post->ID, 'display_date_manual', true );


	if ( ! $display_date && $original_event_date ) {
		// $display_date = $original_event_date;
	}

	// This JS could probably be moved into an admin script
	?>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$("input[name='display_date']").datepicker({
				dateFormat: 'mm/dd/yy',
				changeYear: true
			});
			$("#ui-datepicker-div").hide();
		});
	</script>

	<div class="edit-form-section">
		<div class="display-date-group display-date">
			<label for="display_date"><strong>Date Picker:</strong></label><br>
			<input id="display_date" name="display_date" value="<?php echo $display_date; ?>">

			<p>Click the box to select your date</p>

			<p><a class="datepicker-toggle">Use custom date instead</a></p>
		</div>

		<div class="display-date-group display-date-manual">
			<label for="display_date_manual"><strong>Custom:</strong></label><br>
			<input id="display_date_manual" name="display_date_manual" value="<?php echo $display_date_manual; ?>">

			<p>Use this to override the date with your own text (Spring 2012, May 2014, etc.)</p>

			<p><a class="datepicker-toggle">Use date picker instead</a></p>
		</div>

		<?php wp_nonce_field( 'save', 'carr_post_event_data' ); ?>
	</div>
<?php
}

/**
 * Options for In the News posts
 *
 * @param $post
 */
function carr_post_news_options( $post ) {
	if ( ! in_array( get_post_type( $post ), array( 'post' ) ) ) {
		return;
	}

	global $post;

	$news_type_select = get_post_meta( $post->ID, "news_type_select", true );
	$source           = get_post_meta( $post->ID, "source", true );
	$source_url       = get_post_meta( $post->ID, "source_url", true );

	?>

	<table class="form-table">
		<tr>
			<th style="width: 20%;"><label for="news_type">News Type:</label></th>
			<td>
				<select name="news_type_select">
					<option value=""></option>
					<option value="internal" <?php if ( $news_type_select == 'internal' ) {
						echo 'selected="selected"';
					} ?>>Press Release (Internal)
					</option>
					<option value="external" <?php if ( $news_type_select == 'external' ) {
						echo 'selected="selected"';
					} ?>>External Site
					</option>
					<option value="pdf" <?php if ( $news_type_select == 'pdf' ) {
						echo 'selected="selected"';
					} ?>>PDF
					</option>
				</select>
			</td>
		</tr>
		<tr>
			<th style="width: 20%;"><label for="source">Source Title</label></th>
			<td>
				<input type="text" class="text_input" name="source" id="source" value="<?php echo $source; ?>" style="width:100%" /><br />
				<small>Ex: Google</small>
			</td>
		</tr>
		<tr>
			<th style="width: 20%;"><label for="source_url">Source URL</label></th>
			<td>
				<input type="text" class="text_input" name="source_url" id="source_url" value="<?php echo $source_url; ?>" style="width:100%" /><br />
				<small>Ex: http://www.google.com/</small>
				<br />
				<!-- <small>Note: If PDF file is attached below, this link will be overriden with a link to the PDF.</small> -->
			</td>
		</tr>
		<?php wp_nonce_field( 'save', 'carr_news_options' ); ?>
	</table>

<?php
}

/**
 * Meta box to display sidebar fields on page templates
 *
 * @param $post
 */
function carr_page_sidebars( $post ) {
	if ( ! in_array( get_post_type( $post ), array( 'page' ) ) ) {
		return;
	}

	$post_sidebar_1 = get_post_meta( $post->ID, 'post_sidebar_1', true );
	$post_sidebar_2 = get_post_meta( $post->ID, 'post_sidebar_2', true );
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


/**
 * Save the display date box
 *
 * @param $post_id
 * @param $post
 *
 * @todo rename to make this more semantic
 */
function save_post_options_data( $post_id, $post ) {
	// Bail if doing autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Bail if nonce isn't set
	if ( ! isset( $_POST['carr_post_event_data'] ) || ! wp_verify_nonce( $_POST['carr_post_event_data'], 'save' ) ) {
		return;
	}

	// Bail if the user isn't allowed to edit the post
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Bail if not a page
	if ( 'post' !== $post->post_type ) {
		return;
	}

	if ( isset( $_POST["display_date"] ) ) {
		update_post_meta( $post->ID, "display_date", $_POST['display_date'] );
	}

	if ( isset( $_POST["display_date_manual"] ) ) {
		update_post_meta( $post->ID, "display_date_manual", $_POST['display_date_manual'] );
	} else {
		delete_post_meta( $post->ID, 'display_date_manual' );
	}
}

add_action( 'save_post', 'save_post_options_data', 15, 2 );


/**
 * Save In the News options
 *
 * @param $post_id
 * @param $post
 */
function save_post_news_options_data( $post_id, $post ) {
	// Bail if doing autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Bail if nonce isn't set
	if ( ! isset( $_POST['carr_news_options'] ) || ! wp_verify_nonce( $_POST['carr_news_options'], 'save' ) ) {
		return;
	}

	// Bail if the user isn't allowed to edit the post
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Bail if not an asset
	if ( 'post' !== $post->post_type ) {
		return;
	}

	// Save custom fields
	if ( isset( $_POST["news_type_select"] ) ) {
		update_post_meta( $post->ID, "news_type_select", $_POST["news_type_select"] );
	} else {
		update_post_meta( $post->ID, "news_type_select", '' );
	}

	if ( isset( $_POST["source"] ) ) {
		update_post_meta( $post->ID, "source", $_POST["source"] );
	} else {
		update_post_meta( $post->ID, "source", '' );
	}

	if ( isset( $_POST["source_url"] ) ) {
		update_post_meta( $post->ID, "source_url", $_POST["source_url"] );
	} else {
		update_post_meta( $post->ID, "source_url", '' );
	}
}

add_action( 'save_post', 'save_post_news_options_data', 15, 2 );


/**
 * Save page sidebars
 *
 * @param $post_id
 * @param $post
 */
function save_page_sidebar( $post_id, $post ) {
	// Bail if doing autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Bail if nonce isn't set
	if ( ! isset( $_POST['carr_post_sidebars'] ) || ! wp_verify_nonce( $_POST['carr_post_sidebars'], 'save' ) ) {
		return;
	}

	// Bail if the user isn't allowed to edit the post
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Bail if not a page
	if ( 'page' !== $post->post_type ) {
		return;
	}

	if ( isset( $_POST["post_sidebar_1"] ) ) {
		update_post_meta( $post->ID, "post_sidebar_1", $_POST["post_sidebar_1"] );
	}
	if ( isset( $_POST["post_sidebar_2"] ) ) {
		update_post_meta( $post->ID, "post_sidebar_2", $_POST["post_sidebar_2"] );
	}
}

add_action( 'save_post', 'save_page_sidebar', 15, 2 );
