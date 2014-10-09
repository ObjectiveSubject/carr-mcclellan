<?php

/*********************************************************
	Register Custom Post Type
*/

	add_action('init', 'publications_register');
	function publications_register() {
    	$args = array(
        	'label' => __('Publications'),
        	'singular_label' => __('Publication'),
        	'public' => true,
        	'show_ui' => true,
        	'capability_type' => 'post',
        	'hierarchical' => false,
        	'rewrite' => true,
        	'supports' => array('title', 'editor')
        );
    	register_post_type( 'publications' , $args );

    	register_taxonomy(
			'publications',
			'publications',
			array(
				'label' =>'Publication Type',
				'sort' => true,
				'args' => array('orderby' => 'term_order'),
				//'rewrite' => array('slug' => 'pub_type'),
				'rewrite' => array('slug' => 'publications'),
				'hierarchical'=>true
			)
		);
	}

/*********************************************************
	Custom Meta Box
*/

	add_action("admin_init", "admin_init");
	add_action('save_post', 'save_publications_meta');

	function publications_meta_options(){
		global $post;
		$custom = get_post_custom($post->ID);
		$pub_summary = $custom["pub_summary"][0];
		$pub_attorneys = get_post_meta($post->ID, 'pub_attorneys', true);
		$pub_practices = get_post_meta($post->ID, 'pub_practices', true);
	?>

	<script type="text/javascript">
		jQuery(document).ready(function($) {
			// Initialize TinyMCE for the textareas
			tinyMCE.init({
        plugins : "paste wplink",
				theme_advanced_buttons1 : "bold,italic,separator,numlist,bullist,separator,link,unlink,separator,pasteword,pastetext",
				theme_advanced_buttons2 : "",
				theme_advanced_buttons3 : "",
				mode : "specific_textareas",
	      editor_selector : /(pub_summary)/,
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
				$(this).parent().siblings('input').val(''); // Clear Title
				var editor = $(this).parent().siblings('textarea').attr('name');
				tinyMCE.get(editor).setContent(''); // Clear TinyMCE
				$(this).closest('.area').slideUp();
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
	</style>

	<table class="form-table">
		<tr style="display:none">
			<th style="width: 20%;"><label for="pub_summary">Summary</label></th>
			<td>
				<textarea name="pub_summary" class="pub_summary" style="width:100%;height:200px;"><?=$pub_summary;?></textarea>
			</td>
		</tr>
		<tr>
			<th style="width: 20%;"><label for="pub_attorneys">Attorneys</label></th>
			<td>
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
						$name = $custom["last_name"][0].', ';
						$name .= $custom["first_name"][0] . ' ';
						$name .= $custom["middle_initial"][0];
						$id = $post->ID;
						$checked = (is_array($pub_attorneys) && in_array($id, $pub_attorneys)) ? 'checked="checked"' : '';

						echo '<input type="checkbox" name="pub_attorneys[]" value="' . $id . '" ' . $checked . '/> ' . $name . '<br />';
					}
				?>
			</td>
		</tr>
		<tr>
			<th style="width: 20%;"><label for="pub_practices">Practices</label></th>
			<td>
				<?php
					$loop = new WP_Query(array(
							'post_type' => 'practices',
							//'meta_key' => 'last_name',
							'orderby' => 'title',
							'order' => 'ASC',
							'posts_per_page' => 100
						));
					while ( $loop->have_posts() ) {
						$loop->the_post();
						$custom = get_post_custom($post->ID);
						$id = $post->ID;
						$checked = (is_array($pub_practices) && in_array($id, $pub_practices)) ? 'checked="checked"' : '';

						echo '<input type="checkbox" name="pub_practices[]" value="' . $id . '" ' . $checked . '/> ' . get_the_title() . '<br />';
					}
				?>
			</td>
		</tr>
	</table>

	<?php
	}


	function save_publications_meta(){
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return; // Fixes autosave for custom meta

		global $post;
		if(isset($_POST["pub_summary"])) update_post_meta($post->ID, "pub_summary", $_POST["pub_summary"]);
		if(isset($_POST["pub_attorneys"])) update_post_meta($post->ID, "pub_attorneys", $_POST["pub_attorneys"]);
		if(isset($_POST["pub_practices"])) update_post_meta($post->ID, "pub_practices", $_POST["pub_practices"]);
	}
