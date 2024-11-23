<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?= strtoupper($titlehead) ?></h4>
        </div>
        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><i class="icon-settings"></i> Utilitas</li>
                <li class="active"><?= ($titlehead) ?></li>
            </ol>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <a href="<?php echo (!$_new) ? "#" : base_url('utility/conf_approval/edit_form'); ?>"
                       class="btn btn-success btn-sm pull-left"><i class="fa fa-plus"></i>
                        Tambah</a>
                    <ul class="nav navbar-right panel_toolbox"></ul>
                    <div class="clearfix"></div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <form class='form-horizontal'>
                            <div class="form-group ">
                                <div class="col-sm-3" data-toggle="tooltip" title="Perusahaan">
                                    <?php
                                    $cb_comp = 'id="filter_comp" class="form-control" style="width:100%;" ';
                                    echo form_dropdown('filter_comp', $list_comp, '', $cb_comp);
                                    ?>
                                </div><!-- /.col -->
                                <div class="col-sm-3" data-toggle="tooltip"
                                     title="Kategori Dokumen">
                                    <?php
                                    $cb_comp = 'id="filter_dok" class="form-control" style="width:100%;" ';
                                    echo form_dropdown('filter_dok', $list_katdok, '', $cb_comp);
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
                    <table id="dt-list" class="table table-striped table-bordered table-hover"
                           width="100%" data->
                        <thead>
                        <tr>
                            <th class="align-center" width="8%">#</th>
                            <th width="10%">Urutan</th>
                            <th>Posisi</th>
                            <th width="35%">Unit</th>
                            <th class="align-center" width="10%">Group</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
