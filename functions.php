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

  // if(is_page)
  // elseif(is_post)

  // $my_wp_query = new WP_Query();
  // $all_wp_pages = $my_wp_query->query(array('post_type' => 'page'));

  /*
  $params = array(
    'sort_order' => 'ASC',
    'sort_column' => 'post_title',
    'hierarchical' => 1,
    'child_of' => $page_id,
    'parent' => 0,
  );
  */

  return var_dump(get_page_children(the_id(), $all_wp_pages));
}
add_shortcode('child_list', 'get_child_list');

?>