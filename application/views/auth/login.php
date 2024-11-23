<section id="wrapper" class="login-register">
    <div class="login-box login-sidebar">
        <div class="white-box">
            <!-- /.login-logo -->
            <a href="javascript:void(0)" class="text-center db m-b-40">
                <img class="login_logo" src="<?php echo assets_url() ?>images/logo-full.png" alt="Home" />
            </a>
            <?php
            echo form_open("auth/login/returnurl/" . $this->uri->segment(4), array("class" => "form-horizontal form-material", "id" => "loginform"));
            $has_error = array(
                'identity' => '',
                'password' => ''
            );

            if (isset($errmsg) && $errmsg != "") { ?>
                <div class="alert alert-danger alert-sm">
                    <?php echo $errmsg; ?>
                </div>
            <?php } else if ($this->session->flashdata('info')) { ?>
                <div class="alert alert-info alert-sm">
                    <a class="close" data-dismiss="alert">x</a>
                    <?php echo $this->session->flashdata('info'); ?>
                </div>
            <?php } else if ($this->session->flashdata('message')) { ?>
                <div class="alert alert-info alert-sm">
                    <a class="close" data-dismiss="alert">x</a>
                    <strong>Info! </strong><?php echo $this->session->flashdata('message'); ?>
                </div>
            <?php } ?>

            <div class="form-group has-feedback <?php echo $has_error['identity']; ?>">
                <div class="col-xs-12">
                    <?php echo form_input($identity); ?>
                    <?php if (strtolower($this->config->item('identity', 'ion_auth')) == 'email') { ?>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <?php } else { ?>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <?php } ?>
                </div>
            </div>

            <div class="form-group has-feedback <?php echo $has_error['password']; ?>">
                <div class="col-xs-12">
                    <?php echo form_input($password); ?>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="checkbox checkbox-primary pull-left p-t-0">
                        <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?>
                        <label for="remember"> Ingatkan Saya</label>
                    </div>
                </div>
            </div>
            <div class="form-group text-center m-t-20">
                <div class="col-xs-12">
                    <button
                        class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light m-b-5"
                        type="submit">Login
                    </button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
        <h5 class="text-center text-white"><?= date("Y")?> © PresensiKita.</h5>
    </div>
</section>
