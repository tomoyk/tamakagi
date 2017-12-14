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
      <span class="backPageNavi"><?php previous_posts_link(); ?></span>
      <span class="nextPageNavi"><?php next_posts_link(); ?></span>
    </div>
    <style>
      div.pageNavi {
        position: relative;
      }
      div.pageNavi > span {
        position: absolute;
        bottom: 0;
        display: inline-block;
      }
      div.pageNavi > span.backPageNavi {
        left: 0;
      }
      div.pageNavi > span.nextPageNavi {
        right: 0;
      }
    </style>
  </div><!-- #postContent -->

<?php else: /* POST or PAGE */ ?>

  <?php if(have_posts()): while (have_posts()): the_post(); ?>

    <?php if(is_page() && !is_attachment()): /* PAGE(exclude media) */ ?>
    <ul class="childList"></ul>
    <?php endif; ?>

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
      <?php the_content(); ?>
      <?php /* <!-- nextpage --> */
      $argv = array(
        'before' => '<p class="nextPage">',
        'after' => '</p>',
        'next_or_number' => 'next',
        'nextpagelink' => '次のページ',
        'previouspagelink' => '前のページ',
        'pagelink' => 'ページ: %'
      );
      wp_link_pages($argv);
      ?>
    </div><!-- #postContent -->

  <?php endwhile; endif; ?>

<?php endif; ?>

<?php get_footer(); ?>