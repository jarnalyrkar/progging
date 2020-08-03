<?php
$context = Timber::get_context();

$context['search_query'] = get_search_query();
$context['posts'] = new Timber\PostQuery();
$context['pagination'] = Timber::get_pagination();

Timber::render('pages/search.twig', $context);