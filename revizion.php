<?php
/*
Plugin Name: Revizion
Plugin URI:  https://wordpress.org/plugins/revizion
Description: Revizion allows visitors of a Wordpress site to explore past versions of a post and compare different versions of a post dynamically, directly from the post's page.
Version:     0.2
Author:      Willem Browne
Author URI:  https://github.com/Willooz/revizion
License:     GNUGPLv3
License URI: http://www.gnu.org/licenses/gpl.html
*/

// DEBUG
// echo '<pre>'; print_r($var); echo '</pre>';

// REPLACE POST CONTENT by TAG with REVISIONS DATA
function rvzn_load_revisions( $content ) {
  // 1. Get post revisions
  global $post;
  $id = $post->ID;
  $revisions = wp_get_post_revisions( $id );
  // 2. Make a clean json from revisions array
  $json_revisions = htmlspecialchars( wp_json_encode( $revisions ), ENT_QUOTES, 'UTF-8');
  // 3. Replace post content by tag with post revisions data
  $content = sprintf("<app jrevisions='%s'></app>", $json_revisions);
  return $content;
}
add_filter('the_content', 'rvzn_load_revisions');

// INCLUDE JS THAT MOUNTS PLUGIN ON TAG with REVISIONS DATA
function rvzn_enqueue_scripts($hook) {
  // 1. Text diffing functions
  wp_enqueue_script( 'diff_match_patch', plugins_url( 'dist/diff_match_patch.js', __FILE__ ));
  // 2. Vue.js pluging that hooks to APP TAG
  wp_enqueue_script( 'revizion', plugins_url( 'dist/build.js', __FILE__ ));
}
add_action('wp_enqueue_scripts', 'rvzn_enqueue_scripts');
