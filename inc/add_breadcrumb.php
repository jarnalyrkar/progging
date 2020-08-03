<?php
function breadcrumb() {
  $showOnHome = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = '&gt;'; // delimiter between crumbs
  $home = 'Hjem'; // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
  global $post;
  $homeLink = get_bloginfo('url');

  $output = "";

  if (is_home() || is_front_page()) {
    if ($showOnHome == 1) {
      $output .= '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';
    }
  } else {
      $output .= '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
      if (is_category()) {
          $thisCat = get_category(get_query_var('cat'), false);
          if ($thisCat->parent != 0) {
              $output .= get_category_parents($thisCat->parent, true, ' ' . $delimiter . ' ');
          }
          $output .= $before . '<a href="#">Kategori</a> ' . $delimiter . ' ' . single_cat_title('', false) . $after;
      } elseif (is_search()) {
          $output .= $before . 'Search results for "' . get_search_query() . '"' . $after;
      } elseif (is_day()) {
          $output .= '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
          $output .= '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
          $output .= $before . get_the_time('d') . $after;
      } elseif (is_month()) {
          $output .= '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
          $output .= $before . get_the_time('F') . $after;
      } elseif (is_year()) {
          $output .= $before . get_the_time('Y') . $after;
      } elseif (is_single() && !is_attachment()) {
          if (get_post_type() != 'post') {
              $post_type = get_post_type_object(get_post_type());
              $slug = $post_type->rewrite;
              $output .= '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
              if ($showCurrent == 1) {
                  $output .= ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
              }
          } else {
              $cat = get_the_category();
              $cat = $cat[0];
              $cats = get_category_parents($cat, true, ' ' . $delimiter . ' ');
              if ($showCurrent == 0) {
                  $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
              }
              $output .= $cats;
              if ($showCurrent == 1) {
                  $output .= $before . get_the_title() . $after;
              }
          }
      } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
          $post_type = get_post_type_object(get_post_type());
          $output .= $before . $post_type->labels->singular_name . $after;
      } elseif (is_attachment()) {
          $parent = get_post($post->post_parent);
          $cat = get_the_category($parent->ID);
          $cat = $cat[0];
          $output .= get_category_parents($cat, true, ' ' . $delimiter . ' ');
          $output .= '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
          if ($showCurrent == 1) {
              $output .= ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
          }
      } elseif (is_page() && !$post->post_parent) {
          if ($showCurrent == 1) {
              $output .= $before . get_the_title() . $after;
          }
      } elseif (is_page() && $post->post_parent) {
          $parent_id  = $post->post_parent;
          $breadcrumbs = array();
          while ($parent_id) {
              $page = get_page($parent_id);
              $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
              $parent_id  = $page->post_parent;
          }
          $breadcrumbs = array_reverse($breadcrumbs);
          for ($i = 0; $i < count($breadcrumbs); $i++) {
              $output .= $breadcrumbs[$i];
              if ($i != count($breadcrumbs)-1) {
                  $output .= ' ' . $delimiter . ' ';
              }
          }
          if ($showCurrent == 1) {
              $output .= ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
          }
      } elseif (is_tag()) {
          $output .= $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
      } elseif (is_author()) {
          global $author;
          $userdata = get_userdata($author);
          $output .= $before . 'Articles posted by ' . $userdata->display_name . $after;
      } elseif (is_404()) {
          $output .= $before . 'Error 404' . $after;
      }
      if (get_query_var('paged')) {
          if (is_tax() || is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
              $output .= ' (';
          }
          $output .= __('Side') . ' ' . get_query_var('paged');
          if (is_tax() || is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
              $output .= ')';
          }
      }
      $output .= '</div>';
  }
  return $output;
}