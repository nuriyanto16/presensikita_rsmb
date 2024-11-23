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
                    <a href="<?php echo (!$_new) ? "#" : base_url('utility/module_manage/edit_form'); ?>"
                       class="btn btn-primary btn-sm pull-left" <?php if (!$_new) echo "disabled"; ?> ><i
                            class="fa fa-plus"></i> Tambah Modul </a>

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
                    <table id="dt-listmodule" data-page-length="50"
                           class="table table-striped table-bordered" width="100%">
                        <thead>
                        <tr>
                            <th class="align-center">#</th>
                            <th>Nama Modul</th>
                            <th>Alias</th>
                            <th>URL</th>
                            <th class="align-center">Urutan</th>
                            <th class="align-center">Icon</th>
                            <th>Kelompok Modul</th>
                            <th class="align-center">Aktif</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $seq = 1;
                        foreach ($modules as $row) : ?>

                            <tr>
                                <td class="align-center" width="5%">
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

                                                $id = $this->qsecure->encrypt($row->module_id);
                                                if ($_edit) {
                                                    $att = array(
                                                        'data-toggle' => 'tooltip',
                                                        'data-placement' => 'top',
                                                    );
                                                    $att['title'] = 'Edit';
                                                    echo anchor('utility/module_manage/edit_form/' . $id, '<i class="fa fa-fw fa-edit"></i>Edit', $att);
                                                } else {
                                                    $att['title'] = 'Edit (Not Access)';
                                                    echo anchor('utility/module_manage', '<i class="fa fa-fw fa-edit"></i>Edit (Not Access)', $att);
                                                }
                                                ?>
                                            </li>
                                            <li>
                                                <?php
                                                if ($_delete) {

                                                    $att['title'] = 'Hapus';
                                                    $att['onclick'] = "return confirm('Hapus modul ?');";
                                                    echo anchor('utility/module_manage/delete/' . $id, '<i class="fa fa-fw fa-trash"></i>Hapus', $att);

                                                } else {
                                                    $att['title'] = 'Hapus (Not Access)';
                                                    echo anchor('utility/module_manage', '<i class="fa fa-fw fa-trash"></i>Hapus (Not Access)', $att);
                                                }
                                                ?>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td width="15%"><?php echo $row->treename; ?></td>
                                <td width="5%"><?php echo $row->module_alias; ?></td>
                                <td width="5%"><?php echo $row->module_url; ?></td>
                                <td width="5%"
                                    class="align-center"><?php echo $row->mod_seq; ?></td>
                                <td width="5%" class="align-center"><i
                                        class="fa <?php echo $row->mod_icon_cls ?>"
                                        title="<?php echo $row->mod_icon_cls ?>"></i></td>
                                <td width="5%"><?php echo $row->mod_group; ?></td>
                                <td width="5%"
                                    class="align-center"><?php echo ($row->publish) ? anchor("utility/module_manage/deactivate/" . $this->qsecure->encrypt($row->module_id), "<span class='fa fa-check text-green'>&nbsp;</span>", array("onclick" => "return confirm('Non-aktifkan modul ?');")) :
                                        anchor("utility/module_manage/activate/" . $this->qsecure->encrypt($row->module_id), "<span class='fa fa-times text-red'>&nbsp;</span>", array("onclick" => "return confirm('Aktifkan modul ?');")); ?></td>

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
