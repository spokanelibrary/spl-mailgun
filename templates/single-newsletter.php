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
    	<h3>
    		<span class="label label-warning" style="display:block;"><?php spl_news_sidebar_headline($post); ?></span>
    	</h3>
    	<div class="panel panel-warning" style="border-left-width:5px;">
    		<div class="panel-body">
			  	<?php spl_news_sidebar_content($post); ?>
			  	<div class="clearfix"></div>
			  </div>
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
