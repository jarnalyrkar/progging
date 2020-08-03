<?php
function add_global_assets_to_context($context) {
  $context['site_icon'] = get_site_icon_url();
  $context['site_logo'] = get_stylesheet_directory_uri() . "/assets/img/logo.png";
  $context['magnifier'] = get_stylesheet_directory_uri() . "/assets/img/magnifier.svg";

  return $context;
} add_filter('timber/context', 'add_global_assets_to_context');