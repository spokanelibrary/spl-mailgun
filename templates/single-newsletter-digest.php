<?php //get_template_part('templates/page', 'header'); ?>
<?php //get_template_part('templates/content', 'single'); ?>
<div class="row">
<div class="col-lg-10 col-lg-offset-1">
<div class="spl-news spl-news-digest  " style="margin-top: 0px;">

<!--
	<div class="page-header">
    <h1>
    	News &amp; new ideas
    	<small>from your local Library</small>
    </h1>
    <?php// get_template_part('templates/entry-meta'); ?>
  </div>
-->
  
  
	<div class="panel spl-hero-intranet spl-hero-brand-blue-e" style="">
		
    <div class="panel-heading">
	   <!--
  		<div class="text-right">
			    <i class="glyphicon glyphicon-envelope text-primary"></i>
				  <a href="/subscribe">Subscribe</a>
      </div>
      -->
      <h3 style="margin-top:8px;">
        
        Library News 
        <?php if ( isset($meta->subtitle) && !empty($meta->subtitle) ) : ?>
        <small class="uppercase">
        <?php echo($meta->subtitle); ?>
        </small>
        <?php endif; ?>
      </h3>
      <?php// get_template_part('templates/entry-meta'); ?>

      <!--
      <span class="text-muted">
				<i class="glyphicon glyphicon-send"></i>
				<strong><?php  the_time('F, Y'); ?></strong>
			</span>
      -->
    </div>
		
    <div class="panel-body">
    
      <!--
      <div class="row">
        <div class="col-sm-12">
          <div style="border-bottom: 0px solid #ccc;">
            <h2 class="page-header text-success serif">
              <?php the_title(); ?>
            </h2>
          </div>
        </div>
      </div>
      -->

      <div class="row">
        <div class="<?php if ( isset($meta->sidebar) || isset($meta->callout) ) : ?>col-md-8<?php else: ?>col-lg-8<?php endif; ?>">

          <article class="article">

          <h1 style="margin-top:0;" class="text-success"><?php the_title(); ?></h1>

          <?php the_content(); ?>
          </article>

          <!--
          <p class="lead text-center text-muted">
            &hellip;
            <i class="glyphicon glyphicon-leaf" style="padding: 0 8px 0 12px;"></i>
            &hellip;
          </p>
          -->


          <?php if ( isset($meta->posts) ) :  ?>
          <div class="row">
            <div class="col-sm-12 post">
              <?php echo SPL_Mailgun_Newsletter::getPostSelectFormatted($meta->posts[1]); ?>
            </div><!-- /.col -->
            <div class="col-sm-12 post">
              <?php echo SPL_Mailgun_Newsletter::getPostSelectFormatted($meta->posts[2]); ?>
            </div><!-- /.col -->
            <div class="col-sm-12 post">
              <?php echo SPL_Mailgun_Newsletter::getPostSelectFormatted($meta->posts[3]); ?>
            </div><!-- /.col -->
            <div class="col-sm-12 post">
              <?php echo SPL_Mailgun_Newsletter::getPostSelectFormatted($meta->posts[4]); ?>
            </div><!-- /.col -->
          </div><!-- /.row -->
          <?php endif; ?>


        </div><!-- /.col -->
        <div class="col-md-4">
          <!--
          <p>
            <a class="btn btn-success btn-block" href="/subscribe/"><i class="glyphicon glyphicon-envelope"></i>
Subscribe to Libray News &rarr;</a>
          </p>
          -->
          <!--
          <p style="text-align: center;">
            <a href="https://epay.spokanelibrary.org/eCommerceWebModule/Home"><img class="aligncenter img-responsive" alt="Pay Fines" src="http://news.spokanelibrary.org/wordpress/media/Pay_fines-160x120.jpg" ></a>
          </p>
          -->

          <?php if ( isset($meta->callout) && isset($meta->callout['content']) ) :  ?>
          <!-- sidebar callout -->
            <div class="alert alert-warning">
              <div class="" style="font-style:italic;">
              <?php echo $meta->callout['content']; ?>
              </div>
              <?php if ( isset($meta->callout['attrib']) ) :  ?>
              <span class="help-block">&mdash;<?php echo $meta->callout['attrib']; ?></span>
              <?php endif; ?>
            </div>
          <?php endif; ?>

          <?php if ( isset($meta->sidebar) ) :  ?>
            <div class="panel panel-primary">
            <!-- sidebar -->
            <?php if ( isset($meta->sidebar['headline']) ) :  ?>
            <div class="panel-heading">
              <h4 class="panel-title text-center">
                <?php echo $meta->sidebar['headline']; ?>
              </h4>
            </div><!-- /.panel-heading -->  
            <?php endif; ?>
            <?php if ( isset($meta->sidebar['content']) ) :  ?>
            <div class="panel-body">
              <aside class="aside">
                <?php echo $meta->sidebar['content']; ?>
              </aside>

              <?php
              for ( $i=1; $i<= 12; $i++ ) {
                echo SPL_Mailgun_Newsletter::getPostSelectFormattedSidebar($meta->sidebar['posts'][$i]);
              }
              ?>

            </div><!-- /.panel-body -->
            <?php endif; ?>
            </div><!-- /.panel -->
          <?php endif; ?>
        </div><!-- /.col -->
      

      </div><!-- /.row -->

      <?php if ( isset($meta->posts) ) :  ?>
      <div class="row">
        <div class="col-lg-8 post">
          <?php echo SPL_Mailgun_Newsletter::getPostSelectFormatted($meta->posts[5]); ?>
        </div><!-- /.col -->
        <div class="col-lg-8 post">
          <?php echo SPL_Mailgun_Newsletter::getPostSelectFormatted($meta->posts[6]); ?>
        </div><!-- /.col -->
      </div><!-- /.row -->

      <div class="row">
        <div class="col-sm-6 post">
          <?php echo SPL_Mailgun_Newsletter::getPostSelectFormatted($meta->posts[7]); ?>
        </div><!-- /.col -->
        <div class="col-sm-6 post">
          <?php echo SPL_Mailgun_Newsletter::getPostSelectFormatted($meta->posts[8]); ?>
        </div><!-- /.col -->
      </div><!-- /.row -->
      <div class="row">
        <div class="col-sm-6 post">
          <?php echo SPL_Mailgun_Newsletter::getPostSelectFormatted($meta->posts[9]); ?>
        </div><!-- /.col -->
        <div class="col-sm-6 post">
          <?php echo SPL_Mailgun_Newsletter::getPostSelectFormatted($meta->posts[10]); ?>
        </div><!-- /.col -->
      </div><!-- /.row -->
      <div class="row">
        <div class="col-sm-6 post">
          <?php echo SPL_Mailgun_Newsletter::getPostSelectFormatted($meta->posts[11]); ?>
        </div><!-- /.col -->
        <div class="col-sm-6 post">
          <?php echo SPL_Mailgun_Newsletter::getPostSelectFormatted($meta->posts[12]); ?>
        </div><!-- /.col -->
      </div><!-- /.row -->
      <?php endif; ?>

  	</div><!-- /.panel-body -->

    <div class="panel-footer">
      <div class="text-center">
        <a href="/subscribe">Subscribe</a>
        |
        <a href="/unsubscribe">Unsubscribe</a>
      </div>
    </div><!-- /.panel-footer -->

	</div><!-- /.panel -->
  

  <footer>
    <?php //get_template_part('templates/entry-meta'); ?>
  </footer>
  <?php //comments_template('/templates/comments.php'); ?>

</div>
</div>
</div>
