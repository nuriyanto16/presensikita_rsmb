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

    <strong>LAPORAN REKAP CUTI</strong><br/>
    <!-- <strong><?php echo $infolap ?></strong> -->

    

    <?php         

        $bulan = "";
        $tahun = "";
        $jml_tdk_hadir = 0;
        $tot_psw_tl = 0;
        $nik = "";
        $jml_psw_tl_tot = 0;

        $potongan_mangkir   = 0;
        $potongan_tl_psw    = 0;

        if ($results != null) {
            $no = 1;
            $res = json_decode(json_encode($results));
     
            foreach($res as $row){

                ?>    
                <table style="border: none;"> 
                    <br/>
                    <tr style="border: none;">
                        <td style="border: none;" colspan="15">&nbsp;</td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none;">Perusahaan</td>
                        <td style="border: none;" colspan="10">: <?= $row->comp_name; ?></td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none;">Nama Karyawan</td>
                        <td style="border: none;" colspan="10">: <?= $row->emp_name; ?></td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none;">Jenis Pengajuan</td>
                        <td style="border: none;" colspan="10">: <?= $row->desc_cuti; ?></td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none;">Tanggal Mulai</td>
                        <td style="border: none;" colspan="10">: <?= $row->tgl_awal_cuti; ?></td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none;">Tanggal Akhir</td>
                        <td style="border: none;" colspan="10">: <?= $row->tgl_akhir_cuti; ?></td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none;">Jml. Hari</td>
                        <td style="border: none;" colspan="10">: <?= $row->jml; ?></td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none;">Keterangan</td>
                        <td style="border: none;" colspan="10">: <?= $row->alasan_cuti; ?></td>
                    </tr>

                    <tr style="border: none;">
                        <td style="border: none;">Status</td>
                        <td style="border: none;" colspan="10">: <?= $row->stat_pengajuan; ?></td>
                    </tr>
                </table>
                
            <?php 
            }  
        }
    }
    ?>


</body>
</html>

