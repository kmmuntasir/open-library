<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $this->settings->institute_name; ?> | <?php echo $page_title; ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo $fullpath; ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <?php if($custom_theme) { ?>
    <link href="<?php echo $fullpath; ?>assets/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- <link href="<?php echo $fullpath; ?>assets/css/<?php echo $custom_css_file; ?>" rel="stylesheet"> -->
    <?php } ?>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo $fullpath; ?>assets/font-awesome/css/font-awesome.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="<?php echo $fullpath; ?>assets/DataTables/datatables.min.css"/>

    

    <!-- Custom CSS Styles -->
    <link rel="stylesheet" href="<?php echo $fullpath; ?>assets/css/dashboard.css">
    <link rel="stylesheet" href="<?php echo $fullpath; ?>assets/css/style.css">

    <link rel="shortcut icon" href="<?php echo base_url('images/'.$this->settings->institute_favicon); ?>">

    <?php 

    if($this->session->admin_type == 2) {
    ?>

        

    <?php 
    }

    ?>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>