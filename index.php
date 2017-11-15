<?php get_header(); ?>

<?php if(is_home() || is_archive() || is_search()): /* HOME or ARCHIVE or SEARCH */ ?>

      <?php if(!is_home()): ?>
      <h2 id="postTitle"><?php the_archive_title(); ?></h2>
      <?php endif; ?>

      <?php if(have_posts()): while (have_posts()): the_post(); ?>
      <div id="postHeader">
        <h3 class="postTitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <ul id="postInfo">
          <li>更新日:<span><?php the_time('Y年n月j日'); ?></span></li>
          <li>作者:<span><?php the_author_posts_link(); ?></span></li>
          <li>カテゴリ:<span><?php the_category(', '); ?></span></li>
          <li>タグ:<span><?php the_tags(' '); ?></span></li>
        </ul>
      </div><!-- #postHeader -->
      <div id="postContent">
          <?php the_excerpt(); ?>
      </div><!-- #postContent -->
      <?php endwhile; endif; ?>

<?php else: /* POST or PAGE */ ?>

      <?php if(have_posts()): while (have_posts()): the_post(); ?>
      <div id="postHeader">
        <h2 id="title"><?php single_post_title(); ?></h2>

        <?php if(!is_page()): ?>
        <ul id="postInfo">
          <li>更新日:<span><?php the_time('Y年n月j日'); ?></span></li>
          <li>作者:<span><?php the_author_posts_link(); ?></span></li>
          <li>カテゴリ:<span><?php the_category(', '); ?></span></li>
          <li>タグ:<span><?php the_tags(' '); ?></span></li>
        </ul>
        <?php endif; ?>

      </div><!-- #postHeader -->
      <div id="postContent">
          <?php the_content(); ?>
          <?php
          $argv = array(
            'before' => '<p class="nextPage">',
            'after' => '</p>',
            'next_or_number' => 'next',
            'nextpagelink' => '次のページ',
            'previouspagelink' => '前のページ',
            'pagelink' => 'ページ: %'
          );
          wp_link_pages();
          ?>
      </div><!-- #postContent -->
      <?php endwhile; endif; ?>

<?php endif; ?>

<?php get_footer(); ?>