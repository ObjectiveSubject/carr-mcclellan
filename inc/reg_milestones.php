<?php

/*********************************************************
  Register Custom Post Type
*/

  add_action('init', 'milestones_register');
  function milestones_register() {
      $args = array(
          'label' => __('Milestones'),
          'singular_label' => __('Milestones'),
          'public' => true,
          'show_ui' => true,
          'capability_type' => 'post',
          'hierarchical' => false,
          'rewrite' => true,
          'supports' => array('title', 'editor', 'thumbnail','page-attributes')
        );
      register_post_type( 'milestones' , $args );
  }

/*********************************************************
  Custom Meta Box
*/

  add_action("admin_init", "admin_init");
  add_action( 'save_post', 'save_milestone_meta', 15, 2 );

  function milestones_meta_options(){
    global $post;
    $custom = get_post_custom($post->ID);
    $milestone_date = "";
    if( $custom["milestone_date"][0] ){
      $milestone_date = date('F Y', $custom["milestone_date"][0]);
    }
  ?>

  <table class="form-table">
    <tr>
      <th style="width: 20%;"><label for="milestone_date">Milestone Date</label></th>
      <td>
        <input type="text" class="text_input" name="milestone_date" value="<?php echo $milestone_date; ?>" style="width:97%" /><br />
        <small>Ex: January 1988</small>
      </td>
    </tr>
	<?php wp_nonce_field( 'save', 'carr_milestones' ); ?>
  </table>


  <?php
  }

  function save_milestone_meta( $post_id, $post ){
	// Bail if doing autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }

	// Bail if nonce isn't set
	if ( ! isset( $_POST['carr_milestones'] ) || ! wp_verify_nonce( $_POST['carr_milestones'], 'save' ) ) { return; }

	// Bail if the user isn't allowed to edit the post
	if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }

	// Bail if not an asset
	if ( 'milestones' !== $post->post_type ) { return; }

    if( isset( $_POST['milestone_date'] ) ) {
	    $new_date = strtotime( $_POST['milestone_date'] );

	    update_post_meta( $post_id, 'milestone_date', $new_date );
    } else {
	    delete_post_meta( $post_id, 'milestone_date' );
    }
  }


/*********************************************************
  Custom Column Headers
*/

  add_filter("manage_edit-milestones_columns", "milestones_edit_columns");
  add_action("manage_posts_custom_column",  "milestones_custom_columns");

  function milestones_edit_columns($columns){
        $columns = array(
            "cb" => "<input type=\"checkbox\" />",
            "title" => "Milestone Title",
            "milestone_date" => "Milestone Date"
        );
        return $columns;
  }

  function milestones_custom_columns($column){
        global $post;
        switch ($column)
        {
            case "milestone_date":
                $custom = get_post_custom();
                $milestone_date = "";
                if( $custom["milestone_date"][0] ){
                  $milestone_date = date('F Y', $custom["milestone_date"][0]);
                }
                echo $milestone_date;
                break;
        }
  }

?>