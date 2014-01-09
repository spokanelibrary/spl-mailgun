<?php //get_template_part('templates/page', 'header'); ?>
<?php //get_template_part('templates/content', 'single'); ?>

<div class="spl-news" style="margin-top: 0px;">
<?php while (have_posts()) : the_post(); ?>
<?php
  /*
  $settings = get_option( 'spl-mailgun-newsletter' );
  print_r($settings);
  */
  //print_r($post);
  
  $meta = SPL_Mailgun_Newsletter::getNewsletterMetadata( $post );
  /*
  echo '<pre>';
  print_r( $meta );
  echo '</pre>';
  */
?>

<div class="page-header">
  <h1>
    Library News
  </h1>
  <?php// get_template_part('templates/entry-meta'); ?>
</div>

<!--
	<div class="page-header">
    <h1>
    	News &amp; new ideas
    	<small>from your local Library</small>
    </h1>
    <?php// get_template_part('templates/entry-meta'); ?>
  </div>
-->
  
	<div class="panel panel-default" style="border-left-width:5px;">
		<div class="panel-heading">
			<span class="pull-right">
				<i class="glyphicon glyphicon-envelope text-primary"></i>
				<a href="/subscribe">Subscribe</a>
			</span>
			<span class="text-muted">
				<i class="glyphicon glyphicon-send"></i>
				<strong><?php the_date(); ?></strong>
			</span>
		</div><!-- /.panel-heading -->
		<div class="panel-body">

      <h3 class="page-header text-success">
				<?php the_title(); ?>
			</h3>
      
      <div class="row">
        <div class="col-sm-8">

          <?php if ( isset($meta->callout) && isset($meta->callout['content']) ) :  ?>
          <!-- sidebar callout -->
          <div class="pull-right" style="width:240px; margin-top:40px;">
            <div class="panel panel-warning">
              <div class="panel-body text-primary">
                <div style="font-style:italic;">
                <?php echo $meta->callout['content']; ?>
                </div>
                <?php if ( isset($meta->callout['attrib']) ) :  ?>
                <span class="help-block">&mdash;<?php echo $meta->callout['attrib']; ?></span>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php endif; ?>

          <?php the_content(); ?>
          <p class="lead text-center text-muted">
            &hellip;
            <i class="glyphicon glyphicon-leaf" style="padding: 0 8px 0 12px;"></i>
            &hellip;
          </p>
        </div><!-- /.col -->
        <div class="col-sm-4">
          
          <?php if ( isset($meta->sidebar) ) :  ?>
            <!-- sidebar -->
            <?php if ( isset($meta->sidebar['headline']) ) :  ?>
            <h3 class="text-primary">
              <?php echo $meta->sidebar['headline']; ?>
            </h3>
            <?php endif; ?>
            <?php if ( isset($meta->sidebar['content']) ) :  ?>
            <aside class="aside">
              <?php echo $meta->sidebar['content']; ?>
              <hr />
            </aside>
            <?php endif; ?>
          <?php endif; ?>
        </div><!-- /.col -->
      </div><!-- /.row -->

      <?php if ( isset($meta->posts) ) :  ?>
      <div class="row">
        <div class="col-sm-4 spl-news-post">
          <?php echo SPL_Mailgun_Newsletter::getPostSelectFormatted($meta->posts[1]); ?>
        </div><!-- /.col -->
        <div class="col-sm-4 spl-news-post">
          <?php echo SPL_Mailgun_Newsletter::getPostSelectFormatted($meta->posts[2]); ?>
        </div><!-- /.col -->
        <div class="col-sm-4 spl-news-post">
          <?php echo SPL_Mailgun_Newsletter::getPostSelectFormatted($meta->posts[3]); ?>
        </div><!-- /.col -->
      </div><!-- /.row -->
      <div class="row">
        <div class="col-sm-4 spl-news-post">
          <?php echo SPL_Mailgun_Newsletter::getPostSelectFormatted($meta->posts[4]); ?>
        </div><!-- /.col -->
        <div class="col-sm-4 spl-news-post">
          <?php echo SPL_Mailgun_Newsletter::getPostSelectFormatted($meta->posts[5]); ?>
        </div><!-- /.col -->
        <div class="col-sm-4 spl-news-post">
          <?php echo SPL_Mailgun_Newsletter::getPostSelectFormatted($meta->posts[6]); ?>
        </div><!-- /.col -->
      </div><!-- /.row -->
      <div class="row">
        <div class="col-sm-4 spl-news-post">
          <?php echo SPL_Mailgun_Newsletter::getPostSelectFormatted($meta->posts[7]); ?>
        </div><!-- /.col -->
        <div class="col-sm-4 spl-news-post">
          <?php echo SPL_Mailgun_Newsletter::getPostSelectFormatted($meta->posts[8]); ?>
        </div><!-- /.col -->
        <div class="col-sm-4 spl-news-post">
          <?php echo SPL_Mailgun_Newsletter::getPostSelectFormatted($meta->posts[9]); ?>
        </div><!-- /.col -->
      </div><!-- /.row -->
      <div class="row">
        <div class="col-sm-4 spl-news-post">
          <?php echo SPL_Mailgun_Newsletter::getPostSelectFormatted($meta->posts[10]); ?>
        </div><!-- /.col -->
        <div class="col-sm-4 spl-news-post">
          <?php echo SPL_Mailgun_Newsletter::getPostSelectFormatted($meta->posts[11]); ?>
        </div><!-- /.col -->
        <div class="col-sm-4 spl-news-post">
          <?php echo SPL_Mailgun_Newsletter::getPostSelectFormatted($meta->posts[12]); ?>
        </div><!-- /.col -->
      </div><!-- /.row -->
      <?php endif; ?>

  	</div><!-- /.panel-body -->

    <div class="panel-footer">
    </div><!-- /.panel-footer -->

	</div><!-- /.panel -->





  


  

  <footer>

  </footer>
  <?php //comments_template('/templates/comments.php'); ?>

<?php endwhile; ?>
</div>
