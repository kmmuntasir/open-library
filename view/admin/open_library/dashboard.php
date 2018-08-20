<div class="container-fluid">
  <?php require_once('elements/nav.php'); ?>
</div>
<div class="container-fluid">
  <input type="hidden" id="global_admin_id" value="<?php echo $this->session->admin_id; ?>">
  <input type="hidden" id="global_admin_type" value="<?php echo $this->session->admin_type; ?>">
  <div class="row">
    <!--
    <div class="col-sm-2 col-md-2 sidebar">
      <?php //require_once('elements/sidebar.php'); ?>
    </div>
    -->
    <div class="col-xs-12 main">
      <?php if($page != 'settings') { ?>
      <h1 class="page-header">
        <?php echo $page_title; ?>
        <!-- Trigger the modal with a button -->
        <?php if($page != 'book_copy' && $page != 'sync') { ?>
          <?php if($page == 'dashboard') { ?>
          <button class="btn btn-md btn-primary"><?php echo (count($issues))?'<span class="badge">'.count($issues).'</span> New Request(s)':'No Issue Requests'; ?> </button>     

          <?php if($this->session->admin_type != 0) { ?>
          <button style="margin-left: 5px;" id="restore_backup" class="btn btn-md btn-default pull-right">Restore Backup</button>
          <?php } ?>

          <a style="margin-left: 5px;" href="<?php echo site_url('admin/dashboard/backup'); ?>" class="btn btn-md btn-success pull-right">Backup System</a>
          <?php } ?>
          <?php if($page == 'user') { ?>

            <button style="margin-left: 5px;" id="import_user" class="btn btn-md btn-default pull-right">Import</button>

          <?php } ?>

          <?php if($page == 'books') { ?>

            <button style="margin-left: 5px;" id="book_copy_details_button" type="button" class="btn btn-primary btn-md pull-right"><i class="fa fa-copy"></i> View Single Copy Details</button>

          <?php } ?>




        <button id="add_button" type="button" class="btn btn-info btn-md pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Add</button>
        <?php } ?>

      </h1>
      <?php } ?>
      
      <?php require('contents/'.$content); ?>
    </div>
  </div>
</div>