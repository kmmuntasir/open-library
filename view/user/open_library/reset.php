
<!-- Modal for Resetting Password -->
<div id="password_reset_modal" class="modal show" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Set A New Password</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo site_url($module.'/login/reset_password_process/'.$user_password_reset_code); ?>" method="post">
          <input autofocus required class="form-control" type="password" name="pass_1" placeholder="New Password"><br>
          <input required class="form-control" type="password" name="pass_2" placeholder="Confirm Password"><br>
          <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-key"></i> Set New Password</button>
          <div class="clearfix"></div>
        </form
      </div>
    </div>
  </div>
</div>
