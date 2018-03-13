<div class="container-fluid">
  <?php require_once('elements/nav.php'); ?>
</div>
<div class="container-fluid">
  <div class="row">
    <!--
    <div class="col-sm-2 col-md-2 sidebar">
      <?php //require_once('elements/sidebar.php'); ?>
    </div>
    --
    <div class="col-sm-10 col-sm-offset-2 col-md-10 col-md-offset-2 main"> -->
    <div class="col-sm-12 col-md-12 main">
      <h1 class="page-header">
        <?php echo $page_title; ?>
        <!-- Trigger the modal with a button -->
        <?php if($page == 'issue') { ?>
        <button id="add_button" type="button" class="btn btn-info btn-md pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Request a New Issue</button>
        <?php } ?>
      </h1>
      
      <?php require('contents/'.$content); ?>
    </div>
  </div>
</div>