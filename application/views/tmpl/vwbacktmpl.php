<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16"
          href="<?php echo assets_url(); ?>images/favicon.png">
    <title><?php echo(isset($titlehead) ? $titlehead : ""); ?> :: PresensiKita</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo assets_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="<?php echo assets_url(); ?>vendor/sidebar-nav/sidebar-nav.min.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="<?php echo assets_url(); ?>vendor/morrisjs/morris.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?php echo assets_url(); ?>css/animate.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?php echo assets_url(); ?>css/colors/megna.css" id="theme" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo assets_url() ?>vendor/datatables/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo assets_url() ?>vendor/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
    <!-- Tabulator -->
    <link href="<?php echo assets_url() ?>vendor/tabulator/tabulator_bootstrap.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="<?php echo assets_url() ?>vendor/select2/select2.css" rel="stylesheet"/>
    <link href="<?php echo assets_url() ?>vendor/select2totree/select2totree.css" rel="stylesheet"/>
    <!-- Bootstrap Datepicker -->
    <link href="<?php echo assets_url() ?>vendor/bootstrap-datepicker/datepicker3.css" rel="stylesheet"/>
    <!-- Custom CSS -->

    <link href="<?php echo assets_url() ?>css/theme.min.css" rel="stylesheet">
    <link href="<?php echo assets_url() ?>css/_card.scss" rel="stylesheet">
    <link href="<?php echo assets_url() ?>css/style.css" rel="stylesheet">
    <link href="<?php echo assets_url() ?>css/custom.css" rel="stylesheet">
    <link href="<?php echo assets_url() ?>css/adjustment.css" rel="stylesheet">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">
        var base_url = '<?php echo base_url() . index_page();?>';
        var asset_url = '<?php echo HTTP_ASSET_PATH; ?>';
        var FORMAT_DATE = 'd-m-Y';
        var FDATE_SERVER = '<?php echo date('Y-m-d') ?>';
        var _CSRFData = {};
    </script>
    <?php
    // load stylesheet or javascript at header
    $this->load->view('tmpl/loader_header', (isset($loadhead) ? $loadhead : null));;
    ?>
</head>
<body>
<!-- Preloader -->
<div id="preloader">
    <div class="loader">
        <img src="<?php echo assets_url() ?>images/loader.svg" alt="loader">
    </div>
</div>
<div id="wrapper">
    <!-- top navigation -->
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header">
            <a class="navbar-toggle hidden-sm hidden-md hidden-lg "
               href="javascript:void(0)" data-toggle="collapse"
               data-target=".navbar-collapse"><i class="ti-menu"></i>
            </a>
            <div class="top-left-part">
                <a class="logo" href="<?php echo site_url() ?>">
                    <b><img src="<?php echo assets_url() ?>images/logo_presensikita.png" alt="home"/></b>
                    <span class="hidden-xs">
                        <img src="<?php echo assets_url() ?>images/teks_logo.png" alt="#"/>
                    </span>
                </a>
            </div>
            <ul class="nav navbar-top-links navbar-left hidden-xs">
                <li>
                    <a href="javascript:void(0)"
                       class="open-close hidden-xs waves-effect waves-light">
                        <i class="ti-menu"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-top-links navbar-right pull-right">
                <li class="dropdown">
                    <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown"
                       href="#"><i class="fa fa-bell"></i>
                        <div class="notify">
                            <span class="heartbit"></span>
                            <span class="point"></span>
                        </div>
                    </a>
                    <ul class="dropdown-menu mailbox animated bounceInDown">
                        <li>
                            <div class="message-center"></div>
                        </li>
                        <li>
                            <a class="text-center" href="<?php echo site_url("main/notification/") ?>">
                                <strong>Lihat semua notifikasi</strong> <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                        <img alt="user-img" width="36" class="img-circle"
                             src="<?php echo HTTP_UPLOAD_DIR . 'profile/' . ($this->session->userdata(sess_prefix() . "avatar") == "" ? "avatar.png" : $this->session->userdata(sess_prefix() . "avatar")) ?>">
                        <b class="hidden-xs"><?php echo $this->session->userdata(sess_prefix() . "full_name"); ?></b>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated flipInY">
                        <li>
                            <a href="<?php echo site_url("utility/profile"); ?>">
                                <i class="ti-user"></i> Profil
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url("utility/profile/change_password"); ?>">
                                <i class="ti-lock"></i> Ganti Password</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="<?php echo site_url("auth/logout") ?>">
                                <i class="fa fa-power-off"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown-user -->
                <!-- /.dropdown -->
            </ul>
        </div>
        <!-- /.navbar-header -->
        <!-- /.navbar-top-links -->
        <!-- /.navbar-static-side -->
    </nav>
    <!-- /top navigation -->

    <!-- left navigation -->
    <?php $this->load->view("tmpl/vwbacksidebar.php"); ?>

    <!-- page content -->
    <div id="page-wrapper">
        <?php echo $contents ?>
    </div>
    <!-- /page content -->

    <!-- footer content -->
    <footer class="footer text-center"><?= date("Y") ?> © PresensiKita.</footer>
    <!-- /footer content -->
