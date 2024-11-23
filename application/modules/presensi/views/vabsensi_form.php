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
                                    type="button"> x
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
                            class="form-group col-md-6 <?php if (!empty(form_error('nik'))) echo 'has-error'; ?>">
                            <?php echo form_label('NIK *', 'nik', $label); ?>
                            <?php echo form_input(isset($nik) ? $nik : ""); ?>
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
                            class="form-group col-md-12 <?php if (!empty(form_error('position_code'))) echo 'has-error'; ?>">
                            <?php echo form_label('Posisi / Jabatan *', 'position_code', $label); ?>
                            <?php echo form_dropdown(isset($position_code) ? $position_code : "") ?>
                        </div><!-- /.form-group -->
                    </div>

                    <div class="row">
                        <div
                            class="form-group col-md-12 <?php if (!empty(form_error('unitId'))) echo 'has-error'; ?>">
                            <?php echo form_label('Organisasi *', 'unitId', $label); ?>
                            <?php echo form_dropdown(isset($unitId) ? $unitId : "") ?>
                        </div><!-- /.form-group -->
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <a href="<?php echo site_url("reference/employee") ?>"
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
