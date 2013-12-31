<?php if ( '200' == $vars->result->httpcode ) : ?> 

  Success

<?php else: ?>
  <pre>
  <?php print_r($vars) ?>
  </pre>  
<?php endif; ?>



<a href="<?php echo $slug->subscribe; ?>">Subscribe</a>
<br>
<a href="<?php echo $slug->unsubscribe; ?>">Unsubscribe</a>