<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?= strtoupper($titlehead) ?></h4>
        </div>
        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><i class="icon-docs"></i> Master Data</li>
                <li class="active"><?= ($titlehead) ?></li>
            </ol>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <a href="<?php echo (!$_new) ? "#" : base_url('presensi/cuti/edit_form'); ?>"
                       class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah
                    </a>
<!--                    <div class="col-md-3" style="float: right;">-->
<!--                        <div class="homeSearch w-100" style="width: 100%; margin-left: 5%; margin-top: 0;">-->
<!--                            <input type="text" id="tb-search" class="form-control" placeholder="Search . . .">-->
<!--                            <i class="fa fa-search"></i>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form class='form-horizontal'>
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                <?php
                                  $cb_company = 'id="filter_company" class="form-control"';
                                  echo form_dropdown('filter_company', $list_company, '', $cb_company);
                                ?>
                                </div>
                                <label class="control-label col-md-12 col-sm-12 col-xs-12">Tanggal</label>
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                  <?php echo form_input(isset($start_date) ? $start_date : ""); ?>
                                </div>
                                <div class="col-md-1 col-sm-2 col-xs-2">
                                  <label class="control-label">s/d</label>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                  <?php echo form_input(isset($end_date) ? $end_date : ""); ?>
                                </div>
                                <div class="col-sm-1">
                                  <?php
                                  $data = array(
                                      'type' => 'button',
                                      'name' => 'btnFilter',
                                      'id' => 'btnFilter',
                                      'class' => 'btn btn-primary pull-left',
                                      'value' => 'Filter'
                                  );
                                  echo form_button($data, "Filter");
                                  ?>
                                </div>
                                <div class="col-sm-1" >
                                    <?php
                                    $dataExcel = array(
                                        'type' => 'button',
                                        'name' => 'btnExport',
                                        'id' => 'btnExport',
                                        'class' => 'btn btn-success pull-left',
                                        'value' => 'Export Xls'
                                    );
                                    echo form_button( $dataExcel, "Export");
                                    ?>
                                </div><!-- /.col -->
                                            
                            </div><!-- /.form-group -->

                        </form>
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
        </div>
    </div>
</div>
