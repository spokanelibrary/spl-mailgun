<?php //get_template_part('templates/content', 'single'); ?>

<?php while (have_posts()) : the_post(); ?>
	<div class="page-header">
    <h1><?php the_title(); ?></h1>
    <?php// get_template_part('templates/entry-meta'); ?>
  </div>

  <div class="row-fluid">
    <div class="col-sm-7">
      <?php the_content(); ?>
    </div>
    <div class="col-sm-5">
    	<h4><?php spl_news_sidebar_headline($post); ?></h4>
    	<div class='panel panel-default' style="border-left-width:5px;">
    		<div class="panel-body">
  	  	<?php spl_news_sidebar_content($post); ?>
	  	  </div>
	    </div>
    </div>
  </div>



  <footer>

  </footer>
  <?php //comments_template('/templates/comments.php'); ?>
<?php endwhile; ?>