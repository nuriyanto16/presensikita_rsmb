  <div class="login-box">
        <div class="register-logo">
            <a href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url() ?>assets/images/logo.png" title="Logo"><br />
                Aplikasi Sambara
            </a>
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Lupa Password ? masukan alamat email</p>
                <?php echo form_open("auth/forgot_password", array('role'=>'form'));?>

                   <?php
                    if ($this->session->flashdata('err')) { ?>
                      <div class="alert alert-danger alert-sm">
                         <?php echo $this->session->flashdata('err');?>
                      </div>                 
                   <?php } else if($this->session->flashdata('info')) { ?>
                          <div class="alert alert-info alert-sm">
                              <a class="close" data-dismiss="alert">x</a>
                              <?php echo $this->session->flashdata('info'); ?>
                          </div>                    
                   <?php } else if(isset($err_message) && $err_message != "") { ?>
                         <div class="alert alert-danger alert-sm">
                              <a class="close" data-dismiss="alert">x</a>
                              <?php echo $err_message; ?>
                          </div>                                           
                   <?php } else if($this->session->flashdata('message')) { ?>
                    <div class="alert alert-info alert-sm">
                        <a class="close" data-dismiss="alert">x</a>
                        <strong>Info! </strong><?php echo $this->session->flashdata('message'); ?>
                    </div>                    
                   <?php } ?>


                   <div class="form-group">      
                       <label for="email"><?php echo sprintf(lang('forgot_password_email_label'), $identity_label);?></label>
                       <?php echo form_input($email);?>                       
                   </div>

                    <?php echo form_submit('submit', lang('forgot_password_submit_btn'), "class='btn btn-lg btn-primary btn-block'" );?>
                <?php echo form_close();?> 
                Kembali ke halaman <?php echo anchor('auth/login', 'Log In', 'title="Log In" class="text-center"' ); ?>
        </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

 <div class="login-footer">
</div><!-- /.login-logo -->