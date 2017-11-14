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
    'before_title' => '<h4>',
    'after_title' => '</h4>',
  ));
}
add_action( 'widgets_init', 'left_widgets_init' );

/*
 * Get Post-type in Japanese
 * * * * * * * * * * * * * * * * * * * * * * */
function getPageType(){
  if(is_category()){    return "カテゴリ";}
  else if(is_tag()){    return "タグ";}
  else if(is_author()){ return "作者";}
  else if(is_date()){   return "日付";}
  else if(is_search()){ return "検索";}
}

/*
 * Get parameters
 * * * * * * * * * * * * * * * * * * * * * * */
function getPageText(){
  if(is_search()){
    the_search_query();

  }else if(is_category() || is_tag()){
    single_cat_title();

  }else if(is_author()){
    the_author();

  }else if(is_date()){
    if(is_year()){  get_query_var('year');}
    if(is_month()){ get_query_var('monthnum');}
    if(is_day()){   get_query_var('day');}
  }
}

?>