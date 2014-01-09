<div class="page-header">
  <h1>
    Library Newsletter 
    <small>Archive Editions</small>
  </h1>
</div>

<p>
This is some introductory material.
</p>

<?php while (have_posts()) : the_post(); ?>
<article <?php post_class(); ?>>
  <header>
    <h2 class="entry-title">
    	<a href="<?php the_permalink(); ?>">
    		<time class="published" datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_date('F, Y'); ?></time>
    	</a>
    	<small>
    		<?php the_title(); ?>
    	</small>
    </h2>
  </header>
  <div class="entry-summary">
  	<blockquote>
  	  <?php the_excerpt(); ?>
	  </blockquote>
  </div>
</article>
<?php endwhile; ?>