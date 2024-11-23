<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?= strtoupper($titlehead) ?></h4>
        </div>
        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
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
            <i class="fa fa-info-circle"></i> <i> Isi password lama, tentukan password baru.</i>
            <div class="clearfix"></div>
          </div>
            <?php
                $form_att = array(
                    'role' => 'form',
                    'class' => 'form-horizontal',
                );
            echo form_open("auth/change_password", $form_att); ?>
            <div class="x_content">
                <div class="row">                  
                    <div class="col-md-12">
                        
                      <?php if (isset($message) && $message != "" OR $this->session->flashdata('message')) { ?>
                        <div class="alert alert-info alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <?php echo (isset($message) && $message != "") ? $message : $this->session->flashdata('message');?>
                        </div>
                     <?php } ?>
                     <?php if (isset($errmsg) && $errmsg != "" OR $this->session->flashdata('errmsg')) { ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <?php echo (isset($errmsg) && $errmsg != "") ? $errmsg : $this->session->flashdata('errmsg'); ?>
                        </div>
                     <?php } ?>
                        
                        <?php
                            $cols = '5;6';
                            $form_items = array(
                                
                                // Old Password
                                array(
                                    'type' => 'text',
                                    'name' => 'old_password',
                                    'label' => 'change_password_old_password_label',
                                    'default' => $old_password,
                                ),
                                
                                // New Password
                                array(
                                    'type' => 'text',
                                    'name' => 'new_password',
                                    'label' => 'change_password_new_password_label',
                                    'pass_length' => $min_password_length,
                                    'default' => $new_password,
                                    'desc' => 'panjang karakter minimal %s karakter',
                                ),
                                
                                // New Password Confirm
                                array(
                                    'type' => 'text',
                                    'name' => 'new_password_confirm',
                                    'label' => 'change_password_new_password_confirm_label',
                                    'default' => $new_password_confirm,
                                ),
                            );
                            
                            render_inline_form( $form_items, $cols );
                            
                            echo form_input($user_id);
                            
                        ?>
                        
                         <div class="row">
                            <div class="col-md-6 col-md-offset-5">                                
                                <button id="submit" type="submit" class='btn btn-primary pull-left btn-sm'><span class="fa fa-save"></span> Update</button>
                                &nbsp;&nbsp;<a href="<?php echo base_url()."main/dashboard"?>" class="btn btn-default btn-sm" type="submit"><span class="fa fa-close"></span> Batal</a>
                            </div>
                        </div><!-- /.row -->
                        
                    </div>
                </div>
            </div>
            <?php echo form_close();?>
        </div>
      </div>
    </div>
</div>
