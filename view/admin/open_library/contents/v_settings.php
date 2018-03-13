<div class="row">
  <div class="col-sm-12 col-md-6">
  <form class="lib_form" action="<?php echo $controller.'/update_settings'; ?>" method="post">
    <div class="panel panel-primary">
      <div class="panel-heading">Application Settings</div>
      <div class="panel-body">
        <label class="col-sm-4 col-xs-12" for="application_role">Application Role</label>
        <select id="app_role_selection" class="col-sm-8 col-xs-12" name="application_role" required="">
          <option <?php if($settings->application_role == 0) echo 'selected'; ?> class="" value="0">Local</option>
          <option <?php if($settings->application_role == 1) echo 'selected'; ?> class="" value="1">Remote</option>
        </select><div class="clearfix"></div>
        <hr>
        <div class="local_options <?php if($settings->application_role == 1) echo 'hide'; ?>">
          <label class="col-sm-4 col-xs-12" for="server_url">Remote Server URL</label>
          <input type="text" class="col-sm-8 col-xs-12" name="server_url" value="<?php echo $settings->server_url; ?>" placeholder="Remote Server URL"/><div class="clearfix"></div>
          <label class="col-sm-4 col-xs-12" for="remote_access_code">Remote Server Access Code</label>
          <input type="text" class="col-sm-8 col-xs-12" name="remote_access_code" value="<?php echo $settings->remote_access_code; ?>" placeholder="Remote Server Access Code"/><div class="clearfix"></div>
        </div>
        <!-- ===================================================================================================== -->
        <div class="remote_options <?php if($settings->application_role == 0) echo 'hide'; ?>">
          <label class="col-sm-4 col-xs-12" for="local_access_code">App Access Code</label>
          <input type="text" class="col-sm-8 col-xs-12" name="local_access_code" value="<?php echo $settings->server_access_code; ?>" placeholder="App Access Code"/><div class="clearfix"></div>
        </div>
        <hr>
        <label class="col-sm-4 col-xs-12" for="issue_deadline">Issue Deadline</label>
        <input type="number" class="col-sm-7 col-xs-10" name="issue_deadline" value="<?php echo $settings->issue_deadline; ?>" placeholder="Issue Deadline"/>
        <span style="text-align:right;" class="col-sm-1 col-xs-2">Days</span><div class="clearfix"></div>

        <label class="col-sm-4 col-xs-12" for="issue_auto_expire_deadline">Request Auto Expire</label>
        <input type="number" class="col-sm-7 col-xs-10" name="issue_auto_expire_deadline" value="<?php echo $settings->issue_auto_expire_deadline; ?>" placeholder="Issue Auto Expire Deadline"/>
        <span style="text-align:right;" class="col-sm-1 col-xs-2">Days</span><div class="clearfix"></div>

        <label class="col-sm-4 col-xs-12" for="issue_fine_per_day">Fine Per Day</label>
        <input type="number" class="col-sm-8 col-xs-12" name="issue_fine_per_day" value="<?php echo $settings->issue_fine_per_day; ?>" placeholder="Fine Per Day"/><div class="clearfix"></div>
      </div>
      <div class="panel-footer">
      		<button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Save</button>
      		<div class="clearfix"></div>
      </div>
    </div>
  </form>
  </div>
  <div class="col-sm-12 col-md-6">
  <form class="lib_form " action="<?php echo $controller.'/update_info'; ?>" method="post" enctype="multipart/form-data">
    <div class="panel panel-primary">
      <div class="panel-heading">School Information</div>
      <div class="panel-body">
        <label class="col-sm-4 col-xs-12" for="institute_name">School Name</label>
        <input required type="text" class="col-sm-8 col-xs-12" name="institute_name" value="<?php echo $settings->institute_name; ?>" placeholder="School/College/University/Institute Name"/><div class="clearfix"></div>
        <label class="col-sm-4 col-xs-12" for="institute_email">School Email</label>
        <input required type="text" class="col-sm-8 col-xs-12" name="institute_email" value="<?php echo $settings->institute_email; ?>" placeholder="School/College/University/Institute Email"/><div class="clearfix"></div>
        <label class="col-sm-4 col-xs-12" for="institute_phone">School Phone</label>
        <input required type="text" class="col-sm-8 col-xs-12" name="institute_phone" value="<?php echo $settings->institute_phone; ?>" placeholder="School/College/University/Institute Phone"/><div class="clearfix"></div>
        <label class="col-sm-4 col-xs-12" for="institute_address">School Address</label>
        <textarea class="col-sm-8 col-xs-12" name="institute_address"><?php echo $settings->institute_address; ?></textarea><div class="clearfix"></div>

        <hr>

        <label class="col-xs-12" for="institute_logo">School Logo</label>
        <div class="img_upload_box col-sm-8 col-sm-offset-4 col-xs-12">
          <div class="col-sm-6"><img id="logo_image" class="img-responsive" src="<?php echo base_url('images/'.$settings->institute_logo); ?>" alt="No Current Image" ></div>
          <div class="col-sm-6"><input id="logo_uploader" type="file" class="form-control col-sm-8 col-xs-12" name="institute_logo"/></div><div class="clearfix"></div>
        </div><div class="clearfix"></div>
        <hr>

        <label class="col-xs-12" for="institute_favicon">School Favicon</label>
        <div class="img_upload_box col-sm-8 col-sm-offset-4 col-xs-12">
          <div class="col-sm-6"><img id="favicon_image" class="img-responsive" src="<?php echo base_url('images/'.$settings->institute_favicon); ?>" alt="No Current Image" ></div>
          <div class="col-sm-6"><input id="favicon_uploader" type="file" class="form-control col-sm-8 col-xs-12" name="institute_favicon"/></div><div class="clearfix"></div>
        </div><div class="clearfix"></div>
      </div>
      <div class="panel-footer">
      		<button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Save</button>
      		<div class="clearfix"></div>
      </div>
    </div>
  </div>
  </form>
</div>