</div>

<!-- jQuery -->
<script src="<?php echo assets_url() ?>js/jquery.min.js"></script>
<script src="<?php echo assets_url() ?>js/jquery.cookie.min.js"></script>
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
<!--Style Switcher -->
<script src="<?php echo assets_url() ?>vendor/styleswitcher/jQuery.style.switcher.js"></script>
<!-- Datatables -->
<script src="<?php echo assets_url() ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo assets_url() ?>vendor/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo assets_url() ?>vendor/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<!-- Tabulator -->
<script src="<?php echo assets_url() ?>vendor/tabulator/tabulator.js"></script>
<!-- Select2 -->
<script src="<?php echo assets_url() ?>vendor/select2/select2.min.js?v=4.4.0"></script>
<script src="<?php echo assets_url() ?>vendor/select2totree/select2totree.js"></script>
<!-- Bootstrap Datepicker -->
<script src="<?php echo assets_url() ?>vendor/bootstrap-datepicker/bootstrap-datepicker.js"></script>

<script type="text/javascript">
    function getbasepath() {
        return "<?php echo base_url()?>";
    }

    $(window).load(function () {
        //$(".loader").fadeOut("slow");
        //notifikasi();
    });

    $(document).ready(function () {
        // Attach csrf data token
        _CSRFTOKENNAME = 'frsc_pihcmanrisk_tn';
        _CSRFData[_CSRFTOKENNAME] = $.cookie('frsc_pihcmanrisk_cn');
        $.ajaxSetup({
            data: _CSRFData
        });

        $(document).ajaxComplete(function () {
            _CSRFData[_CSRFTOKENNAME] = $.cookie('frsc_pihcmanrisk_cn');
            $.ajaxSetup({
                data: _CSRFData
            });
        });

        // default DataTables
        $.extend(true, $.fn.dataTable.defaults, {
            language: {
                url: asset_url + "vendor/datatables/indonesian.json"
            }
        });

        // extend Tabulator
        Tabulator.prototype.extendModule("localize", "langs", {
            "id": {
                "columns": {
                },
                "ajax": {
                    "loading":"Sedang memproses...",
                    "error":"Terjadi kesalahan",
                },
                "pagination": {
                    "page_size":"Tampilkan",
                    "first": "Pertama",
                    "first_title": "Hal Pertama",
                    "last": "Terakhir",
                    "last_title": "Hal Terakhir",
                    "prev": "Sebelumnya",
                    "prev_title":"Hal Sebelumnya",
                    "next":"Selanjutnya",
                    "next_title":"Hal Selanjutnya",
                },
                "headerFilters":{
                    "default":"filter column...",
                    "columns":{}
                }
            },
        });

        notifikasi();
        setInterval(function(){
            notifikasi();
        }, 60000);

        // fix dropdown menu aksi
        $(document).on('shown.bs.dropdown', '.table-responsive', function (e) {
            // The .dropdown container
            let $container = $(e.target);

            // Find the actual .dropdown-menu
            let $dropdown = $container.find('.dropdown-menu');
            if ($dropdown.length) {
                // Save a reference to it, so we can find it after we've attached it to the body
                $container.data('dropdown-menu', $dropdown);
            } else {
                $dropdown = $container.data('dropdown-menu');
            }

            $dropdown.css('top', ($container.offset().top + $container.outerHeight()) + 'px');
            $dropdown.css('left', $container.offset().left + 'px');
            $dropdown.css('position', 'absolute');
            $dropdown.css('display', 'block');
            $dropdown.appendTo('body');
        });
        $(document).on('hide.bs.dropdown', '.table-responsive', function (e) {
            // Hide the dropdown menu bound to this button
            $(e.target).data('dropdown-menu').css('display', 'none');
        });

        // fix width tabulator
        $("body").on('resize', function () {
            if (typeof dtList === 'undefined' || dtList == null) return;
            setTimeout(function () {
                dtList.redraw(true);
            }, 200);
        });

        // remove scroll input number
        $(':input[type=number]').on('wheel',function(e){ $(this).blur(); });
    });


    function notifikasi() {
        $.ajax({
            url: getbasepath() + 'main/notification/notifikasi',
            type: "POST",
            dataType: "JSON",
            success: function (data) {
                $('.message-center').html(data.html);
                let jumlah = parseInt(data.jumlah);
                if (!isNaN(jumlah) && jumlah > 0) {
                    // $('#nav-notify').addClass("notify");
                    $('#nav_notif').html(jumlah);
                } else {
                    // $('#nav-notify').removeClass("notify");
                    $('#nav_notif').html('0');
                }
            }
        });
    }
</script>
<?php
$this->load->view('tmpl/loader_footer', (isset($loadfoot) ? $loadfoot : null)); // load stylesheet or javascript at footer
?>
</body>
</html>
