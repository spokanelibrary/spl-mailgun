<?php if ( '200' == $vars->result->httpcode ) : ?> 

<div class="alert alert-success">
  <h3>Thanks!</h3>
  <p>
    We added you to our distribution list.
  </p>
  <blockquote>
    <em><?php echo $vars->result->member->address; ?></em>
  </blockquote>
</div>

<?php else: ?>

<div class="alert alert-warning">
  <h3>Whoops!</h3>
  <p>
    <strong>Something went wrong with your subscription:</strong>
  </p>
  <blockquote>
    <em><?php echo $vars->result->message; ?></em>
  </blockquote>
  <p>
    <a href="<?php echo $slug->subscribe; ?>" class="btn btn-warning">
      Try Again &rarr;
    </a>
  </p>
</div>

<?php endif; ?>

<?php print_r($vars); ?>
