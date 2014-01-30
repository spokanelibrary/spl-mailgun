<form class="form-horizontal spl-mailgun" method="post" role="form">
  <input type="hidden" name="spl-subscribe[vars][add_via]" value="Website" />

  <fieldset>
    <legend class="text-muted">Subscribe</legend>
    
    <div class="form-group">
      <label for="subscribe-email" class="col-sm-4 control-label">
        <sup class="text-danger">*</sup>
        Your Email Address 
        <!-- <small class="text-muted glyphicon glyphicon-envelope"></small> -->
      </label>
      <div class="col-sm-8">
        <input type="email" class="form-control required" id="subscribe-email" name="spl-subscribe[email]" placeholder="Email" value="<?php echo $_REQUEST['email']; ?>">
        <span class="help-block">
          We will not share your email address with anyone. 
          <br>
          <a href="/privacy">Read our privacy policy.</a>
        </span>
      </div>
    </div>
    
    <div class="form-group">
      <label for="subscribe-name-first" class="col-sm-4 control-label">
        Your Name 
        <!-- <small class="text-muted glyphicon glyphicon-user"></small> -->
      </label>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="subscribe-name-first" name="spl-subscribe[name][first]" placeholder="First">
        <span class="help-block">
          Your first name
        </span>
      </div>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="subscribe-name-last" name="spl-subscribe[name][last]" placeholder="Last">
        <span class="help-block">
          Your last name
        </span>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-4 col-sm-8">
        <button type="submit" class="btn btn-primary">
          Subscribe Now &rarr;
        </button>
      </div>
    </div>
  </fieldset>
</form>
