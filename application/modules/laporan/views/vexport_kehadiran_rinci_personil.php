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
    // print_r($results);
    // exit();
    
    if ($results != null) {
    ?>

    <strong>LAPORAN RINCIAN ABSENSI KARYAWAN</strong><br/>
    <strong><?php echo $infolap ?></strong>

    <br/>
    <table style="border: none;"> 
        <?php
        $potongan_mangkir = 0;
        $potongan_tl_psw = 0;
        if($resultsPersonil != null){
            $resPersonil = json_decode(json_encode($resultsPersonil));
            foreach($resPersonil as $rowPersonil){
                $potongan_mangkir = $rowPersonil->jml_pot_point_kehadiran;
                $potongan_tl_psw = $rowPersonil->jml_pot_point_keterlambatan;
            ?>
            <tr style="border: none;">
                <td style="border: none;">NIP</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $rowPersonil->nik; ?></td>
            </tr>
            <tr style="border: none;">
                <td style="border: none;">Nama</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $rowPersonil->emp_name; ?></td>
            </tr>
            <tr style="border: none;">
                <td style="border: none;">Unit Kerja</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $rowPersonil->unitName; ?></td>
            </tr>
            <tr style="border: none;">
                <td style="border: none;">Jabatan</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $rowPersonil->position_desc; ?></td>
            </tr>
            <?php
            }
        }
        ?>
    </table>

    <br/>

    <table align="center" border="1">
        <tr class="layout">
            <td align="center" class="layout" rowspan="2">Tanggal</td>
            <td align="center" class="layout" rowspan="2">Jam Masuk</td>
            <td align="center" class="layout" rowspan="2">Jam Pulang</td>
            <td align="center" class="layout" rowspan="2">Scan Masuk</td>
            <td align="center" class="layout" rowspan="2">Scan Pulang</td>
            <td align="center" class="layout" rowspan="2">Terlambat</td>
            <td align="center" class="layout" rowspan="2">Plg Cepat</td>
            <td align="center" class="layout" rowspan="2">Lembur</td>
            <td align="center" class="layout" rowspan="2">Jml hadir</td>
            <td align="center" class="layout" rowspan="2">Pengecualian</td>
            <td align="center" class="layout" colspan="2">Poin Ketidak Hadiran</td>
            <td align="center" class="layout" colspan="2">Poin Keterlambatan </br> & Cepat Pulang</td>
        </tr>
        <tr>
            <td align="center" class="layout">Jumlah</td>
            <td align="center" class="layout">Perentase %</td>
            <td align="center" class="layout">Jumlah</td>
            <td align="center" class="layout">Perentase %</td>
        </tr>
    <?php         

        $bulan = "";
        $tahun = "";
        $jml_tdk_hadir = 0;
        $tot_psw_tl = 0;
        $jml_psw_tl_tot = 0;
        // $total_point_jml_ketidakhadiran = 0;
        $persen_terlambat = 0;

        $m_abs_type = array();
        $m_abs_flag = array();
        foreach($abs_types as $type){
            $m_abs_type[$type->ID_ABS_TYPE] = $type->ABS_TYPE_DESC;
            $m_abs_flag[$type->ID_ABS_TYPE] = $type->FLAG_KETIDAKHADIRAN;
        }

        if ($results != null) {
            $no = 1;
            $res = json_decode(json_encode($results));
            foreach($res as $row){
                
                if ($jml_psw_tl_tot <= 1) {
                    $persen_terlambat = 0;
                } elseif ($jml_psw_tl_tot <= 5) {
                    $persen_terlambat = 5;
                } elseif ($jml_psw_tl_tot <= 10) {
                    $persen_terlambat = 10;
                } elseif ($jml_psw_tl_tot <= 20) {
                    $persen_terlambat = 15;
                } else {
                    $persen_terlambat = 20;
                }

                $status_terlambat = ""; // ($row->jml_terlambat == 1) ? "Terlambat" : "";
                $bulan = $row->bulan_nama;
                $tahun = $row->tahun;
                $point_jml_ketidakhadiran = 0;
                $jml_psw_tl = 0;

                if($row->jam_masuk == "00:00" && $row->jam_pulang = "00:00"){
                    if($row->id_abs_type != 0 && $row->id_abs_type != 7){
                        $jml_tdk_hadir += 1;
                        $point_jml_ketidakhadiran = 1;
                    }
                }else{
                    $point_jml_ketidakhadiran = 0;
                }

                if($row->jml_jam_kurang > 0 || $row->jml_terlambat > 0){
                    $tot_psw_tl += 1;
                    $jml_psw_tl = 1;
                    $jml_psw_tl_tot += 1 ;
                }

                if ($jml_tdk_hadir >= 5) {
                    $persen_tidak_hadir = 25;
                } else {
                    // Sesuaikan perhitungan sesuai kebutuhan Anda
                    $persen_tidak_hadir = $jml_tdk_hadir * 5;
                }

                //cek abs type
                $abs_type_txt = $m_abs_type[$row->id_abs_type];
                $keterangan = $row->keterangan ? $row->keterangan : $abs_type_txt;
                $keterangan_libur = $row->ket_libur ? $row->ket_libur : $row->keterangan;  

                if($row->id_abs_type == 1){
                    $jam_masuk = $row->jam_masuk;
                    $jam_pulang = $row->jam_pulang;
                    $jdwl_masuk = $row->jdwl_masuk;
                    $jdwl_pulang = $row->jdwl_pulang;
                    $jml_jam_kerja = $row->jml_jam_kerja;

                }else if($row->id_abs_type == 0){
                    $jam_masuk = $keterangan_libur;
                    $jam_pulang = $keterangan_libur;
                    $jdwl_masuk = $keterangan_libur;
                    $jdwl_pulang = $keterangan_libur;
                    $jml_jam_kerja = 0;
                }else{
                    $jam_masuk = $keterangan;
                    $jam_pulang = $keterangan;
                    $jdwl_masuk = $keterangan;
                    $jdwl_pulang = $keterangan;
                    $jml_jam_kerja = 0;
                }

                // if($row->id_abs_type == 3 || $row->id_abs_type == 4 || $row->id_abs_type == 5 || $row->id_abs_type == 6 ||
                // $row->id_abs_type == 7 || $row->id_abs_type == 9 || $row->id_abs_type == 10 || $row->id_abs_type == 0 
                // ){
                //     $jam_masuk = $row->keterangan;
                //     $jam_pulang = $row->keterangan;
                //     $jdwl_masuk = $row->keterangan;
                //     $jdwl_pulang = $row->keterangan;
                //     $jml_jam_kerja = 0;
                // }else{
                //     $jam_masuk = $row->jam_masuk;
                //     $jam_pulang = $row->jam_pulang;
                //     $jdwl_masuk = $row->jdwl_masuk;
                //     $jdwl_pulang = $row->jdwl_pulang;
                //     $jml_jam_kerja = $row->jml_jam_kerja;
                // }

                 echo "<tr>
                                <td>".$row->tanggal."</td>
                                <td align='center'>".$jdwl_masuk."</td>
                                <td align='center'>".$jdwl_pulang."</td>
                                <td align='center'>".$jam_masuk."</td>
                                <td align='center'>".$jam_pulang."</td>
                                <td align='center'>".$row->jml_terlambat."</td>
                                <td align='center'>".$row->jml_jam_kurang."</td>
                                <td align='center'>".$row->jml_jam_lembur."</td>
                                <td align='center'>".$jml_jam_kerja ."</t
                                <td></td>
                                <td align='center'>".$row->jml_pot_point_kehadiran. "</td>
                                <td align='center'></td>
                                <td align='center'>".$row->jml_pot_point_keterlambatan. "</td>
                                <td align='center'></td>
                        </tr>";

                // $total_point_jml_ketidakhadiran += $point_jml_ketidakhadiran_;
                $no++;
            }

            echo "<tr>
                    <td>Total:</td>
                    <td colspan='9'></td>
                    <td align='center'>$jml_tdk_hadir</td>
                    <td align='center'>".$persen_tidak_hadir."%</td>
                    <td align='center'>$jml_psw_tl_tot</td>
                    <td align='center'>".$persen_terlambat."%</td>
                </tr>";
        }
    ?>
		</tbody>
     </table>


    <?php 
    }
    ?>




</body>
</html>

