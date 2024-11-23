
<meta charset="utf-8">

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?= strtoupper($titlehead) ?></h4>
        </div>
        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><i class="icon-settings"></i> Presensi</li>
                <li>Lembur</li>
                <li class="active"><?= ($titlehead) ?></li>
            </ol>
        </div>
    </div>

    <div class="clearfix"></div>
    <?php echo form_open(uri_string(), array('id' => 'fmain', 'name' => 'fmain', 'class' => 'form', 'enctype' => 'multipart/form-data')); ?>
    <div class="row">
        <?php
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
                    $style_disabled = ($sts_aju_validate > 0) ? "pointer-events: none;" : "";
                    ?>

                    <div style="<?= $style_disabled ?>">
                        
                    <div class="row">
                            <div class="col-md-12 <?php if (!empty(form_error('nik'))) echo 'has-error'; ?>">
                                <?php echo form_label('NIK *', 'nik', $label); ?>
                            </div>
                            <div class="form-group col-md-10">
                                <?php echo form_input($nik); ?>
                                <?php echo form_input($nik_pegawai); ?>
                            </div>
                            <div class="form-group col-md-2" style="<?php echo ($role_id==4) ? "display:none;" : "display:block;";?>">
                                <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal_list_pegawai"><span class="fa fa-search"></span></a>
                            </div>
                        </div>

                        <div class="row">
                            <div
                                class="form-group col-md-12 <?php if (!empty(form_error('emp_name'))) echo 'has-error'; ?>">
                                <?php echo form_label('Nama *', 'emp_name', $label) ?>
                                <?php
                                echo form_input($emp_name);
                                ?>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div
                                class="form-group col-md-12 <?php if (!empty(form_error('position'))) echo 'has-error'; ?>">
                                <?php echo form_label('Jabatan *', 'position', $label) ?>
                                <?php
                                echo form_input($position);
                                ?>
                            </div>
                        </div>

                        <div class="row">
                            <div
                                class="form-group col-md-12 <?php if (!empty(form_error('unit'))) echo 'has-error'; ?>">
                                <?php echo form_label('Unit *', 'unit', $label) ?>
                                <?php echo form_input($unit); ?>
                            </div>
                        </div>

                        <div class="row">
                            <div
                                class="form-group col-md-12 <?php if (!empty(form_error('compid'))) echo 'has-error'; ?>">
                                <?php echo form_label('Instansi *', 'compid', $label) ?>
                                <?php 
                                echo form_input($comp_name);
                                echo form_input($compid);
                                ?>
                            </div><!-- /.col -->
                        </div><!-- /.form-group -->

                        <div class="row">
                            <div
                                class="form-group col-md-12 <?php if (!empty(form_error('start_date'))) echo 'has-error'; ?>">
                                <?php echo form_label('Tanggal', 'start_date', $label); ?>
                                <?php echo form_input(isset($start_date) ? $start_date : ""); ?>
                            </div><!-- /.form-group -->
                        </div>

                        <div class="row">
                            <div
                                class="form-group col-md-6 <?php if (!empty(form_error('start_time'))) echo 'has-error'; ?>">
                                <?php echo form_label('Jam Mulai *', 'start_time', $label); ?>
                                <?php echo form_input(isset($start_time) ? $start_time : ""); ?>
                            </div><!-- /.form-group -->
                            <div
                                class="form-group col-md-6 <?php if (!empty(form_error('end_time'))) echo 'has-error'; ?>">
                                <?php echo form_label('Jam Selesai *', 'end_time', $label); ?>
                                <?php echo form_input(isset($end_time) ? $end_time : ""); ?>
                            </div><!-- /.form-group -->
                        </div>

                        <div class="row">
                            <div
                                class="form-group col-md-12 <?php if (!empty(form_error('id_abs_type'))) echo 'has-error'; ?>">
                                <?php echo form_label('Status Pekerjaan *', 'id_abs_type', $label); ?>
                                <?php echo form_dropdown(isset($id_abs_type) ? $id_abs_type : "") ?>
                            </div>
                        </div>
                   
                        <div class="row">
                            <div 
                                class="form-group col-md-12  <?php if (!empty(form_error('remark'))) echo 'has-error'; ?>">
                                    <?php echo form_label('Deskripsi Pekerjaan *', 'remark', $label); ?>
                                    <?php echo isset($remark) ? form_textarea($remark) : ""; ?>
                            </div>
                        </div>

                        <div class="row">
                            <div
                                class="form-group col-md-12 <?php if (!empty(form_error('pj'))) echo 'has-error'; ?>">
                                <?php echo form_label('Penanggung Jawab *', 'pj', $label); ?>
                                <?php echo form_input(isset($pj) ? $pj : ""); ?>
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
                        <?php echo isset($sts_aju) ? form_input($sts_aju) : ""; ?>
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
                        <a href="<?php echo site_url("presensi/lembur") ?>"
                           class="btn btn-default"
                           type="button"><span class="fa fa-arrow-left"></span> Kembali</a>

                           <?php if (isset($show_save_btn) && $show_save_btn === TRUE): ?>
                           <button id="btn-save" type="button" value="save"
                                   class='btn btn-primary'>
                               <span class="fa fa-save"></span> Simpan
                           </button>
                           <?php endif; ?>
                           <?php if (isset($show_approve_btn) && $show_approve_btn === TRUE): ?>
                               <button id="btn-approve" type="button"  value="approve"
                                       class='btn btn-success'>
                                   <span class="fa fa-check"></span> Setuju
                               </button>
                           <?php endif; ?>
                           <?php if (isset($show_reject_btn) && $show_reject_btn === TRUE): ?>
                               <button id="btn-reject" type="button"  value="reject"
                                       class='btn btn-danger'>
                                   <span class="fa fa-remove"></span> Tidak Setuju
                               </button>
                           <?php endif; ?>


                           <!-- Approval 2 -->
                           <?php if (isset($show_approve_btn_ho) && $show_approve_btn_ho === TRUE): ?>
                               <button id="btn-approve-ho" type="button"  value="approve-ho"
                                       class='btn btn-success'>
                                   <span class="fa fa-check"></span> Setuju (HO)
                               </button>
                           <?php endif; ?>
                           <?php if (isset($show_reject_btn_ho) && $show_reject_btn_ho === TRUE): ?>
                               <button id="btn-reject-ho" type="button"  value="reject-ho"
                                       class='btn btn-danger'>
                                   <span class="fa fa-remove"></span> Tidak Setuju (HO)
                               </button>
                           <?php endif; ?>
                           
                           <input type="hidden" id="actionf" name="actionf" value="">
                           <input type="hidden" id="dtx_slc">
                    </div><!-- /.form-group -->

                </div>


                <?php echo form_hidden('id', $id); ?>
                <?php echo form_hidden($csrf); ?>
                
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<!-- The Modal -->
<div id="myModalZoomImg" class="modal">
  <!-- The Close Button -->
  <span class="close">&times;</span>
  <!-- Modal Content (The Image) -->
  <img class="modal-content-zoom" id="img01">
  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>

<!-- modal Popup list pegawai -->
<div class="modal fade bd-example-modal-lg" id="modal_list_pegawai" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
                <h4 class="modal-title custom_align" id="Heading">List Pegawai</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="dt-listkaryawan" class="table table-striped table-responsive"  width="100%">
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>