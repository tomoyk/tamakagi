<?php

/*
 * Enbale widget
 * * * * * * * * * * * * * * * * * * * * * * */
function left_widgets_init() {
  register_sidebar(array(
    'name' => 'Site Left Sidebar',
    'id' => 'site_left',
    'before_widget' => '<div class="container widget">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgetTitle">',
    'after_title' => '</h4>',
  ));
}
add_action( 'widgets_init', 'left_widgets_init' );

/*
 * Enbale short-tag
 * * * * * * * * * * * * * * * * * * * * * * */
function get_child_list($argv) {
  $page_id = $wp_query->post->ID;
  // wp_list_pages('title_li=&child_of='.$id);

  /*
  $params = array(
    'sort_order' => 'ASC',
    'sort_column' => 'post_title',
    'hierarchical' => 1,
    'child_of' => $page_id,
    'parent' => 0,
  );
  */

  // return var_dump(get_pages($params));

  // get new objects
  $my_wp_query = new WP_Query();
  $all_wp_pages = $my_wp_query->query( array(
      'post_type' => 'page',
      'nopaging'  => 'true'
  ));

  return get_page_children($page_id, $all_wp_pages);

  // return 'this is child_list';
}
add_shortcode('child_list', 'get_child_list');

?>