<?php //get_template_part('templates/content', 'single'); ?>
<div class="spl-news">
<?php while (have_posts()) : the_post(); ?>
	<div class="page-header">
    <h1>
    	<small>From the News Desk at Spokane Public Library:</small>
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
    			<div class="page-header">
			      <h1 class="page-header">
	    				<small><?php the_title(); ?></small>
	    			</h1>
	    		</div>
		      <?php the_content(); ?>
      	</div>
    		<p class="lead text-center text-muted">
	      	<i class="glyphicon glyphicon-leaf"></i>
	      </p>
    	</div>
    </div><!-- /.col -->
    <div class="col-sm-4">
			<p class="lead text-center">	
				<span class="label label-warning"><?php spl_news_sidebar_headline($post); ?></span>
			</p>
			<aside class="aside">
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
