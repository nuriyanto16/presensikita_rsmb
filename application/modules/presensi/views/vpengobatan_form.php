<meta charset="utf-8">

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?= strtoupper($titlehead) ?></h4>
        </div>
        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><i class="icon-settings"></i> Master Data</li>
                <li>Jadwal Kerja</li>
                <li class="active"><?= ($titlehead) ?></li>
            </ol>
        </div>
    </div>

    <div class="clearfix"></div>

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

        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <i class="fa fa-info-circle"></i> <i><b>(*)</b> harus diisi !</i>
                    <ul class="nav navbar-right panel_toolbox"></ul>
                    <div class="clearfix"></div>
                </div> 
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

                    <?php 
                    //pointer-events: none;
                    $style_disabled = ($sts_aju_validate > 0) ? "pointer-events: none;" : "";
                    ?>

                    <div style="<?= $style_disabled ?>">
                        <div class="row">
                            <div
                                class="form-group col-md-12 <?php if (!empty(form_error('compid'))) echo 'has-error'; ?>">
                                <?php echo form_label('Company *', 'compid', $label); ?>
                                <?php echo form_dropdown(isset($compid) ? $compid : "") ?>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div
                                class="form-group col-md-12 <?php if (!empty(form_error('nik'))) echo 'has-error'; ?>">
                                <?php echo form_label('Karyawan *', 'nik', $label); ?>
                                <?php echo form_dropdown(isset($nik) ? $nik : "") ?>
                            </div><!-- /.form-group -->
                        </div>
                        

                        <div class="row">
                            <div
                                class="form-group col-md-12 <?php if (!empty(form_error('nama_kuitansi'))) echo 'has-error'; ?>">
                                <?php echo form_label('Nama Kuitansi *', 'nama_kuitansi', $label); ?>
                                <?php echo form_dropdown(isset($nama_kuitansi) ? $nama_kuitansi : "") ?>
                            </div><!-- /.form-group -->
                        </div>

                        <div class="row">
                            <div
                                class="form-group col-md-12 <?php if (!empty(form_error('pengobatan_id'))) echo 'has-error'; ?>">
                                <?php echo form_label('Jenis Pengobatan *', 'pengobatan_id', $label); ?>
                                <?php echo form_dropdown(isset($pengobatan_id) ? $pengobatan_id : "") ?>
                            </div>
                        </div>
                   
                        <div class="row">
                            <div 
                                class="form-group col-md-12  <?php if (!empty(form_error('diagnosa'))) echo 'has-error'; ?>">
                                    <?php echo form_label('Diagnosa/Keterangan *', 'diagnosa', $label); ?>
                                    <?php echo isset($diagnosa) ? form_textarea($diagnosa) : ""; ?>
                            </div>
                        </div>

                        <div class="row">
                            <div
                                class="form-group col-md-12 <?php if (!empty(form_error('tgl_kuitansi'))) echo 'has-error'; ?>">
                                <?php echo form_label('Tanggal Kuitansi *', 'tgl_kuitansi', $label); ?>
                                <?php echo form_input(isset($tgl_kuitansi) ? $tgl_kuitansi : ""); ?>
                            </div><!-- /.form-group -->
                        </div>

                        <div class="row">
                            <div
                                class="form-group col-md-12 <?php if (!empty(form_error('nom_kuitansi'))) echo 'has-error'; ?>">
                                <?php echo form_label('Nominal Kuitansi *', 'nom_kuitansi', $label);
                                echo form_input(isset($nom_kuitansi) ? $nom_kuitansi : "");
                                ?>
                            </div><!-- /.form-group -->
                        </div>

                        <div class="row">
                            <div
                                class="form-group col-md-12 <?php if (!empty(form_error('nilai_diganti'))) echo 'has-error'; ?>">
                                <?php echo form_label('Nilai Yang Diganti *', 'nilai_diganti', $label);
                                echo form_input(isset($nilai_diganti) ? $nilai_diganti : "");
                                ?>
                            </div><!-- /.form-group -->
                        </div>


                        <?php if($sts_aju_validate != "") { ?>
                        <div class="row">
                            <div 
                                class="form-group col-md-12  <?php if (!empty(form_error('app_ket'))) echo 'has-error'; ?>">
                                <?php echo form_label('Catatan Approval *', 'app_ket', $label); ?>
                                <?php echo isset($app_ket) ? form_textarea($app_ket) : ""; ?>
                            </div>
                        </div>
                        <?php } ?>

                    </div>

                        <div class="row">
                            <?php echo form_input(isset($hid_detail_attachment) ? $hid_detail_attachment : ""); ?>
                        </div>

                        <div class="row">
                            <?php echo isset($emp_nik) ? form_input($emp_nik) : ""; ?>
                            <?php echo isset($sts_aju) ? form_input($sts_aju) : ""; ?>
                            <?php echo isset($app_nik) ? form_input($app_nik) : ""; ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="input-field">
                                <label class="active">Lampiran</label>
                                <div class="input-images-1" style="padding-top: .5rem;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <a href="<?php echo site_url("presensi/izin") ?>"
                           class="btn btn-default"
                           type="button"><span class="fa fa-arrow-left"></span> Kembali</a>

                           <?php if (isset($show_save_btn) && $show_save_btn === TRUE): ?>
                           <button id="btn-save" type="button" name="actionf" value="save"
                                   class='btn btn-primary'>
                               <span class="fa fa-save"></span> Simpan
                           </button>
                           <?php endif; ?>
                           <?php if (isset($show_approve_btn) && $show_approve_btn === TRUE): ?>
                               <button id="btn-approve" type="button" name="actionf" value="approve"
                                       class='btn btn-success'>
                                   <span class="fa fa-check"></span> Setuju
                               </button>
                           <?php endif; ?>
                           <?php if (isset($show_reject_btn) && $show_reject_btn === TRUE): ?>
                               <button id="btn-reject" type="button" name="actionf" value="reject"
                                       class='btn btn-danger'>
                                   <span class="fa fa-remove"></span> Tidak Setuju
                               </button>
                           <?php endif; ?>
                           <input type="hidden" id="actionf" name="actionf" value="">
                           <input type="hidden" id="dtx_slc">
                    </div><!-- /.form-group -->
                </div>


                <?php echo form_hidden('id', $id); ?>
                <?php echo form_hidden($csrf); ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div id="myModalZoomImg" class="modal">
  <!-- The Close Button -->
  <span class="close">&times;</span>
  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">
  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>