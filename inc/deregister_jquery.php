<?php
// Remove jquery from non-admin pages. Comment out require_once in functions.php if you actually need jquery.
function deregister_jquery(){
  if (!is_admin()) {
    wp_deregister_script('jquery');
  }
}
add_filter( 'wp_enqueue_scripts', 'deregister_jquery', PHP_INT_MAX );