<?php
/* Used by WooCommerce, the rest of the site uses base.twig to find header */
$context = Timber::context();
$context['post'] = new Timber\Post();

Timber::render('partials/header.twig', $context);