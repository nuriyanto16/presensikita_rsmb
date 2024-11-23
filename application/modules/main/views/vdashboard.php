<style type="text/css">
    #map-canvas {
        height: 100%
    }

    /* Style the tab */
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    /* Style the buttons inside the tab */
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 10px 12px;
        transition: 0.3s;
        font-size: 14px;
        font-weight: bold;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
    }

    .little_box {
        display: inline-block;
        width: 15px;
    }
</style>


<?php
$label = array(
    'class' => 'control-label'
);
$label2 = array(
    'class' => 'control-label col-md-2'
);
?>
<!-- https://colorlib.com/polygon/gentelella/index.html -->

<div class="container-fluid">
    <!-- <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?= strtoupper($titlehead) ?></h4>
        </div>

        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li class="active">
                    <a href="<?php echo site_url("main/dashboard") ?>"><i class="fa fa-home"></i>
                        Dashboard</a>
                </li>
            </ol>
        </div>
    </div> -->
    <div class="row bg-title"></div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                   <div class="col-md-12"><h3> <small>FILTER</small></h3></div>
                   <ul class="nav navbar-right panel_toolbox">
                   </ul>
                   <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form class="form-horizontal form-label-left">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12">Perusahaan</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php echo form_dropdown(isset($compid) ? $compid : "") ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group row">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12">Karyawan</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    <?php echo form_dropdown(isset($nik) ? $nik : "") ?>
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label col-md-12 col-sm-12 col-xs-12">Tanggal</label>
                                    <div class="col-md-5 col-sm-5 col-xs-5">
                                    <?php echo form_input(isset($start_date) ? $start_date : ""); ?>
                                    </div>
                                    <div class="col-md-1 col-sm-2 col-xs-2">
                                        <label class="control-label">s/d</label>
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-xs-5">
                                    <?php echo form_input(isset($end_date) ? $end_date : ""); ?>
                                </div>
                                </div>
                            </div>
                        </div>

                      
                      <div class="ln_solid"></div>
                      <div class="form-group row m-b-0">
                         <div class="col-md-12 offset-md-12">
                            <a href="<?php echo site_url("main/dashboard") ?>"
                           class="btn btn-default"
                           type="button"><span class="fa fa-arrow-left"></span> Cancel</a>
                            <button type="submit" class="btn btn-success">Submit</button>
                         </div>
                      </div>
                   </form>
                </div>
             </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="x_panel">
                <div class="row x_title">
                    <div class="col-md-12"><h3> <small>DASHBBOARD KEHADIRAN</small></h3></div>
                </div>
                <div class="x_content">
                    <div class="row m-b-15">
                        <div class="col-md-2 col-2">
                            <img class="w-100" src="<?= assets_url(); ?>images/icon-menu-2.png" alt="Icon Izin/Sakit">
                        </div>
                        <div class="col-md-10 col-10">
                            <div class="m-b-5"><span class="h2 text-bold"><?= $jml_sakit_total ?></span> Izin/Sakit</div>
                            <div>
                                <span class="badge badge-info p-10"><?= $jml_sakit_pending ?> Pending</span>
                                <span class="badge badge-success p-10"><?= $jml_sakit_approved ?> Approved</span>
                                <span class="badge bg-red p-10"><?= $jml_sakit_disapproved ?> Disapproved</span>
                            </div>
                        </div>
                    </div>
                    <div class="row m-b-15">
                        <div class="col-md-2 col-2">
                            <img class="w-100" src="<?= assets_url(); ?>images/icon-menu-3.png" alt="Icon Izin/Sakit">
                        </div>
                        <div class="col-md-10 col-10">
                            <div class="m-b-5"><span class="h2 text-bold"><?= $jml_cuti_total ?></span> Cuti</div>
                            <div>
                                <span class="badge badge-info p-10"><?= $jml_cuti_pending ?> Pending</span>
                                <span class="badge badge-success p-10"><?= $jml_cuti_approved ?> Approved</span>
                                <span class="badge bg-red p-10"><?= $jml_cuti_disapproved ?> Disapproved</span>
                            </div>
                        </div>
                    </div>
                    <div class="row m-b-15">
                        <div class="col-md-2 col-2">
                            <img class="w-100" src="<?= assets_url(); ?>images/icon-menu-4.png" alt="Icon Izin/Sakit">
                        </div>
                        <div class="col-md-10 col-10">
                            <div class="m-b-5"><span class="h2 text-bold"><?= $jml_obat_total ?></span> Pengobatan</div>
                            <div>
                                <span class="badge badge-info p-10"><?= $jml_obat_pending ?> Pending</span>
                                <span class="badge badge-success p-10"><?= $jml_obat_approved ?> Approved</span>
                                <span class="badge bg-red p-10"><?= $jml_obat_disapproved ?> Disapproved</span>
                            </div>
                        </div>
                    </div>
                    <div class="row m-b-15">
                        <div class="col-md-2 col-2">
                            <img class="w-100" src="<?= assets_url(); ?>images/icon-menu-5.png" alt="Icon Izin/Sakit">
                        </div>
                        <div class="col-md-10 col-10">
                            <div class="m-b-5"><span class="h2 text-bold"><?= $jml_biaya_total ?></span> Penggantian Biaya</div>
                            <div>
                                <span class="badge badge-info p-10"><?= $jml_biaya_pending ?> Pending</span>
                                <span class="badge badge-success p-10"><?= $jml_biaya_approved ?> Approved</span>
                                <span class="badge bg-red p-10"><?= $jml_biaya_disapproved ?> Disapproved</span>
                            </div>
                        </div>
                    </div>
                    <div class="row m-b-15">
                        <div class="col-md-2 col-2">
                            <img class="w-100" src="<?= assets_url(); ?>images/icon-menu-6.png" alt="Icon Izin/Sakit">
                        </div>
                        <div class="col-md-10 col-10">
                            <div class="m-b-5"><span class="h2 text-bold"><?= $jml_dinas_total ?></span> Perjalanan Dinas</div>
                            <div>
                                <span class="badge badge-info p-10"><?= $jml_dinas_pending ?> Pending</span>
                                <span class="badge badge-success p-10"><?= $jml_dinas_approved ?> Approved</span>
                                <span class="badge bg-red p-10"><?= $jml_dinas_disapproved ?> Disapproved</span>
                            </div>
                        </div>
                    </div>
                    <div class="row m-b-15">
                        <div class="col-md-2 col-2">
                            <img class="w-100" src="<?= assets_url(); ?>images/icon-menu-7.png" alt="Icon Izin/Sakit">
                        </div>
                        <div class="col-md-10 col-10">
                            <div class="m-b-5"><span class="h2 text-bold"><?= $jml_pelatihan_total ?></span> Pelatihan</div>
                            <div>
                                <span class="badge badge-info p-10"><?= $jml_pelatihan_pending ?> Pending</span>
                                <span class="badge badge-success p-10"><?= $jml_pelatihan_approved ?> Approved</span>
                                <span class="badge bg-red p-10"><?= $jml_pelatihan_disapproved ?> Disapproved</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="x_panel">
                <div class="row x_title">
                    <div class="col-md-12"><h3> <small>STATUS PRESENSI</small></h3></div>
                </div>
                <div class="x_content status_pengajuan">
                    <div class="row">
                        <div class="col-md-5 col_pengajuan">
                            <span class="fa fa-users fa-2x fa_pengajuan"></span>
                            <h4>Total Karyawan</h4>
                            <h2 class="h2 text-bold"><?= $total_karyawan ?></h2>
                        </div>
                        <div class="col-md-5 col-md-offset-2 col_pengajuan">
                            <span class="fa fa-calendar fa-2x fa_pengajuan"></span>
                            <h4>Total Kehadiran</h4>
                            <h2 class="h2 text-bold"><?= $total_kehadiran ?></h2>
                        </div>
                        <div class="col-md-5 col_pengajuan">
                            <span class="fa fa-clock-o fa-2x fa_pengajuan"></span>
                            <h4>Total Terlambat</h4>
                            <h2 class="h2 text-bold"><?= $total_terlambat ?></h2>
                        </div>
                        <div class="col-md-5 col-md-offset-2 col_pengajuan">
                            <span class="fa fa-envelope fa-2x fa_pengajuan"></span>
                            <h4>Total Izin/Sakit</h4>
                            <h2 class="h2 text-bold"><?= $total_sakit ?></h2>
                        </div>
                        <div class="col-md-5 col_pengajuan">
                            <span class="fa fa-suitcase fa-2x fa_pengajuan"></span>
                            <h4>Total Dinas</h4>
                            <h2 class="h2 text-bold"><?= $total_dinas ?></h2>
                        </div>
                        <div class="col-md-5 col-md-offset-2 col_pengajuan">
                            <span class="fa fa-exclamation-triangle fa-2x fa_pengajuan"></span>
                            <h4>Total Mangkir</h4>
                            <h2 class="h2 text-bold"><?= $total_mangkir ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col_lokasi hidden">
            <div class="x_panel">
                <div class="row x_title">
                    <div class="col-md-12"><h3> <small>LOKASI ABSEN KARYAWAN</small></h3></div>
                </div>
                <div class="x_content">
                    <div style="width: 100%; height: 480px; margin-top:40px;">
                        <div id="map-canvas"></div>
                        <!-- <input type="checkbox" id="cek" value="Show" onclick="displayMarkers(this);"> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col_kehadiran hidden">
            <div class="x_panel">
                <div class="row x_title">
                    <div class="col-md-12"><h3> <small>DATA KEHADIRAN TERAKHIR</small></h3></div>
                </div>
                <div class="x_content data_kehadiran">
                    <ul class="list-unstyled top_profiles scroll-view">
                        <?php 
                        foreach($detail_absen as $row){
                        ?>
                        <li class="media event">
                            <a class="pull-left border-aero profile_thumb">
                            <i class="fa fa-user aero"></i>
                            </a>
                            <div class="media-body">
                                <a class="title" href="#"><?php echo $row->EMP_NAME; ?></a>
                                <p style="margin-top: 3px;"><?php echo ucfirst(strtolower($row->ABS_TYPE_DESC)); ?></p>
                                <p class="text-muted"><small><span class="fa fa-calendar"></span> <?php echo $row->JAM_IN;  ?></small></p>
                                <p class="text-muted"><small><span class="fa fa-compass"></span> <?php echo $row->LOKASI; ?></small></p>
                            </div>
                        </li>
                        <?php 
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
