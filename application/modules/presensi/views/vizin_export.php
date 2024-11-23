<html>
<head>
    <title><?php echo isset($title_head) ? $title_head : '' ?></title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <style type='text/css'>

    table {
        font-size : 10pt;
        font-family: sans-serif;
        border: 0.5mm solid black;
        border-collapse: collapse;
    }
    table.table2 {
        font-size : 10pt;
        border: 1mm solid black;
        border-collapse: collapse;
    }
    table.layout {
        font-size : 10pt;
        border: 0.5mm solid black;
        border-collapse: collapse;
    }
    td.layout {
        font-size : 10pt;
        text-align: center;
        border: 0.5mm solid black;
    }
    td {
        font-size : 10pt;
        padding: 1.5mm;
        border: 0.5mm solid black;
        vertical-align: middle;
    }
    td.redcell {
        font-size : 10pt;
        border: 0.5mm solid black;
    }
    td.redcell2 {
        font-size : 10pt;
        border: 0.5mm solid black;
    }

    </style>
</head>
<body>

    <?php 
    if ($results != null) {
    ?>

    <strong>LAPORAN IZIN/SAKIT <?= $params ?></strong><br/>
    <!-- <strong><?php echo $infolap ?></strong> -->
    <?php         
        if ($results != null) {
            $no = 1;
            $res = json_decode(json_encode($results));
            ?>
            <table> 
                <thead>
                    <td>NIK Pegawai</td>
                    <td>Nama</td>
                    <td>Unit</td>
                    <td>Jenis Izin</td>
                    <td>Tanggal Mulai</td>
                    <td>Tangal Akhir</td>
                    <td>Jumlah Hari</td>
                    <td>Alasan/Keterangan</td>
                    <td>Status</td>
                </thead>
            <?php 
            foreach($res as $row){

            ?>   
                </tr>
                    <td><?= $row->nik_pegawai; ?></td>
                    <td><?= $row->emp_name; ?></td>
                    <td><?= $row->unit; ?></td>
                    <td><?= $row->desc_izin; ?></td>
                    <td><?= $row->tgl_awal_izin; ?></td>
                    <td><?= $row->tgl_akhir_izin; ?></td>
                    <td><?= $row->jml; ?></td>
                    <td><?= $row->alasan_izin ; ?></td>
                    <td><?= $row->stat_pengajuan; ?></td>
                </tr>
            
            <?php 
            }  
            ?>
            </table>
            <?php
        }
    }
    ?>


</body>
</html>

