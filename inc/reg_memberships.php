<?php

/*********************************************************
  Register Custom Post Type
*/

  add_action('init', 'memberships_register');
  function memberships_register() {
      $args = array(
          'label' => __('Memberships'),
          'singular_label' => __('Membership'),
          'public' => true,
          'show_ui' => true,
          'capability_type' => 'post',
          'hierarchical' => false,
          'rewrite' => true,
          'supports' => array('title', 'editor', 'thumbnail')
        );
      register_post_type( 'memberships' , $args );
  }

/*********************************************************
  Custom Meta Box
*/

  add_action("admin_init", "admin_init");
  add_action('save_post', 'save_membership_meta');

  function memberships_meta_options(){
    global $post;
    $custom = get_post_custom($post->ID);
    $membership_url = $custom["membership_url"][0];
  ?>

  <table class="form-table">
    <tr>
      <th style="width: 20%;"><label for="membership_url">Membership Website URL</label></th>
      <td>
        <input type="text" class="text_input" name="membership_url" value="<?php echo $membership_url; ?>" style="width:97%" /><br />
        <small>Ex: http://www.google.com/</small>
      </td>
    </tr>
  </table>


  <?php
  }


  function save_membership_meta(){
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return; // Fixes autosave for custom meta

    global $post;
    if(isset($_POST["membership_url"])) update_post_meta($post->ID, "membership_url", $_POST["membership_url"]);
  }




?>