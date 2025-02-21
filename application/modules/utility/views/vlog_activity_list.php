<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?= strtoupper($titlehead) ?></h4>
        </div>
        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><i class="icon-settings"></i> Utilitas</li>
                <li class="active"><?=($titlehead)?></li>
            </ol>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php if ($this->session->flashdata('message')) { ?>
                        <script type="text/javascript">
                            window.setTimeout(function () {
                                $(".alert").alert('close');
                            }, 3000);
                        </script>
                        <div class="alert alert-success">
                            <button class="close" data-dismiss="alert" aria-hidden="true"
                                    type="button">x
                            </button>
                            <strong>Info! </strong><?php echo $this->session->flashdata('message'); ?>
                        </div>
                    <?php } ?>
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
                    <table id="dt-list" data-page-length="25"
                           class="table table-striped table-bordered" width="100%">
                        <thead>
                        <tr>
                            <th class="text-center" style="width:7%">Tgl Log</th>
                            <th class="text-center" style="width:10%">Ip Address</th>
                            <th class="text-center" style="width:10%">Nama Komputer</th>
                            <th class="text-center" style="width:10%">Username</th>
                            <th class="text-center" style="width:10%">Modul Alias</th>
                            <th class="text-center" style="width:10%">No Trans</th>
                            <th class="text-center" style="width:10%">Aktifitas</th>
                            <th class="text-center" style="width:10%">Http Agent</th>
                            <th class="text-center" style="width:10%">Http Host</th>
                            <th class="text-center" style="width:10%">MacAddress</th>
                        </tr>
                        </thead>
                        <tbody></tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
