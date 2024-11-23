<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <div class="container">
        
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
        
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Selamat Datang
            </h1>
        </section><!-- /.content-header -->
        
        <section class="content">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Aplikasi E-office</h3>
                </div>
                <div class="box-body">
                                      
                </div><!-- /.box-body -->
            </div><!-- /.box -->
                
            
        </section><!-- /.content -->
        
    </div><!-- /.container -->
</div><!-- /.content-wrapper -->

