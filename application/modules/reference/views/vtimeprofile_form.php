
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
                            class="form-group col-md-12 <?php if (!empty(form_error('deskripsi'))) echo 'has-error'; ?>">
                            <?php echo form_label('Deskripsi *', 'deskripsi', $label);
                            echo form_input(isset($deskripsi) ? $deskripsi : "");
                            ?>
                        </div><!-- /.form-group -->
                    </div>

                    <div class="row">
                        <div hidden
                            class="form-group col-md-2 <?php if (!empty(form_error('hari_1'))) echo 'has-error'; ?>">
                            <?php echo form_label('Senin ', 'hari_1', $label);
                            echo form_input(isset($hari_1) ? $hari_1 : "");
                            ?>
                        </div><!-- /.form-group -->
                        <div
                            class="form-group col-md-5 <?php if (!empty(form_error('hari_1_jam_in'))) echo 'has-error'; ?>">
                            <?php echo form_label('Jam Masuk ', 'hari_1_jam_in', $label);
                            echo form_input(isset($hari_1_jam_in) ? $hari_1_jam_in : "");
                            ?>
                        </div><!-- /.form-group -->
                        <div
                            class="form-group col-md-5 <?php if (!empty(form_error('hari_1_jam_out'))) echo 'has-error'; ?>">
                            <?php echo form_label('Jam Pulang ', 'hari_1_jam_out', $label);
                            echo form_input(isset($hari_1_jam_out) ? $hari_1_jam_out : "");
                            ?>
                        </div><!-- /.form-group -->
                    </div>

                    <div class="row" hidden>
                        <div
                            class="form-group col-md-2 <?php if (!empty(form_error('hari_2'))) echo 'has-error'; ?>">
                            <?php echo form_label('Selasa ', 'hari_2', $label);
                            echo form_input(isset($hari_2) ? $hari_2 : "");
                            ?>
                        </div><!-- /.form-group -->
                        <div
                            class="form-group col-md-5 <?php if (!empty(form_error('hari_2_jam_in'))) echo 'has-error'; ?>">
                            <?php echo form_label('Jam Masuk ', 'hari_2_jam_in', $label);
                            echo form_input(isset($hari_2_jam_in) ? $hari_2_jam_in : "");
                            ?>
                        </div><!-- /.form-group -->
                        <div
                            class="form-group col-md-5 <?php if (!empty(form_error('hari_2_jam_out'))) echo 'has-error'; ?>">
                            <?php echo form_label('Jam Pulang ', 'hari_2_jam_out', $label);
                            echo form_input(isset($hari_2_jam_out) ? $hari_2_jam_out : "");
                            ?>
                        </div><!-- /.form-group -->
                    </div>

                    <div class="row" hidden>
                        <div
                            class="form-group col-md-2 <?php if (!empty(form_error('hari_3'))) echo 'has-error'; ?>">
                            <?php echo form_label('Rabu ', 'hari_3', $label);
                            echo form_input(isset($hari_3) ? $hari_3 : "");
                            ?>
                        </div><!-- /.form-group -->
                        <div
                            class="form-group col-md-5 <?php if (!empty(form_error('hari_3_jam_in'))) echo 'has-error'; ?>">
                            <?php echo form_label('Jam Masuk ', 'hari_3_jam_in', $label);
                            echo form_input(isset($hari_3_jam_in) ? $hari_3_jam_in : "");
                            ?>
                        </div><!-- /.form-group -->
                        <div
                            class="form-group col-md-5 <?php if (!empty(form_error('hari_3_jam_out'))) echo 'has-error'; ?>">
                            <?php echo form_label('Jam Pulang ', 'hari_3_jam_out', $label);
                            echo form_input(isset($hari_3_jam_out) ? $hari_3_jam_out : "");
                            ?>
                        </div><!-- /.form-group -->
                    </div>

                    <div class="row" hidden>
                        <div
                            class="form-group col-md-2 <?php if (!empty(form_error('hari_4'))) echo 'has-error'; ?>">
                            <?php echo form_label('Kamis ', 'hari_4', $label);
                            echo form_input(isset($hari_4) ? $hari_4 : "");
                            ?>
                        </div><!-- /.form-group -->
                        <div
                            class="form-group col-md-5 <?php if (!empty(form_error('hari_4_jam_in'))) echo 'has-error'; ?>">
                            <?php echo form_label('Jam Masuk ', 'hari_4_jam_in', $label);
                            echo form_input(isset($hari_4_jam_in) ? $hari_4_jam_in : "");
                            ?>
                        </div><!-- /.form-group -->
                        <div
                            class="form-group col-md-5 <?php if (!empty(form_error('hari_4_jam_out'))) echo 'has-error'; ?>">
                            <?php echo form_label('Jam Pulang ', 'hari_4_jam_out', $label);
                            echo form_input(isset($hari_4_jam_out) ? $hari_4_jam_out : "");
                            ?>
                        </div><!-- /.form-group -->
                    </div>

                    <div class="row" hidden>
                        <div
                            class="form-group col-md-2 <?php if (!empty(form_error('hari_5'))) echo 'has-error'; ?>">
                            <?php echo form_label('Jumat ', 'hari_5', $label);
                            echo form_input(isset($hari_5) ? $hari_5 : "");
                            ?>
                        </div><!-- /.form-group -->
                        <div
                            class="form-group col-md-5 <?php if (!empty(form_error('hari_5_jam_in'))) echo 'has-error'; ?>">
                            <?php echo form_label('Jam Masuk ', 'hari_5_jam_in', $label);
                            echo form_input(isset($hari_5_jam_in) ? $hari_5_jam_in : "");
                            ?>
                        </div><!-- /.form-group -->
                        <div
                            class="form-group col-md-5 <?php if (!empty(form_error('hari_5_jam_out'))) echo 'has-error'; ?>">
                            <?php echo form_label('Jam Pulang ', 'hari_5_jam_out', $label);
                            echo form_input(isset($hari_5_jam_out) ? $hari_5_jam_out : "");
                            ?>
                        </div><!-- /.form-group -->
                    </div>

                    <div class="row" hidden>
                        <div
                            class="form-group col-md-2 <?php if (!empty(form_error('hari_6'))) echo 'has-error'; ?>">
                            <?php echo form_label('Sabtu ', 'hari_6', $label);
                            echo form_input(isset($hari_6) ? $hari_6 : "");
                            ?>
                        </div><!-- /.form-group -->
                        <div
                            class="form-group col-md-5 <?php if (!empty(form_error('hari_6_jam_in'))) echo 'has-error'; ?>">
                            <?php echo form_label('Jam Masuk ', 'hari_6_jam_in', $label);
                            echo form_input(isset($hari_6_jam_in) ? $hari_6_jam_in : "");
                            ?>
                        </div><!-- /.form-group -->
                        <div
                            class="form-group col-md-5 <?php if (!empty(form_error('hari_6_jam_out'))) echo 'has-error'; ?>">
                            <?php echo form_label('Jam Pulang ', 'hari_6_jam_out', $label);
                            echo form_input(isset($hari_6_jam_out) ? $hari_6_jam_out : "");
                            ?>
                        </div><!-- /.form-group -->
                    </div>

                    <div class="row" hidden>
                        <div
                            class="form-group col-md-2 <?php if (!empty(form_error('hari_7'))) echo 'has-error'; ?>">
                            <?php echo form_label('Minggu ', 'hari_7', $label);
                            echo form_input(isset($hari_7) ? $hari_7 : "");
                            ?>
                        </div><!-- /.form-group -->
                        <div
                            class="form-group col-md-5 <?php if (!empty(form_error('hari_7_jam_in'))) echo 'has-error'; ?>">
                            <?php echo form_label('Jam Masuk ', 'hari_7_jam_in', $label);
                            echo form_input(isset($hari_7_jam_in) ? $hari_7_jam_in : "");
                            ?>
                        </div><!-- /.form-group -->
                        <div
                            class="form-group col-md-5 <?php if (!empty(form_error('hari_7_jam_out'))) echo 'has-error'; ?>">
                            <?php echo form_label('Jam Pulang ', 'hari_7_jam_out', $label);
                            echo form_input(isset($hari_7_jam_out) ? $hari_7_jam_out : "");
                            ?>
                        </div><!-- /.form-group -->
                    </div>
                    
                    <div class="row">

                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <a href="<?php echo site_url("reference/timeprofile") ?>"
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