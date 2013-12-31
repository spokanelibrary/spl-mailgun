<?php if ( '200' == $vars->result->httpcode ) : ?> 

<div class="alert alert-success">
  <h3>Thank You!</h3>
  <p>
    We have added you to our distribution list.
  </p>
</div>

<?php else: ?>

<div class="alert alert-warning">
  <h3>Whoops!</h3>
  <p>
    Something went wrong with your subscription:
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
