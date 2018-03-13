<html>
    <head>
        <title><?php echo $this->settings->institute_name; ?> | <?php echo $page_title; ?></title>
        <style>
            * {
                margin:0;
                padding:0;
                clear:both;
            }
        </style>
        <link rel="shortcut icon" href="<?php echo base_url('images/'.$this->settings->institute_favicon); ?>">
    </head>
    <body>
        <iframe frameborder="0" scrolling="no" style="border:0px" src="<?php echo $book_url; ?>" width="100%" height="100%"></iframe>
    </body>
</html>