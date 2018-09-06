<div class="container">
  <div class="row">
    <div class="col-sm-3 col-md-4 hidden-xs"></div>
    <div class="col-sm-6 col-md-4 col-xs-10 col-xs-offset-1 col-lg-4 col-lg-offset-0">
        <?php
          $msg = '';
          $alert_class = '';
          if($this->session->flashdata('number') != '') {
            $msg = $this->session->flashdata('msg');
            foreach($msg as $key=>$m) {
        ?>
        <div class="flash_message_login col-xs-12" <?php if($m[0]) echo 'style="display:block;"'; ?>>
          <div class="alert alert-<?php echo $m[1]; ?>" role="alert">
            <h5><?php echo $m[0]; ?></h5>
          </div>
        </div>
        <?php } } ?>
      <form action="<?php echo $controller.'/login_process'; ?>" method="post">
        <img class="logo_img" src="<?php echo base_url('images/'.$this->settings->institute_logo); ?>" alt="Logo">
        <h2 class="text-center">Library User Login</h2>
        <label for="username" class="sr-only">Username</label>
        <input name="username" class="form-control" placeholder="Username" required autofocus>
        <br />
        <label for="Password" class="sr-only">Password</label>
        <input name="password" type="password" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <button class="btn btn-md btn-primary pull-right" type="submit">Login</button>
          <label>
            <input name="remember" type="hidden" value="0">
            <input name="remember" type="checkbox" value="1"> Remember me<br>
          </label>
        </div>
      </form>
      <button id="forgot_button" class="btn btn-sm btn-default forgot_password" href="#"><i class="fa fa-key"></i> I forgot my password :(</button>
    </div>
    <div class="col-sm-3 col-md-4 hidden-xs"></div>
  </div>
</div> <!-- /container -->


<!-- Modal for Resetting Password -->
<div id="password_reset_modal" class="modal hide" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reset Password</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo site_url($module.'/login/request_password_reset'); ?>" method="post">
          <input autofocus required class="form-control" type="text" name="user_username" placeholder="Account Username"><br>
          <input required class="form-control" type="email" name="user_email" placeholder="Account Email"><br>
          <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-key"></i> Send Password Reset Link</button>
          <div class="clearfix"></div>
        </form
      </div>
    </div>
  </div>
</div>
