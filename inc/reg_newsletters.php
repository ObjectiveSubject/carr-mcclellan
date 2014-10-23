<?php

/*********************************************************
  Register Custom Post Type
*/

  add_action('init', 'newsletters_register');
  function newsletters_register() {
      $args = array(
          'label' => __('Newsletters'),
          'singular_label' => __('Newsletter'),
          'public' => true,
          'show_ui' => true,
          'capability_type' => 'post',
          'hierarchical' => false,
          'rewrite' => true,
          'supports' => array('title', 'editor')
        );
      register_post_type( 'newsletters' , $args );
  }

/*********************************************************
  Custom Meta Box
*/

  add_action("admin_init", "admin_init");
  add_action( 'save_post', 'save_newsletters_meta', 15, 2 );

  function newsletters_meta_options(){
    global $post;
    $custom = get_post_custom($post->ID);
    $author = $custom["author"][0];
    $in_this_issue_wysiwyg = $custom["in_this_issue_wysiwyg"][0];

    $in_this_issue_type = get_post_meta($post->ID, 'in_this_issue_type', 'single');
    if(!$in_this_issue_type){
      $in_this_issue_type = array('','','','','','','','','','');
    }

    $in_this_issue = get_post_meta($post->ID, 'in_this_issue', 'single');
    if(!$in_this_issue){
      $in_this_issue = array('','','','','','','','','','');
    }
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
        editor_selector : /(in_this_issue_wysiwyg)/,
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_resizing : true,
        menubar : false
      });

      // Show the first hidden Areas of Focus box
      $('.add-new').click(function(e){
        e.preventDefault();
        $(".issue").filter(function() { return $(this).css("display") == "none" }).first().slideDown();
      });

      // Clear Areas of Focus fields and hide box
      $('.delete-issue').click(function(e){
        e.preventDefault();

        $(this).siblings('select').val(''); // Clear Title
        $(this).closest('.issue').slideUp();
      });

      $('.issue-container').sortable({
        handle: 'h4',
        cursor: 'move',
        start: function(){
        },
        stop: function(e,ui) {
          resetAreas();
        }
      });

      function resetAreas(){
        var i = 1;
        $('.issue').each(function(){

          $(this).children('select.type').attr('name', 'in_this_issue_type_' + i);
          $(this).children('select.main').attr('name', 'in_this_issue_' + i);

          //$(this).children('div.inside').children('input.areas_title').attr('name','areas_title_' + i);
          //$(this).children('div.inside').children('textarea.areas_textarea').attr('name','areas_body_' + i);
          i++;
        });
      }

      $('.issue select.type').change(function(){
        var type = $(this).val();
        var content = $(this).siblings('select.' + type).html();
        $(this).siblings('select.main').html(content);
      });

      $('.issue select.type').each(function(){
        var type = $(this).val();
        var content = $(this).siblings('select.' + type).html();
        $(this).siblings('select.main').html(content);
      });

    });

  </script>

  <style type="text/css">
    .issue {
      clear: both;
      margin-bottom: 10px;
      }
    .issue h4 {
      float: left;
      background: url('<?php bloginfo('template_url');?>/images/sort.png') no-repeat;
      width: 10px;
      height: 10px;
      text-indent: -9999px;
      margin: 8px 10px 0px 0px;
      padding: 0px;
      }
    .issue h4:hover {
      cursor: pointer;
      }
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
      <th style="width: 20%;"><label for="author">Author</label></th>
      <td>
        <select name="author">
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
              $selected = ($author == $id) ? 'selected="selected"' : '';

              echo '<option value="' . $id . '" ' . $selected . '>' . $name . '</option>';
            }
          ?>
        </select>
      </td>
    </tr>

    <tr style="display:none;">
      <th style="width: 20%;"><label for="in_this_issue_wysiwyg">In This Issue</label></th>
      <td>
        <textarea class="in_this_issue_wysiwyg" name="in_this_issue_wysiwyg" style="width:100%;height:200px;"><?=$in_this_issue_wysiwyg;?></textarea>
      </td>
    </tr>

    <tr>
      <th style="width: 20%;"><label for="in_this_issue">In This Issue</label></th>
      <td>
        <div class="issue-container">

        <?php
          $i = 1;
          $o = 0;
          foreach($in_this_issue as $issue) :
          if($issue) {
        ?>
          <div class="issue">
            <h4>Sort</h4>
            <select name="in_this_issue_type_<?=$i;?>" class="type">
              <option value="publications" <?=($in_this_issue_type[$o] == 'publications') ? 'selected="selected"' : '';?>>Publication</option>
              <option value="posts" <?=($in_this_issue_type[$o] == 'posts') ? 'selected="selected"' : '';?>>Post</option>
            </select>

            <select name="in_this_issue_<?=$i;?>" class="main">
            </select>

            <select class="publications" style="display:none;">
              <option value="">Select…</option>
              <?php
                $loop = new WP_Query(array(
                    'post_type' => 'publications',
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'posts_per_page' => 100
                  ));
                while ( $loop->have_posts() ) {
                  $loop->the_post();
                  $custom = get_post_custom($post->ID);
                  $id = $post->ID;
                  $selected = ($issue == $id) ? 'selected="selected"' : '';
                  $title = get_the_title();
                  $title = (strlen($title) > 50) ? substr($title, 0, 50) . '…' : $title;

                  echo '<option value="' . $id . '" ' . $selected . '>' . $title . '</option>';
                }
              ?>
            </select>
            <select class="posts" style="display:none;">
              <option value="">Select...</option>
              <?php
                $loop = new WP_Query(array(
                    'post_type' => 'post',
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'posts_per_page' => 100
                  ));
                while ( $loop->have_posts() ) {
                  $loop->the_post();
                  $custom = get_post_custom($post->ID);
                  $id = $post->ID;
                  $selected = ($issue == $id) ? 'selected="selected"' : '';
                  $title = get_the_title();
                  $title = (strlen($title) > 50) ? substr($title, 0, 50) . '…' : $title;

                  echo '<option value="' . $id . '" ' . $selected . '>' . $title . '</option>';
                }
              ?>
            </select>
            <a href="#" class="delete-issue" onclick="return confirm('Are you sure?');">Delete</a>

          </div>

        <?php
          } else {
        ?>

          <div class="issue" style="display:none;">
            <h4>Sort</h4>

            <select name="in_this_issue_type_<?=$i;?>" class="type">
              <option value="publications">Publication</option>
              <option value="posts">Post</option>
            </select>

            <select name="in_this_issue_<?=$i;?>" class="main">
            </select>

            <select class="publications" style="display:none;">
              <option value="">Select…</option>
              <?php
                $loop = new WP_Query(array(
                    'post_type' => 'publications',
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'posts_per_page' => 100
                  ));
                while ( $loop->have_posts() ) {
                  $loop->the_post();
                  $custom = get_post_custom($post->ID);
                  $id = $post->ID;
                  $selected = ($issue == $id) ? 'selected="selected"' : '';
                  $title = get_the_title();
                  $title = (strlen($title) > 50) ? substr($title, 0, 50) . '…' : $title;

                  echo '<option value="' . $id . '" ' . $selected . '>' . $title . '</option>';
                }
              ?>
            </select>
            <select class="posts" style="display:none;">
              <option value="">Select...</option>
              <?php
                $loop = new WP_Query(array(
                    'post_type' => 'post',
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'posts_per_page' => 100
                  ));
                while ( $loop->have_posts() ) {
                  $loop->the_post();
                  $custom = get_post_custom($post->ID);
                  $id = $post->ID;
                  $selected = ($issue == $id) ? 'selected="selected"' : '';
                  $title = get_the_title();
                  $title = (strlen($title) > 50) ? substr($title, 0, 50) . '…' : $title;

                  echo '<option value="' . $id . '" ' . $selected . '>' . $title . '</option>';
                }
              ?>
            </select>

            <a href="#" class="delete-issue" onclick="return confirm('Are you sure?');">Delete</a>
          </div>

        <?php
          }
          $i++;
          $o++;
          endforeach;
        ?>
        </div>

        <a href="#" class="add-new">Add New</a>

      </td>
    </tr>
	  <?php wp_nonce_field( 'save', 'carr_newsletters' ); ?>
  </table>

  <?php
  }


  function save_newsletters_meta( $post_id, $post ) {
	  // Bail if doing autosave
	  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }

	  // Bail if nonce isn't set
	  if ( ! isset( $_POST['carr_newsletters'] ) || ! wp_verify_nonce( $_POST['carr_newsletters'], 'save' ) ) { return; }

	  // Bail if the user isn't allowed to edit the post
	  if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }

	  // Bail if not an asset
	  if ( 'newsletters' !== $post->post_type ) { return; }

    if(isset($_POST["author"])) update_post_meta($post->ID, "author", $_POST["author"]);
    if(isset($_POST["in_this_issue_wysiwyg"])) update_post_meta($post->ID, "in_this_issue_wysiwyg", $_POST["in_this_issue_wysiwyg"]);

    $in_this_issue_type_array = array(
        $_POST["in_this_issue_type_1"],
        $_POST["in_this_issue_type_2"],
        $_POST["in_this_issue_type_3"],
        $_POST["in_this_issue_type_4"],
        $_POST["in_this_issue_type_5"],
        $_POST["in_this_issue_type_6"],
        $_POST["in_this_issue_type_7"],
        $_POST["in_this_issue_type_8"],
        $_POST["in_this_issue_type_9"],
        $_POST["in_this_issue_type_10"]
      );
    if(isset($_POST["in_this_issue_type_1"])) update_post_meta($post->ID, "in_this_issue_type", $in_this_issue_type_array);

    $in_this_issue_array = array(
        $_POST["in_this_issue_1"],
        $_POST["in_this_issue_2"],
        $_POST["in_this_issue_3"],
        $_POST["in_this_issue_4"],
        $_POST["in_this_issue_5"],
        $_POST["in_this_issue_6"],
        $_POST["in_this_issue_7"],
        $_POST["in_this_issue_8"],
        $_POST["in_this_issue_9"],
        $_POST["in_this_issue_10"]
      );
    if(isset($_POST["in_this_issue_1"])) update_post_meta($post->ID, "in_this_issue", $in_this_issue_array);
  }