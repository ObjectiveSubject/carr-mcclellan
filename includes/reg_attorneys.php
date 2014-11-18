<?php

/*********************************************************
 * Custom Meta Box
 */

add_action( 'admin_init', 'admin_init' );
add_action( 'save_post', 'save_attorneys_meta', 15, 2 );

function attorneys_meta_options() {
	global $post;
	$fax   = '';
	$phone = '';

	$custom                = get_post_custom( $post->ID );
	$first_name            = get_post_meta( $post->ID, 'first_name', true );
	$middle_initial        = get_post_meta( $post->ID, "middle_initial", true );
	$last_name             = get_post_meta( $post->ID, "last_name", true );
	$title                 = get_post_meta( $post->ID, "title", true );
	$secondary_title       = get_post_meta( $post->ID, "secondary_title", true );
	$phone                 = ( $phone ) ? get_post_meta( $post->ID, "phone", true ) : '650-342-9600 ';
	$fax                   = ( $fax ) ? get_post_meta( $post->ID, "fax", true ) : '650-342-7685';
	$email                 = get_post_meta( $post->ID, "email", true );
	$linkedin              = get_post_meta( $post->ID, "linkedin", true );
	$biography             = get_post_meta( $post->ID, "biography", true );
	$quote                 = get_post_meta( $post->ID, "quote", true );
	$academic_creds        = get_post_meta( $post->ID, "academic_creds", true );
	$attorney_languages    = get_post_meta( $post->ID, "attorney_languages", true );
	$special_exp           = get_post_meta( $post->ID, "special_exp", true );
	$prof_affilations      = get_post_meta( $post->ID, "prof_affilations", true );
	$courts_forums         = get_post_meta( $post->ID, "courts_forums", true );
	$civic_affiliations    = get_post_meta( $post->ID, "civic_affiliations", true );
	$honors_awards         = get_post_meta( $post->ID, "honors_awards", true );
	$custom_title          = get_post_meta( $post->ID, "custom_title", true );
	$custom_body           = get_post_meta( $post->ID, "custom_body", true );
	$recent_exp            = get_post_meta( $post->ID, "recent_exp", true );
	$recent_speaking       = get_post_meta( $post->ID, "recent_speaking", true );
	$areas_practice_hidden = get_post_meta( $post->ID, "areas_practice_hidden", true );
	$areas_practice        = get_post_meta( $post->ID, 'areas_practice', true );
	$industry_hidden       = get_post_meta( $post->ID, "industry_hidden", true );
	$industry              = get_post_meta( $post->ID, 'industry', true );
	?>

	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			tinyMCE.init({
				plugins                           : "paste wplink",
				theme_advanced_buttons1           : "bold,italic,separator,numlist,bullist,separator,link,unlink,separator,pasteword,pastetext",
				theme_advanced_buttons2           : "",
				theme_advanced_buttons3           : "",
				mode                              : "specific_textareas",
				editor_selector                   : /(biography|academic_creds|attorney_languages|special_exp|prof_affilations|courts_forums|civic_affiliations|honors_awards|recent_exp|recent_speaking|custom_body)/,
				theme_advanced_toolbar_location   : "top",
				theme_advanced_toolbar_align      : "left",
				theme_advanced_resizing           : true,
				theme_advanced_resizing_max_height: 240,
				menubar                           : false
			});
		});
	</script>

	<style type="text/css">
		.attachments-fields,
		.attachments-data,
		.attachment-thumbnail {
			display: none;
		}

		.attachments-file {
			height: 50px !important;
		}

		ul.metabox-tabs li.active {
			/* border-bottom: 1px solid #ddd; */
		}
	</style>

	<table class="form-table">
		<tr>
			<th style="width: 20%;"><label for="first_name">First Name</label></th>
			<td>
				<input type="text" class="text_input" name="first_name" value="<?php echo $first_name; ?>" size="30" />
			</td>
		</tr>
		<tr>
			<th style="width: 20%;"><label for="middle_initial">Middle Initial</label></th>
			<td>
				<input type="text" class="text_input" name="middle_initial" value="<?php echo $middle_initial; ?>" size="5" />
			</td>
		</tr>
		<tr>
			<th style="width: 20%;"><label for="last_name">Last Name</label></th>
			<td>
				<input type="text" class="text_input" name="last_name" value="<?php echo $last_name; ?>" size="30" />
			</td>
		</tr>

		<tr>
			<th style="width: 20%;"><label for="title">Title</label></th>
			<td>
				<select name="title">
					<option value="" <?php echo ( $title == '' ) ? 'selected="selected"' : ''; ?>>No Title</option>
					<option value="Attorney" <?php echo ( $title == 'Attorney' ) ? 'selected="selected"' : ''; ?>>Attorney</option>
					<option value="Director" <?php echo ( $title == 'Director' ) ? 'selected="selected"' : ''; ?>>Director</option>
					<option value="Special Counsel" <?php echo ( $title == 'Special Counsel' ) ? 'selected="selected"' : ''; ?>>Special Counsel</option>
					<option value="Senior Counsel" <?php echo ( $title == 'Senior Counsel' ) ? 'selected="selected"' : ''; ?>>Senior Counsel</option>
					<option value="Of Counsel" <?php echo ( $title == 'Of Counsel' ) ? 'selected="selected"' : ''; ?>>Of Counsel</option>
					<option value="Senior Associate" <?php echo ( $title == 'Senior Associate' ) ? 'selected="selected"' : ''; ?>>Senior Associate</option>
				</select>
			</td>
		</tr>
		<tr>
			<th style="width: 20%;"><label for="secondary_title">Secondary Title</label></th>
			<td>
				<input type="text" class="text_input" name="secondary_title" value="<?php echo $secondary_title; ?>" size="30" />
			</td>
		</tr>

		<tr>
			<th style="width: 20%;"><label for="phone">Phone</label></th>
			<td>
				<input type="text" class="text_input" name="phone" value="<?php echo $phone; ?>" size="30" />
			</td>
		</tr>
		<tr>
			<th style="width: 20%;"><label for="fax">Fax</label></th>
			<td>
				<input type="text" class="text_input" name="fax" value="<?php echo $fax; ?>" size="30" />
			</td>
		</tr>
		<tr>
			<th style="width: 20%;"><label for="email">Email</label></th>
			<td>
				<input type="text" class="text_input" name="email" value="<?php echo $email; ?>" size="30" />
			</td>
		</tr>
		<tr>
			<th style="width: 20%;"><label for="linkedin">LinkedIn Profile</label></th>
			<td>
				<input type="text" class="text_input" name="linkedin" value="<?php echo $linkedin; ?>" size="30" />
			</td>
		</tr>

		<tr>
			<th style="width: 20%;"><label>About</label></th>
			<td>
				<div class="metabox-tabs-div">
					<ul class="metabox-tabs" id="metabox-tabs">
						<li class="active tab_bio"><a class="active" href="javascript:void(null);">Biography</a></li>
						<li class="tab_aca"><a href="javascript:void(null);">Academic Credentials</a></li>
						<li class="tab_lang"><a href="javascript:void(null);">Languages</a></li>
					</ul>
					<div class="tab_bio">
						<?php wp_editor( $biography, 'biography' ); ?>
					</div>
					<div class="tab_aca">
						<?php wp_editor( $academic_creds, 'academic_creds' ); ?>
					</div>
					<div class="tab_lang">
						<?php wp_editor( $attorney_languages, 'attorney_languages' ); ?>
					</div>
				</div>
			</td>
		</tr>

		<tr style="display:none;">
			<th style="width: 20%;"><label for="quote">Quote</label></th>
			<td>
				<textarea class="quote" style="width:97%;height:50px;" name="quote"><?php echo $quote; ?></textarea>
			</td>
		</tr>

		<tr>
			<th style="width: 20%;"><label for="areas_practice">Practice Areas</label></th>
			<td>
				<div style="height:90px;overflow:scroll;background:#fff;border:1px solid #ccc;padding:10px;">
					<?php
					$loop = new WP_Query( array(
						'post_type'      => 'practices',
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
						$selected  = ( is_array( $areas_practice ) && in_array( $id, $areas_practice ) ) ? 'checked="checked"' : '';
						echo '<input type="checkbox" class="areas" name="areas_practice[]"';
						echo 'value="' . $id . '" ' . $selected . '/> ' . $name . ' <br />';
					}
					?>
				</div>
				<input type="hidden" class="text_input" name="areas_practice_hidden" value="<?php echo $areas_practice_hidden; ?>" size="30" />
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

		<tr>
			<th style="width: 20%;"><label>Experience and affiliations</label></th>
			<td>
				<div class="metabox-tabs-div">
					<ul class="metabox-tabs" id="metabox-tabs">
						<li class="active tab0"><a class="active" href="javascript:void(null);">Representative Matters</a></li>
						<li class="tab1"><a href="javascript:void(null);">Prof Orgs</a></li>
						<li class="tab2"><a href="javascript:void(null);">Admissions</a></li>
						<li class="tab3"><a href="javascript:void(null);">Civic &amp; Charitable</a></li>
						<li class="tab4"><a href="javascript:void(null);">Speaking Engagements</a></li>
						<li class="tab5"><a href="javascript:void(null);">Honors &amp; Awards</a></li>
						<li class="tab6"><a href="javascript:void(null);">Custom</a></li>
					</ul>
					<div class="tab0">
						<?php wp_editor( $special_exp, 'special_exp' ); ?>
					</div>
					<div class="tab1">
						<?php wp_editor( $prof_affilations, 'prof_affilations' ); ?>
					</div>
					<div class="tab2">
						<?php wp_editor( $courts_forums, 'courts_forums' ); ?>
					</div>
					<div class="tab3">
						<?php wp_editor( $civic_affiliations, 'civic_affiliations' ); ?>
					</div>
					<div class="tab4">
						<?php wp_editor( $recent_speaking, 'recent_speaking' ); ?>
					</div>
					<div class="tab5">
						<?php wp_editor( $honors_awards, 'honors_awards' ); ?>
					</div>
					<div class="tab6">
						<p>
							<label for="custom_title">Title</label><br>
							<input type="text" class="custom_title" name="custom_title" value="<?php echo $custom_title; ?>" size="30" />
						</p>
						<label for="custom_body">Body</label><br>
						<?php wp_editor( $custom_body, 'custom_body' ); ?>
					</div>
				</div>
			</td>
		</tr>
		<?php wp_nonce_field( 'save', 'carr_attorneys' ); ?>
	</table>

<?php
}

