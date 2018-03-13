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
    <div class="flash_message" style="display:block;">
      <div class="alert alert-info" role="alert">
        <h1>Do not ever share this card with anyone else.</h1>
        <h3>Use your browsers print function (Ctrl + P) to print this card.<br /><br />Use a laser printer for better accuracy.</h3>
      </div>
    </div>

    <?php
      require('contents/'.$content); 
      require_once('elements/scripts.php');
      require_once('elements/js_functions.php');
    ?>
  </body>
</html>