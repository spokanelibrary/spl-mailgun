<?php //get_template_part('templates/content', 'single'); ?>

This is a custom template!

<?php while (have_posts()) : the_post(); ?>
      <h1 class=""><?php the_title(); ?></h1>
      <?php// get_template_part('templates/entry-meta'); ?>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    <footer>
      <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
<?php endwhile; ?>