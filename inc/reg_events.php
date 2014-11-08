<?php

/*********************************************************
  Register Custom Post Type
*/

  add_action('init', 'events_register');
  function events_register() {
      $args = array(
          'label' => __('Events'),
          'singular_label' => __('Event'),
          'public' => true,
          'show_ui' => true,
          'capability_type' => 'post',
          'hierarchical' => false,
          'rewrite' => true,
          'supports' => array('title', 'thumbnail', 'revisions' ),
	      'taxonomies' => array( 'category' )
        );
      register_post_type( 'events' , $args );
  }

/*********************************************************
  Custom Column Headers
*/

  add_filter("manage_edit-events_columns", "events_edit_columns");
  add_action("manage_posts_custom_column",  "events_custom_columns");

  function events_edit_columns($columns){

      unset($columns['date']);

          $columns = array(
              "cb" => "<input type=\"checkbox\" />",
              "title" => "Events",
              //"status" => "Status",
              "new_date" => "Date",
          );
          return $columns;
  }

  function events_custom_columns($column){
          global $post;
          switch ($column)
          {
              case "new_date":
                  $custom = get_post_custom();
                  $date = $custom["date"][0];
          $fix_date = explode('/', $date);
          $fix_date = $fix_date[2] . '-' . $fix_date[1] . '-20' . $fix_date[0];
          //echo date('F jS, Y', strtotime($fix_date));
          echo date('Y/m/d', strtotime($fix_date));
                  break;
          }
  }

  function price_column_register_sortable( $columns ) {
    $columns['new_date'] = 'new_date';
    return $columns;
  }
  add_filter( 'manage_edit-events_sortable_columns', 'price_column_register_sortable' );

  function events_column_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'new_date' == $vars['orderby'] ) {
      $vars = array_merge( $vars, array(
        'meta_key' => 'date',
        'orderby' => 'meta_value_num'
      ) );
    }
    return $vars;
  }
  add_filter( 'request', 'events_column_orderby' );

