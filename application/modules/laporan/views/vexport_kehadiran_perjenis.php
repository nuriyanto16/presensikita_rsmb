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

    <strong>LAPORAN <?php echo $jenisLaporan." BULAN ". strtoupper($bulan)." TAHUN ".$tahun ?></strong><br/>
    <br/>
    <?php         
            $no = 1;
            ?>
            <table> 
                    <td>NIK Pegawai</td>
                    <td>Nama</td>
                    <td>Unit</td>
                    <td>Posisi</td>
                    <td>Tanggal</td>
                    <td>Kode Jadwal</td>
                    <td>Keterangan</td>
                    <?php 
                    //DINAS MALAM
                    if($jenis_id ==  2){
                    ?>
                    <td>Jam Masuk</td>
                    <td>Jam Pulang</td>
                    <td>Scan Masuk</td>
                    <td>Scan Pulang</td>
                    <?php 
                    }
                    ?>
                    <?php 
                    //TUKAR SHIFT
                    if($jenis_id ==  4){
                    ?>
                    <td>Jam Masuk</td>
                    <td>Jam Pulang</td>
                    <td>Scan Masuk</td>
                    <td>Scan Pulang</td>
                    <td>Counter Perubahan</td>
                    <?php 
                    }
                    ?>
                    <?php 
                    //SIANG MALAM
                    if($jenis_id ==  5){
                    ?>
                    <td>Jam Masuk</td>
                    <td>Jam Pulang</td>
                    <td>Scan Masuk</td>
                    <td>Scan Pulang</td>
                    <?php 
                    }
                    ?>
                    <?php 
                    //ALPHA
                    if($jenis_id ==  6){
                    ?>
                    <td>Jam Masuk</td>
                    <td>Jam Pulang</td>
                    <td>Scan Masuk</td>
                    <td>Scan Pulang</td>
                    <?php 
                    }
                    ?>
                </thead>
            <?php 
            if (isset($results) && !empty($results)) {
                foreach ($results as $row) {
            ?>   
                </tr>
                    <td><?= $row['nik']; ?></td>
                    <td><?= $row['emp_name']; ?></td>
                    <td><?= $row['unitName']; ?></td>
                    <td><?= $row['position_desc']; ?></td>
                    <td><?= $row['tanggal']; ?></td>
                    <td><?= $row['kode_jadwal'] ; ?></td>
                    <td><?= $row['keterangan']; ?></td>
                    <?php 
                    //DINAS MALAM 
                    if($jenis_id ==  2){
                    ?>
                    <td><?= $row['jdwl_masuk']; ?></td>
                    <td><?= $row['jdwl_pulang']; ?></td>
                    <td><?= $row['jam_masuk'] ; ?></td>
                    <td><?= $row['jam_pulang']; ?></td>
                    <?php 
                    }
                    ?>
                    <?php 
                    //TUKAR JADWAL / SHIFT
                    if($jenis_id == 4){
                    ?>
                    <td><?= $row['jdwl_masuk']; ?></td>
                    <td><?= $row['jdwl_pulang']; ?></td>
                    <td><?= $row['jam_masuk'] ; ?></td>
                    <td><?= $row['jam_pulang']; ?></td>
                    <td><?= $row['counter']; ?></td>
                    <?php 
                    }
                    ?>
                    <?php 
                    //SIANG MALAM
                    if($jenis_id == 5){
                    ?>
                    <td><?= $row['jdwl_masuk']; ?></td>
                    <td><?= $row['jdwl_pulang']; ?></td>
                    <td><?= $row['jam_masuk'] ; ?></td>
                    <td><?= $row['jam_pulang']; ?></td>
                    <?php 
                    }
                    ?>
                    <?php 
                    //ALPHA
                    if($jenis_id == 6){
                    ?>
                    <td><?= $row['jdwl_masuk']; ?></td>
                    <td><?= $row['jdwl_pulang']; ?></td>
                    <td></td>
                    <td></td>
                    <?php 
                    }
                    ?>
                </tr>
            
            <?php 
                }  
            }
            ?>
            </table>
            <?php
        }
    ?>


</body>
</html>

