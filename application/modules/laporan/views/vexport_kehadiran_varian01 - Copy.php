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

        $potongan_mangkir   = 0;
        $potongan_tl_psw    = 0;

        if ($results != null) {
            $no = 1;
            $res = json_decode(json_encode($results));
     
            foreach($res as $row){

                if($nik != $row->nik){
                    $nik = $row->nik;
                ?>    
                <table style="border: none;"> 
                    <br/>
                    <tr style="border: none;">
                        <td style="border: none;" colspan="15">&nbsp;</td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none;">NIP</td>
                        <td style="border: none;" colspan="10">: <?= $row->nik; ?></td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none;">Nama</td>
                        <td style="border: none;" colspan="10">: <?= $row->emp_name; ?></td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none;">Unit Kerja</td>
                        <td style="border: none;" colspan="10">: <?= $row->unitName; ?></td>
                    </tr>
                    <tr style="border: none;">
                        <td style="border: none;">Jabatan</td>
                        <td style="border: none;" colspan="10">: <?= $row->position_desc; ?></td>
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
                    $status_terlambat = ""; // ($row->jml_terlambat == 1) ? "Terlambat" : "";
                    $bulan = $row->bulan_nama;
                    $tahun = $row->tahun;
                    $point_jml_ketidakhadiran = 0;
                    $jml_psw_tl = 0;

                    $potongan_mangkir   = 0; //$row->jml_pot_point_kehadiran;
                    $potongan_tl_psw    = 0; //$row->jml_pot_point_keterlambatan;
    
                    if($row->jam_masuk == "00:00" && $row->jam_pulang = "00:00"){
                        if($row->id_abs_type != 0){
                            $jml_tdk_hadir += 1;
                            $point_jml_ketidakhadiran = 1;
                        }
                    }else{
                        $point_jml_ketidakhadiran = 0;
                    }

                    if($row->id_abs_type == 3 || $row->id_abs_type == 4 || $row->id_abs_type == 5 || $row->id_abs_type == 6 ||
                        $row->id_abs_type == 7 || $row->id_abs_type == 9 || $row->id_abs_type == 10
                    ){
                        $jam_masuk = $row->keterangan;
                        $jam_pulang = $row->keterangan;
                        $jdwl_masuk = $row->keterangan;
                        $jdwl_pulang = $row->keterangan;
                        $jml_jam_kerja = 0;
                    }else{
                        $jam_masuk = $row->jam_masuk;
                        $jam_pulang = $row->jam_pulang;
                        $jdwl_masuk = $row->jdwl_masuk;
                        $jdwl_pulang = $row->jdwl_pulang;
                        $jml_jam_kerja = $row->jml_jam_kerja;
                    }
                    
                    echo "<tr>
                            <td>".$row->tanggal."</td>
                            <td align='center'>".$jdwl_masuk."</td>
                            <td align='center'>".$jdwl_pulang."</td>
                            <td align='center'>".$jam_masuk."</td>
                            <td align='center'>".$jam_pulang."</td>
                            <td align='center'>".$row->jml_terlambat."</td>
                            <td align='center'>".$row->jml_jam_kurang."</td>
                            <td align='center'>".$row->jml_jam_lembur."</td>
                            <td align='center'>".$jml_jam_kerja ."</td>
                            <td></td>
                            <td align='center'>".$point_jml_ketidakhadiran. "</td>
                            <td></td>
                            <td align='center'>".$jml_psw_tl. "</td>
                            <td></td>
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
    
                    if($row->jam_masuk == "00:00" && $row->jam_pulang = "00:00"){
                        if($row->id_abs_type != 0 ){
                            $jml_tdk_hadir += 1;
                            $point_jml_ketidakhadiran = 1;
                        }
                    }else{
                        $point_jml_ketidakhadiran = 0;
                    }

                    if($row->id_abs_type == 3 || $row->id_abs_type == 4 || $row->id_abs_type == 5 || $row->id_abs_type == 6 ||
                    $row->id_abs_type == 7 || $row->id_abs_type == 9 || $row->id_abs_type == 10
                    ){
                        $jam_masuk = $row->keterangan;
                        $jam_pulang = $row->keterangan;
                        $jdwl_masuk = $row->keterangan;
                        $jdwl_pulang = $row->keterangan;
                        $jml_jam_kerja = 0;
                    }else{
                        $jam_masuk = $row->jam_masuk;
                        $jam_pulang = $row->jam_pulang;
                        $jdwl_masuk = $row->jdwl_masuk;
                        $jdwl_pulang = $row->jdwl_pulang;
                        $jml_jam_kerja = $row->jml_jam_kerja;
                    }
    
                    if($row->jml_jam_kurang > 0 || $row->jml_terlambat > 0){
                        $tot_psw_tl += 1;
                        $jml_psw_tl = 1;
                    }
    
                    echo "<tr>
                            <td>".$row->tanggal."</td>
                            <td align='center'>".$jdwl_masuk."</td>
                            <td align='center'>".$jdwl_pulang."</td>
                            <td align='center'>".$jam_masuk."</td>
                            <td align='center'>".$jam_pulang."</td>
                            <td align='center'>".$row->jml_terlambat."</td>
                            <td align='center'>".$row->jml_jam_kurang."</td>
                            <td align='center'>".$row->jml_jam_lembur."</td>
                            <td align='center'>".$jml_jam_kerja ."</td>
                            <td></td>
                            <td align='center'>".$point_jml_ketidakhadiran. "</td>
                            <td></td>
                            <td align='center'>".$jml_psw_tl. "</td>
                            <td></td>
                        </tr>";

                            $a_date = _fyyyymmdd($row->tanggal);
                            $lastdate = substr(date("Y-m-t", strtotime($a_date)),-2,2);
                            if($lastdate == substr($row->tanggal,0,2)){
                            echo "<tr>
                                    <td colspan='10'></td>
                                    <td align='center'>".$jml_tdk_hadir. "</td>
                                    <td align='center'>"._potongan($jml_tdk_hadir,1)." %</td>
                                    <td align='center'>".$tot_psw_tl. "</td>
                                    <td align='center'>"._potongan($tot_psw_tl,2)." %</td>
                                    </tr>
                                </tbody>
                            </table>";
                                $jml_tdk_hadir = 0;
                                $tot_psw_tl = 0;
                                $potongan_mangkir = 0;
                                $potongan_tl_psw  = 0;
                            }
                        
                    $no++;
                }
            ?>
            <?php 
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
?>
