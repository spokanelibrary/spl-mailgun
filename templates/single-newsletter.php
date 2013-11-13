<?php //get_template_part('templates/content', 'single'); ?>
<div class="spl-news">
<?php while (have_posts()) : the_post(); ?>
	<div class="page-header">
    <h1>
    	<i class="glyphicon glyphicon-send"></i>
    	<small>on this day</small>
    </h1>
    <?php// get_template_part('templates/entry-meta'); ?>
  </div>

  <div class="row">
    <div class="col-sm-8">
    	<div class="panel panel-default" style="border-left-width:5px;">
    		<div class="panel-heading">
    			<span class="pull-right">Published:</span>
    			<h3>
    				<i class="glyphicon glyphicon-list text-muted"></i>
    				<?php the_title(); ?>
    			</h3>
    		</div>
    		<div class="panel-body">
		      <?php the_content(); ?>
      	</div>
    	</div>
    </div><!-- /.col -->
    <div class="col-sm-4">
    	<aside class="aside">
  			<h3>
  			<span class="label label-warning" style="display:block;"><?php spl_news_sidebar_headline($post); ?></span>
  			</h3>
		  	<?php spl_news_sidebar_content($post); ?>
		  	<div class="clearfix"></div>
		  </aside>
    </div><!-- /.col -->
  </div><!-- /.row -->

  <div class="row">
		<div class="col-sm-4">
			<?php spl_news_post_select($post, 1); ?>
			<hr />
		</div><!-- /.col -->
		<div class="col-sm-4">
			<?php spl_news_post_select($post, 2); ?>
			<hr />
		</div><!-- /.col -->
		<div class="col-sm-4">
			<?php spl_news_post_select($post, 3); ?>
			<hr />
		</div><!-- /.col -->
	</div><!-- /.row -->

  <footer>

  </footer>
  <?php //comments_template('/templates/comments.php'); ?>

<?php endwhile; ?>
</div>
