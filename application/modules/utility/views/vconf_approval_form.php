<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?= strtoupper($titlehead) ?></h4>
        </div>
        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><i class="icon-settings"></i> Utilitas</li>
                <li>Konfigurasi Approval</li>
                <li class="active"><?=($titlehead)?></li>
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
                            class="form-group col-md-6 <?php if (!empty(form_error('comp_code'))) echo 'has-error'; ?>">
                            <?php
                            echo form_label('Perusahaan *', 'comp_code', $label);
                            $js = 'id="comp_code" class="form-control select2" ';
                            echo form_dropdown('comp_code', $list_comp, (isset($comp_code) ? $comp_code : ''), $js); ?>
                        </div>
                    </div><!-- /.form-group -->

                    <div class="row">
                        <div
                            class="form-group col-md-6 ">
                            <?php echo form_label('Kategori Dokumen*', '', $label);
                            $js = 'id="katdok_id" class="form-control select2 {$error_cls}" ';
                            // if ($disabled_input === true) $js .= "disabled";
                            echo form_dropdown('katdok_id', $list_katdok, (isset($katdok_id) ? $katdok_id : ''), $js);
                            ?>
                        </div>
                    </div><!-- /.form-group -->

                    <div class="row">
                        <div class="col-md-6 no-padding">
                            <div
                                class="form-group col-md-12 <?php if (!empty(form_error('position_code'))) echo 'has-error'; ?>">
                                <?php echo form_label('Posisi *', 'position_desc', $label);
                                echo form_input($position_desc);
                                echo form_input($position_code);
                                ?>
                            </div><!-- /.form-group -->
                        </div>
                        <div class="col-md-6 no-padding">
                            <button id="btn-cari" type="button" class="btn btn-default btn-lg"
                                    style="height:59px">
                                <span class="fa fa-search"></span> Cari
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div
                            class="form-group col-md-6 <?php if (!empty(form_error('unit_id'))) echo 'has-error'; ?>">
                            <?php echo form_label('Unit *', 'unit_name', $label);
                            echo form_input($unit_name);
                            echo form_input($unit_id);
                            ?>
                        </div><!-- /.form-group -->
                    </div>

                    <div class="row">
                        <div
                            class="form-group col-md-6 <?php if (!empty(form_error('urutan'))) echo 'has-error'; ?>">
                            <?php echo form_label('Urutan *', 'urutan', $label);
                            echo form_input($urutan);
                            ?>
                        </div><!-- /.form-group -->
                    </div>

                    <div class="row">
                        <div
                            class="form-group col-md-6 <?php if (!empty(form_error('group_app'))) echo 'has-error'; ?>">
                            <?php echo form_label('Group', 'group_app', $label);
                            echo form_input($group_app);
                            ?>
                        </div><!-- /.form-group -->
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <a href="<?php echo site_url("utility/conf_approval") ?>"
                           class="btn btn-default pull-left"
                           type="button"><span class="fa fa-arrow-left"></span> Kembali</a>
                        <button id="btn-save" type="button" name="actionf" value="save"
                                class='btn btn-primary pull-left'>
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

<!-- modal-content Popup Position -->
<div class="modal fade" id="modal-popupposition" tabindex="-1" role="dialog"
     aria-labelledby="modal-popupposition"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
                <h4 class="modal-title custom_align" id="Heading">Pilih Posisi dan Unit</h4>
            </div>
            <div class="modal-body overflow-edit">
                <div class="row">
                    <div class="col-md-12">
                        <a href="#" id="btn-getdok" class="btn btn-primary btn-sm pull-left">
                            <span class="fa fa-check"></span> Pilih</a>
                    </div>
                </div>
                <div class="row">
                    <div class="box-body">
                        <table id="dt-popup-position"
                               class="table table-striped table-bordered table-hover"
                               data-page-length="25">
                            <thead>
                            <tr>
                                <th>Kode Posisi</th>
                                <th>Nama Posisi</th>
                                <th>Kode Unit</th>
                                <th>Nama Unit</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.modal-content Popup Position -->
