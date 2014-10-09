<?php

/*********************************************************
  Register Custom Post Type
*/

  add_action('init', 'attorneys_register');
  function attorneys_register() {
      $args = array(
          'label' => __('Attorneys'),
          'singular_label' => __('Attorney'),
          'public' => true,
          'show_ui' => true,
          //'capability_type' => 'post',
          'hierarchical' => false,
          //'rewrite' => true,
          'supports' => array('title', 'thumbnail')
        );
      register_post_type( 'attorneys' , $args );
  }
  add_action("admin_head","carr_load_tiny_mce");

  // Disable Autosave ** Edit - Modified save_attorneys_meta() to fix autosave
  //
  //add_action('admin_print_scripts', 'disable_autosave');
  function disable_autosave(){
      global $post;
      if(get_post_type($post->ID) === 'attorneys'){
          wp_deregister_script('autosave');
      }
  }

/*********************************************************
  Custom Meta Box
*/

  add_action("admin_init", "admin_init");
  add_action('save_post', 'save_attorneys_meta');

  function attorneys_meta_options(){
    global $post;
    $custom = get_post_custom($post->ID);
    $first_name = $custom["first_name"][0];
    $middle_initial = $custom["middle_initial"][0];
    $last_name = $custom["last_name"][0];
    $title = $custom["title"][0];
    $secondary_title = $custom["secondary_title"][0];
    $phone = ($phone) ? $custom["phone"][0] : '650-342-9600 ';
    $fax = ($fax) ? $custom["fax"][0] : '650-342-7685';
    $email = $custom["email"][0];
    $linkedin = $custom["linkedin"][0];
    $biography = $custom["biography"][0];
    $quote = $custom["quote"][0];
    $academic_creds = $custom["academic_creds"][0];
    $attorney_languages = $custom["attorney_languages"][0];
    $special_exp = $custom["special_exp"][0];
    $prof_affilations = $custom["prof_affilations"][0];
    $courts_forums = $custom["courts_forums"][0];
    $civic_affiliations = $custom["civic_affiliations"][0];
    $honors_awards = $custom["honors_awards"][0];
    $custom_title = $custom["custom_title"][0];
    $custom_body = $custom["custom_body"][0];
    $recent_exp = $custom["recent_exp"][0];
    $recent_speaking = $custom["recent_speaking"][0];
    $areas_practice_hidden = $custom["areas_practice_hidden"][0];
    $areas_practice = get_post_meta($post->ID, 'areas_practice', true);
    $areas_related_practice_hidden = $custom["areas_related_practice_hidden"][0];
    $areas_related_practice = get_post_meta($post->ID, 'areas_related_practice', true);
  ?>

  <script type="text/javascript">
  jQuery(document).ready(function($) {
    tinyMCE.init({
      plugins : "paste wplink",
      theme_advanced_buttons1 : "bold,italic,separator,numlist,bullist,separator,link,unlink,separator,pasteword,pastetext",
      theme_advanced_buttons2 : "",
      theme_advanced_buttons3 : "",
      mode : "specific_textareas",
      editor_selector : /(biography|academic_creds|attorney_languages|special_exp|prof_affilations|courts_forums|civic_affiliations|honors_awards|recent_exp|recent_speaking|custom_body)/,
      theme_advanced_toolbar_location : "top",
      theme_advanced_toolbar_align : "left",
      theme_advanced_resizing : true,
      theme_advanced_resizing_max_height : 240,
      menubar : false
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
          <option value="" <?php echo($title=='') ? 'selected="selected"':'';?>>No Title</option>
          <!-- <option value="Member" <?php echo($title=='Member') ? 'selected="selected"':'';?>>Member</option> -->
          <option value="Director" <?php echo($title=='Director') ? 'selected="selected"':'';?>>Director</option>
          <option value="Special Counsel" <?php echo($title=='Special Counsel') ? 'selected="selected"':'';?>>Special Counsel</option>
          <option value="Senior Counsel" <?php echo($title=='Senior Counsel') ? 'selected="selected"':'';?>>Senior Counsel</option>
          <option value="Of Counsel" <?php echo($title=='Of Counsel') ? 'selected="selected"':'';?>>Of Counsel</option>
        </select>
      </td>
    </tr>
    <tr>
      <th style="width: 20%;"><label for="secondary_title">Secondary Title</label></th>
      <td>
        <input type="text" class="text_input" name="secondary_title" value="<?php echo $secondary_title; ?>" size="30"/>
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
            <textarea class="biography" style="width:100%;height:200px;" name="biography"><?php echo $biography; ?></textarea>
          </div>
          <div class="tab_aca">
            <textarea class="academic_creds" style="width:100%;height:200px;" name="academic_creds"><?php echo $academic_creds; ?></textarea>
          </div>
          <div class="tab_lang">
            <textarea class="attorney_languages" style="width:100%;height:200px;" name="attorney_languages"><?php echo $attorney_languages; ?></textarea>
          </div>
        </div>
      </td>
    </tr>

    <tr style="display:none;">
      <th style="width: 20%;"><label for="quote">Quote</label></th>
      <td>
        <textarea class="quote" style="width:97%;height:50px;" name="quote"><?php echo $quote;?></textarea>
      </td>
    </tr>

    <tr>
      <th style="width: 20%;"><label for="areas_practice">Practice Areas</label></th>
      <td>
        <div style="height:90px;overflow:scroll;background:#fff;border:1px solid #ccc;padding:10px;">
        <?php
          $loop = new WP_Query(array(
              'post_type' => 'practices',
              'orderby' => 'title',
              'order' => 'ASC',
              'posts_per_page' => 100
            ));
          while ( $loop->have_posts() ) {
            $loop->the_post();
            $id = $post->ID;
            $custom = get_post_custom($id);
            $name = get_the_title();
            $cust_name = str_replace(',','', $name);
            $cust_name = str_replace('&','', $cust_name);
            $selected = ( is_array($areas_practice) && in_array($id, $areas_practice)) ? 'checked="checked"' : '';
            echo '<input type="checkbox" class="areas" name="areas_practice[]"';
            echo 'value="' . $id . '" ' . $selected . '/> ' . $name . ' <br />';
          }
        ?>
        </div>
        <input type="hidden" class="text_input" name="areas_practice_hidden" value="<?php echo $areas_practice_hidden; ?>" size="30" />
      </td>
    </tr>



    <tr>
      <th style="width: 20%;"><label for="areas_related_practice">Related Practice Areas</label></th>
      <td>
        <div style="height:90px;overflow:scroll;background:#fff;border:1px solid #ccc;padding:10px;">
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
            $name = get_the_title();
            $cust_name_related = str_replace(',','', $name);
            $cust_name_related = str_replace('&','', $cust_name_related);
            $selected = ( is_array($areas_related_practice) && in_array($cust_name_related, $areas_related_practice)) ? 'checked="checked"' : '';
            echo '<input type="checkbox" class="areas" name="areas_related_practice[]"';
            echo 'value="' . $cust_name_related . '" ' . $selected . '/> ' . $name . ' <br />';
          }
        ?>
        </div>
        <input type="hidden" class="text_input" name="areas_related_practice_hidden" value="<?php echo $areas_related_practice_hidden; ?>" size="30" />
      </td>
    </tr>

    <tr>
      <th style="width: 20%;"><label>Experience and affiliations</label></th>
      <td>
        <div class="metabox-tabs-div">
          <ul class="metabox-tabs" id="metabox-tabs">
            <li class="active tab0"><a class="active" href="javascript:void(null);">Representative Matters</a></li>
            <li class="tab1"><a href="javascript:void(null);">Professional Organizations</a></li>
            <li class="tab2"><a href="javascript:void(null);">Courts and Forums</a></li>
            <li class="tab3"><a href="javascript:void(null);">Civic and Charitable</a></li>
            <li class="tab4"><a href="javascript:void(null);">Recent Speaking Engagements</a></li>
            <li class="tab5"><a href="javascript:void(null);">Honors and Awards</a></li>
            <li class="tab6"><a href="javascript:void(null);">Custom</a></li>
          </ul>
          <div class="tab0">
            <textarea class="special_exp" style="width:100%;height:200px;" name="special_exp"><?php echo $special_exp; ?></textarea>
          </div>
          <div class="tab1">
            <textarea class="prof_affilations" style="width:100%;height:200px;" name="prof_affilations"><?php echo $prof_affilations; ?></textarea>
          </div>
          <div class="tab2">
            <textarea class="courts_forums" style="width:100%;height:200px;" name="courts_forums"><?php echo $courts_forums; ?></textarea>
          </div>
          <div class="tab3">
            <textarea class="civic_affiliations" style="width:100%;height:200px;" name="civic_affiliations"><?php echo $civic_affiliations; ?></textarea>
          </div>
          <div class="tab4">
            <textarea class="recent_speaking" style="width:100%;height:200px;" name="recent_speaking"><?php echo $recent_speaking; ?></textarea>
          </div>
          <div class="tab5">
            <textarea class="honors_awards" style="width:100%;height:200px;" name="honors_awards"><?php echo $honors_awards; ?></textarea>
          </div>
          <div class="tab6">
            <p>
            <label for="custom_title">Title</label><br />
            <input type="text" class="custom_title" name="custom_title" value="<?php echo $custom_title; ?>" size="30" /></p>
            <label for="custom_body">Body</label><br />
            <textarea class="custom_body" style="width:100%;height:200px;" name="custom_body"><?php echo $custom_body; ?></textarea>
          </div>
        </div>
      </td>
    </tr>

  </table>

  <?php
  }

  function save_attorneys_meta(){
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return; // Fixes autosave for custom meta
    global $post;
    if(isset($_POST["first_name"])) update_post_meta($post->ID, "first_name", $_POST["first_name"]);
    if(isset($_POST["middle_initial"])) update_post_meta($post->ID, "middle_initial", $_POST["middle_initial"]);
    if(isset($_POST["last_name"])) update_post_meta($post->ID, "last_name", $_POST["last_name"]);
    if(isset($_POST["title"])) update_post_meta($post->ID, "title", $_POST["title"]);
    if(isset($_POST["secondary_title"])) update_post_meta($post->ID, "secondary_title", $_POST["secondary_title"]);
    if(isset($_POST["phone"])) update_post_meta($post->ID, "phone", $_POST["phone"]);
    if(isset($_POST["fax"])) update_post_meta($post->ID, "fax", $_POST["fax"]);
    if(isset($_POST["email"])) update_post_meta($post->ID, "email", $_POST["email"]);
    if(isset($_POST["linkedin"])) update_post_meta($post->ID, "linkedin", $_POST["linkedin"]);
    if(isset($_POST["biography"])) update_post_meta($post->ID, "biography", $_POST["biography"]);
    if(isset($_POST["quote"])) update_post_meta($post->ID, "quote", $_POST["quote"]);
    if(isset($_POST["academic_creds"])) update_post_meta($post->ID, "academic_creds", $_POST["academic_creds"]);
    if(isset($_POST["attorney_languages"])) update_post_meta($post->ID, "attorney_languages", $_POST["attorney_languages"]);
    if(isset($_POST["special_exp"])) update_post_meta($post->ID, "special_exp", $_POST["special_exp"]);
    if(isset($_POST["prof_affilations"])) update_post_meta($post->ID, "prof_affilations", $_POST["prof_affilations"]);
    if(isset($_POST["courts_forums"])) update_post_meta($post->ID, "courts_forums", $_POST["courts_forums"]);
    if(isset($_POST["civic_affiliations"])) update_post_meta($post->ID, "civic_affiliations", $_POST["civic_affiliations"]);
    if(isset($_POST["honors_awards"])) update_post_meta($post->ID, "honors_awards", $_POST["honors_awards"]);
    if(isset($_POST["custom_title"])) update_post_meta($post->ID, "custom_title", $_POST["custom_title"]);
    if(isset($_POST["custom_body"])) update_post_meta($post->ID, "custom_body", $_POST["custom_body"]);
    if(isset($_POST["recent_exp"])) update_post_meta($post->ID, "recent_exp", $_POST["recent_exp"]);
    if(isset($_POST["recent_speaking"])) update_post_meta($post->ID, "recent_speaking", $_POST["recent_speaking"]);
    if(isset($_POST["areas_practice_hidden"])) update_post_meta($post->ID, "areas_practice_hidden", $_POST["areas_practice_hidden"]);


    if(isset($_POST["areas_practice"])) {
      update_post_meta($post->ID, "areas_practice", $_POST["areas_practice"]);
    } else {
      update_post_meta($post->ID, "areas_practice", '');
    }


    if(isset($_POST["areas_related_practice"])) {
      update_post_meta($post->ID, "areas_related_practice", $_POST["areas_related_practice"]);
    } else {
      update_post_meta($post->ID, "areas_related_practice", '');
    }

    if(isset($_POST["test_input"])) update_post_meta($post->ID, "test_input", $_POST["test_input"]);

    // Custom abbreviated Biography
    $abbr_biography = strip_tags($_POST["biography"]);
    if (strlen($abbr_biography) > 120) {
        $abbr_biography = wordwrap($abbr_biography, 120);
        $abbr_biography = substr($abbr_biography, 0, strpos($abbr_biography, "\n"));
    }
    if(isset($_POST["biography"])) update_post_meta($post->ID, "abbr_biography", $abbr_biography);

  }

/*********************************************************
  Secondary Featured Image
*/

/*
  if (class_exists('MultiPostThumbnails')) {
    new MultiPostThumbnails(array(
      'label' => 'Secondary Image',
      'id' => 'secondary-image',
      'post_type' => 'attorneys'
    ));
  }


*/


?>