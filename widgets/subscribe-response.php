<?php if ( '200' == $vars->result->httpcode ) : ?> 

<div class="alert alert-success">
  <h3>Thank You!</h3>
</div>

<?php else: ?>
<div class="alert alert-warning">
  <h3>Whoops!</h3>
</div>

<pre>
<?php print_r($vars) ?>
</pre>  

<?php endif; ?>



<a href="<?php echo $slug->subscribe; ?>">Subscribe</a>
<br>
<a href="<?php echo $slug->unsubscribe; ?>">Unsubscribe</a>