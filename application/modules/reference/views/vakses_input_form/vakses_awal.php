
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?= strtoupper($titlehead) ?></h4>
        </div>
        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><i class="icon-settings"></i> Master Data</li>
                <li>Masa Akses Input Risiko - Input Awal</li>
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
                            class="form-group col-md-8 <?php if (!empty(form_error('periode_risiko_id'))) echo 'has-error'; ?>">
                            <?php echo form_label('Periode *', 'periode_risiko_id', $label); ?>
                            <?php echo form_dropdown(isset($periode_risiko_id) ? $periode_risiko_id : "")  ?>
                        </div><!-- /.form-group -->
                    </div>

                    <div class="row">
                        <div
                            class="form-group col-md-6 <?php if (!empty(form_error('start_date'))) echo 'has-error'; ?>">
                            <?php echo form_label('Tangal Awal Penginputan *', 'start_date', $label); ?>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <?php echo form_input(isset($start_date) ? $start_date : ""); ?>
                            </div>
                        </div><!-- /.form-group -->
                        <div
                            class="form-group col-md-6 <?php if (!empty(form_error('compCode_sap'))) echo 'has-error'; ?>">
                            <?php echo form_label('Tanggal Akhir Penginputan *', 'end_date', $label); ?>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <?php echo form_input(isset($end_date) ? $end_date : ""); ?>
                            </div>
                        </div><!-- /.form-group -->
                    </div>
                    <hr <?= (!empty($id))? "":"hidden"; ?>>
                     <div class="x_panel" <?= (!empty($id))? "":"hidden"; ?> >
                           <div class="x_title">
                              <a onclick='insertModal()'
                                 class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                                    Tambah</a>
                              <div class="col-md-3" style="float: right;">
                                    <div class="homeSearch w-100" style="width: 100%; margin-left: 5%; margin-top: 0;">
                                       <input type="text" id="tb-search" class="form-control" placeholder="Search . . .">
                                       <i style='margin-top:1%;' class="fa fa-search"></i>
                                    </div>
                              </div>
                           </div>
                           <div class="x_content">
                              <?php if ($this->session->flashdata('message')) {
                                    echo $this->session->flashdata('message');
                              } ?>
                              <?php if ($this->session->flashdata('err')) { ?>
                                    <script type="text/javascript">
                                       window.setTimeout(function () {
                                          $(".alert").alert('close');
                                       }, 5000);
                                    </script>
                                    <div class="alert alert-error">
                                       <button class="close" data-dismiss="alert" aria-hidden="true"
                                                type="button">x
                                       </button>
                                       <strong>Warning! </strong><?php echo $this->session->flashdata('err'); ?>
                                    </div>
                              <?php } ?>
                              <div id="_msgbox"></div>
                              <table id="dt-list" class="table table-striped table-responsive"
                                       width="100%">
                              </table>
                           </div>
                     </div>
                     <div class="ln_solid"></div>
                    <div class="form-group">
                        <a href="<?php echo site_url("reference/masa_akses_input") ?>"
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

<!-- popup insert akses_mon -->
<div class="modal fade" id="modalAkses_mon">
    <div class="modal-dialog  modal-md">
        <div class="modal-content">
            <div class="modal-header">
            <span style="float:left;"><h4 class="modal-title">Insert Akses Risiko Monitoring</h4></span><span style="float:right;">
                <!-- <button id="btnPilihTembusan" type="button" class="btn btn-primary">Tambahkan</button></span> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <input type="hidden" id="id_mon">
            </div>
            <div class="modal-body">
                <div class="row" style="margin-bottom:1%;">
                    <div class="col-sm-3" style="text-align: right;margin-top: 2%;">
                        <label for="periode_tahun">Periode (Tahun) :</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" id="periode_tahun" readonly class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-bottom:1%;">
                    <div class="col-sm-3" style="text-align: right;margin-top: 2%;">
                        <label for="periode_bulan">Periode (Bulan) :</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <!-- <input type="text" id="periode_bulan" class="form-control a"> -->
                                <select name="periode_bulan" class="form-control" id="periode_bulan">
                                    
                                </select>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-bottom:1%;">
                    <div class="col-sm-3" style="text-align: right;margin-top: 2%;">
                        <label for="tglMonAwal">Tanggal Mulai :</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" id="tglMonAwal" class="form-control tanggals">
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-bottom:1%;">
                    <div class="col-sm-3" style="text-align: right;margin-top: 2%;">
                        <label for="tglMonAkhir">Tanggal Selseai :</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" id="tglMonAkhir" class="form-control tanggals">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row" style="text-align:right;">
                    <div class="col-sm-12">
                        <button class="btn btn-primary" id="simpanMon">
                                       <i class="fa fa-save"></i>
                                       Simpan
                        </button>
                        <button class="btn btn-default" data-dismiss="modal">
                                       <i class="fa fa-times"></i>
                                       Batal 
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
