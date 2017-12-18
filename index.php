<?php get_header(); ?>

<?php
  /* ***** ***** SUB-MENU ***** ***** */

  if(is_page()){ /* PAGE(exclude media) */

    // Get current page and parent page
    $parent = $post->post_parent;
    $current = get_the_ID();

    getPageSubMenu($parent, $current);

  } elseif(is_single() && !is_attachment()) { /* POST */

    // Get current post category
    $post_categories = get_the_category();
    $post_category_id = $post_categories[0]->cat_ID;

    getPostSubMenu($post_category_id);

  }
?>

<div id="postHeader">

  <?php if(is_search()): /* SEARCH */ ?>
  <h2 id="title">検索: <?php the_search_query(); ?></h2>

  <?php elseif(is_archive()): /* ARCHIVE(AUTHOR, DATE, TAG, CATEGORY) */ ?>
  <h2 id="title"><?php the_archive_title(); ?></h2>

  <?php elseif(!is_home()): ?>
  <h2 id="title"><?php single_post_title(); ?></h2>

  <?php endif; ?>

  <?php if(is_page() || is_single()): /* PAGE or POST */ ?>
  <ul id="postInfo">
    <li>更新日:<span><?php the_time(get_option('date_format')); ?></span></li>
    <li>作者:<span><?php the_author_posts_link(); ?></span></li>

    <?php if(!is_attachment() && !is_page()): /* POST */ ?>
    <li>カテゴリ:<span><?php the_category(', '); ?></span></li>
    <li>タグ:<span><?php the_tags(', '); ?></span></li>
    <?php endif; ?>

  </ul>
  <?php endif; ?>

</div><!-- #postHeader -->

<div id="postContent">
  <ul class="childList">

    <?php if(have_posts()): while (have_posts()): the_post(); ?>
    <li><a href="<?php the_permalink(); ?>">
      <span><?php the_title(); ?></span>
      <div><?php the_excerpt(); ?></div>
    </a></li>
    <?php endwhile; endif; ?>

  </ul>
  <div class="pageNavi">
    <?php previous_posts_link(); ?>
    <?php next_posts_link(); ?>
  </div>
</div><!-- #postContent -->

<div id="postContent">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <?php the_content(); ?>
  <?php endwhile; endif; ?>
  <?php /* <!--nextpage--> */
    $argv = array(
      'before' => '<div class="pageNavi">',
      'after' => '</div>',
      'next_or_number' => 'next',
      'nextpagelink'     => __('Next page'),
      'previouspagelink' => __('Previous page')
    );
    wp_link_pages($argv);
  ?>
</div><!-- #postContent -->

<?php get_footer(); ?>