<form class="form-horizontal spl-mailgun" method="post" role="form">
  <input type="hidden" id="unsubscribe-list" name="spl-unsubscribe[list]" value="<?php echo $_REQUEST['list']; ?>">
  <fieldset>
    <legend class="text-muted">Unsubscribe</legend>
    
    <div class="form-group">
      <label for="unsubscribe-email" class="col-sm-4 control-label">
        <sup class="text-danger">*</sup>
        Your Email Address 
        <!-- <small class="text-muted glyphicon glyphicon-envelope"></small> -->
      </label>
      <div class="col-sm-8">
        <input type="email" class="form-control required" id="unsubscribe-email" name="spl-unsubscribe[email]" placeholder="Email" value="<?php echo $_REQUEST['email']; ?>">
      </div>
    </div>
    <!--
    <div class="form-group">
      <div class="col-sm-8 col-sm-offset-4">
        <div class="checkbox">
          <label>
            <input type="checkbox" name="spl-unsubscribe[delete]"> Delete permanently?
          </label>
        </div>
      </div>
    </div>
    -->
    <div class="form-group">
      <div class="col-sm-offset-4 col-sm-8">
        <button type="submit" class="btn btn-primary">
          Unsubscribe Now &rarr;
        </button>
      </div>
    </div>
  </fieldset>
</form>
