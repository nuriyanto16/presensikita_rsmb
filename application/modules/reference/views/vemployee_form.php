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
                                <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-user" aria-hidden="true"></i> Personal Info</a></li>
                                <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-cog" aria-hidden="true"></i> Konfigurasi</a></li>
                                <li><a href="#tab_3" data-toggle="tab"><i class="fa fa-clock-o" aria-hidden="true"></i> Jadwal Kerja/Shift</a></li>
                                <li><a href="#tab_4" data-toggle="tab"><i class="fa fa-users" aria-hidden="true"></i> Data Keluarga</a></li>
                                <li><a href="#tab_5" data-toggle="tab"><i class="fa fa-paperclip" aria-hidden="true"></i> Lampiran Pendukung</a></li>
                                <li><a href="#tab_6" data-toggle="tab"><i class="fa fa-calendar" aria-hidden="true"></i> Penyesuaian Cuti</a></li>
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
                                    <i class="fa fa-info-circle"></i> <i><b>(*)</b> harus diisi !</i>
                                    <ul class="nav navbar-right panel_toolbox"></ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="row">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Informasi Pekerjaan </h3>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('COMPID'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Company *', 'COMPID', $label); ?>
                                            <?php echo form_dropdown(isset($COMPID) ? $COMPID : "") ?>
                                        </div>
                                    </div>
                
                                    <div class="row" hidden>
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('nik'))) echo 'has-error'; ?>">
                                            <?php echo form_label('NIK *', 'nik', $label); ?>
                                            <?php echo form_input(isset($nik) ? $nik : ""); ?>
                                        </div><!-- /.form-group -->
                                    </div>

                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('nik_pegawai'))) echo 'has-error'; ?>">
                                            <?php echo form_label('NIK *', 'nik_pegawai', $label); ?>
                                            <?php echo form_input(isset($nik_pegawai) ? $nik_pegawai : ""); ?>
                                        </div><!-- /.form-group -->
                                    </div>
                
                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('emp_name'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Nama *', 'emp_name', $label);
                                            echo form_input(isset($emp_name) ? $emp_name : "");
                                            ?>
                                        </div><!-- /.form-group -->
                                    </div>
                
                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('email'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Email *', 'email', $label);
                                            echo form_input(isset($email) ? $email : "");
                                            ?>
                                        </div><!-- /.form-group -->
                                    </div>
                
                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('unitId'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Organisasi *', 'unitId', $label); ?>
                                            <?php echo form_dropdown(isset($unitId) ? $unitId : "") ?>
                                        </div><!-- /.form-group -->
                                    </div>
                
                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('position_code'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Posisi / Jabatan *', 'position_code', $label); ?>
                                            <?php echo form_dropdown(isset($position_code) ? $position_code : "") ?>
                                        </div><!-- /.form-group -->
                                    </div>

                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('kantor_id'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Kantor *', 'kantor_id', $label); ?>
                                            <?php echo form_dropdown(isset($kantor_id) ? $kantor_id : "") ?>
                                        </div><!-- /.form-group -->
                                    </div>

                                    <div class="row">
                                        <div
                                            class="form-group col-md-6 <?php if (!empty(form_error('company_begin'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Tanggal Bergabung', 'company_begin', $label); ?>
                                            <?php echo form_input(isset($company_begin) ? $company_begin : ""); ?>
                                        </div><!-- /.form-group -->
                                        <div
                                            class="form-group col-md-6 <?php if (!empty(form_error('company_last'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Tanggal Masuk Kerja', 'company_last', $label); ?>
                                            <?php echo form_input(isset($company_last) ? $company_last : ""); ?>
                                        </div><!-- /.form-group -->
                                    </div>

                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('fid'))) echo 'has-error'; ?>">
                                            <?php echo form_label('FID *', 'fid', $label);
                                            echo form_input(isset($fid) ? $fid : "");
                                            ?>
                                        </div><!-- /.form-group -->
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="x_panel">
                                <div class="x_title">
                                    <i class="fa fa-info-circle"></i> <i><b>(*)</b> harus diisi !</i>
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
                                            class="form-group col-md-12 <?php if (!empty(form_error('jns_kelamin'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Jenis Kelamin', 'jns_kelamin', $label); ?>
                                            <?php echo form_dropdown(isset($jns_kelamin) ? $jns_kelamin : "") ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('tgl_lahir'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Tanggal Lahir', 'tgl_lahir', $label); ?>
                                            <?php echo form_input(isset($tgl_lahir) ? $tgl_lahir : ""); ?>
                                        </div><!-- /.form-group -->
                                    </div>

                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('tmp_lahir'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Tempat Lahir', 'tmp_lahir', $label); ?>
                                            <?php echo form_input(isset($tmp_lahir) ? $tmp_lahir : ""); ?>
                                        </div><!-- /.form-group -->
                                    </div>

                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('hp1'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Nomor Handphone *', 'hp1', $label); ?>
                                            <?php echo form_input(isset($hp1) ? $hp1 : ""); ?>
                                        </div><!-- /.form-group -->
                                    </div>

                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('p_alamat'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Alamat', 'p_alamat', $label); ?>
                                            <?php echo form_input(isset($p_alamat) ? $p_alamat : ""); ?>
                                        </div><!-- /.form-group -->
                                    </div>

                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('p_kota'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Kota/Kabupaten', 'p_kota', $label); ?>
                                            <?php echo form_input(isset($p_kota) ? $p_kota : ""); ?>
                                        </div><!-- /.form-group -->
                                    </div>

                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('p_propinsi'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Propinsi', 'p_propinsi', $label); ?>
                                            <?php echo form_input(isset($p_propinsi) ? $p_propinsi : ""); ?>
                                        </div><!-- /.form-group -->
                                    </div>

                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('p_kodepos'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Kode Pos', 'p_kodepos', $label); ?>
                                            <?php echo form_input(isset($p_kodepos) ? $p_kodepos : ""); ?>
                                        </div><!-- /.form-group -->
                                    </div>

                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('religion_id'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Agama', 'religion_id', $label); ?>
                                            <?php echo form_dropdown(isset($religion_id) ? $religion_id : "") ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('status_nikah'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Status', 'status_nikah', $label); ?>
                                            <?php echo form_dropdown(isset($status_nikah) ? $status_nikah : "") ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('education'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Pendidikan Terakhir', 'education', $label); ?>
                                            <?php echo form_input(isset($education) ? $education : ""); ?>
                                        </div><!-- /.form-group -->
                                    </div>

                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('edu_name'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Jurusan', 'edu_name', $label); ?>
                                            <?php echo form_input(isset($edu_name) ? $edu_name : ""); ?>
                                        </div><!-- /.form-group -->
                                    </div>

                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('jml_anak'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Jumlah Anak', 'jml_anak', $label); ?>
                                            <?php echo form_input(isset($jml_anak) ? $jml_anak : ""); ?>
                                        </div><!-- /.form-group -->
                                    </div>

                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('gol_darah'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Golongan Darah', 'gol_darah', $label); ?>
                                            <?php echo form_input(isset($gol_darah) ? $gol_darah : ""); ?>
                                        </div><!-- /.form-group -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="x_panel">
                                <div class="x_title">
                                    <i class="fa fa-info-circle"></i> <i><b>(*)</b> harus diisi !</i>
                                    <ul class="nav navbar-right panel_toolbox"></ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                <div class="row">
                                    <div class="col-sm-2" hidden>
                                    <?php echo form_input(isset($stat_sales) ? $stat_sales : ""); ?>
                                    </div>
                                <div class="col-sm-10" hidden>
                                    <div class="pull-left">
                                        <p>*Klik centang untuk Karyawan dapat melakukan absensi/check point dimana saja, <br/>Unchecklist jika karyawan hanya dapat absensi pada radius sekitaran kantor </p><br/>
                                    </div>
                                </div>
                            </div><!-- /.row -->

                            <div class="row">
                                
                                <div 
                                    class="form-group col-md-7  <?php if (!empty(form_error('nama_atasan_langsung'))) echo 'has-error'; ?>">
                                        <?php echo form_label('Nama Atasan Langsung ', 'nama_atasan_langsung', $label); ?>
                                        <?php echo isset($nama_atasan_langsung) ? form_input($nama_atasan_langsung) : ""; ?>
                                        <?php echo isset($nik_atasan) ? form_input($nik_atasan) : ""; ?>
                                        <input type="hidden" id="flag_pop" />
                                </div>
                                <div class="form-group col-md-3">
                                    <?php echo form_label('&nbsp;', '', ''); ?>
                                    <button id="btn-caripejabat"  class="btn btn-info" type="button">
                                        <span class="fa fa-plus"></span> Cari Nama Atasan
                                    </button>
                                </div>
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_3">
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
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                  <button type="button" id="btn-tampilkan" class="btn btn-success">Tampilkan</button>
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>

                        <div class="x_panel">
                            <div class="x_content">                             
                              <div class="row">
                                <div class="col-sm-12">
                                  <h4><b>Hitory Jadwal Kerja</b></h4>
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
                <div class="tab-pane" id="tab_4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <i class="fa fa-info-circle"></i> <i><b>(*)</b> harus diisi !</i>
                                    <ul class="nav navbar-right panel_toolbox"></ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-12">
                                        <h4><b>Detail Data Keluarga</b></h4>
                                    </div>
                                    <?php 
                                    echo form_input(isset($hid_keluarga) ? $hid_keluarga : "");
                                    ?>
                                    <table id="dt-listKeluarga"
                                        class="table table-hover table-striped table-bordered table-condensed table-responsive db">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Keluarga</th>
                                            <th>Hubungan Keluarga</th>
                                            <th class="text-center">
                                                <button id="btn-tambahkeluarga" class="btn btn-default btn-sm" type="button">
                                                    <span class="fa fa-plus"></span> Tambah
                                                </button>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($keluarga as $valkel){ ?>
                                                <tr data-id="<?php echo $valkel->seq; ?>">
                                                    <td><?php echo $valkel->seq; ?></td>
                                                    <td><?php echo $valkel->nama_kel; ?></td>
                                                    <td><?php echo $valkel->relasi_kel; ?></td>
                                                    <td align="text-center"><a href='#' class='btn-kel-removeitem' title='Hapus kelaurga dari list'><span class='fa fa-fw fa-trash'></span></a></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div><!-- /.col-sm-12 -->
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="x_panel">
                                <div class="x_title">
                                    <i class="fa fa-info-circle"></i> <i><b>(*)</b> harus diisi !</i>
                                    <ul class="nav navbar-right panel_toolbox"></ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="picture-container">
                                        <div class="picture" data-toggle="wizard-radio" rel="tooltip" title="Upload File Foto">
                                            <a href="<?php echo base_url('uploads/personal/photo/'.$comp_code.'/'); ?><?=(isset($url_profile) ? $url_profile : "")?>" target="_blank"><img src="<?php echo base_url('uploads/personal/photo/'); ?><?=(isset($url_profile) ? $url_profile : "")?>" width="100%" class="picture-src m-b-20" id="wizardPicturePreview" title=""/></a>
                                            <input type="file" id="wizard-picture" name="foto_profile">
                                            <input type="hidden" class="form-control" id="url_profile" name="url_profile" value="<?=(isset($url_profile) ? $url_profile: "")?>" >
                                        </div>
                                        <h6>Upload Foto</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="x_panel">
                                <div class="x_title">
                                    <i class="fa fa-info-circle"></i> <i><b>(*)</b> harus diisi !</i>
                                    <ul class="nav navbar-right panel_toolbox"></ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                <div class="picture-container">
                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('ktp'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Nomor KTP', 'ktp', $label); ?>
                                            <?php echo form_input(isset($ktp) ? $ktp : ""); ?>
                                        </div><!-- /.form-group -->
                                    </div>

                                    <div class="picture" data-toggle="wizard-radio" rel="tooltip" title="Upload File Hasil Scan e-KTP">
                                        <a href="<?php echo base_url('uploads/personal/ktp/'.$comp_code.'/'); ?><?=(isset($url_ktp) ? $url_ktp : "")?>" target="_blank"><img src="<?php echo base_url('uploads/personal/ktp/'.$comp_code.'/'); ?><?=(isset($url_ktp) ? $url_ktp : "")?>" width="100%" class="picture-src m-b-20" id="wizardPicturePreview" title=""/></a>
                                        <input type="file" id="wizard-picture" name="foto_ktp">
                                        <input type="hidden" class="form-control" id="url_ktp" name="url_ktp" value="<?=(isset($url_ktp) ? $url_ktp: "")?>" >
                                    </div>
                                    <h6>Upload Kopi eKTP</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="x_panel">
                                <div class="x_title">
                                    <i class="fa fa-info-circle"></i> <i><b>(*)</b> harus diisi !</i>
                                    <ul class="nav navbar-right panel_toolbox"></ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="picture-container">
                                        <div class="picture" data-toggle="wizard-radio" rel="tooltip" title="Upload File Hasil Scan SIM">
                                            <a href="<?php echo base_url('uploads/personal/sim/'.$comp_code.'/'); ?><?=(isset($url_sim) ? $url_sim : "")?>" target="_blank"><img src="<?php echo base_url('uploads/personal/sim/'.$comp_code.'/'); ?><?=(isset($url_sim) ? $url_sim : "")?>" width="100%" class="picture-src m-b-20" id="wizardPicturePreview" title=""/></a>
                                            <input type="file" id="wizard-picture" name="foto_sim">
                                            <input type="hidden" class="form-control" id="url_sim" name="url_sim" value="<?=(isset($url_sim) ? $url_sim: "")?>" >
                                        </div>
                                        <h6>Upload File Hasil Scan SIM</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="x_panel">
                                <div class="x_title">
                                    <i class="fa fa-info-circle"></i> <i><b>(*)</b> harus diisi !</i>
                                    <ul class="nav navbar-right panel_toolbox"></ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                <div class="picture-container">
                                    <div class="row">
                                        <div
                                            class="form-group col-md-12 <?php if (!empty(form_error('npwp'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Nomor NPWP', 'npwp', $label); ?>
                                            <?php echo form_input(isset($npwp) ? $npwp : ""); ?>
                                        </div><!-- /.form-group -->
                                    </div>

                                    <div class="picture" data-toggle="wizard-radio" rel="tooltip" title="Upload File Hasil Scan NPWP">
                                        <a href="<?php echo base_url('uploads/personal/npwp/'.$comp_code.'/'); ?><?=(isset($url_npwp) ? $url_npwp : "")?>" target="_blank"><img src="<?php echo base_url('uploads/personal/npwp/'.$comp_code.'/'); ?><?=(isset($url_npwp) ? $url_npwp : "")?>" width="100%" class="picture-src m-b-20" id="wizardPicturePreview" title=""/></a>
                                        <input type="file" id="wizard-picture" name="foto_npwp">
                                        <input type="hidden" class="form-control" id="url_npwp" name="url_npwp" value="<?=(isset($url_npwp) ? $url_npwp: "")?>" >
                                    </div>
                                    <h6>Upload File Hasil Scan NPWP</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="x_panel">
                                <div class="x_title">
                                    <i class="fa fa-info-circle"></i> <i><b>(*)</b> harus diisi !</i>
                                    <ul class="nav navbar-right panel_toolbox"></ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="picture-container">
                                        <div class="row">
                                            <div
                                                class="form-group col-md-12 <?php if (!empty(form_error('no_bpjstk'))) echo 'has-error'; ?>">
                                                <?php echo form_label('Nomor BPJS Ketenagakerjaan', 'no_bpjstk', $label); ?>
                                                <?php echo form_input(isset($no_bpjstk) ? $no_bpjstk : ""); ?>
                                            </div><!-- /.form-group -->
                                        </div>

                                        <div class="picture" data-toggle="wizard-radio" rel="tooltip" title="Upload File Hasil Scan BPJS Ketenagakerjaan">
                                            <a href="<?php echo base_url('uploads/personal/bpjs_tk/'.$comp_code.'/'); ?><?=(isset($url_bpjstk) ? $url_bpjstk : "")?>" target="_blank"><img src="<?php echo base_url('uploads/personal/bpjs_tk/'.$comp_code.'/'); ?><?=(isset($url_bpjstk) ? $url_bpjstk : "")?>" width="100%" class="picture-src m-b-20" id="wizardPicturePreview" title=""/></a>
                                            <input type="file" id="wizard-picture" name="foto_bpjs_tk">
                                            <input type="hidden" class="form-control" id="url_bpjstk" name="url_bpjstk" value="<?=(isset($url_bpjstk) ? $url_bpjstk: "")?>" >
                                        </div>
                                        <h6>Upload File Hasil Scan BPJS Ketenagakerjaan</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="x_panel">
                                <div class="x_title">
                                    <i class="fa fa-info-circle"></i> <i><b>(*)</b> harus diisi !</i>
                                    <ul class="nav navbar-right panel_toolbox"></ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="picture-container">
                                        <div class="row">
                                            <div
                                                class="form-group col-md-12 <?php if (!empty(form_error('no_bpjskes'))) echo 'has-error'; ?>">
                                                <?php echo form_label('Nomor BPJS Kesehatan', 'no_bpjskes', $label); ?>
                                                <?php echo form_input(isset($no_bpjskes) ? $no_bpjskes : ""); ?>
                                            </div><!-- /.form-group -->
                                        </div>

                                        <div class="picture" data-toggle="wizard-radio" rel="tooltip" title="Upload File Hasil Scan BPJS Kesehatan">
                                            <a href="<?php echo base_url('uploads/personal/bpjs_kes/'.$comp_code.'/'); ?><?=(isset($url_bpjskes) ? $url_bpjskes : "")?>" target="_blank"><img src="<?php echo base_url('uploads/personal/bpjs_kes/'.$comp_code.'/'); ?><?=(isset($url_bpjskes) ? $url_bpjskes : "")?>" width="100%" class="picture-src m-b-20" id="wizardPicturePreview" title=""/></a>
                                            <input type="file" id="wizard-picture" name="foto_bpjs_kes">
                                            <input type="hidden" class="form-control" id="url_bpjskes" name="url_bpjskes" value="<?=(isset($url_bpjskes) ? $url_bpjskes: "")?>" >
                                        </div>
                                        <h6>Upload File Hasil Scan BPJS Kesehatan</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="x_panel">
                                <div class="x_title">
                                    <i class="fa fa-info-circle"></i> <i><b>(*)</b> harus diisi !</i>
                                    <ul class="nav navbar-right panel_toolbox"></ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="picture-container">
                                        <div class="row">
                                            <div
                                                class="form-group col-md-12 <?php if (!empty(form_error('no_aia'))) echo 'has-error'; ?>">
                                                <?php echo form_label('Nomor AIA', 'no_aia', $label); ?>
                                                <?php echo form_input(isset($no_aia) ? $no_aia : ""); ?>
                                            </div><!-- /.form-group -->
                                        </div>

                                        <div class="picture" data-toggle="wizard-radio" rel="tooltip" title="Upload File Hasil Scan AIA">
                                            <a href="<?php echo base_url('uploads/personal/aia/'.$comp_code.'/'); ?><?=(isset($url_aia) ? $url_aia : "")?>" target="_blank"><img src="<?php echo base_url('uploads/personal/aia/'.$comp_code.'/'); ?><?=(isset($url_aia) ? $url_aia : "")?>" width="100%" class="picture-src m-b-20" id="wizardPicturePreview" title=""/></a>
                                            <input type="file" id="wizard-picture" name="foto_aia">
                                            <input type="hidden" class="form-control" id="url_aia" name="url_aia" value="<?=(isset($url_aia) ? $url_aia: "")?>" >
                                        </div>
                                        <h6>Upload File Hasil Scan AIA</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="x_panel">
                                <div class="x_title">
                                    <i class="fa fa-info-circle"></i> <i><b>(*)</b> harus diisi !</i>
                                    <ul class="nav navbar-right panel_toolbox"></ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="picture-container">
                                        <div class="row">
                                            <div
                                                class="form-group col-md-12 <?php if (!empty(form_error('no_asuransi'))) echo 'has-error'; ?>">
                                                <?php echo form_label('Nomor Asuransi', 'no_asuransi', $label); ?>
                                                <?php echo form_input(isset($no_asuransi) ? $no_asuransi : ""); ?>
                                            </div><!-- /.form-group -->
                                        </div>

                                        <div class="picture" data-toggle="wizard-radio" rel="tooltip" title="Upload File Hasil Scan Asuransi">
                                            <a class="m=b-10" href="<?php echo base_url('uploads/personal/asuransi/'.$comp_code.'/'); ?><?=(isset($url_asuransi) ? $url_asuransi : "")?>" target="_blank"><img src="<?php echo base_url('uploads/personal/asuransi/'.$comp_code.'/'); ?><?=(isset($url_asuransi) ? $url_asuransi : "")?>" width="100%" class="picture-src m-b-20" id="wizardPicturePreview" title=""/></a>
                                            <input type="file" id="wizard-picture" name="foto_asuransi">
                                            <input type="hidden" class="form-control" id="url_asuransi" name="url_asuransi" value="<?=(isset($url_asuransi) ? $url_asuransi: "")?>" >
                                        </div>
                                        <h6>Upload File Hasil Scan Asuransi</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <i class="fa fa-info-circle"></i> <i><b>(*)</b> harus diisi !</i>
                                    <ul class="nav navbar-right panel_toolbox"></ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-12">
                                        <h4><b>Penyesuian Jumlah Cuti Tahunan</b></h4>
                                    </div>
                                    <?php 
                                    echo form_input(isset($hid_cutiadjustment) ? $hid_cutiadjustment : "");
                                    ?>
                                    <table id="dt-listCutiAdjustment"
                                        class="table table-hover table-striped table-bordered table-condensed table-responsive db">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Periode</th>
                                            <th>Jumlah Cuti</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Akhir</th>
                                            <th class="text-center">
                                                <button id="btn-tambahcutiadjustment" class="btn btn-default btn-sm" type="button">
                                                    <span class="fa fa-plus"></span> Tambah
                                                </button>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($cutiadjustment as $valcuti){ ?>
                                                <tr data-id="<?php echo $valcuti->seq; ?>">
                                                    <td><?php echo $valcuti->seq; ?></td>
                                                    <td><?php echo $valcuti->periode; ?></td>
                                                    <td><?php echo $valcuti->jml_cuti; ?></td>
                                                    <td><?php echo $valcuti->remark_adj; ?></td>
                                                    <td><?php echo $valcuti->start_adj; ?></td>
                                                    <td><?php echo $valcuti->end_adj; ?></td>
                                                    <td align="text-center">
                                                        <a href='#' class='btncutiadj-edititem' title='Edit penyesuaian cuti'><span class='fa fa-fw fa-pencil'></span></a>
                                                        <a href='#' class='btncutiadj-removeitem' title='Hapus penyesuaian cuti dari list'><span class='fa fa-fw fa-trash'></span></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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

                    <div class="form-group m-b-0">
                        <a href="<?php echo site_url("reference/employee") ?>"
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
                            <div
                                class="form-group col-md-12 <?php if (!empty(form_error('id_tp'))) echo 'has-error'; ?>">
                                <?php echo form_label('Jadwal Kerja *', 'id_tp', $label); ?>
                                <?php echo form_dropdown(isset($id_tp) ? $id_tp : "") ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 <?php if (!empty(form_error('tgl_akhir_jadwal'))) echo 'has-error'; ?>">
                            <?php echo form_label('Tanggal Mulai *', 'tgl_mulai_jadwal', $label); ?>    
                                <div class="input-group">    
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="tgl_mulai_jadwal" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 <?php if (!empty(form_error('tgl_akhir_jadwal'))) echo 'has-error'; ?>">
                                <?php echo form_label('Tanggal Akhir *', 'tgl_akhir_jadwal', $label); ?>
                                <div class="input-group">    
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="tgl_akhir_jadwal" class="form-control"/>
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

<!-- modal-keluarga -->
<div class="modal fade" id="modal_keluarga" tabindex="-1" role="dialog" aria-labelledby="modal-keluarga" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">Isian Data Keluarga</h4>
            </div>
            <div class="modal-body overflow-edit">

                <div class="row">
                    <div class="box-body">

                        <div class="row">
                            <div class="form-group col-md-12 <?php if (!empty(form_error('nama_kel'))) echo 'has-error'; ?>">
                            <?php echo form_label('Nama *', 'nama_kel', $label); ?>    
                                <input type="text" id="nama_kel" class="form-control"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12 <?php if (!empty(form_error('relasi_kel'))) echo 'has-error'; ?>">
                            <?php echo form_label('Hubungan Keluarga *', 'relasi_kel', $label); ?>    
                                <input type="text" id="relasi_kel" class="form-control"/>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="box-body">
                        <button id="btn-pilihkeluarga" class="btn btn-primary pull-right">
                            <span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Tambahkan Keluarga
                        </button>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div><!-- /.modal-keluarga -->



<!-- modal-cutiadjustment -->
<div class="modal fade" id="modal-cutiadjustment" tabindex="-1" role="dialog" aria-labelledby="modal-cutiadjustment" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">Isian Penyesuaian Cuti</h4>
            </div>
            <div class="modal-body overflow-edit">

                <div class="row">
                    <div class="box-body">
                    
                        <div class="row">
                            <div class="form-group col-md-6 <?php if (!empty(form_error('periode'))) echo 'has-error'; ?>">
                            <?php echo form_label('Tahun *', 'periode', $label); ?>    
                                <input type="text" id="periode" class="form-control"/>
                                <input type="hidden" id="seq_cutiadj"  class="form-control"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 <?php if (!empty(form_error('jml_cuti'))) echo 'has-error'; ?>">
                            <?php echo form_label('Jumlah Cuti Penyesuaian *', 'jml_cuti', $label); ?>    
                                <input type="text" id="jml_cuti" class="form-control"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 <?php if (!empty(form_error('remark_adj'))) echo 'has-error'; ?>">
                            <?php echo form_label('Keterangan *', 'remark_adj', $label); ?>    
                                <input type="text" id="remark_adj" class="form-control"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 <?php if (!empty(form_error('start_adj'))) echo 'has-error'; ?>">
                            <?php echo form_label('Tanggal Mulai *', 'start_adj', $label); ?>    
                                <div class="input-group">    
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="start_adj" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 <?php if (!empty(form_error('end_adj'))) echo 'has-error'; ?>">
                                <?php echo form_label('Tanggal Akhir *', 'end_adj', $label); ?>
                                <div class="input-group">    
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="end_adj" class="form-control"/>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="box-body">
                        <button id="btn-pilihcutiadjustment" class="btn btn-primary pull-right">
                            <span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Tambahkan Penyesuaian Cuti
                        </button>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div><!-- /.modal-jadwal -->


<!-- modal-atasan-langsung -->
<div class="modal fade" id="modal_peserta" tabindex="-1" role="dialog" aria-labelledby="modal-keluarga" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">Pilih Karyawan</h4>
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



