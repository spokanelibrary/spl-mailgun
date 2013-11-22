<?php //get_template_part('templates/content', 'single'); ?>

<?php
	/*
	$settings = get_option( 'spl-mailgun-newsletter' );
	print_r($settings);
	*/
?>

<div class="spl-news">
<?php while (have_posts()) : the_post(); ?>
	<div class="page-header">
    <h1>
    	News
    	<small>from the Library</small>
    </h1>
    <?php// get_template_part('templates/entry-meta'); ?>
  </div>

  <div class="row">
    <div class="col-sm-8">
    	<div class="panel panel-default" style="border-left-width:5px;">
    		<div class="panel-heading">
    			<span class="pull-right">
    				<i class="glyphicon glyphicon-envelope text-primary"></i>
    				<a href="#">Subscribe</a>
    			</span>
    			<span class="text-muted">
    				<i class="glyphicon glyphicon-send"></i>
    				<strong><?php the_date(); ?></strong>
    			</span>
    		</div>
    		<div class="panel-body">
		      <h3 class="page-header text-success">
    				<?php the_title(); ?>
    			</h3>
		      <?php the_content(); ?>
      	</div>
    		<p class="lead text-center text-muted">
    			&hellip;
	      	<i class="glyphicon glyphicon-leaf" style="padding: 0 8px 0 12px;"></i>
	      	&hellip;
	      </p>
    	</div>
    </div><!-- /.col -->
    <div class="col-sm-4">
      <blockquote>
        <?php spl_news_sidebar_callout($post); ?>
      </blockquote>
    	<h3 class="text-primary">
    		<?php spl_news_sidebar_headline($post); ?>
			</h3>
			<aside class="aside">
		  	<?php spl_news_sidebar_content($post); ?>
		  	<hr />
		  </aside>
    </div><!-- /.col -->
  </div><!-- /.row -->

  <div class="row">
		<div class="col-sm-4 spl-news-post">
			<?php spl_news_post_select($post, 1); ?>
			<hr />
		</div><!-- /.col -->
		<div class="col-sm-4 spl-news-post">
			<?php spl_news_post_select($post, 2); ?>
			<hr />
		</div><!-- /.col -->
		<div class="col-sm-4 spl-news-post">
			<?php spl_news_post_select($post, 3); ?>
			<hr />
		</div><!-- /.col -->
	</div><!-- /.row -->

  <footer>

  </footer>
  <?php //comments_template('/templates/comments.php'); ?>

<?php endwhile; ?>
</div>
