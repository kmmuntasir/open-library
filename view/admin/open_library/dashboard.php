<div class="container-fluid">
  <?php require_once('elements/nav.php'); ?>
</div>
<div class="container-fluid">
  <input type="hidden" id="global_admin_id" value="<?php echo $this->session->admin_id; ?>">
  <input type="hidden" id="global_admin_type" value="<?php echo $this->session->admin_type; ?>">

  <input type="hidden" id="sms_access_token" value="<?php echo $this->settings->sms_access_token; ?>">
  <input type="hidden" id="sms_gateway_url" value="<?php echo $this->settings->sms_gateway_url; ?>">
  <input type="hidden" id="sms_sending_status" value="<?php echo $this->settings->sms_sending_status; ?>">

  
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
        <?php if($page == 'sync') { ?>
          <button id="sync_page_time" class="pull-right btn btn-primary">Last Sync: <?php echo date('g:i:s A, F d, Y', strtotime(date($this->server->server_last_connection))); ?></button>
          <div id="sync_indicator" style="margin-right: 5px;" class="btn btn-success btn-md pull-right"><i class="fa fa-refresh"></i></div>
        <?php } ?>
        <?php if($page != 'book_copy' && $page != 'sync' && $page != 'deleted_books') { ?>
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


            <?php if('Books by Category' == $page_title) { ?>
                    <a target="_blank" href="<?php echo site_url($module.'/book/print_by_category/'.$category_id); ?>" style="margin-left: 5px;" class="btn btn-default btn-md pull-right"><i class="fa fa-list"></i> Print Report By Category</a>
            <?php } ?>

            <a href="<?php echo site_url($module.'/book/deleted_books'); ?>" style="margin-left: 5px;" class="btn btn-warning btn-md pull-right"><i class="fa fa-book"></i> Deleted Books</a>

            <a href="<?php echo site_url($module.'/book/accession_list'); ?>" style="margin-left: 5px;" class="btn btn-default btn-md pull-right"><i class="fa fa-list"></i> Accession List</a>

            <button style="margin-left: 5px;" id="book_copy_details_button" type="button" class="btn btn-primary btn-md pull-right"><i class="fa fa-copy"></i> Single Copy Details</button>

            <button style="margin-left: 5px;" id="merge_book_button" type="button" class="btn btn-success btn-md pull-right"><i class="fa fa-compress"></i> Merge Books <span style="display: none;" class="badge badge-xs">3</span></button>

          <?php } ?>

          <?php if($page == 'issue' && $this->session->admin_type == 2) { ?>

            <button style="margin-left: 5px;" id="issue_add_super_admin" type="button" class="btn btn-primary btn-md pull-right"><i class="fa fa-credit-card"></i> Issue Add Superadmin</button>

          <?php } ?>




        <button id="add_button" type="button" class="btn btn-info btn-md pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Add</button>
        <?php } ?>

      </h1>
      <?php } ?>
      
      <?php require('contents/'.$content); ?>
    </div>
  </div>
</div>