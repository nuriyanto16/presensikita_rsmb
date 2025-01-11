<style>
    .select2 {
        max-width: 300px; /* Ganti 300px dengan ukuran yang sesuai */
        width: 100%; /* Menyesuaikan lebar dengan container */
    }
</style>


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
                    <div class="row">
                        <div class="col-md-3" style="float: left;">
                            <?php   if($this->session->userdata(sess_prefix()."roleid") == 1 || $this->session->userdata(sess_prefix()."roleid") == 2){ ?>
                            <!-- <form action="<?php echo base_url('reference/organisasi/sinkronOrganisasi'); ?>" method="get">
                                <button type="submit" value="Submit" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>
                                    Sinkronisasi Data Organisasi dari SIMRS
                                </button>
                            </form>  -->
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="x_title">
                    <a href="<?php echo (!$_new) ? "#" : base_url('reference/organisasi/edit_form'); ?>"
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
                                <div class="col-sm-4" data-toggle="tooltip" title="Company">
                                    <?php
                                    $cb_company = 'id="filter_company" class="form-control" style="width:100%;" ';
                                    echo form_dropdown('filter_company', $list_company, '1', $cb_company);
                                    ?>
                                </div><!-- /.col -->
                                <div class="col-sm-1">
                                    <?php
                                    $data = array(
                                        'type' => 'button',
                                        'name' => 'btnFilter',
                                        'id' => 'btnFilter',
                                        'class' => 'btn btn-primary pull-right',
                                        'value' => 'Filter'
                                    );
                                    echo form_button($data, "Filter");
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



<!-- Modal -->
<div class="modal fade" id="parameterModaljadwal" tabindex="-1" role="dialog" aria-labelledby="parameterModaljadwal" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
                <h4 class="modal-title custom_align" id="Heading">Import Jadwal</h4>
            </div>
            <div class="modal-body overflow-edit" style="max-height: 800px">
                <div class="row">
                    <div class="box-body" style="max-height: 800px">
                        <form id="parameterForm" enctype="multipart/form-data">
                          <div class="row">
                            <div class="form-group col-md-12">
                                <label for="kdunit" class="form-label">Kode Unit</label>
                                <input type="text" id="kdunit" class="form-control" required readonly>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="namaunit" class="form-label">Nama Unit</label>
                                <input type="text" id="namaunit" class="form-control" required readonly>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12">Periode* </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <?php echo isset($periode_id) ? form_dropdown($periode_id) : "" ?>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12">Bulan*</label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <?php echo form_dropdown(isset($bulan_id) ? $bulan_id : "") ?>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="fileUpload" class="form-label">Upload File</label>
                                <input type="file" id="fileUpload" class="form-control" required>
                            </div>
                          </div>

                          <!-- Loading Indicator -->
                          <div id="loading" class="text-center" style="display:none;">
                              <p>Loading...</p>
                          </div>

                          <!-- Button Submit -->
                          <div class="row">
                              <div class="box-body">
                                  <button type="submit" id="upload-jadwal" class="btn btn-primary pull-right">
                                      <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Upload
                                  </button>
                              </div>
                          </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.modal-jadwal -->



