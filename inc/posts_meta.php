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
} ?>