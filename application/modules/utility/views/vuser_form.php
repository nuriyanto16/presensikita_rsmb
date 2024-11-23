<?php 
//print_r($perusahaan);exit();
?>

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?= $titlehead ?></h4>
        </div>
        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Utilitas</li>
                <li class="breadcrumb-item">Pengaturan Pengguna</li>
                <li class="breadcrumb-item active"><?=($titlehead)?></li>
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
          <?php echo form_open(uri_string(), array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data')); ?>
            <?php
                $input = array(
                    'class' => 'form-control'
                );

                $label = array(
                    'class' => 'control-label col-md-4'
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
                            <?php echo form_label('Username*', 'username', $label) ?>
                            <div class="col-md-8">
                                <?php
                                echo form_input($username);
                                ?>
                            </div><!-- /.col -->
                        </div><!-- /.form-group -->

                        <div class="form-group">
                            <?php echo form_label('Email*', 'email', $label) ?>
                            <div class="col-md-8">
                                <?php
                                echo form_input($email);
                                ?>
                            </div><!-- /.col -->
                        </div><!-- /.form-group -->
                        
                        <div class="form-group">
                            <?php echo form_label('Sapaan', 'prefix', $label) ?>
                            <div class="col-md-8">
                                <?php
                               
                                $selected = '';
                                if (isset($user->prefix) && trim($user->prefix) != '') $selected = $user->prefix;
                                $attr = 'id="prefix" class="form-control select2" ';
                                echo form_dropdown('prefix', $list_prefix, $selected, $attr);
                                ?>
                            </div><!-- /.col -->
                        </div><!-- /.form-group -->

                        <div class="form-group">
                            <?php echo form_label('Nama Lengkap*', 'fullname', $label) ?>
                            <div class="col-md-8">
                                <?php
                                echo form_input($full_name);
                                ?>
                            </div><!-- /.col -->
                        </div><!-- /.form-group -->

                        <div class="form-group">
                            <?php echo form_label('Password*', 'password', $label) ?>
                            <div class="col-md-8">
                                <?php
                                echo form_password($password);
                                ?>
                            </div><!-- /.col -->
                        </div><!-- /.form-group -->

                        <div class="form-group">
                            <?php echo form_label('Konfirmasi Password*', 'repassword', $label) ?>
                            <div class="col-md-8">
                                <?php
                                echo form_password($password_confirm);
                                ?>
                            </div><!-- /.col -->
                        </div><!-- /.form-group -->

                        <div class="form-group">
                            <?php echo form_label('User Role*', 'userrole', $label) ?>
                            <div class="col-md-8">
                                <?php
                                $attr = 'id="role_id" class="form-control select2" ';
                                echo form_dropdown('role_id', $list_role, $user->role_id, $attr);
                                ?>
                            </div><!-- /.col -->
                        </div><!-- /.form-group -->

                        <div class="form-group">
                            <?php echo form_label('Foto', 'avatar', $label) ?>
                            <div class="col-md-8">
                                <input type="file" onchange="readURL(this)" class="input" id="filephoto" name="filephoto"/>
                            </div>
                            
                            <div class="profile_user">
                                <img id="show_gambar" style="max-width: 130px; min-height: 130px;" src="<?php echo HTTP_UPLOAD_DIR . 'profile/'. $user->photo ?>" alt="<?=$user->photo?>" class="img-circle profile_img">
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('', 'avatar', $label) ?>
                            <div class="col-md-8">
                                <?php
                                echo form_hidden($photo_edit);
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo form_label('NIK', 'nik', $label) ?>
                            <div class="col-md-7">
                                <?php
                                echo form_input($nik);
                                echo form_input($empId);
                                ?>
                            </div>
                            <div class="col-md-1">
                                <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-karyawan"><span class="fa fa-search"></span></a>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo form_label('Company', 'compId', $label) ?>
                            <div class="col-md-8">
                                <?php
                                echo form_input($compId);
                                echo form_input($compName);
                                ?>
                            </div><!-- /.col -->
                        </div><!-- /.form-group -->
                        
                        <div class="form-group">
                            <?php echo form_label('Nama Jabatan', 'positionDesc', $label) ?>
                            <div class="col-md-8">
                                <?php
                                echo form_input($positionId);
                                echo form_input($positionDesc);
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo form_label('Unit', 'unit', $label) ?>
                            <div class="col-md-8">
                                <?php echo form_input($unitId);?>
                                <?php echo form_input($unit); ?>
                            </div>
                        </div>
                        
                        <div class="form-group" hidden>
                            <?php echo form_label('Mewakili', 'represent2', $label) ?>
                            <div class="col-md-8">
                                <input type="checkbox"  id="represent" name="represent" <?=($user->represent) ? "checked" : ""?> />
                            </div>
                        </div>
                    
                        
                        <div class="form-group" hidden>
                            <?php echo form_label('No. Telp', 'phone', $label) ?>
                            <div class="col-md-8">
                                <?php
                                echo form_input($phone);
                                ?>
                            </div>
                        </div>

                        <div class="form-group" hidden>
                            <?php echo form_label('Role Data', 'role_data', $label) ?>
                            <div class="col-md-8">
                                <input type="checkbox"  id="dt_superadmin" name="dt_superadmin" <?=($user->dt_superadmin) ? "checked" : ""?> /> Super Administrator &nbsp;&nbsp;&nbsp;
                                <input type="checkbox"  id="dt_admin" name="dt_admin" <?=($user->dt_admin) ? "checked" : ""?> /> Administrator &nbsp;&nbsp;&nbsp;
                                <input type="checkbox"  id="dt_user" name="dt_user" <?=($user->dt_user) ? "checked" : ""?> /> User
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8">
                                <button id="submit" type="submit" class='btn btn-primary pull-left btn-sm'><span
                                            class="fa fa-save"></span> Simpan
                                </button>
                                &nbsp;&nbsp;<a href="<?php echo base_url() . "utility/user_manage" ?>"
                                               class="btn btn-default btn-sm" type="submit"><span
                                            class="fa fa-close"></span> Batal</a>
                            </div><!-- /.col -->
                        </div><!-- /.form-group -->
                    </div>
                </div>

            </div>
            
            <?php echo form_hidden('email_edit', $email_edit); ?>
            <?php echo form_hidden('username_edit', $username_edit); ?>

            <?php echo form_hidden('id', $id); ?>
            <?php echo form_hidden($csrf); ?>

            <?php echo form_close(); ?>
        </div>
      </div>
    </div>
</div>

<style type="text/css">
    .hover{
        cursor: pointer;
    }
    tbody tr:hover{
        background-color: #9cd7f4;
        color: #000;
    }
</style>

<div class="modal fade in bs-example-modal-lg" id="modalunit" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Pilih Karyawan</h4>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="row">
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
                                                        <th>Nama Perusahaan</th>
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


<!-- modal-atasan-langsung -->
<div class="modal fade" id="modal-karyawan" tabindex="-1" role="dialog" aria-labelledby="modal-karyawan" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">Pilih Karyawan</h4>
            </div>
            <div class="modal-body overflow-edit">
                <div class="row">
                    <div class="col-md-12">
                        <table id="dt-listkaryawan" class="table table-striped table-responsive"  width="100%">
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.modal-keluarga -->
