<style type="text/css">

#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
  max-width:100px;
  min-width:100px;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */

/* Modal Content (image) */
.modal-content {
  margin: auto;
  /*display: block;
  width: 80%;
  max-width: 700px;*/
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?= strtoupper($titlehead) ?></h4>
        </div>
        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><i class="icon-settings"></i> Master Data</li>
                <li>Karyawan</li>
                <li class="active"><?= ($titlehead) ?></li>
            </ol>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col_tabs">
            <div class="x_panel">
                <div class="x_content">
                    <div class="row">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-user" aria-hidden="true"></i> Info Jadwal Pegawai</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <?php
        echo form_open(uri_string(), array('id' => 'fmain', 'class' => 'form', 'enctype' => 'multipart/form-data'));
        $label = array(
            'class' => 'control-label'
        );
        $label2 = array(
            'class' => 'control-label col-md-2'
        );
        ?>

        <div class="col-md-12">
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="x_panel">
                                <div class="x_title">
                                    <ul class="nav navbar-right panel_toolbox"></ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="row">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Informasi Jadwal Pegawai </h3>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('COMPID'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Company', 'COMPID', $label); ?>
                                            <?php echo form_dropdown(isset($COMPID) ? $COMPID : "") ?>
                                        </div>
                                    </div>
                
                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('nik'))) echo 'has-error'; ?>">
                                            <?php echo form_label('nik', 'nik', $label); ?>
                                            <?php echo form_input(isset($nik) ? $nik : ""); ?>
                                            <?php echo form_input(isset($nik_pegawai) ? $nik_pegawai : ""); ?>
                                            <?php echo form_input(isset($emp_id) ? $emp_id : ""); ?>
                                        </div><!-- /.form-group -->
                                    </div>
                
                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('emp_name'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Nama', 'emp_name', $label);
                                            echo form_input(isset($emp_name) ? $emp_name : "");
                                            ?>
                                        </div><!-- /.form-group -->
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="x_panel">
                                <div class="x_title">
                                    <ul class="nav navbar-right panel_toolbox"></ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <div class="row">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Informasi Umum </h3>
                                            <br>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('unitId'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Organisasi', 'unitId', $label); ?>
                                            <?php echo form_dropdown(isset($unitId) ? $unitId : "") ?>
                                        </div><!-- /.form-group -->
                                    </div>

                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('position_code'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Posisi / Jabatan', 'position_code', $label); ?>
                                            <?php echo form_dropdown(isset($position_code) ? $position_code : "") ?>
                                        </div><!-- /.form-group -->
                                    </div>

                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('kantor_id'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Kantor', 'kantor_id', $label); ?>
                                            <?php echo form_dropdown(isset($kantor_id) ? $kantor_id : "") ?>
                                        </div><!-- /.form-group -->
                                    </div>
                                    <div class="row hidden">
                                      <?php echo form_input(isset($multiple_kode_unit) ? $multiple_kode_unit : "") ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                          
                            <div class="x_panel">
                              <div class="row">
                                <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-2">Periode</label>
                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                    <?php echo isset($periode_id) ? form_dropdown($periode_id) : "" ?>
                                    </div>
                                    <label class="control-label col-md-2 col-sm-2 col-xs-2">Bulan</label>
                                    <div class="col-md-3 col-sm-3 col-xs-3">  
                                        <?php echo form_dropdown(isset($bulan_id) ? $bulan_id : "") ?>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-md-2 col-sm-2 col-xs-2">
                                            <button type="button" id="btn-tampilkan" class="btn btn-success">Tampilkan Jadwal</button>
                                        </div>
                                        <label class="control-label col-md-2 col-sm-2 col-xs-2"></label>
                                        <div class="col-md-2 col-sm-2 col-xs-2">
                                            <button type="button" class="btn btn-warning" id="btn-generate">Generate Jadwal</button>
                                        </div>
                                        <label class="control-label col-md-2 col-sm-2 col-xs-2"></label>
                                        <div class="col-md-2 col-sm-2 col-xs-2">
                                            <button type="button" id="btnExportDetailV2" class="btn btn-success">Preview Hasil Jadwal</button>
                                        </div>
                                    </div>
                                </div>
                              </div>
                            </div>

                            <div class="x_panel">
                                <div class="x_content">                             
                                  <div class="row">
                                    <div class="col-sm-6">
                                      <h4><b>Detail Jadwal Kerja</b></h4>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="button" id="upload-excel" class="btn btn-success pull-right" style="visibility: hidden;">Upload Jadwal Kerja</button>
                                    </div>
                                    <div class="col-sm-12">
                                      <table id="dt-listjadwal" class="table table-striped table-responsive" width="100%"></table>
                                    </div><!-- /.col-sm-12 -->
                                  </div>
                              </div>
                            </div>
                          </div>
                      </div>
                  </div>

                </div>
          
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <?php if (isset($message) && $message != "" OR $this->session->flashdata('message')) { ?>
                        <?php echo (isset($message) && $message != "") ? $message : $this->session->flashdata('message'); ?>
                    <?php } ?>
                    <?php if (isset($errmsg) && $errmsg != "" OR $this->session->flashdata('errmsg')) { ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button class="close" data-dismiss="alert" aria-hidden="true"
                                    type="button"> x
                            </button>
                            <?php echo (isset($errmsg) && $errmsg != "") ? $errmsg : $this->session->flashdata('errmsg'); ?>
                        </div>
                    <?php } ?>                    

                    <div class="form-group m-b-0" hidden>
                        <a href="<?php echo site_url("presensi/penjadwalan") ?>"
                           class="btn btn-default"
                           type="button"><span class="fa fa-arrow-left"></span> Kembali</a>
                                <button id="btn-save" type="submit" id="submit" name="actionf" value="save" class='btn btn-primary'>
                            <span class="fa fa-save"></span> Simpan
                        </button>
                        <input type="hidden" id="actionf" name="actionf" value="">
                    </div><!-- /.form-group -->
                </div>
                <?php echo form_hidden('id', $id); ?>
                <?php echo form_hidden($csrf); ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>


<!-- modal-jadwal -->
<div class="modal fade" id="modal-jadwal" tabindex="-1" role="dialog" aria-labelledby="modal-jadwal" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">Pilih Jadwal</h4>
            </div>
            <div class="modal-body overflow-edit" style="max-height: 800px">

                <div class="row">
                    <div class="box-body" style="max-height: 800px">
                        <form>    

                          <div class="row">
                              <div class="form-group col-md-6 <?php if (!empty(form_error('tgl_akhir_jadwal'))) echo 'has-error'; ?>">
                              <?php echo form_label('Tanggal *', 'tgl_mulai_jadwal', $label); ?>    
                                  <div class="input-group">    
                                      <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" id="tgl_mulai_jadwal" id="tgl_mulai_jadwal" class="form-control"/>
                                  </div>
                              </div>
                          </div>

                          <div class="row" hidden>
                              <div class="form-group col-md-6 <?php if (!empty(form_error('tgl_akhir_jadwal'))) echo 'has-error'; ?>">
                                  <?php echo form_label('Tanggal Akhir *', 'tgl_akhir_jadwal', $label); ?>
                                  <div class="input-group">    
                                      <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" id="tgl_akhir_jadwal" id="tgl_akhir_jadwal" class="form-control"/>
                                  </div>
                              </div>
                          </div>
                          
                          <div class="row">
                            <div
                                class="form-group col-md-9 <?php if (!empty(form_error('id_tp'))) echo 'has-error'; ?>">
                                <?php echo form_label('Kode Jadwal *', 'id_tp', $label); ?>
                                <input type="hidden" id="mode" name="mode" class="form-control"/>
                                <input type="hidden" id="id_tp" name="id_tp" class="form-control"/>
                                <input type="text" id="kode" name="kode" class="form-control"/>
                            </div>
                            <div class="form-group col-md-3">
                              <?php echo form_label('&nbsp;', '', ''); ?>
                              <br/>
                              <button id="btn-carijadwal"  class="btn btn-info" type="button">
                                  <span class="fa fa-plus"></span> Cari Jadwal
                              </button>
                            </div>
                            <div
                              class="form-group col-md-9 <?php if (!empty(form_error('id_tp'))) echo 'has-error'; ?>">
                                <?php echo form_label('Keterangan', 'keterangan', $label); ?>
                                <input type="text" id="deskripsi_jadwal" name="deskripsi_jadwal" class="form-control"/>
                            </div>
                          </div>

                          <div class="row">
                              <div class="form-group col-md-6 <?php if (!empty(form_error('tgl_akhir_jadwal'))) echo 'has-error'; ?>">
                              <?php echo form_label('Jadwal Masuk', 'jadwal_masuk', $label); ?>    
                                  <div class="input-group">    
                                      <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" id="hari_1_jam_in" id="hari_1_jam_in" class="form-control"/>
                                  </div>
                              </div>
                          </div>

                          <div class="row">
                              <div class="form-group col-md-6 <?php if (!empty(form_error('tgl_akhir_jadwal'))) echo 'has-error'; ?>">
                              <?php echo form_label('Jadwal Pulang', 'jadwal_pulang', $label); ?>    
                                  <div class="input-group">    
                                      <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" id="hari_1_jam_out" id="hari_1_jam_out" class="form-control"/>
                                  </div>
                              </div>
                          </div>

                        </form>

                    </div>
                </div>

                <div class="row">
                  <div class="box-body">
                    <button id="btn-pilihjadwal" class="btn btn-primary pull-right">
                      <span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Tambahkan Jadwal
                    </button>
                  </div>
                </div>


            </div>
        </div>
    </div>
</div><!-- /.modal-jadwal -->



<!-- modal-atasan-langsung -->
<div class="modal fade" id="modal_peserta" tabindex="-1" role="dialog" aria-labelledby="modal-keluarga" aria-hidden="true">
    <div class="modal-dialog  ">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">Pilih Jadwal/Shift Kerja</h4>
            </div>
            <div class="modal-body overflow-edit">
                <div class="row">
                    <!-- <div class="box-body"> -->
                        <table id="dt-list" class="table table-striped table-responsive"  width="100%">
                        </table>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
</div><!-- modal-atasan-langsung -->


<div class="modal fade" id="modal-upload" tabindex="-1" role="dialog" aria-labelledby="modal-upload" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">Input Jadwal</h4>
            </div>
            <div class="modal-body overflow-edit" style="max-height: 800px">

                <!-- <div class="row">
                    <div class="box-body" style="max-height: 800px">
                        <form>
                          <div class="row">
                          <div class="form-group col-md-6 <?php if (!empty(form_error('file-upload'))) echo 'has-error'; ?>">
                                  <?php echo form_label('Choose File *', 'file-upload', $label); ?>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file-upload" id="file_upload">
                            </div>
                          </div>
                        </form>

                    </div>
                </div> -->

                <div class="row">
                  <div class="box-body">
                    <button id="upload-jadwal" class="btn btn-primary pull-right">
                      <span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Upload
                    </button>
                  </div>
                </div>


            </div>
        </div>
    </div>
</div><!-- /.modal-jadwal -->



