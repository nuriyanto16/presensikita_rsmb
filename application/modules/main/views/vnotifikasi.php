<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?= isset($titlehead) ? strtoupper($titlehead) : "" ?></h4>
        </div>
        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><i class="icon-pie-chart"></i> Dashboard</li>
                <li class="active"><?= isset($titlehead) ? $titlehead : "" ?></li>
            </ol>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <table id="dt-list" width="100%"
                           class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                        <tr>
                            <th class="text-center" style="width:20%">Tanggal Notifikasi</th>
                            <th>Pesan</th>
                            <th>Nama</th>
                            <th class="text-center" style="width:20%">Status</th>
                            <!-- <th class="text-center" style="width:20%">Tanggal Dibaca</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (isset($list_data) && $list_data != null) {
                            foreach ($list_data as $row) {
                                $url = site_url("main/notification/go/" . $this->qsecure->encrypt($row->notif_id));
                                $date = fdatetime_eng_to_ind($row->tgl);
                                $date_read = fdatetime_eng_to_ind($row->tgl);
                                $sort_date = strtotime($date);
                                $sort_date_read = strtotime($date_read);
                                ?>
                                <tr href="<?php echo $url; ?>">
                                    <td class="text-center"
                                        data-sort="<?php echo $sort_date; ?>"><?php echo $date; ?></td>
                                    <td><?php echo "{$row->notif_msg}" ?></td>
                                    <td><?php echo "{$row->emp_name}" ?></td>
                                    <?php if ($row->is_read > 0) { ?>
                                        <td class="text-center"><span
                                                class="label label-sm label-success">Dibaca</span>
                                        </td>
                                    <?php } else { ?>
                                        <td class="text-center"><span
                                                class="label label-sm label-warning">Belum Dibaca</span>
                                        </td>
                                    <?php } ?>
                                    <!-- <td class="text-center"
                                        data-sort="<?php echo $sort_date_read; ?>"><?php echo $date_read; ?></td> -->
                                </tr>
                            <?php }
                        }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
