<?php //get_template_part('templates/content', 'single'); ?>

<?php while (have_posts()) : the_post(); ?>
	<div class="page-header">
    <h1><?php the_title(); ?></h1>
    <?php// get_template_part('templates/entry-meta'); ?>
  </div>

  <div class="row-fluid">
    <div class="col-sm-8">
      <?php the_content(); ?>
    </div>
    <div class="col-sm-4">
    	<h4 class="text-warning"><?php spl_news_sidebar_headline($post); ?></h4>
    	<div style="border-left: 5px solid #ccc;">
  	  	<?php spl_news_sidebar_content($post); ?>
	  	</div>
    </div>
  </div>

  <div class="row-fluid">
		<div class="col-sm-4">
			<?php spl_news_post_select($post, 1); ?>
		</div>
		<div class="col-sm-4">
			<?php spl_news_post_select($post, 2); ?>
		</div>
		<div class="col-sm-4">
			<?php spl_news_post_select($post, 3); ?>
		</div>
	</div>

  <footer>

  </footer>
  <?php //comments_template('/templates/comments.php'); ?>

<?php endwhile; ?>
