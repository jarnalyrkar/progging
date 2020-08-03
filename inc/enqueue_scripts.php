<?php
/* CSS og JS */
function enqueue_files($path) {
  return new DirectoryIterator(get_stylesheet_directory() . $path);
}

function add_my_scripts() {
  $cssDir = enqueue_files('/dist/css');
  foreach ($cssDir as $cssfile) {
    if (pathinfo($cssfile, PATHINFO_EXTENSION) === 'css') {
      $fullName = basename($cssfile);    // main.3hZ9.js
      $name = substr(basename($fullName), 0, strpos(basename($fullName), '.')); //
      // echo $name;
      wp_enqueue_style(
        $fullName,
        get_template_directory_uri() . '/dist/css/' . $fullName,
        null,
        null,
        false
      );
      // wp_enqueue_style('main-styles', $name , null,  false, false);
    }

  }

  $jsDir = enqueue_files('/dist/js');
  foreach ($jsDir as $jsfile) {
    if (pathinfo($jsfile, PATHINFO_EXTENSION) === 'js') {
      $fullName = basename($jsfile);    // main.3hZ9.js
      $name = substr(basename($fullName), 0, strpos(basename($fullName), '.')); //
      wp_enqueue_script(
        $fullName,
        get_template_directory_uri() . '/dist/js/' . $fullName,
        array(),
        null,
        true
      );
      // wp_enqueue_style('main-styles', $name , null,  false, false);
    }

  }

  // $css = get_template_directory_uri() . '/style.css';
  // $script = get_template_directory_uri() . '/assets/js/scripts-bundled.js';
  // wp_enqueue_style('typekit', 'https://use.typekit.net/gsp0zqy.css', null, '1.0.0', false);
  // wp_enqueue_style('typekit', 'https://use.typekit.net/pln3dhd.css', null, '1.0.0', false);
  // wp_enqueue_style('main-styles', $css , null,  null, false);
  // wp_enqueue_script('main-scripts', $script, array(), null, true);
} add_action('wp_enqueue_scripts', 'add_my_scripts');
