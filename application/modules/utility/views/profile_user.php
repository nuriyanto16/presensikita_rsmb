<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?= strtoupper($titlehead) ?></h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><i class="icon-user"></i> Profil</li>
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
                    <div class="alert alert-success alert-dismissable">
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
                            <?php echo form_label('Nama Lengkap*', 'fullname', $label) ?>
                            <div class="col-md-8">
                                <?php
                                echo form_input($full_name);
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
                            <?php echo form_label('No. Telp', 'phone', $label) ?>
                            <div class="col-md-8">
                                <?php
                                echo form_input($phone);
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8">
                                <button id="submit" type="submit" class='btn btn-primary pull-left btn-sm'><span
                                            class="fa fa-save"></span> Simpan
                                </button>
                                &nbsp;&nbsp;<a href="<?php echo base_url() . "" ?>"
                                               class="btn btn-default btn-sm" type="submit"><span
                                            class="fa fa-close"></span> Batal</a>
                            </div><!-- /.col -->
                        </div><!-- /.form-group -->
                    </div>
                </div>

            </div>
            <?php echo form_hidden('email_edit', $email_edit); ?>
            <?php echo form_hidden('username_edit', $username_edit); ?>

            <?php echo form_hidden('id', $user->id); ?>
            <?php echo form_hidden($csrf); ?>

            <?php echo form_close(); ?>
        </div>
      </div>
    </div>
</div>
