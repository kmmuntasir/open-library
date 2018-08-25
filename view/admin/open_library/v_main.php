<?php
  $custom_theme = true;
  $custom_css_file = 'yeti.min.css';
  function unique_code($length=8, $keyspace = '0123456789@#$%&abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
  {
      $str = '';
      $max = mb_strlen($keyspace, '8bit') - 1;
      for ($i = 0; $i < $length; ++$i) {
          $str .= $keyspace[random_int(0, $max)];
      }
      return $str;
  }
?>
<!DOCTYPE html>
<html lang="en">
  <?php require_once('elements/head.php'); ?>
  <body>

    <div class="flash_message standby_flash" style="display:none;"><div class="alert alert-success" role="alert">Sample Flash Message</div></div>

    <?php
      $msg = '';
      $alert_class = '';
      if($page != 'login' && $this->session->flashdata('number') != '') {
        $msg = $this->session->flashdata('msg');
        foreach($msg as $key=>$m) {
    ?>
    <div class="flash_message" <?php if($m[0]) echo 'style="display:block;"'; ?>>
      <div class="alert alert-<?php echo $m[1]; ?>" role="alert">
        <?php echo $m[0]; ?>
      </div>
    </div>

    <?php
        }
      }
    	$template = ($page == 'login')? 'login.php':'dashboard.php';
      require($template);
    ?>
      <div id="footer_top"></div>
    <?php
      require_once('elements/footer.php');
    	require_once('elements/scripts.php');
    	require_once('elements/js_functions.php');

      if($page == 'sync') {
    ?>
    <script type="text/javascript" src="<?php echo $fullpath; ?>elements/jquery.md5.js"></script>
    <script type="text/javascript" src="<?php echo $fullpath; ?>elements/js_sync.js"></script>
    <?php } ?>
  </body>


</html>