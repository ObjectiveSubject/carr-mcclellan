<?php

/*********************************************************
  Register Custom Post Type
*/

  add_action('init', 'news_register');
  function news_register() {
      $args = array(
          'label' => __('In the News'),
          'singular_label' => __('News'),
          'public' => true,
          'show_ui' => true,
          'capability_type' => 'post',
          'hierarchical' => false,
          'rewrite' => true,
          'supports' => array('title', 'thumbnail')
        );
      register_post_type( 'news' , $args );
  }


/*********************************************************
  Custom Column Headers
*/

  add_filter("manage_edit-news_columns", "news_edit_columns");
  add_action("manage_posts_custom_column",  "news_custom_columns");

  function news_edit_columns($columns){

      unset($columns['date']);

          $columns = array(
              "cb" => "<input type=\"checkbox\" />",
              "title" => "News",
              "type" => "Type",
              "news_date" => "Date",
          );
          return $columns;
  }

  function news_custom_columns($column){
          global $post;
          switch ($column)
          {
              case "news_date":
                  $custom = get_post_custom();
                  $date = $custom["date"][0];
          $fix_date = explode('/', $date);
          $fix_date = $fix_date[2] . '-' . $fix_date[1] . '-20' . $fix_date[0];
          //echo date('F jS, Y', strtotime($fix_date));
          echo date('Y/m/d', strtotime($fix_date));
                  break;
              case "type":
                $custom = get_post_custom();
                  $news_type_select = $custom["news_type_select"][0];
                  if($news_type_select == 'internal') { echo 'Internal';}
                  else if($news_type_select == 'external') { echo 'External';}
                  else if($news_type_select == 'pdf') { echo 'PDF';}
                  else { echo 'Undefined';}
                  break;
          }
  }

  function news_column_register_sortable( $columns ) {
    $columns['news_date'] = 'news_date';
    return $columns;
  }
  add_filter( 'manage_edit-news_sortable_columns', 'news_column_register_sortable' );



  function news_column_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'news_date' == $vars['orderby'] ) {
      $vars = array_merge( $vars, array(
        'meta_key' => 'date',
        'orderby' => 'meta_value_num'
      ) );
    }

    return $vars;
  }
  add_filter( 'request', 'news_column_orderby' );

