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
               <div class="x_content">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item active">
                           <a class="nav-link" id="awal-tab" data-toggle="tab" href="#input-awal" role="tab" aria-controls="dashboard" aria-selected="true">Masa Akses Input Awal</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" data-toggle="tab" href="#input-awal-unlock" role="tab" aria-controls="tab" aria-selected="false">Masa Akses Input Awal (Unlock)</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" data-toggle="tab" href="#input-monitoring-unlock" role="tab" aria-controls="tab" aria-selected="false">Masa Akses Input Monitoring (Unlock)</a>
                        </li>
                  </ul>
                  <div class="tab-content" style="margin-top:0px !important;">
                     <div class="tab-pane fade active in" id="input-awal" role="tabpanel" aria-labelledby="dashboard-tab">
                        <div class="x_panel">
                           <div class="x_title">
                              <a href="<?php echo (!$_new) ? "#" : base_url('reference/masa_akses_input/edit_form/'.$this->qsecure->encrypt(1)); ?>"
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
                     </div>
                     <div class="tab-pane fade in" id="input-awal-unlock" role="tabpanel" aria-labelledby="dashboard-tab">
                        <div class="x_panel">
                              <div class="row">
                                 <div class="col-md-4">
                                    <label>Perusahaan</label>
                                    <select class='required form-control pilih' name='company' id="company">
                                       <option value='0'>- Pilih -</option>
                                       <?php
                                          foreach ($perusahaan as $comp) { ?>
                                             <option value="<?php echo $comp['compId']?>"> <?php echo $comp['compName']?> </option>
                                       <?php } ?>
                                    </select>
                                 </div>
                                 <div class="col-md-1" style="margin-top:23px;">
                                    <button type="button" id="cari1" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                 </div>
                              </div><br>
                           <div class="x_title">
                              
                              <a href="<?php echo (!$_new) ? "#" : base_url('reference/masa_akses_input/edit_form/'.$this->qsecure->encrypt(2)); ?>"
                                 class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                                    Tambah</a>
                              <div class="col-md-3" style="float: right;">
                                    <div class="homeSearch w-100" style="width: 100%; margin-left: 5%; margin-top: 0;">
                                       <input type="text" id="tb-search2" class="form-control" placeholder="Search . . .">
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
                              <table id="dt-list2" class="table table-striped table-responsive"
                                       width="100%">
                              </table>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane fade in" id="input-monitoring-unlock" role="tabpanel" aria-labelledby="dashboard-tab">
                        <div class="x_panel">
                              <div class="row">
                                 <div class="col-md-4">
                                    <label>Perusahaan</label>
                                    <select class='required form-control pilih' name='company2' id="company2">
                                       <option value='0'>- Pilih -</option>
                                       <?php
                                          foreach ($perusahaan as $comp) { ?>
                                             <option value="<?php echo $comp['compId']?>"> <?php echo $comp['compName']?> </option>
                                       <?php } ?>
                                    </select>
                                 </div>
                                 <div class="col-md-1" style="margin-top:23px;">
                                    <button type="button" id="cari2" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                 </div>
                              </div><br>
                           <div class="x_title">
                              <a href="<?php echo (!$_new) ? "#" : base_url('reference/masa_akses_input/edit_form/'.$this->qsecure->encrypt(4)); ?>"
                                 class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                                    Tambah</a>
                              <div class="col-md-3" style="float: right;">
                                    <div class="homeSearch w-100" style="width: 100%; margin-left: 5%; margin-top: 0;">
                                       <input type="text" id="tb-search3" class="form-control" placeholder="Search . . .">
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
                              <table id="dt-list3" class="table table-striped table-responsive"
                                       width="100%">
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
