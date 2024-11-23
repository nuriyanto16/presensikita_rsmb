
<meta charset="utf-8">

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?= strtoupper($titlehead) ?></h4>
        </div>
        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><i class="icon-settings"></i> Master Data</li>
                <li>Setting Hari Libur</li>
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
                            class="form-group col-md-12 <?php if (!empty(form_error('nama_kantor'))) echo 'has-error'; ?>">
                            <?php echo form_label('Nama Kantor ', 'nama_kantor', $label);
                            echo form_input(isset($nama_kantor) ? $nama_kantor : "");
                            ?>
                        </div><!-- /.form-group -->
                    </div>

                    <div class="row">
                        <div
                            class="form-group col-md-12 <?php if (!empty(form_error('alamat'))) echo 'has-error'; ?>">
                            <?php echo form_label('Alamat * ', 'alamat', $label);
                            echo form_input(isset($alamat) ? $alamat : "");
                            ?>
                        </div><!-- /.form-group -->
                    </div>

                    <div class="row">
                        <div
                            class="form-group col-md-12 <?php if (!empty(form_error('long'))) echo 'has-error'; ?>">
                            <?php echo form_label('Longitude * ', 'long', $label);
                            echo form_input(isset($long) ? $long : "");
                            ?>
                        </div><!-- /.form-group -->
                    </div>

                    <div class="row">
                        <div
                            class="form-group col-md-12 <?php if (!empty(form_error('lat'))) echo 'has-error'; ?>">
                            <?php echo form_label('Latitude * ', 'lat', $label);
                            echo form_input(isset($lat) ? $lat : "");
                            ?>
                        </div><!-- /.form-group -->
                    </div>
                    
                    <div class="row">
                        <div
                            class="form-group col-md-12 <?php if (!empty(form_error('batas'))) echo 'has-error'; ?>">
                            <?php echo form_label('Batas jarak toleransi absensi dengan kantor (satuan km) ', 'batas', $label);
                            echo form_input(isset($batas) ? $batas : "");
                            ?>
                        </div><!-- /.form-group -->
                    </div>

                    <div class="row">

                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <a href="<?php echo site_url("reference/kantor") ?>"
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