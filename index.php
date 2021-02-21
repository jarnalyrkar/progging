<?php
$context = Timber::context();
$context['post'] = new Timber\Post();
$context['nextPage'] = null;
$context['prevPage'] = null;

$pages = get_pages(['sort_column' => 'menu_order', 'hierarchical' => true]);
for ($i = 0; $i < count($pages); $i++) {
  if ($pages[$i]->ID === $context['post']->ID) {
    $context['nextPage'] = new Timber\Post($pages[$i+1]);
    if (isset($pages[$i-1])) {
      $context['prevPage'] = new Timber\Post($pages[$i-1]);
    }
  }
}

$context['pages'] = $pages;

Timber::render('pages/index.twig', $context);