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

    <?php         

        $bulan = "";
        $tahun = "";
        $jml_tdk_hadir = 0;
        $tot_psw_tl = 0;
        $nik = "";
        
        $total_point_jml_ketidakhadiran = 0;
        
        // $persen_tidak_hadir = 0;
        $persen_terlambat = 0;
        $jml_terlambat = 0;
        $menit_terlambat = 0;
        $jml_psw = 0;
        $tot_jml_jam_kerja = 0;
        $tot_jml_jam_kurang = 0;
        $potongan_mangkir   = 0;
        $potongan_tl_psw    = 0;

        $m_abs_type = array();
        $m_abs_flag = array();
        foreach($abs_types as $type){
            $m_abs_type[$type->ID_ABS_TYPE] = $type->ABS_TYPE_DESC;
            $m_abs_flag[$type->ID_ABS_TYPE] = $type->FLAG_KETIDAKHADIRAN;
        }

        if ($results != null) {
            $jml_psw_tl_tot = 0;
            $no = 1;
            $res = json_decode(json_encode($results));
            $previous_nik = null;
            $last_item = null;
            foreach($res as $row){

                if ($jml_psw_tl_tot >= 1 && $jml_psw_tl_tot <= 5) {
                    $persen_terlambat = 5;
                } elseif ($jml_psw_tl_tot <= 10) {
                    $persen_terlambat = 10;
                } elseif ($jml_psw_tl_tot <= 20) {
                    $persen_terlambat = 15;
                } else {
                    $persen_terlambat = 20;
                }
                $jml_terlambat = $jml_terlambat + $row->jml_terlambat;
                $menit_terlambat = $menit_terlambat + $row->menit_terlambat;
                $tot_jml_jam_kerja = $tot_jml_jam_kerja + $row->jml_jam_kerja;
                $tot_jml_jam_kurang = $tot_jml_jam_kurang + $row->jml_jam_kurang;
                $jml_psw = 0;
                $jml_hadir = 0;

                // $persen_tidak_hadir = min(25, $total_point_jml_ketidakhadiran * 5);
                // $persen_terlambat = min(25, $total_point_jml_ketidakhadiran * 5);

                $last_item = $row;
                if($nik != $row->nik){
                    if ($previous_nik !== null) {
                        $persen_tidak_hadir = min(25, $total_point_jml_ketidakhadiran * 5);
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
                        echo "<tr>
                            <td colspan='5'>Total:</td>
                            <td align='center'>$jml_terlambat</td>
                            <td align='center'>".formatMinutesToTime($menit_terlambat)."</td>
                            <td align='center'>$tot_jml_jam_kurang</td>
                            <td colspan='1'></td>
                            <td align='center'>$tot_jml_jam_kerja</td>
                            <td align='center' colspan='1'></td>
                            <td align='center'>$total_point_jml_ketidakhadiran</td>
                            <td align='center'>".$persen_tidak_hadir."%</td>
                            <td align='center'>$jml_psw_tl_tot</td>
                            <td align='center'>".$persen_terlambat."%</td>
                        </tr>";
                    }
                    $total_point_jml_ketidakhadiran = 0;
                    $jml_terlambat = 0;
                    $menit_terlambat = 0;
                    $jml_psw_tl_tot = 0;
                    $nik = $row->nik;
                ?>    
                <table style="border: none;"> 
                    <br/>
                    <tr style="border: none;">
                        <td style="border: none;" colspan="15">&nbsp;</td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none;">NIP</td>
                        <td style="border: none;" colspan="15">: <?= $row->nik; ?></td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none;">Nama</td>
                        <td style="border: none;" colspan="15">: <?= $row->emp_name; ?></td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none;">Unit Kerja</td>
                        <td style="border: none;" colspan="15">: <?= $row->unitName; ?></td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none;">Jabatan</td>
                        <td style="border: none;" colspan="15">: <?= $row->position_desc; ?></td>
                    </tr>
                </table>
                
                <table align="center" border="1">
                    <tr class="layout">
                        <td align="center" class="layout" rowspan="2">Tanggal</td>
                        <td align="center" class="layout" rowspan="2">Jam Masuk</td>
                        <td align="center" class="layout" rowspan="2">Jam Pulang</td>
                        <td align="center" class="layout" rowspan="2">Scan Masuk</td>
                        <td align="center" class="layout" rowspan="2">Scan Pulang</td>
                        <td align="center" class="layout" rowspan="2">Terlambat</td>
                        <td align="center" class="layout" rowspan="2">Jam Menit Terlambat</td>
                        <td align="center" class="layout" rowspan="2">Jml Jam Kurang</td>
                        <td align="center" class="layout" rowspan="2">Lembur</td>
                        <td align="center" class="layout" rowspan="2">Jml Jam Hadir</td>
                        <td align="center" class="layout" rowspan="2">Pengecualian</td>
                        <td align="center" class="layout" colspan="2">Poin Ketidak Hadiran</td>
                        <td align="center" class="layout" colspan="2">Poin Keterlambatan </br> & Cepat Pulang</td>
                        <td align="center" class="layout" rowspan="2">Counter Ganti <br/> Shift / Jadwal</td>
                    </tr>
                    <tr>
                        <td align="center" class="layout">Jumlah</td>
                        <td align="center" class="layout">Persentase %</td>
                        <td align="center" class="layout">Jumlah</td>
                        <td align="center" class="layout">Persentase %</td>
                    </tr>
                    <?php
                    $status_terlambat = ""; // ($row->jml_terlambat == 1) ? "Terlambat" : "";
                    $bulan = $row->bulan_nama;
                    $tahun = $row->tahun;
                    $point_jml_ketidakhadiran = 0;
                    $jml_terlambat = 0;
                    $menit_terlambat = 0;
                    $jml_psw_tl = 0;

                    $potongan_mangkir   = 0; //$row->jml_pot_point_kehadiran;
                    $potongan_tl_psw    = 0; //$row->jml_pot_point_keterlambatan;
    
                    if($row->jam_masuk == "00:00" && $row->jam_pulang == "00:00"){
                        
                        if($row->id_abs_type != 0 && $row->id_abs_type != 7 && $row->id_abs_type != 9 && $row->id_abs_type != 10 && $row->id_abs_type != 13 && $row->id_abs_type != 15){
                            $jml_tdk_hadir += 1;
                            $point_jml_ketidakhadiran = 1;
                        }else{
                            $flag = $m_abs_flag[$row->id_abs_type];
                            $jml_tdk_hadir += $flag;
                            $point_jml_ketidakhadiran = $flag;

                        }
                    }else{
                        $point_jml_ketidakhadiran = 0;
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
                    $jml_terlambat = $jml_terlambat + $row->jml_terlambat;
                    $menit_terlambat = $menit_terlambat + $row->menit_terlambat;
                    /*
                    if($row->id_abs_type == 3 || $row->id_abs_type == 4 || $row->id_abs_type == 5 || $row->id_abs_type == 6 ||
                    $row->id_abs_type == 7 || $row->id_abs_type == 9 || $row->id_abs_type == 10 
                    ){
                        $jam_masuk = $row->keterangan;
                        $jam_pulang = $row->keterangan;
                        $jdwl_masuk = $row->keterangan;
                        $jdwl_pulang = $row->keterangan;
                        $jml_jam_kerja = 0;
                    }else if($row->id_abs_type == 0){
                        $jam_masuk = $row->ket_libur;
                        $jam_pulang = $row->ket_libur;
                        $jdwl_masuk = $row->ket_libur;
                        $jdwl_pulang = $row->ket_libur;
                        $jml_jam_kerja = 0;
                    }else{
                        $jam_masuk = $row->jam_masuk;
                        $jam_pulang = $row->jam_pulang;
                        $jdwl_masuk = $row->jdwl_masuk;
                        $jdwl_pulang = $row->jdwl_pulang;
                        $jml_jam_kerja = $row->jml_jam_kerja;
                    }
                    */

                    $point_jml_ketidakhadiran_ = ($row->ket_hitungan == 0) ? 0 : $point_jml_ketidakhadiran;
                    
                    echo "<tr>
                            <td>".$row->tanggal."</td>
                            <td align='center'>".$jdwl_masuk."</td>
                            <td align='center'>".$jdwl_pulang."</td>
                            <td align='center'>".$jam_masuk."</td>
                            <td align='center'>".$jam_pulang."</td>
                            <td align='center'>".$row->jml_terlambat."</td>
                            <td align='center'>".formatMinutesToTime($row->menit_terlambat)."</td>
                            <td align='center'>".$row->jml_jam_kurang."</td>
                            <td align='center'>".$row->jml_jam_lembur."</td>
                            <td align='center'>".$jml_jam_kerja ."</td>
                            <td></td>
                            <td align='center'>".$point_jml_ketidakhadiran_. "</td>
                            <td></td>
                            <td align='center'>".$jml_psw_tl. "</td>
                            <td></td>
                            <td align='center'>".$row->counter ."</td>
                        </tr>";
                    ?>
                <?php
                }else{
                    $status_terlambat = ""; // ($row->jml_terlambat == 1) ? "Terlambat" : "";
                    $bulan = $row->bulan_nama;
                    $tahun = $row->tahun;
                    $point_jml_ketidakhadiran = 0;
                    $jml_psw_tl = 0;

                    $potongan_mangkir   = 0; //$row->jml_pot_point_kehadiran;
                    $potongan_tl_psw    = 0; //$row->jml_pot_point_keterlambatan;
                    if($row->ket_hitungan == 1){ // Jika hari < Sekarang
                        if($row->jam_masuk == "00:00" && $row->jam_pulang == "00:00"){
                            
                            if($row->id_abs_type != 0 && $row->id_abs_type != 7 && $row->id_abs_type != 9 && $row->id_abs_type != 10 && $row->id_abs_type != 13 && $row->id_abs_type != 15){
                                $jml_tdk_hadir += 1;
                                $point_jml_ketidakhadiran = 1;
                            }else{
                                $flag = $m_abs_flag[$row->id_abs_type];
                                $jml_tdk_hadir += $flag;
                                $point_jml_ketidakhadiran = $flag;

                            }
                        }else{
                            $point_jml_ketidakhadiran = 0;
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
                        
                        /*
                        if($row->id_abs_type == 3 || $row->id_abs_type == 4 || $row->id_abs_type == 5 || $row->id_abs_type == 6 ||
                        $row->id_abs_type == 7 || $row->id_abs_type == 9 || $row->id_abs_type == 10 || $row->id_abs_type == 0

                        ){
                            $jam_masuk = $row->keterangan;
                            $jam_pulang = $row->keterangan;
                            $jdwl_masuk = $row->keterangan;
                            $jdwl_pulang = $row->keterangan;
                            $jml_jam_kerja = 0;
                        }else if($row->id_abs_type == 0){
                            $jam_masuk = $row->ket_libur;
                            $jam_pulang = $row->ket_libur;
                            $jdwl_masuk = $row->ket_libur;
                            $jdwl_pulang = $row->ket_libur;
                            $jml_jam_kerja = 0;
                        }else{
                            $jam_masuk = $row->jam_masuk;
                            $jam_pulang = $row->jam_pulang;
                            $jdwl_masuk = $row->jdwl_masuk;
                            $jdwl_pulang = $row->jdwl_pulang;
                            $jml_jam_kerja = $row->jml_jam_kerja;
                        }
                        */
        
                        if($row->jml_jam_kurang > 0 || $row->jml_terlambat > 0){
                            $tot_psw_tl += 1;
                            $jml_psw_tl = 1;
                            $jml_psw_tl_tot += 1 ;
                        }
                    }
                    
                    $point_jml_ketidakhadiran_ = ($row->ket_hitungan == 0) ? 0 : $point_jml_ketidakhadiran;
                    
                   
                    echo "<tr>
                            <td>".$row->tanggal."</td>
                            <td align='center'>".$jdwl_masuk."</td>
                            <td align='center'>".$jdwl_pulang."</td>
                            <td align='center'>".$jam_masuk."</td>
                            <td align='center'>".$jam_pulang."</td>
                            <td align='center'>".$row->jml_terlambat."</td>
                            <td align='center'>".formatMinutesToTime($row->menit_terlambat)."</td>
                            <td align='center'>".$row->jml_jam_kurang."</td>
                            <td align='center'>".$row->jml_jam_lembur."</td>
                            <td align='center'>".$jml_jam_kerja ."</td>
                            <td></td>
                            <td align='center'>".$point_jml_ketidakhadiran_. "</td>
                            <td></td>
                            <td align='center'>".$jml_psw_tl. "</td>
                            <td></td>
                            <td align='center'>".$row->counter ."</td>
                        </tr>";
                    $total_point_jml_ketidakhadiran += $point_jml_ketidakhadiran_;
                    $previous_nik = $row->nik;
                    $no++;
                }
            }  

            // Menghitung total per karyawan untuk karyawan terakhir
            if ($previous_nik !== null) {
                $persen_tidak_hadir = min(25, $total_point_jml_ketidakhadiran * 5);
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
                echo "<tr>
                            <td colspan='12'>Total</td>
                            <td align='center'>$total_point_jml_ketidakhadiran</td>
                            <td align='center'>".$persen_tidak_hadir."%</td>
                            <td align='center'>$jml_psw_tl_tot</td>
                            <td align='center'>".$persen_terlambat."%</td>
                        </tr>";
            } 
        }
    }
    ?>


</body>
</html>


<?php

function _fyyyymmdd($date_str){
    $date ="";
    $dd=substr($date_str, 0, 2);
    $mm=substr($date_str, 3, 2);
    $yyyy=substr($date_str, 6, 4);
    $date = $yyyy."-".$mm."-".$dd;
    return $date;
}

function _potongan($v_jml, $v_stat){
    $v_ret = 0;
    
    if( $v_stat == 1 ) { 
        if( $v_jml == 0 ) { 
            $v_ret = 0;
        }else if ( $v_jml == 1 ) { 
            $v_ret = 5;
        }else if ( $v_jml == 2 ) { 
            $v_ret = 10;
        }else if ( $v_jml == 3 ) { 
            $v_ret = 15;
        }else if ( $v_jml == 4 ) { 
            $v_ret = 20;
        }else if ( $v_jml >= 4 ) { 
            $v_ret = 25;
        }
		
    }else if ( $v_stat == 2 ) { 
            
        if ( $v_jml == 0 ) { 
            $v_ret = 0;
        }else if ( $v_jml >=1 && $v_jml <= 5 ) { 
            $v_ret = 5;
        }else if ( $v_jml >=6 && $v_jml <= 10 ) { 
            $v_ret = 10;
        }else if ( $v_jml >=11 && $v_jml <= 20 ) { 
            $v_ret = 15;
        }else if ( $v_jml >20 ) { 
            $v_ret = 20;
        }

    }


        return $v_ret;

    }

    function formatMinutesToTime($minutes) {
        // Menghitung jam dan menit
        $hours = intdiv($minutes, 60); // Pembagian untuk mendapatkan jam
        $remainingMinutes = $minutes % 60; // Sisa menit
    
        // Format output ke format waktu (jam:menit)
        return sprintf("%d:%02d", $hours, $remainingMinutes);
    }
?>
