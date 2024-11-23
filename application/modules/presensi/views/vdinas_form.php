
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
        <div class="col-md-12 col_tabs">
            <div class="x_panel">
                <div class="x_content">
                    <div class="row">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-info-circle" aria-hidden="true"></i> Info Umum</a></li>
                                <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-hotel" aria-hidden="true"></i> Akomodasi</a></li>
                                <li><a href="#tab_3" data-toggle="tab"><i class="fa fa-user" aria-hidden="true"></i> Peserta Lain</a></li>
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

        <?php 
            $style_disabled =  ($sts_aju_validate > 0) ? "pointer-events: none;" : "";
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
                                        class="form-group col-md-6 <?php if (!empty(form_error('tgl_brkt'))) echo 'has-error'; ?>">
                                        <?php echo form_label('Tanggal Mulai *', 'tgl_brkt', $label); ?>
                                        <?php echo form_input(isset($tgl_brkt) ? $tgl_brkt : ""); ?>
                                    </div><!-- /.form-group -->
                                    <div
                                        class="form-group col-md-6 <?php if (!empty(form_error('tgl_plng'))) echo 'has-error'; ?>">
                                        <?php echo form_label('Tanggal Akhir *', 'tgl_plng', $label); ?>
                                        <?php echo form_input(isset($tgl_plng) ? $tgl_plng : ""); ?>
                                    </div><!-- /.form-group -->
                                </div>

                                <div class="row">
                                    <div
                                        class="form-group col-md-12 <?php if (!empty(form_error('jml'))) echo 'has-error'; ?>">
                                        <?php echo form_label('Jumlah Hari ', 'jml', $label);
                                        echo form_input(isset($jml) ? $jml : "");
                                        ?>
                                    </div><!-- /.form-group -->
                                </div>

                                <div class="row">
                                    <div 
                                        class="form-group col-md-7  <?php if (!empty(form_error('nm_pejabat'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Nama Pejabat *', 'nm_pejabat', $label); ?>
                                            <?php echo isset($nm_pejabat) ? form_input($nm_pejabat) : ""; ?>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <?php echo form_label('&nbsp;', '', ''); ?>
                                        <button id="btn-caripejabat"  class="btn btn-info" type="button">
                                            <span class="fa fa-plus"></span> Cari Nama Pejabat
                                        </button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div 
                                        class="form-group col-md-12  <?php if (!empty(form_error('jabatan'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Jabatan *', 'jabatan', $label); ?>
                                            <?php echo isset($jabatan) ? form_input($jabatan) : ""; ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div 
                                        class="form-group col-md-12  <?php if (!empty(form_error('tujuan'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Tujuan *', 'tujuan', $label); ?>
                                            <?php echo isset($tujuan) ? form_input($tujuan) : ""; ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div 
                                        class="form-group col-md-12  <?php if (!empty(form_error('keperluan'))) echo 'has-error'; ?>">
                                            <?php echo form_label('Keperluan *', 'keperluan', $label); ?>
                                            <?php echo isset($keperluan) ? form_input($keperluan) : ""; ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label> ALLOWANCE </label>
                                        <br/>
                                        <?php echo form_input(isset($all_bdgjkt) ? $all_bdgjkt : ""); ?>
                                        <label> Bandung - Jakarta </label>
                                        <br/>
                                        <?php echo form_input(isset($all_lr_kota) ? $all_lr_kota : ""); ?>
                                        <label> Luar Kota </label>
                                        <br/>
                                        <?php echo form_input(isset($all_lr_negeri) ? $all_lr_negeri : ""); ?>
                                        <label> Luar Negeri </label>
                                    </div>
                               
                                    <div class="form-group col-md-6">
                                        <label> KEBUTUHAN TRANSPORTASI</label>
                                        <br/>
                                        <?php echo form_input(isset($tr_k_pribadi) ? $tr_k_pribadi : ""); ?>
                                        <label> Kendaraan Pribadi </label>
                                        <br/>
                                        <?php echo form_input(isset($tr_k_dinas) ? $tr_k_dinas : ""); ?>
                                        <label> Kendaraan Dinas </label>
                                        <br/>
                                        <?php echo form_input(isset($tr_ka) ? $tr_ka : ""); ?>
                                        <label> Kereta Api </label>
                                        <br/>
                                        <?php echo form_input(isset($tr_pesawat) ? $tr_pesawat : ""); ?>
                                        <label> Pesawat</label>
                                        <br/>
                                        <?php echo form_input(isset($tr_travel) ? $tr_travel : ""); ?>
                                        <label> Travel </label>
                                        <br/>
                                        <?php echo form_input(isset($tr_bus) ? $tr_bus : ""); ?>
                                        <label> Bus </label>
                                    </div>
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
                                <input type="hidden" id="flag_pop" />
                                <?php echo isset($sts_aju) ? form_input($sts_aju) : ""; ?>
                                <?php echo isset($app_nik) ? form_input($app_nik) : ""; ?>
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
                            <div style="<?= $style_disabled ?>">
                                <div class="row">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Hotel </h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <!-- text input -->
                                        <div class="form-group col-md-2" >
                                            <?php echo form_label('Ceklis ', 'ak_hotel', $label);
                                            echo form_input(isset($ak_hotel) ? $ak_hotel : "");
                                            ?>
                                        </div>
                                        <div class="form-group col-md-10">
                                            <?php echo form_label('Nominal ', 'ak_hotel_nom', $label);
                                            echo form_input(isset($ak_hotel_nom) ? $ak_hotel_nom : "");
                                            ?>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <?php echo form_label('Keterangan ', 'ak_hotel_ket', $label);
                                            echo form_textarea(isset($ak_hotel_ket) ? $ak_hotel_ket : "");
                                            ?>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
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
                            <div style="<?= $style_disabled ?>">
                                <div class="row">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Transportasi</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <!-- text input -->
                                        <div class="form-group col-md-2" >
                                            <?php echo form_label('Ceklis ', 'ak_tr_loc', $label);
                                            echo form_input(isset($ak_tr_loc) ? $ak_tr_loc : "");
                                            ?>
                                        </div>
                                        <div class="form-group col-md-10">
                                            <?php echo form_label('Nominal ', 'ak_tr_loc_nom', $label);
                                            echo form_input(isset($ak_tr_loc_nom) ? $ak_tr_loc_nom : "");
                                            ?>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <?php echo form_label('Keterangan ', 'ak_tr_loc_ket', $label);
                                            echo form_textarea(isset($ak_tr_loc_ket) ? $ak_tr_loc_ket : "");
                                            ?>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
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
                            <div style="<?= $style_disabled ?>">
                                <div class="row">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Suspense</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <!-- text input -->
                                        <div class="form-group col-md-2" >
                                            <?php echo form_label('Ceklis ', 'ak_susp', $label);
                                            echo form_input(isset($ak_susp) ? $ak_susp : "");
                                            ?>
                                        </div>
                                        <div class="form-group col-md-10">
                                            <?php echo form_label('Nominal ', 'ak_susp_nom', $label);
                                            echo form_input(isset($ak_susp_nom) ? $ak_susp_nom : "");
                                            ?>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <?php echo form_label('Keterangan ', 'ak_susp_ket', $label);
                                            echo form_textarea(isset($ak_susp_ket) ? $ak_susp_ket : "");
                                            ?>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab_3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="x_panel">
                            <div class="x_title">
                                <i class="fa fa-info-circle"></i> <i><b>(*)</b> harus diisi !</i>
                                <ul class="nav navbar-right panel_toolbox"></ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                            <div style="<?= $style_disabled ?>">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-12">
                                            <h4><b>Detail Data Peserta</b></h4>
                                        </div>
                                        <?php 
                                        echo form_input(isset($hid_peserta) ? $hid_peserta : "");
                                        ?>
                                        <table id="dt-listPeserta"
                                            class="table table-hover table-striped table-bordered table-condensed">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIK</th>
                                                <th>Nama Karyawan</th>
                                                <th class="text-center">
                                                    <button id="btn-tambahpeserta"  class="btn btn-info" type="button">
                                                        <span class="fa fa-plus"></span> Tambah
                                                    </button>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($peserta as $valpsrt){ ?>
                                                    <tr data-id="<?php echo $valpsrt->SEQ; ?>">
                                                        <td><?php echo $valpsrt->SEQ; ?></td>
                                                        <td><?php echo $valpsrt->NIK; ?></td>
                                                        <td><?php echo $valpsrt->NAMA; ?></td>
                                                        <td align="text-center"><a href='#' class='btn-peserta-removeitem' title='Hapus Peserta dari list'><span class='fa fa-fw fa-trash'></span></a></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div><!-- /.col-sm-12 -->
                                </div><!-- /.row -->
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="col-md-6 col-sm-12 col-xs-12">
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
                        <a href="<?php echo site_url("presensi/pelatihan") ?>"
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

<div class="modal fade" id="modal_peserta" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content-list" id="img01">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Pilih Peserta</h4>
            </div>
            <div class="modal-body">
                <table id="dt-list" class="table table-striped table-responsive"  width="100%">
                </table>
            </div>
        </div>
    </div>
    <!-- Modal content-->
</div>