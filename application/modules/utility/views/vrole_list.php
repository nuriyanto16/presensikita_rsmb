<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?= strtoupper($titlehead) ?></h4>
        </div>
        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><i class="icon-settings"></i> Utilitas</li>
                <li class="active"><?= ($titlehead) ?></li>
            </ol>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <a href="<?php echo (!$_new) ? "#" : base_url('utility/role_manage/edit_form'); ?>"
                       class="btn btn-primary btn-sm pull-left"><i class="fa fa-plus"></i> Tambah
                        Role</a>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php if ($this->session->flashdata('message')) { ?>
                        <script type="text/javascript">
                            window.setTimeout(function () {
                                $(".alert").alert('close');
                            }, 3000);
                        </script>
                        <div class="alert alert-success">
                            <button class="close" data-dismiss="alert" aria-hidden="true"
                                    type="button">x
                            </button>
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
                            <button class="close" data-dismiss="alert" aria-hidden="true"
                                    type="button">x
                            </button>
                            <strong>Warning! </strong><?php echo $this->session->flashdata('err'); ?>
                        </div>
                    <?php } ?>
                    <table id="dt-listrole" data-page-length="25"
                           class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center" style="width:7%">#</th>
                            <th>Nama Role</th>
                            <th style="width:20%">Alias</th>
                            <th class="text-center" style="width:10%">Aktif</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $seq = 1;
                        foreach ($roles as $role) : ?>
                            <tr>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button"
                                                class="btn btn-default btn-sm dropdown-toggle"
                                                data-toggle="dropdown">
                                            <i class="fa fa-gear"></i> Aksi <span
                                                class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <?php
                                                $id = $this->qsecure->encrypt($role->role_id);
                                                if ($_edit) {
                                                    $att = array(
                                                        'data-toggle' => 'tooltip',
                                                        'data-placement' => 'top',
                                                    );
                                                    $att['title'] = 'Edit';
                                                    echo anchor('utility/role_manage/edit_form/' . $id, '<i class="fa fa-fw fa-edit"></i>Edit', $att);
                                                } else {
                                                    $att['title'] = 'Edit (Not Access)';
                                                    echo anchor('utility/role_manage', '<i class="fa fa-fw fa-edit"></i>Edit (Not Access)', $att);
                                                }


                                                ?>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td><?php echo htmlspecialchars($role->role_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($role->role_alias, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="text-center"><?php echo ($role->active) ? anchor("utility/role_manage/deactivate/" . $this->qsecure->encrypt($role->role_id), "<span class='fa fa-check text-green'>&nbsp;</span>", array("onclick" => "return confirm('Non-aktifkan role ?');")) :
                                        anchor("utility/role_manage/activate/" . $this->qsecure->encrypt($role->role_id), "<span class='fa fa-times text-red'>&nbsp;</span>", array("onclick" => "return confirm('Aktifkan role ?');")); ?></td>
                            </tr>
                            <?php
                            $seq++;
                        endforeach;
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
