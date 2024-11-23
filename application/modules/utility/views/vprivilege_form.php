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
            <i class="fa fa-info-circle"></i> Pilih Role dan akses modul.
<!--            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>-->
            <div class="clearfix"></div>
          </div>
            <?php echo form_open(base_url() . index_page() . "utility/privilege_manage/save_privilege"); ?>
                <?php
                    $input = array(
                        'class' => 'form-control'
                    );

                    $label = array(
                        'class' => 'control-label col-sm-2'
                    );
                ?>
                <button id="submit" type="submit" class='btn btn-primary btn-sm pull-right'><span class="fa fa-save"></span> Update</button>
                <div class="x_content">
                    <?php if (isset($message) && $message != "" OR $this->session->flashdata('message')) { ?>
                        <script type="text/javascript">
                            window.setTimeout(function () {
                                $(".alert").alert('close');
                            }, 3000);
                        </script>
                        <div class="alert alert-success alert-dismissable">
                            <button class="close" data-dismiss="alert" aria-hidden="true" type="button">x</button>
                            <?php echo (isset($message) && $message != "") ? $message : $this->session->flashdata('message'); ?>
                        </div>
                    <?php } ?>
                    <?php if (isset($errmsg) && $errmsg != "" OR $this->session->flashdata('errmsg')) { ?>
                        <script type="text/javascript">
                            window.setTimeout(function () {
                                $(".alert").alert('close');
                            }, 5000);
                        </script>
                        <div class="alert alert-danger alert-dismissable">
                            <button class="close" data-dismiss="alert" aria-hidden="true" type="button">x</button>
                            <?php echo (isset($errmsg) && $errmsg != "") ? $errmsg : $this->session->flashdata('errmsg'); ?>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo form_label('Nama Role*', 'role_id') ?>

                                <?php
                                $selectedrole = '';
                                if (isset($priv->role_id) && trim($priv->role_id) != '') $selectedmod = $priv->role_id;
                                $js = 'id="role_id" class="form-control select2" ';
                                echo form_dropdown('role_id', $list_roles, $selectedrole, $js);
                                ?>

                            </div><!-- /.form-group -->
                        </div><!-- /.col-md-6 -->

                        <div class="col-md-12">
                            <?php echo form_label('Hak Akses Modul', 'lbl_aksesmodul') ?>
                            <table class="table table-striped table-bordered table-hover" id="dt-listpriv" width="100%;" data-page-length="100">
                                <thead>
                                <tr>
                                    <th class="align-center" width="10%">#</th>
                                    <th>Nama Modul</th>
                                    <th>New</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    <th>Print</th>
                                    <th>Approve</th>
                                </tr>
                                </thead>
                                <tbody id="modul_det">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php echo form_hidden($csrf); ?>
            <?php echo form_close(); ?>
        </div>
      </div>
    </div>
</div>
