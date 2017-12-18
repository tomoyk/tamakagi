<?php

/*
 * Enable widget
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
 * Enable short-tag
 * * * * * * * * * * * * * * * * * * * * * * */
function get_child_list($argv) {

  // Check page
  if(!is_page()) {
    return "エラー: このショートタグは固定ページでのみ動作します。";
  }

  // Create query
  $my_wp_query = new WP_Query();
  $all_wp_pages = $my_wp_query->query(array(
    'post_type' => 'page',
    'nopaging'  => 'false'
  ));

  // Get array of child-page
  $child_pages = get_page_children( get_the_ID(), $all_wp_pages );

  // Not found child-pages
  if(count($child_pages)<1){
    return;
  }

  // Debug::
  // echo "<pre>".var_dump($child_pages)."</pre>";

  // Build list-html
  $child_pages_html = '<ul class="childList">';

  foreach($child_pages as $child_page){

    // Get data of child-page
    $child_page_id = $child_page->ID;
    $child_page_data = get_post($child_page_id);
    $child_page_title = $child_page_data->post_title;
    $child_page_raw_content = $child_page_data->post_content;

    // Modified HTML(remove html-tag and get substring of 55 characters)
    $child_page_content = mb_substr(wp_strip_all_tags($child_page_raw_content, true), 0, 55);
    $child_page_url = $child_page_data->guid;

    // Build list-html
    $child_pages_html .= <<< EOF
      <li><a href="$child_page_url">
        <span>$child_page_title</span>
        <div>$child_page_content</div>
      </a></li>
EOF;

  } // end of foreach

  // Callback list-html
  return "$child_pages_html</ul>";

} // end of get_child_list()

add_shortcode('child_list', 'get_child_list');

/*
 * Enable theme-customizer(footer-text)
 * * * * * * * * * * * * * * * * * * * * * * */
function theme_customize_register($wp_custom){

  // section
  $wp_custom->add_section('tamakagi_original_scheme', array(
    'title' => 'Footer Text',
    'priority' => 200,
  ));

  // settings
  $wp_custom->add_setting('tamakagi_options', array(
    'default'   => 'Copyright ...',
    'type'      => 'option',
    'transport' => 'postMessage',
  ));

  $wp_custom->add_control('tamakagi_options_origin_text', array(
    'settings'  => 'tamakagi_options', // settings
    'label'     => 'フッターテキスト',
    'section'   => 'tamakagi_original_scheme', // section
    'type'      => 'textarea', // Form type(text,checkbox...)
  ));

}

add_action('customize_register', 'theme_customize_register');

?>