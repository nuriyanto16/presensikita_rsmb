<style>
    #dvloading {
    
        background-color : rgba(0,0,0, .3);
        height: 100%;
        width : 100%;
        padding-top:250px;
        z-index: 9999;
        position: fixed;
        left: 0;
        top: 0;
        font-family:"Trebuchet MS", verdana, arial,tahoma;
        font-size:18pt;
        text-align:center;
        font-weight: bold;
        color: white;
    }
</style>

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?= $titlehead ?></h4>
        </div>
        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Utilitas</li>
                <li class="breadcrumb-item active"><?=($titlehead)?></li>
            </ol>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <a href="<?php echo (!$_new) ?  "#" : base_url('utility/user_manage/edit_form'); ?>"
               class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah User</a>
            <?php if($_new) { ?>
                <button id="btn_sinkronisasi" type="button" class='btn btn-info btn-sm hide'>
                    <i class="fa fa-users"></i> Sinkronisasi
                </button>
                <div id="dvloading" style="display:none;">
                    <img id="img_load" src="<?php echo assets_url(); ?>images/loader.svg" alt=""/>Sinkronisasi... Please wait
                </div>
            <?php } ?>
          </div>
          <div class="x_content">
            <?php if ($this->session->flashdata('message')) { ?>
                <script type="text/javascript">
                    window.setTimeout(function () {
                        $(".alert").alert('close');
                    }, 3000);
                </script>
                <div class="alert alert-success">
                    <button class="close" data-dismiss="alert" aria-hidden="true" type="button">x</button>
                    <strong>Info! </strong><?php echo $this->session->flashdata('message'); ?>
                </div>
            <?php } ?>
            <?php if ($this->session->flashdata('err')) { ?>
                <script type="text/javascript">
                    window.setTimeout(function () {
                        $(".alert").alert('close');
                    }, 5000);
                </script>
                <div class="alert alert-error">
                    <button class="close" data-dismiss="alert" aria-hidden="true" type="button">x</button>
                    <strong>Warning! </strong><?php echo $this->session->flashdata('err'); ?>
                </div>
            <?php } ?>
            <table id="dt-listuser" class="table table-striped table-bordered" width="100%">
              <thead>
                <tr>
                    <th id="user-list-action" style="width: 5%;" class="align-center">#</th>
                    <th style="width: 10%;">Username</th>
                    <th style="width: 10%;">Email</th>
                    <th>Nama Lengkap</th>
                    <th>Unit</th>
                    <th style="width: 5%;">Role</th>
                    <th>Login Terakhir</th>
                    <th class="align-center">Aktif</th>
                </tr>
              </thead>

              <tbody>
                <!-- <?php
                $seq = 1;
                foreach ($users as $user) : ?>

                    <tr>
                        <td class="align-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle"
                                        data-toggle="dropdown">
                                    <i class="fa fa-gear"></i> Aksi <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <?php
                                        $id = $this->qsecure->encrypt($user->id);
                                        
                                        if($_edit) {
                                            $att = array(
                                                'data-toggle' => 'tooltip',
                                                'data-placement' => 'top',
                                            );
                                            $att['title'] = 'Edit';
                                            echo anchor('utility/user_manage/edit_form/' . $id, '<i class="fa fa-fw fa-edit"></i>Edit', $att);
                                        } else {
                                            $att['title'] = 'Edit (Not Access)';
                                            echo anchor('utility/user_manage', '<i class="fa fa-fw fa-edit"></i>Edit (Not Access)', $att);
                                        }
                                        
                                        
                                        ?>
                                    </li>
                                   
                                    <li>
                                        <?php
                                        
                                        if($_delete) {
                                            $att['title'] = 'Hapus';
                                            $att['onclick'] = "return confirm('Hapus user ?');";
                                            echo anchor('utility/user_manage/delete/' . $id, '<i class="fa fa-fw fa-trash"></i>Hapus', $att);
                                        } else {
                                            $att['title'] = 'Hapus (Not Access)';
                                            echo anchor('utility/user_manage', '<i class="fa fa-fw fa-trash"></i>Delete (Not Access)', $att);
                                        }
                                        
                                        ?>
                                    </li>
                                        
                                </ul>
                            </div>
                        </td>
                        <td><?php echo htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($user->full_name, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($user->positionName, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($user->unitName, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($user->role_name, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo($user->last_login); ?></td>
                        <td class="align-center">
                            <?php echo ($user->active) ? anchor("utility/user_manage/deactivate/" . $this->qsecure->encrypt($user->id), "<i class='fa fa-check text-green'>&nbsp;</i>", array("onclick" => "return confirm('Non-aktifkan user ?');")) :
                                anchor("utility/user_manage/activate/" . $this->qsecure->encrypt($user->id), "<i class='fa fa-times text-red'>&nbsp;</i>", array("onclick" => "return confirm('Aktifkan user ?');")); 
                            ?>
                        </td>
                    </tr>

                    <?php
                    $seq++;
                endforeach;

                ?> -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
