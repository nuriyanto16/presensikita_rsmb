
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

                    <div class="row">
                        <div
                            class="form-group col-md-12 <?php if (!empty(form_error('compid'))) echo 'has-error'; ?>">
                            <?php echo form_label('Company *', 'compid', $label); ?>
                            <?php echo form_dropdown(isset($compid) ? $compid : "") ?>
                        </div>
                    </div>

                    <div class="row">
                        <div
                            class="form-group col-md-12 <?php if (!empty(form_error('id_menu'))) echo 'has-error'; ?>">
                            <?php echo form_label('Menu *', 'id_menu', $label); ?>
                            <?php echo form_dropdown(isset($id_menu) ? $id_menu : "") ?>
                        </div>
                    </div>

                    <div class="row">
                        <div
                            class="form-group col-md-12 <?php if (!empty(form_error('remark'))) echo 'has-error'; ?>">
                            <?php echo form_label('Remark ', 'remark', $label);
                            echo form_input(isset($remark) ? $remark : ""); 
                            ?>
                        </div><!-- /.form-group -->
                    </div>

                    <div class="row">
                        <div
                            class="form-group col-md-12 <?php if (!empty(form_error('start_date'))) echo 'has-error'; ?>">
                            <?php echo form_label('Tanggal Awal ', 'start_date', $label);
                            echo form_input(isset($start_date) ? $start_date : ""); 
                            ?>
                        </div><!-- /.form-group -->
                    </div>

                    <div class="row">
                        <div
                            class="form-group col-md-12 <?php if (!empty(form_error('end_date'))) echo 'has-error'; ?>">
                            <?php echo form_label('Tanggal Akhir ', 'end_date', $label);
                            echo form_input(isset($end_date) ? $end_date : "");
                            ?>
                        </div><!-- /.form-group -->
                    </div>
                    
                    <div class="row">

                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <a href="<?php echo site_url("reference/settingpresensi") ?>"
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