<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16"
          href="<?php echo assets_url(); ?>images/favicon.png">
    <title><?php echo(isset($titlehead) ? $titlehead : ""); ?> :: PresensiKita </title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo assets_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="<?php echo assets_url(); ?>vendor/sidebar-nav/sidebar-nav.min.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="<?php echo assets_url(); ?>vendor/morrisjs/morris.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?php echo assets_url(); ?>css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo assets_url(); ?>css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?php echo assets_url(); ?>css/colors/megna.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- Preloader -->
<div id="preloader">
    <div class="loader">
        <img src="<?php echo assets_url() ?>images/loader.svg" alt="loader">
    </div>
</div>
<?php echo $contents ?>

<!-- jQuery -->
<script src="<?php echo assets_url() ?>js/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo assets_url() ?>js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="<?php echo assets_url() ?>vendor/sidebar-nav/sidebar-nav.min.js"></script>
<!--slimscroll JavaScript -->
<script src="<?php echo assets_url() ?>js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="<?php echo assets_url() ?>js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo assets_url() ?>js/custom.min.js"></script>
</body>
</html>
