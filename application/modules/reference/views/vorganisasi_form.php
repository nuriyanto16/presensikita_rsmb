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

        <div class="col-md-12 col-sm-12 col-xs-12">
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
                            class="form-group col-md-12 <?php if (!empty(form_error('COMPID'))) echo 'has-error'; ?>">
                            <?php echo form_label('Company *', 'COMPID', $label); ?>
                            <?php echo form_dropdown(isset($COMPID) ? $COMPID : "") ?>
                        </div>
                    </div>

                    <div class="row">
                        <div
                            class="form-group col-md-12 <?php if (!empty(form_error('parentUnitId'))) echo 'has-error'; ?>">
                            <?php echo form_label('Parent Org *', 'parentUnitId', $label); ?>
                            <div id="parentUnitId_container">
                            <?php echo form_dropdown(isset($parentUnitId) ? $parentUnitId : "") ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div
                            class="form-group col-md-6 <?php if (!empty(form_error('unitCode'))) echo 'has-error'; ?>">
                            <?php
                            echo form_label('Kode *', 'unitCode', $label);
                            echo form_input(isset($unitCode) ? $unitCode : "");
                            ?>
                        </div><!-- /.form-group -->
                        <div
                            class="form-group col-md-6 <?php if (!empty(form_error('unitAlias'))) echo 'has-error'; ?>">
                            <?php echo form_label('Alias', 'unitAlias', $label);
                            echo form_input(isset($unitAlias) ? $unitAlias : "");
                            ?>
                        </div><!-- /.form-group -->
                    </div>

                    <div class="row">
                        <div
                            class="form-group col-md-12 <?php if (!empty(form_error('unitName'))) echo 'has-error'; ?>">
                            <?php echo form_label('Nama *', 'unitName', $label);
                            echo form_input(isset($unitName) ? $unitName : "");
                            echo form_input(isset($multiple_kode_unit) ? $multiple_kode_unit : "");
                            ?>
                        </div><!-- /.form-group -->
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <?php echo form_label('&nbsp;', '', ''); ?>
                            <br/>
                            <button id="btn-carijadwal"  class="btn btn-info" type="button">
                                <span class="fa fa-plus"></span> Cari Jadwal
                            </button>
                        </div>
                    </div>

                    <div class="x_panel">
                        <div class="x_content">                             
                            <div class="row">
                            <div class="col-sm-12">
                                <h4><b>Detail Jadwal Kerja</b></h4>
                            </div>
                            <div class="col-sm-12">
                                <table id="dt-listjadwal" class="table table-striped table-responsive" width="100%"></table>
                            </div><!-- /.col-sm-12 -->
                            </div>
                        </div>
                    </div>

                    <!-- <div class="row">
                        <div
                            class="form-group col-md-12 <?php //if (!empty(form_error('costcenter_code'))) echo 'has-error'; ?>">
                            <?php //echo form_label('Cost Center', 'costcenter_code', $label); ?>
                            <?php //echo form_dropdown(isset($costcenter_code) ? $costcenter_code : "") ?>
                        </div>
                    </div> -->

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <a href="<?php echo site_url("reference/organisasi") ?>"
                           class="btn btn-default"
                           type="button"><span class="fa fa-arrow-left"></span> Kembali</a>
                        <button id="btn-save" type="submit" name="actionf" value="save"
                                class='btn btn-primary'>
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

<!-- modal-atasan-langsung -->
<div class="modal fade" id="modal_jadwal" tabindex="-1" role="dialog" aria-labelledby="modal_jadwal" aria-hidden="true">
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
                    <table id="dt-list" class="table table-striped table-responsive" width="100%"></table>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
</div><!-- modal-atasan-langsung -->
