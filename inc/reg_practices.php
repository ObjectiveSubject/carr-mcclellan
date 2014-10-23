<?php

/*********************************************************
	Register Custom Post Type
*/


	add_action('init', 'practices_register');
	function practices_register() {
    	$args = array(
        	'label' => __('Practices'),
        	'singular_label' => __('Practice'),
        	'public' => true,
        	'show_ui' => true,
        	//'capability_type' => 'post',
        	'hierarchical' => false,
        	'rewrite' => true,
        	'supports' => array('title', 'editor')
        );
    	register_post_type( 'practices' , $args );
  }

/*********************************************************
	Custom Meta Box
*/

	add_action("admin_init", "admin_init");
	add_action( 'save_post', 'save_practices_meta', 15, 2 );

	function practices_meta_options() {
		global $post;

		$tagline = get_post_meta( $post->ID, "tagline", true );
		$description = get_post_meta( $post->ID, "description", true );
		$chair_id = get_post_meta( $post->ID, "chair_id", true );
		$attorney_title = get_post_meta( $post->ID, "attorney_title", true );
		$chair_id_2 = get_post_meta( $post->ID, "chair_id_2", true );
		$attorney_title_2 = get_post_meta( $post->ID, "attorney_title_2", true );
		$practices_url = get_post_meta( $post->ID, "practices_url", true );
		$rep_matters = get_post_meta( $post->ID, "rep_matters", true );
		$areas_focus = get_post_meta($post->ID, 'areas_focus', true );

		if ( ! $areas_focus ) {
			$areas_focus = array( '','','','','','','','','','' );
		}

	?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			// Initialize TinyMCE for the textareas
			tinyMCE.init({
				//theme : "advanced",
        plugins : "paste wplink",
				theme_advanced_buttons1 : "bold,italic,separator,numlist,bullist,separator,link,unlink,separator,pasteword,pastetext",
				theme_advanced_buttons2 : "",
				theme_advanced_buttons3 : "",
				mode : "specific_textareas",
	      editor_selector : /(rep_matters|recent_exp|areas_textarea)/,
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_resizing : true,
				theme_advanced_resizing_max_height : 240,
      	menubar : false
			});

			// Show the first hidden Areas of Focus box
			$('.add_area').click(function(e){
				e.preventDefault();
				$(".area").filter(function() { return $(this).css("display") == "none" }).first().slideDown();
			});

			// Clear Areas of Focus fields and hide box
			$('.delete_area').click(function(e){
				e.preventDefault();

				//$(this).parent().siblings('input').val(''); // Clear Title
				$(this).parent().parent().parent().children('.inside-header').children('.left').children('input').val('');
				var editor = $(this).parent().siblings('textarea').attr('name');
				tinyMCE.get(editor).setContent(''); // Clear TinyMCE
				$(this).closest('.area').slideUp();
			});

			$('.area-sort-container').sortable({
				handle: 'h4',
				cursor: 'move',
				start: function(){
					//tinyMCE.execCommand('mceRemoveControl', false, $('.areas_textarea') );
				},
				stop: function(e,ui) {
					resetAreas();
					//tinyMCE.execCommand( 'mceAddControl', true, $(this).attr('id') );
				}
			});

			function resetAreas(){
				var i = 1;
				$('.area').each(function(){
					$(this).children('div.inside').children('.inside-header').children('.left').children('input').attr('name','areas_title_' + i);
					$(this).children('div.inside').children('.inside-hide').children('textarea').attr('name','areas_body_' + i);
					i++;
				});
			}

			$('.inside-header h2').click(function(){

				if($(this).html() == '+'){
					$(this).html('-');
				} else {
					$(this).html('+');
				}
				$(this).parent().parent().siblings('.inside-hide').slideToggle();
			});

		});
	</script>

	<style type="text/css">
		#sortable li {
			border: 1px solid #ddd;
			background:#f5f5f5;
			padding:10px;
			}
		#sortable li h4 {
			/* cursor: pointer; */
			}
		.inside h4 {
			text-align: right;
			color: #888;
			background: url('<?php bloginfo('template_url');?>/images/sort.png') no-repeat center right;
			padding-right: 20px;
			cursor: pointer;
			}
		.inside-header .left {
			float: left;
			width: 60%;
			}
		.inside-header .left h2 {
			float: left;
			width: 20px;
			font-weight: bold;
			color: #888 !important;
			margin: 7px 0 0 0 !important;
			padding: 0 !important;
			}
		.inside-header .left h2:hover {
			color: #000 !important;
			cursor: pointer;
			}
		.inside-header .left input {
			margin-top: 12px;
			width: 80%;
			}
		.inside-header h4 {
			float: right;
			width: 30%;
			}
		.inside-hide {
			/* display: none; */
			}
	</style>

	<table class="form-table">

		<tr>
			<th style="width: 20%;"><label for="tagline">Tagline</label></th>
			<td>
				<textarea class="" name="tagline" style="width: 97%;height:50px;"><?php echo $tagline;?></textarea>
				<!-- <input type="text" class="text_input" name="tagline" value="<?php echo $tagline; ?>" style="width:97%" /> -->
			</td>
		</tr>
		<tr style="display:none;">
			<th style="width: 20%;"><label for="description">Description</label></th>
			<td>
				<textarea name="description" style="width: 97%;height:140px;"><?php echo $description;?></textarea>
			</td>
		</tr>

		<tr>
			<th style="width: 20%;"><label for="chair_id">Attorney 1</label></th>
			<td>
				<select name="chair_id">
					<option value=''>None</option>
					<?php
						$loop = new WP_Query(array(
								'post_type' => 'attorneys', 
								'meta_key' => 'last_name',
								'orderby' => 'meta_value',
								'order' => 'ASC',
								'posts_per_page' => 100
							));
						while ( $loop->have_posts() ) {
							$loop->the_post();
							$custom = get_post_custom($post->ID);
							$name = get_post_meta( $post->ID, "last_name", true ).', ';
							$name .= get_post_meta( $post->ID, "first_name", true ) . ' ';
							$name .= get_post_meta( $post->ID, "middle_initial", true );
							$id = $post->ID;
							$selected = ($chair_id == $id) ? 'selected="selected"' : '';
							echo '<option value="' . $id . '" ' . $selected . '>' . $name . '</option>';
						}
					?>
				</select>
				<select name="attorney_title">
					<option value="Practice Contact" <?php echo ($attorney_title == 'Practice Contact') ? 'selected="selected"' : '';?>>Practice Contact</option>
					<option value="Practice Chair" <?php echo ($attorney_title == 'Practice Chair') ? 'selected="selected"' : '';?>>Practice Chair</option>
				</select>
			</td>
		</tr>
		<tr>
			<th style="width: 20%;"><label for="chair_id_2">Attorney 2</label></th>
			<td>
				<select name="chair_id_2">
					<option value=''>None</option>
					<?php
						$loop = new WP_Query(array(
								'post_type' => 'attorneys', 
								'meta_key' => 'last_name',
								'orderby' => 'meta_value',
								'order' => 'ASC',
								'posts_per_page' => 100
							));
						while ( $loop->have_posts() ) {
							$loop->the_post();
							$custom = get_post_custom($post->ID);
							$name = get_post_meta( $post->ID, "last_name", true ).', ';
							$name .= get_post_meta( $post->ID, "first_name", true ) . ' ';
							$name .= get_post_meta( $post->ID, "middle_initial", true );
							$id = $post->ID;
							$selected = ($chair_id_2 == $id) ? 'selected="selected"' : '';
							echo '<option value="' . $id . '" ' . $selected . '>' . $name . '</option>';
						}
					?>
				</select>
				<select name="attorney_title_2">
					<option value="Practice Contact" <?php echo ($attorney_title_2 == 'Practice Contact') ? 'selected="selected"' : '';?>>Practice Contact</option>
					<option value="Practice Chair" <?php echo ($attorney_title_2 == 'Practice Chair') ? 'selected="selected"' : '';?>>Practice Chair</option>
				</select>
			</td>
		</tr>

		<tr>
			<th style="width: 20%;"><label for="rep_matters">Representative Matters</label></th>
			<td>
				<textarea class="rep_matters" name="rep_matters" style="width: 97%;height:140px;"><?php echo $rep_matters;?></textarea>
			</td>
		</tr>

		<tr>
			<th style="width: 20%;"><label for="areas_focus">Areas of Focus</label></th>
			<td class="area-sort-container">

				<?php
					$i = 1;
					foreach( $areas_focus as $area ) :
					if ( isset( $area['title'] ) && $area['title'] !== '' ) {
				?>
				<div class="postbox area" id="area-<?php echo $i; ?>">
				<div class="inside">

					<div class="inside-header">
						<div class="left">
							<h2>+</h2>
							<input type="text" class="text_input areas_title" name="areas_title_<?php echo $i;?>" value="<?php echo $area['title'];?>"/>
						</div>
						<h4>Sort</h4>
						<div style="clear:both;"></div>
					</div>

					<div class="inside-hide" style="display:none;">
						<!--
<label for="areas_title_<?php echo $i;?>">Title</label>
						<input type="text" class="text_input areas_title" name="areas_title_<?php echo $i;?>" style="width:100%;" value="<?php echo $area['title'];?>"/>
						<label for="areas_body_<?php echo $i;?>">Description</label>
-->
						<textarea class="areas_textarea" name="areas_body_<?php echo $i;?>" style="width: 100%;height:140px;"><?php echo $area['description'];?></textarea>
						<p style="text-align:right;">
							<a href="#" class="delete_area" onclick="return confirm('Are you sure?');">Delete</a>
						</p>
					</div>

				</div>
				</div>
				<?php
					} else {
						if ( isset( $area['title'] ) ) { $area_title = $area['title']; }
						else { $area_title = ''; }

						if ( isset( $area['title'] ) ) { $area_desc = $area['description']; }
						else { $area_desc = ''; }
				?>
				<div class="postbox area" id="area-<?php echo $i;?>" style="display:none;">
				<div class="inside">
					<div class="inside-header">
						<div class="left">
							<h2>-</h2>
							<input type="text" class="text_input areas_title" name="areas_title_<?php echo $i;?>" value="<?php echo $area_title; ?>"/>
						</div>
						<h4>Sort</h4>
						<div style="clear:both;"></div>
					</div>

					<div class="inside-hide">
						<!--
<label for="areas_title_<?php echo $i;?>">Title</label>
						<input type="text" class="text_input" name="areas_title_<?php echo $i;?>" style="width:100%;" value="<?php echo $area_title; ?>"/>
						<label for="areas_body_<?php echo $i;?>">Description</label>
-->
						<textarea class="areas_textarea" name="areas_body_<?php echo $i;?>" style="width: 100%;height:140px;"><?php echo $area_desc; ?></textarea>
						<p style="text-align:right;">
							<a href="#" class="delete_area" onclick="return confirm('Are you sure?');">Delete</a>
						</p>
					</div>
				</div>
				</div>
				<?php
					}
					$i++;
					endforeach;
				?>

				<a href="#" class="add_area">Add New</a>

			</td>
		</tr>
		<?php wp_nonce_field( 'save', 'carr_practices' ); ?>
	</table>

	<?php
	}


	function save_practices_meta( $post_id, $post ){

		// Bail if doing autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }

		// Bail if nonce isn't set
		if ( ! isset( $_POST['carr_practices'] ) || ! wp_verify_nonce( $_POST['carr_practices'], 'save' ) ) { return; }

		// Bail if the user isn't allowed to edit the post
		if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }

		// Bail if not an asset
		if ( 'practices' !== $post->post_type ) { return; }

		if(isset($_POST["tagline"])) update_post_meta($post->ID, "tagline", $_POST["tagline"]);
		if(isset($_POST["description"])) update_post_meta($post->ID, "description", $_POST["description"]);
		if(isset($_POST["attorney_title"])) update_post_meta($post->ID, "attorney_title", $_POST["attorney_title"]);
		if(isset($_POST["attorney_title_2"])) update_post_meta($post->ID, "attorney_title_2", $_POST["attorney_title_2"]);
		if(isset($_POST["chair_id"])) update_post_meta($post->ID, "chair_id", $_POST["chair_id"]);
		if(isset($_POST["chair_id_2"])) update_post_meta($post->ID, "chair_id_2", $_POST["chair_id_2"]);
		if(isset($_POST["practices_url"])) update_post_meta($post->ID, "practices_url", $_POST["practices_url"]);
		if(isset($_POST["rep_matters"])) update_post_meta($post->ID, "rep_matters", $_POST["rep_matters"]);

		$focus_array = array(
			array(
				'title' => $_POST["areas_title_1"],
				'description' => ($_POST["areas_title_1"]) ? $_POST["areas_body_1"] : ''
				),
			array(
				'title' => $_POST["areas_title_2"],
				'description' => ($_POST["areas_title_2"]) ? $_POST["areas_body_2"] : ''
				),
			array(
				'title' => $_POST["areas_title_3"],
				'description' => ($_POST["areas_title_3"]) ? $_POST["areas_body_3"] : ''
				),
			array(
				'title' => $_POST["areas_title_4"],
				'description' => ($_POST["areas_title_4"]) ? $_POST["areas_body_4"] : ''
				),
			array(
				'title' => $_POST["areas_title_5"],
				'description' => ($_POST["areas_title_5"]) ? $_POST["areas_body_5"] : ''
				),
			array(
				'title' => $_POST["areas_title_6"],
				'description' => ($_POST["areas_title_6"]) ? $_POST["areas_body_6"] : ''
				),
			array(
				'title' => $_POST["areas_title_7"],
				'description' => ($_POST["areas_title_7"]) ? $_POST["areas_body_7"] : ''
				),
			array(
				'title' => $_POST["areas_title_8"],
				'description' => ($_POST["areas_title_8"]) ? $_POST["areas_body_8"] : ''
				),
			array(
				'title' => $_POST["areas_title_9"],
				'description' => ($_POST["areas_title_9"]) ? $_POST["areas_body_9"] : ''
				),
			array(
				'title' => $_POST["areas_title_10"],
				'description' => ($_POST["areas_title_10"]) ? $_POST["areas_body_10"] : ''
				)
			);
		//update_post_meta($post->ID,'areas_focus', $focus_array);

		if(isset($_POST["areas_title_1"])) update_post_meta($post->ID, "areas_focus", $focus_array); 
	}

	add_action('save_post', 'save_practices_attorneys_meta', 15, 2 );

	function practices_attorneys_meta_options(){
		global $post;
		$custom = get_post_custom($post->ID);
		$practices_attorneys = get_post_meta($post->ID, 'practices_attorneys', true);
	?>

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
						$checked = (is_array($practices_attorneys) && in_array($id, $practices_attorneys)) ? 'checked="checked"' : '';
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


	function save_practices_attorneys_meta( $post_id, $post ){
		// Bail if doing autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }

		// Bail if nonce isn't set
		if ( ! isset( $_POST['carr_practices_attorneys'] ) || ! wp_verify_nonce( $_POST['carr_practices_attorneys'], 'save' ) ) { return; }

		// Bail if the user isn't allowed to edit the post
		if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }

		// Bail if not an asset
		if ( 'practices' !== $post->post_type ) { return; }

		if( isset($_POST['practices_attorneys'] ) ) {
			update_post_meta( $post->ID, 'practices_attorneys', $_POST['practices_attorneys'] );
		}
	}