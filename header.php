<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title><?php echo wp_get_document_title(); ?></title>
  <meta name="description" content="<?php bloginfo('description'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{$uri_base}image/ts.ico" rel="shortcut icon" />
  <link rel="stylesheet" type="text/css" media="all" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.css">
  <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>">
</head>
<body>
<?php if(is_admin_bar_showing()): ?>
<style>
div#container {
  margin-top: 60px;
}
</style>
<?php endif; ?>
<div id="container">
  <div id="side-left">
    <input type="checkbox" id="menuStatus" class="actionItems">
    <div class="container title">
      <h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
      <p><?php bloginfo('description'); ?></p>
      <label for="menuStatus" class="btn">メニュー</label>
    </div>
    <div class="container menu">
      <?php
      $argv = array(
        'menu'            => '',
        'menu_class'      => 'menu',
        'menu_id'         => 'menu-1',
        'container'       => 'div',
        'container_class' => 'menu-container',
        'container_id'    => '',
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'echo'            => true,
        'depth'           => 2,
        'walker'          => '',
        'theme_location'  => '',
        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
      );
      wp_nav_menu($argv);
      ?>
    </div>
    <div class="container search">
      <?php get_search_form(); ?>
    </div>
    <?php dynamic_sidebar('site_left'); ?>
  </div><!-- #side-left -->
  <div id="side-right">
    <div class="container">