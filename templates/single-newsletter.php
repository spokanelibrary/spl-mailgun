<?php //get_template_part('templates/content', 'single'); ?>

<?php while (have_posts()) : the_post(); ?>

  <article <?php post_class(); ?>>
    <header class="page-header">
      <h1><?php the_title(); ?></h1>
      <?php// get_template_part('templates/entry-meta'); ?>
    </header>

    <div class="row-fluid">
	    <div class="col-sm-8">
	      <?php the_content(); ?>
	    </div>
	    <div class="col-sm-4">
	    	<div class='well well-sm'>
	  	  	<h3><?php spl_news_sidebar_headline($post); ?></h3>
		    	<?php spl_news_sidebar_content($post); ?>
		    </div>
	    </div>
	  </div>



    <footer>

    </footer>
    <?php //comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>