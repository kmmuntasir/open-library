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
      </h1>
      
      <?php require('contents/'.$content); ?>
    </div>
  </div>
</div>