/*********************************************************
  Custom Meta Box
*/


  add_action("admin_init", "admin_init");
  add_action( 'save_post', 'save_events_meta', 15, 2 );

  function events_meta_options(){
    global $post;

	$date = '';
	  $expired = '';
	  $time = '';
	  $location = '';
	  $description = '';
	  $rsvp = '';
	  $wufoo = '';
	  $event_attorneys = '';
	  $event_practices = '';
	  $fix_date = '';

    $custom = get_post_custom($post->ID);
    $date = get_post_meta($post->ID, "date", true );
    if($date){
      $fix_date = explode('/', $date);
      $fix_date = $fix_date[1] . '/' . $fix_date[2] . '/' . $fix_date[0];
    }
    $expired = get_post_meta( $post->ID, "expired", true );

    $time = get_post_meta($post->ID, "time", true );
    $location = get_post_meta($post->ID, "location", true );
    $description = get_post_meta($post->ID, "description", true );
    $rsvp = get_post_meta($post->ID, "rsvp", true );
    $wufoo = get_post_meta($post->ID, 'wufoo', true);
    $event_attorneys = get_post_meta($post->ID, 'event_attorneys', true);
    $event_practices = get_post_meta($post->ID, 'event_practices', true);
  ?>

  <script type="text/javascript">
  jQuery(document).ready(function($) {
      // Initialize TinyMCE for the textareas
      tinyMCE.init({
        plugins : "paste wplink",
        theme_advanced_buttons1 : "bold,italic,numlist,bullist,link",
        theme_advanced_buttons2 : "",
        theme_advanced_buttons3 : "",
        mode : "specific_textareas",
        editor_selector : /(description)/,
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_resizing : true,
        theme_advanced_disable : "formatselect",
        menubar : false,
        style_formats : false
      });

      $("input[name='date']").datepicker({
          dateFormat: 'mm/dd/y',
          changeYear: true
        });
	  $("input[name='display_date']").datepicker({
		  dateFormat: 'mm/dd/y',
		  changeYear: true
	  });
      $("#ui-datepicker-div").hide();
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
    <tr>
      <th style="width: 20%;"><label for="date">Date</label></th>
      <td>
        <input type="text" class="text_input" name="date" value="<?php echo $fix_date; ?>" size="20" /><br />
        <small>Ex: 09/25/11</small>
      </td>
    </tr>
    <tr>
      <th style="width: 20%;"><label for="time">Archive Event</label></th>
      <td>
        <input type="checkbox" name="expired" value="1" <?php checked( $expired, 1 ); ?>/><br />
        <small>Check this box to archive this event once it's date has passed.</small>
      </td>
    </tr>
    <tr style="display:none;">
      <th style="width: 20%;"><label for="time">Time</label></th>
      <td>
        <input type="text" class="text_input" name="time" value="<?php echo $time; ?>" style="width:100%" /><br />
        <small>Ex: 2:00pm - 5:00pm</small>
      </td>
    </tr>
    <tr style="display:none;">
      <th style="width: 20%;"><label for="location">Location</label></th>
      <td>
        <input type="text" class="text_input" name="location" value="<?php echo $location; ?>" style="width:100%" /><br />
        <small>Ex: 216 Park Road, Burlingame, CA 94010</small>
      </td>
    </tr>
    <tr>
      <th style="width: 20%;"><label for="description">Description</label></th>
      <td>
	      <?php wp_editor( $description, 'description' ); ?>
      </td>
    </tr>
    <tr>
      <th style="width: 20%;"><label for="wufoo">WuFoo Form Embed</label></th>
      <td>
        <input type="text" class="text_input" name="wufoo" value="<?php echo esc_attr($wufoo); ?>" style="width:100%" /><br />
        <small>Ex: [wufoo username="carrmcclellan" formhash="x7w3w3" autoresize="true" height="458" header="show" ssl="true"]</small>
      </td>
    </tr>
    <tr style="display:none;">
      <th style="width: 20%;"><label for="rsvp">RSVP</label></th>
      <td>
        <input type="text" class="text_input" name="rsvp" value="<?php echo $rsvp; ?>" style="width:100%" /><br />
        <small>Ex: name@email.com</small>
      </td>
    </tr>
    <tr>
      <th style="width: 20%;"><label for="event_attorneys">Attorneys</label></th>
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
            $checked = (is_array($event_attorneys) && in_array($id, $event_attorneys)) ? 'checked="checked"' : '';

            echo '<input type="checkbox" name="event_attorneys[]" value="' . $id . '" ' . $checked . '/> ' . $name . '<br />';
          }
        ?>
      </td>
    </tr>
    <tr>
      <th style="width: 20%;"><label for="event_practices">Practices</label></th>
      <td>
        <?php
          $loop = new WP_Query(array(
              'post_type' => 'practices',
              'orderby' => 'title',
              'order' => 'ASC',
              'posts_per_page' => 100
            ));
          while ( $loop->have_posts() ) {
            $loop->the_post();
            $custom = get_post_custom($post->ID);
            $id = $post->ID;
            $checked = (is_array($event_practices) && in_array($id, $event_practices)) ? 'checked="checked"' : '';

            echo '<input type="checkbox" name="event_practices[]" value="' . $id . '" ' . $checked . '/> ' . get_the_title() . '<br />';
          }
        ?>
      </td>
    </tr>
	  <?php wp_nonce_field( 'save', 'carr_events' ); ?>
  </table>

  <?php
  }


  function save_events_meta( $post_id, $post ) {
	  // Bail if doing autosave
	  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }

	  // Bail if nonce isn't set
	  if ( ! isset( $_POST['carr_events'] ) || ! wp_verify_nonce( $_POST['carr_events'], 'save' ) ) { return; }

	  // Bail if the user isn't allowed to edit the post
	  if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }

	  // Bail if not an asset
	  if ( 'events' !== $post->post_type ) { return; }

    $fix_date = explode('/', $_POST["date"]);
    $fix_date = $fix_date[2] . '/' . $fix_date[0] . '/' . $fix_date[1];

    if(isset($_POST["date"])) update_post_meta($post->ID, "date", $fix_date);
    if(isset($_POST["date"])) update_post_meta($post->ID, "sort_date", $_POST["date"]);
    if(isset($_POST["expired"])){
      update_post_meta($post->ID, "expired", $_POST["expired"]);
    } else{
      delete_post_meta($post->ID, "expired", $_POST["expired"]);
    }

    if(isset($_POST["time"])) update_post_meta($post->ID, "time", $_POST["time"]);
    if(isset($_POST["location"])) update_post_meta($post->ID, "location", $_POST["location"]);
    if(isset($_POST["description"])) update_post_meta($post->ID, "description", $_POST["description"]);
    if(isset($_POST["wufoo"])) update_post_meta($post->ID, "wufoo", $_POST["wufoo"]);
    if(isset($_POST["rsvp"])) update_post_meta($post->ID, "rsvp", $_POST["rsvp"]);
    if(isset($_POST["event_attorneys"])) update_post_meta($post->ID, "event_attorneys", $_POST["event_attorneys"]);
    if(isset($_POST["event_practices"])) update_post_meta($post->ID, "event_practices", $_POST["event_practices"]);
  }