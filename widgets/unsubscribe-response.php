<?php if ( '200' == $vars->result->httpcode ) : ?> 

<div class="alert alert-success">
  <h3>Ok</h3>
  <p>
    We have removed you from our distribution list.
  </p>
  <p>
  	If this was a mistake, <a href="<?php echo $slug->subscribe; ?>">please re-subscribe</a>.
  </p>
</div>

<?php else: ?>

<div class="alert alert-warning">
  <h3>Whoops!</h3>
  <p>
    <strong>Something went wrong removing your address:</strong>
  </p>
  <blockquote>
    <em><?php echo $vars->result->message; ?></em>
  </blockquote>
  <p>
    <a href="<?php echo $slug->unsubscribe; ?>" class="btn btn-warning">
      Try Again &rarr;
    </a>
  </p>
</div>

<?php endif; ?>

<?php print_r($vars); ?>
