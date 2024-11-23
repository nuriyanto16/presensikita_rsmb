<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?= strtoupper($titlehead) ?></h4>
        </div>
        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><i class="icon-settings"></i> Utilitas</li>
                <li>Group/Role</li>
                <li class="active"><?=($titlehead)?></li>
            </ol>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <i class="fa fa-info-circle"></i> <i><b>(*)</b> harus diisi !</i>
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
          <?php echo form_open(uri_string(), array('class' => 'form-horizontal')); ?>
                <?php
                $input = array(
                    'class' => 'form-control'
                );

                $label = array(
                    'class' => 'control-label col-sm-2'
                );
            ?>
            <div class="x_content">
                <?php if (isset($message) && $message != "" OR $this->session->flashdata('message')) { ?>
                    <div class="alert alert-info alert-dismissable">
                        <button class="close" data-dismiss="alert" aria-hidden="true" type="button">x</button>
                        <?php echo (isset($message) && $message != "") ? $message : $this->session->flashdata('message'); ?>
                    </div>
                <?php } ?>
                <?php if (isset($errmsg) && $errmsg != "" OR $this->session->flashdata('errmsg')) { ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button class="close" data-dismiss="alert" aria-hidden="true" type="button">x</button>
                        <?php echo (isset($errmsg) && $errmsg != "") ? $errmsg : $this->session->flashdata('errmsg'); ?>
                    </div>
                <?php } ?>

                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <?php echo form_label('Nama Role*', 'role_name', $label) ?>
                            <div class="col-sm-8">
                                <?php
                                echo form_input($role_name);
                                ?>
                            </div><!-- /.col -->
                        </div><!-- /.form-group -->

                        <div class="form-group">
                            <?php echo form_label('Alias*', 'role_alias', $label) ?>
                            <div class="col-sm-8">
                                <?php
                                echo form_input($role_alias);
                                ?>
                            </div><!-- /.col -->
                        </div><!-- /.form-group -->

                    </div><!-- /.col-md-9 -->
                </div>
                <div class="box-footer">
                    <button id="submit" type="submit" class='btn btn-primary pull-left btn-sm'><span
                                class="fa fa-save"></span> Simpan
                    </button>
                    &nbsp;&nbsp;<a href="<?php echo base_url() . "utility/role_manage" ?>"
                                   class="btn btn-default btn-sm" type="submit"><span class="fa fa-close"></span> Batal</a>
                </div><!-- /.box-footer -->
            </div>
            <?php echo form_hidden('id', $id); ?>
            <?php echo form_hidden('role_alias_edit', $role_alias_edit); ?>
            <?php echo form_hidden($csrf); ?>
            <?php echo form_close(); ?>
        </div>
      </div>
    </div>
</div>
