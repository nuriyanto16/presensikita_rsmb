<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?= strtoupper($titlehead) ?></h4>
        </div>
        <div class="col-lg-6 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><i class="icon-layers"></i> Laporan </li>
                <li class="active"><?= ($titlehead) ?></li>
            </ol>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                   <div class="col-md-12"><h3> <small>FILTER</small></h3></div>
                   <ul class="nav navbar-right panel_toolbox">
                   </ul>
                   <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form class="form form-horizontal" id="form" action="<?php echo base_url();?>laporan/generateabsen/sendRekapAbsensi" method="post">

                    <div class="col-md-6 col-sm-6">
                        <div class="form-group row">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">Tahun* </label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <?php echo isset($periode_id) ? form_dropdown($periode_id) : "" ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">Bulan*</label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <?php echo form_dropdown(isset($bulan_id) ? $bulan_id : "") ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12">
                        <div class="ln_solid"></div>
                        <div class="form-group row">
                            <div class="col-md-12 col-sm-12">
                                <?php  //if($this->session->userdata(sess_prefix()."roleid") == 1 || $this->session->userdata(sess_prefix()."roleid") == 2){ ?>
                                <button type="submit" class="btn btn-warning" id="btn-generate-rekap">Generate Data</button>
                                <?php //} ?>
                            </div>
                        </div>
                      </div>
                    </form>
                </div>
             </div>
        </div>
        <div class="col-md-4 col-sm-12  ">
        </div>
    </div>

</div>
</div></div></div></div>