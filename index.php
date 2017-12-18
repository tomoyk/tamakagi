<?php get_header(); ?>

<?php if(is_home() || is_archive() || is_search()): /* HOME or ARCHIVE or SEARCH */ ?>

  <div id="postHeader">
    <?php if(is_search()): /* SEARCH */ ?>
    <h2 id="title">検索: <?php the_search_query(); ?></h2>

    <?php elseif(!is_home()): /* ARCHIVE(AUTHOR, DATE, TAG, CATEGORY) */ ?>
    <h2 id="title"><?php the_archive_title(); ?></h2>

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

<?php else: /* POST or PAGE */

  /* ***** ***** SUB-MENU ***** ***** */

  if(is_page() && !is_attachment()){ /* PAGE(exclude media) */

    // Get current page and parent page
    $parent_page_id = $post->post_parent;
    $current_page_id = get_the_ID();

    // In the case of defined parent page
    if($parent_page_id > 0){

      echo '<ul class="childList">';

      // Create query
      $my_wp_query = new WP_Query();
      $all_wp_pages = $my_wp_query->query(array(
        'post_type' => 'page',
        'nopaging'  => 'false'
      ));

      // Get array of same-level-page
      $same_level_pages = get_page_children( $parent_page_id, $all_wp_pages );

      foreach($same_level_pages as $same_level_page){

        // Get data of same-level-page
        $same_level_page_id = $same_level_page->ID;
        $same_level_page_data = get_post($same_level_page_id);

        // Get same-level page
        $same_level_page_title = $same_level_page_data->post_title;
        $same_level_page_url = $same_level_page_data->guid;

        if($same_level_page_id == $current_page_id){
          echo '<li class="current-page">';
        }else{
          echo '<li>';
        }

        echo "<a href=\"$same_level_page_url\">$same_level_page_title</a></li>";

      } // end of foreach

      echo "</ul>";

    } // end of if($parent_page > 0)

  } elseif(is_single() && !is_attachment()) { /* POST */

    $post_categories = get_the_category();
    $post_category_id = $post_categories[0]->cat_ID;
    $posts = get_posts("category=${post_category_id}&showposts=10");

    if($posts){

      echo '<ul class="childList">';

      foreach($posts as $post){
        setup_postdata($post);
        $post_title = mb_substr(get_the_title(), 0, 10);
        $post_link = get_permalink();
        echo "<li><a href=\"$post_link\">$post_title</a></li>";
      }

      echo '</ul>';

    } // end of if($posts)

  }

?>

<div id="postHeader">
  <h2 id="title"><?php single_post_title(); ?></h2>
  <ul id="postInfo">
    <li>更新日:<span><?php the_time(get_option('date_format')); ?></span></li>
    <li>作者:<span><?php the_author_posts_link(); ?></span></li>

    <?php if(!is_attachment() && !is_page()): /* POST */ ?>
    <li>カテゴリ:<span><?php the_category(', '); ?></span></li>
    <li>タグ:<span><?php the_tags(', '); ?></span></li>
    <?php endif; ?>

  </ul>
</div><!-- #postHeader -->
<div id="postContent">
  <?php if(have_posts()): while (have_posts()): the_post(); ?>
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

<?php endif; ?>

<?php get_footer(); ?>