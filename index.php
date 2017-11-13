<?php get_header(); ?>
      <div id="postHeader">
        <h2 id="title"><?php single_post_title(); ?></h2>
        <ul id="postInfo">
          <li>更新日:<span>{$date}</span></li>
          <li>作者:<span>{$author}</span></li>
          <li>カテゴリ:<span>{$category}</span></li>
          <li>タグ:<span>{$tag}</span></li>
        </ul>
      </div><!-- #postHeader -->
      <div id="postContent">
        <?php if(have_posts()): while (have_posts()): the_post(); ?>
          <?php the_content(); ?>
        <?php endwhile; else: ?>
          <p><?php _e('No such post/page.'); ?></p>
        <?php endif; ?>
      </div><!-- #postContent -->
<?php get_footer(); ?>