<?php
require_once 'add_breadcrumb.php';
require_once 'phone_number_filter.php';

/*
 *  I denne funksjonen legger du til funksjoner og filter som du ønsker
 *  Selve funksjonene som du kaller kan du definere utenfor.
 */
function add_to_twig( $twig ) {
  // Du kan legge til filter
  $twig->addFilter(new Timber\Twig_Filter('phone', 'phone'));

  // Du kan legge til funksjoner:
  $twig->addFunction(new Timber\Twig_Function('breadcrumb', 'breadcrumb'));

  return $twig;
} add_filter( 'timber/twig', 'add_to_twig' );

