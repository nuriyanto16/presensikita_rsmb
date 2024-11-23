<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?= strtoupper($titlehead) ?></h4>
        </div>
        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><i class="icon-settings"></i> Master Data</li>
                <li>Company</li>
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
                                    type="button">
                                x
                            </button>
                            <?php echo (isset($errmsg) && $errmsg != "") ? $errmsg : $this->session->flashdata('errmsg'); ?>
                        </div>
                    <?php } ?>


                    <div class="row">
                        <div
                            class="form-group col-md-12 <?php if (!empty(form_error('COMP_CODE'))) echo 'has-error'; ?>">
                            <?php
                            echo form_label('Kode Perusahaan *', 'COMP_CODE', $label);
                            echo form_input(isset($COMP_CODE) ? $COMP_CODE : "");
                            ?>
                        </div><!-- /.form-group -->
                    </div>

                    <div class="row">
                        <div
                            class="form-group col-md-12 <?php if (!empty(form_error('COMP_NAME'))) echo 'has-error'; ?>">
                            <?php echo form_label('Nama Perusahaan *', 'COMP_NAME', $label);
                            echo form_input(isset($COMP_NAME) ? $COMP_NAME : "");
                            ?>
                        </div><!-- /.form-group -->
                    </div>

                    <div class="row">
                        <div
                            class="form-group col-md-12 <?php if (!empty(form_error('LONG'))) echo 'has-error'; ?>">
                            <?php
                            echo form_label('Longitude', 'LONG', $label);
                            echo form_input(isset($LONG) ? $LONG : "");
                            ?>
                        </div><!-- /.form-group -->
                    </div>

                    <div class="row">
                        <div
                            class="form-group col-md-12 <?php if (!empty(form_error('LAT'))) echo 'has-error'; ?>">
                            <?php
                            echo form_label('Latitude', 'LAT', $label);
                            echo form_input(isset($LAT) ? $LAT : "");
                            ?>
                        </div><!-- /.form-group -->
                    </div>

                    <div class="row">
                        <div 
                            class="form-group col-md-12  <?php if (!empty(form_error('ALAMAT'))) echo 'has-error'; ?>">
                            <?php echo form_label('Alamat Perusahaan *', 'ALAMAT', $label); ?>
                            <?php echo isset($ALAMAT) ? form_textarea($ALAMAT) : ""; ?>
                        </div>
                    </div>

                    <div class="row">
                        <div 
                            class="form-group col-md-7  <?php if (!empty(form_error('NAMA_ATASAN_HO'))) echo 'has-error'; ?>">
                                <?php echo form_label('Nama Approval HO ', 'NAMA_ATASAN_HO', $label); ?>
                                <?php echo isset($NAMA_ATASAN_HO) ? form_input($NAMA_ATASAN_HO) : ""; ?>
                                <?php echo isset($NIK_ATASAN_HO) ? form_input($NIK_ATASAN_HO) : ""; ?>
                        </div>
                        <div class="form-group col-md-3">
                            <?php echo form_label('&nbsp;', '', ''); ?>
                            <button id="btn-caripejabat"  class="btn btn-info" type="button">
                                <span class="fa fa-plus"></span> Cari Nama Atasan
                            </button>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <a href="<?php echo site_url("reference/company") ?>"
                           class="btn btn-default"
                           type="button"><span class="fa fa-arrow-left"></span> Kembali</a>
                        <button id="btn-save" type="submit" name="actionf" value="save"
                                class='btn btn-primary'>
                            <span class="fa fa-save"></span> Simpan
                        </button>
                        <input type="hidden" id="actionf" name="actionf" value="">
                    </div><!-- /.form-group -->
                </div>
                <input type="hidden" id="flag_pop" />
                <?php echo form_hidden('id', $id); ?>
                <?php echo form_hidden($csrf); ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

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
