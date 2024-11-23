<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <!-- <h4 class="page-title"><?= strtoupper($titlehead) ?></h4> -->
        </div>
        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><i class="icon-docs"></i> Laporan</li>
                <li class="active"><?= ($titlehead) ?></li>
            </ol>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
<!--                    <div class="col-md-3" style="float: right;">-->
<!--                        <div class="homeSearch w-100" style="width: 100%; margin-left: 5%; margin-top: 0;">-->
<!--                            <input type="text" id="tb-search" class="form-control" placeholder="Search . . .">-->
<!--                            <i class="fa fa-search"></i>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>
                
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4><b>Laporan Rekap Cuti</b></h4>
                        </div>
                        <div class="col-sm-6">
                            <button type="button" id="exportExcel" class="btn btn-success pull-right">Download (Excel)</button>
                        </div>
                        <div class="col-sm-12">
                            <table id="dt-list" class="table table-striped table-responsive" width="100%"></table>
                        </div><!-- /.col-sm-12 -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
