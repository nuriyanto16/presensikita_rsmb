
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?= strtoupper($titlehead) ?></h4>
        </div>
        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><i class="icon-settings"></i> Master Data</li>
                <li>Masa Akses Input Risiko </li>
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
                            class="form-group col-md-6 <?php if (!empty(form_error('periode_risiko_id'))) echo 'has-error'; ?>">
                            <?php echo form_label('Periode *', 'periode_risiko_id', $label); ?>
                            <?php echo form_dropdown(isset($periode_risiko_id) ? $periode_risiko_id : "")  ?>
                        </div><!-- /.form-group -->
                        
                        <!-- <div class="form-group col-md-1" style="margin-top:2%;">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalunit"><i class="fa fa-search"></i></button>
                        </div> -->
                    </div>

                    <div class="row">
                        <div
                            class="form-group col-md-6 <?php if (!empty(form_error('compId'))) echo 'has-error'; ?>">
                            <?php echo form_label('Company *', 'company_code', $label); ?>
                                    <?php echo form_dropdown(form_dropdown($company_code) ? $company_code : ""); ?>
                        </div><!-- /.form-group -->
                        <div
                            class="form-group col-md-6 <?php if (!empty(form_error('unit_id'))) echo 'has-error'; ?>">
                            <?php echo form_label('Organisasi *', 'unit_id', $label); ?>
                                    <?php echo form_dropdown(isset($unit_id) ? $unit_id : ""); ?>
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

<!-- modal list Unit -->
<div class="modal fade in bs-example-modal-lg" id="modalunit" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Pilih Unit</h4>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>Perusahaan</label>
                        <select class='required form-control' name='company' id="company" required>
                            <option value='0'>- Pilih -</option>
                            <?php
                                foreach ($perusahaan as $comp) { ?>
                                  <option value="<?php echo $comp['compId']?>"> <?php echo $comp['compName']?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Lokasi</label>
                        <select class='required form-control' name='site' id='site' required>
                            <option value=''>- Pilih -</option>
                        </select>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <div class="">
                                        <div id="reload">
                                            <table class="table hover" id="dt-pilihunit" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Unit ID</th>
                                                        <th style="width: 20px;">Kode Unit</th>
                                                        <th>Nama Unit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
      </div>
    </div>
    <!-- Modal content-->
</div>