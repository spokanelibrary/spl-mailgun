<?php //get_template_part('templates/content', 'single'); ?>

<?php while (have_posts()) : the_post(); ?>

  <article <?php post_class(); ?>>
    <header class="page-header">
      <h1><?php the_title(); ?></h1>
      <?php// get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="newsletter-content">
      <?php the_content(); ?>
    </div>
    <aside>
    	<h2><?php spl_news_sidebar_headline($post); ?></h2>
    	<?php spl_news_sidebar_content($post); ?>
    </aside>
    <footer>

    </footer>
    <?php //comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>