/*********************************************************
  Custom Meta Box
*/

  add_action("admin_init", "admin_init");
  add_action( 'save_post', 'save_news_meta', 15, 2 );

  function news_meta_options(){
    global $post;
    $custom = get_post_custom($post->ID);
    $date = $custom["date"][0];
    if($date){
      $fix_date = explode('/', $date);
      $fix_date = $fix_date[1] . '/' . $fix_date[2] . '/' . $fix_date[0];
    }

    $news_type_select = $custom["news_type_select"][0];
    $news_type = get_post_meta($post->ID, 'news_type', 'single');
    $source = $custom["source"][0];
    $source_url = $custom["source_url"][0];
    $summary = $custom["summary"][0];

    $news_attorneys = get_post_meta($post->ID, 'news_attorneys', true);
    $news_practices = get_post_meta($post->ID, 'news_practices', true);

  ?>

  <script type="text/javascript">
  jQuery(document).ready(function($) {
    // Initialize TinyMCE for the textareas
    tinyMCE.init({
      //theme : "advanced",
      plugins : "paste wplink media wpeditimage wordpress",
      theme_advanced_buttons1 : "bold,italic,numlist,bullist,link,unlink,image",
      theme_advanced_buttons2 : "",
      theme_advanced_buttons3 : "",
      theme_advanced_blockformats : "p,h2,h3,h4,blockquote",
      mode : "specific_textareas",
      editor_selector : /(summary)/,
      theme_advanced_toolbar_location : "top",
      theme_advanced_toolbar_align : "left",
      theme_advanced_resizing : true,
      menubar : false
    });

    $("input[name='date']").datepicker({
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
      <th style="width: 20%;"><label for="news_type">News Type:</label></th>
      <td>
        <select name="news_type_select">
          <option value="internal" <?php if($news_type_select == 'internal'){echo 'selected="selected"';}?>>Press Release (Internal)</option>
          <option value="external" <?php if($news_type_select == 'external'){echo 'selected="selected"';}?>>External Site</option>
          <option value="pdf" <?php if($news_type_select == 'pdf'){echo 'selected="selected"';}?>>PDF</option>
        </select>
      </td>

      <td style="display:none;">
        <?php
          function set_check($value,$array){
            if(in_array($value,$array)){
              echo 'checked="checked"';
            }
          }
        ?>
        <input type="checkbox" name="news_type[]" <?php set_check('Media Coverage',$news_type);?> value="Media Coverage"> Media Coverage<br />
        <input type="checkbox" name="news_type[]" <?php set_check('In The News',$news_type);?> value="In The News"> In The News<br />
        <input type="checkbox" name="news_type[]" <?php set_check('Press Release',$news_type);?> value="Press Release"> Press Release
      </td>
    </tr>
    <tr>
      <th style="width: 20%;"><label for="source">Source Title</label></th>
      <td>
        <input type="text" class="text_input" name="source" value="<?php echo $source; ?>" style="width:100%" /><br />
        <small>Ex: Google</small>
      </td>
    </tr>
    <tr>
      <th style="width: 20%;"><label for="source_url">Source URL</label></th>
      <td>
        <input type="text" class="text_input" name="source_url" value="<?php echo $source_url; ?>" style="width:100%" /><br />
        <small>Ex: http://www.google.com/</small><br />
        <small>Note: If PDF file is attached below, this link will be overriden with a link to the PDF.</small>
      </td>
    </tr>
    <tr>
      <th style="width: 20%;"><label for="summary">Press Release</label></th>
      <td>
        <textarea class="summary" name="summary" style="width: 100%;height:200px;"><?php echo $summary;?></textarea>
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
            $checked = (is_array($news_attorneys) && in_array($id, $news_attorneys)) ? 'checked="checked"' : '';

            echo '<input type="checkbox" name="news_attorneys[]" value="' . $id . '" ' . $checked . '/> ' . $name . '<br />';
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
            $checked = (is_array($news_practices) && in_array($id, $news_practices)) ? 'checked="checked"' : '';

            echo '<input type="checkbox" name="news_practices[]" value="' . $id . '" ' . $checked . '/> ' . get_the_title() . '<br />';
          }
        ?>
      </td>
    </tr>
	  <?php wp_nonce_field( 'save', 'carr_news' ); ?>
  </table>


  <?php
  }


  function save_news_meta( $post_id, $post ) {
	  // Bail if doing autosave
	  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }

	  // Bail if nonce isn't set
	  if ( ! isset( $_POST['carr_news'] ) || ! wp_verify_nonce( $_POST['carr_news'], 'save' ) ) { return; }

	  // Bail if the user isn't allowed to edit the post
	  if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }

	  // Bail if not an asset
	  if ( 'news' !== $post->post_type ) { return; }

    $fix_date = explode('/', $_POST["date"]);
    $fix_date = $fix_date[2] . '/' . $fix_date[0] . '/' . $fix_date[1];
    if(isset($_POST["date"])) update_post_meta($post->ID, "date", $fix_date);
    if(isset($_POST["news_type"])) update_post_meta($post->ID, "news_type", $_POST["news_type"]);
    if(isset($_POST["news_type_select"])) update_post_meta($post->ID, "news_type_select", $_POST["news_type_select"]);
    if(isset($_POST["source"])) update_post_meta($post->ID, "source", $_POST["source"]);
    if(isset($_POST["source_url"])) update_post_meta($post->ID, "source_url", $_POST["source_url"]);
    if(isset($_POST["summary"])) update_post_meta($post->ID, "summary", $_POST["summary"]);

    if(isset($_POST["news_attorneys"])) update_post_meta($post->ID, "news_attorneys", $_POST["news_attorneys"]);
    if(isset($_POST["news_practices"])) update_post_meta($post->ID, "news_practices", $_POST["news_practices"]);

  }
