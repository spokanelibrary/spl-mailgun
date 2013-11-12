<?php //get_template_part('templates/content', 'single'); ?>

<?php while (have_posts()) : the_post(); ?>
	<?php
	$spl_mail_news['sidebar'] = wpautop(get_post_meta($post->ID
																									, '_spl_mailgun_newsletter_sidebar_content'
																									, true 
																									)
																			);
	?>

  <article <?php post_class(); ?>>
    <header class="page-header">
      <h1><?php the_title(); ?></h1>
      <?php// get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="newsletter-content">
      <?php the_content(); ?>
    </div>
    <aside>
    	<?php echo $spl_mail_news['sidebar']; ?>
    </aside>
    <footer>

    </footer>
    <?php //comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>