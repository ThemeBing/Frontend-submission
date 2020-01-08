<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://ThemeBeyond.com
 * @since             1.0.0
 * @package           Frontend_Submission
 *
 * @wordpress-plugin
 * Plugin Name:       Frontend Submission
 * Plugin URI:        https://ThemeBeyond.com/mega-addons-for-elementor
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            ThemeBeyond
 * Author URI:        https://ThemeBeyond.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       makplus
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

get_header(); ?>
<?php 
if(isset($_POST['new_post']) == '1') {
    $post_title = $_POST['post_title'];
    $post_category = $_POST['product_cat'];
    $post_content = $_POST['post_content'];

    $new_post = array(
          'post_type' => 'product',
          'ID' => '',
          'post_author' => $user->ID, 
          'post_category' => array($post_category),
          'post_content' => $post_content, 
          'post_title' => $post_title,
          'post_status' => 'draft'
        );

    $post_id = wp_insert_post($new_post);

    // This will redirect you to the newly created post
    $post = get_post($post_id);
    wp_redirect($post->guid);
}      
?>      
<div class="container pt-5 pb-5">
	<form method="post" action=""> 
	    <input type="text" name="post_title" size="45" id="input-title"/>
	    <?php wp_dropdown_categories('orderby=name&hide_empty=0&exclude=1&hierarchical=1'); ?>
	    <textarea rows="5" name="post_content" cols="66" id="text-desc"></textarea> 
	    <input type="hidden" name="new_post" value="1"/> 
	    <input class="subput round" type="submit" name="submit" value="Post"/>
	</form>
</div>
<?php get_footer();