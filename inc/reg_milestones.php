<?php

/*********************************************************
  Register Custom Post Type
*/

  add_action('init', 'milestones_register');
  function milestones_register() {
      $args = array(
          'label' => __('Firm History'),
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
  Custom Column Headers
*/

  add_filter("manage_edit-milestones_columns", "milestones_edit_columns");

  function milestones_edit_columns($columns){
        $columns = array(
            "cb" => "<input type=\"checkbox\" />",
            "title" => "Title"
        );
        return $columns;
  }