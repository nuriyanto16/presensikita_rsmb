<div id="loading-spinner" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 9999; text-align: center; color: white; font-size: 20px; padding-top: 20%;">
    Loading...
</div>
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
                    <form class="form form-horizontal" id="form">

                    <div class="col-md-6 col-sm-6">
                        <div class="form-group row">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">Instansi*</label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <?php echo form_dropdown(isset($compid) ? $compid : "") ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">Unit Kerja*</label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <?php echo form_dropdown(isset($unitid) ? $unitid : "") ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">Karyawan</label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                            <?php echo form_dropdown(isset($nik) ? $nik : "") ?>
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="form-group row">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">Periode* </label>
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
                                <a href="<?php echo site_url("laporan/rekapabsen") ?>" class="btn btn-default" type="button"><span class="fa fa-arrow-left"></span> Cancel</a>
                                <?php  if($this->session->userdata(sess_prefix()."roleid") == 1 || $this->session->userdata(sess_prefix()."roleid") == 2){ ?>
                                <button type="button" class="btn btn-warning" id="btn-generate">Generate Absensi</button>
                                <?php } ?>
                                <button type="button" class="btn btn-success" id="btn-tampilkan">Tampilkan</button>
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


    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                   <div class="col-md-12"><h3> <small>SUMMARY ABSENSI</small></h3></div>
                   <ul class="nav navbar-right panel_toolbox">
                   </ul>
                   <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="col-md-12 col-sm-12">
                        <button class ="btn btn-danger pull-right hidden" id ="btnExportSummaryPdf">Download PDF</button>
                        <button class ="btn btn-success pull-right hidden" id ="btnExportSummary">Download XLSX</button>
                        <table id="dt-list-summary" class="table table-striped table-responsive"
                            width="100%">
                        </table>

                    </div>
                </di>

            </div>
            
        </div>
    <div>

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                   <div class="col-md-12"><h3> <small>RINCIAN ABSENSI</small></h3></div>
                   <ul class="nav navbar-right panel_toolbox">
                   </ul>
                   <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="col-md-12 col-sm-12">

                        
                        <button class ="btn btn-danger pull-right hidden" id ="btnExportDetailPdfV2">Download PDF (Type 2)</button>
                        <button class ="btn btn-success pull-right" id ="btnExportDetailV2">Download XLSX (Type 2)</button>

                        <button class ="btn btn-danger pull-right hidden" id ="btnExportDetailPdf">Download PDF (Type 1)</button>
                        <button class ="btn btn-success pull-right" id ="btnExportDetail">Download XLSX (Type 1)</button>


                        <table id="dt-list-details" class="table table-striped table-responsive"
                            width="100%">
                        </table>

                    </div>
                </di>

            </div>
            
        </div>
    <div>

</div>
</div></div></div></div>