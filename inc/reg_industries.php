<?php

/*********************************************************
  Register Custom Post Type
*/

  add_action( 'init', 'industries_register' );
  function industries_register() {
      $args = array(
          'label' => __('Industries'),
          'singular_label' => __('Industry'),
          'public' => true,
          'show_ui' => true,
          'capability_type' => 'post',
          'hierarchical' => false,
          'rewrite' => true,
          'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' )
        );
      register_post_type( 'industries' , $args );
  }


/*********************************************************
  Custom Column Headers
*/

  add_filter( "manage_edit-industries_columns", "industries_edit_columns" );

  function industries_edit_columns( $columns ){
        $columns = array(
            "cb" => "<input type=\"checkbox\" />",
            "title" => "Industry Title",
        );
        return $columns;
  }