function save_attorneys_meta( $post_id, $post ) {
	// Bail if doing autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Bail if nonce isn't set
	if ( ! isset( $_POST['carr_attorneys'] ) || ! wp_verify_nonce( $_POST['carr_attorneys'], 'save' ) ) {
		return;
	}

	// Bail if the user isn't allowed to edit the post
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Bail if not an asset
	if ( 'attorneys' !== $post->post_type ) {
		return;
	}

	global $post;

	if ( isset( $_POST["first_name"] ) ) {
		update_post_meta( $post->ID, "first_name", $_POST["first_name"] );
	}
	if ( isset( $_POST["middle_initial"] ) ) {
		update_post_meta( $post->ID, "middle_initial", $_POST["middle_initial"] );
	}
	if ( isset( $_POST["last_name"] ) ) {
		update_post_meta( $post->ID, "last_name", $_POST["last_name"] );
	}
	if ( isset( $_POST["title"] ) ) {
		update_post_meta( $post->ID, "title", $_POST["title"] );
	}
	if ( isset( $_POST["secondary_title"] ) ) {
		update_post_meta( $post->ID, "secondary_title", $_POST["secondary_title"] );
	}
	if ( isset( $_POST["phone"] ) ) {
		update_post_meta( $post->ID, "phone", $_POST["phone"] );
	}
	if ( isset( $_POST["fax"] ) ) {
		update_post_meta( $post->ID, "fax", $_POST["fax"] );
	}
	if ( isset( $_POST["email"] ) ) {
		update_post_meta( $post->ID, "email", $_POST["email"] );
	}
	if ( isset( $_POST["linkedin"] ) ) {
		update_post_meta( $post->ID, "linkedin", $_POST["linkedin"] );
	}
	if ( isset( $_POST["biography"] ) ) {
		update_post_meta( $post->ID, "biography", $_POST["biography"] );
	}
	if ( isset( $_POST["quote"] ) ) {
		update_post_meta( $post->ID, "quote", $_POST["quote"] );
	}
	if ( isset( $_POST["academic_creds"] ) ) {
		update_post_meta( $post->ID, "academic_creds", $_POST["academic_creds"] );
	}
	if ( isset( $_POST["attorney_languages"] ) ) {
		update_post_meta( $post->ID, "attorney_languages", $_POST["attorney_languages"] );
	}
	if ( isset( $_POST["special_exp"] ) ) {
		update_post_meta( $post->ID, "special_exp", $_POST["special_exp"] );
	}
	if ( isset( $_POST["prof_affilations"] ) ) {
		update_post_meta( $post->ID, "prof_affilations", $_POST["prof_affilations"] );
	}
	if ( isset( $_POST["courts_forums"] ) ) {
		update_post_meta( $post->ID, "courts_forums", $_POST["courts_forums"] );
	}
	if ( isset( $_POST["civic_affiliations"] ) ) {
		update_post_meta( $post->ID, "civic_affiliations", $_POST["civic_affiliations"] );
	}
	if ( isset( $_POST["honors_awards"] ) ) {
		update_post_meta( $post->ID, "honors_awards", $_POST["honors_awards"] );
	}
	if ( isset( $_POST["custom_title"] ) ) {
		update_post_meta( $post->ID, "custom_title", $_POST["custom_title"] );
	}
	if ( isset( $_POST["custom_body"] ) ) {
		update_post_meta( $post->ID, "custom_body", $_POST["custom_body"] );
	}
	if ( isset( $_POST["recent_exp"] ) ) {
		update_post_meta( $post->ID, "recent_exp", $_POST["recent_exp"] );
	}
	if ( isset( $_POST["recent_speaking"] ) ) {
		update_post_meta( $post->ID, "recent_speaking", $_POST["recent_speaking"] );
	}
	if ( isset( $_POST["areas_practice_hidden"] ) ) {
		update_post_meta( $post->ID, "areas_practice_hidden", $_POST["areas_practice_hidden"] );
	}


	if ( isset( $_POST["areas_practice"] ) ) {
		update_post_meta( $post->ID, "areas_practice", $_POST["areas_practice"] );
	} else {
		update_post_meta( $post->ID, "areas_practice", '' );
	}

	if ( isset( $_POST["industry"] ) ) {
		update_post_meta( $post->ID, "industry", $_POST["industry"] );
	} else {
		update_post_meta( $post->ID, "industry", '' );
	}

	if ( isset( $_POST["test_input"] ) ) {
		update_post_meta( $post->ID, "test_input", $_POST["test_input"] );
	}

	// Custom abbreviated Biography
	$abbr_biography = strip_tags( $_POST["biography"] );
	if ( strlen( $abbr_biography ) > 120 ) {
		$abbr_biography = wordwrap( $abbr_biography, 120 );
		$abbr_biography = substr( $abbr_biography, 0, strpos( $abbr_biography, "\n" ) );
	}
	if ( isset( $_POST["biography"] ) ) {
		update_post_meta( $post->ID, "abbr_biography", $abbr_biography );
	}

}