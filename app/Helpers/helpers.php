<?php

function wpPostsByType($type) {
  $query = new \WP_Query(array(
    'post_type' => $type,
    'posts_per_page' => 20,
    'order' => 'ASC',
    'orderby' => 'menu_order',
  ));

  $posts = $query->get_posts();

  return $posts;
}

function wpPostsLimitedNo($type,$no,$orderBy) {
	$args = array(
		'numberposts' => $no,
		'orderby' => $orderBy,
		'order' => 'ASC',
		'post_type' => $type
	);

  $posts = get_posts($args);

  return $posts;
}

function wpSinglePostBySlug($slug,$type) {
  $query = new \WP_Query(array(
    'pagename' => $slug,
    'post_type' => $type
  ));
  //$p = get_post($id);

  $post = $query->get_posts();

  return $post;
}

// Active page highlight
function set_active($uri) {
    return Request::is($uri) ? 'current' : '';
}