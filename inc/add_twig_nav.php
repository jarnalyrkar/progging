<?php
/* Registrer menyene som vanlig: */
register_nav_menus(array(
  'headerMenuLocation' => 'Header Menu Location',
  )
);

/* Legg til menyen i det globale scopet til timber  */
function add_nav_to_context( $context ) {
  // Vi instansierer et nytt Timber\Menu objekt
  $context['mainNav'] = new Timber\Menu('headerMenuLocation');
  return $context;
} add_filter( 'timber/context', 'add_nav_to_context' );
