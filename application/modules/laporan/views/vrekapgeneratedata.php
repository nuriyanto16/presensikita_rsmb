<html>
<head>
    <title><?php echo isset($title_head) ? $title_head : '' ?></title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    
</head>
<body>

    <?php 
    if ($results != null) {
    ?>

    <strong>GENERATE RINCIAN KETIDAKHADIRAN & KETERLAMBATAN</strong><br/>
    <strong><?php echo $infolap ?></strong>

    <br/>
    
    <?php         

        $bulan = "";
        $tahun = "";
        $jml_tdk_hadir = 0;
        $tot_psw_tl = 0;
        $nik = "";
        $jml_psw_tl_tot = 0;

        $potongan_mangkir   = 0;
        $potongan_tl_psw    = 0;

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

                if($nik != $row->nik){
                    $jml_psw_tl_tot = 0;
                    $nik = $row->nik;
                
                    $status_terlambat = ""; // ($row->jml_terlambat == 1) ? "Terlambat" : "";
                    $bulan = $row->bulan_nama;
                    $tahun = $row->tahun;
                    $point_jml_ketidakhadiran = 0;
                    $jml_psw_tl = 0;

                    $potongan_mangkir   = 0; //$row->jml_pot_point_kehadiran;
                    $potongan_tl_psw    = 0; //$row->jml_pot_point_keterlambatan;
    
                    if($row->jam_masuk == "00:00" && $row->jam_pulang = "00:00"){
                        if($row->id_abs_type != 0 && $row->id_abs_type != 7){
                            $jml_tdk_hadir += 1;
                            $point_jml_ketidakhadiran = 1;
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

                    // if($row->id_abs_type == 3 || $row->id_abs_type == 4 || $row->id_abs_type == 5 || $row->id_abs_type == 6 ||
                    // $row->id_abs_type == 7 || $row->id_abs_type == 9 || $row->id_abs_type == 10
                    // ){
                    //     $jam_masuk = $row->keterangan;
                    //     $jam_pulang = $row->keterangan;
                    //     $jdwl_masuk = $row->keterangan;
                    //     $jdwl_pulang = $row->keterangan;
                    //     $jml_jam_kerja = 0;
                    // }else if($row->id_abs_type == 0){
                    //     $jam_masuk = $row->ket_libur;
                    //     $jam_pulang = $row->ket_libur;
                    //     $jdwl_masuk = $row->ket_libur;
                    //     $jdwl_pulang = $row->ket_libur;
                    //     $jml_jam_kerja = 0;
                    // }else{
                    //     $jam_masuk = $row->jam_masuk;
                    //     $jam_pulang = $row->jam_pulang;
                    //     $jdwl_masuk = $row->jdwl_masuk;
                    //     $jdwl_pulang = $row->jdwl_pulang;
                    //     $jml_jam_kerja = $row->jml_jam_kerja;
                    // }

                    $point_jml_ketidakhadiran_ = ($row->ket_hitungan == 0) ? 0 : $point_jml_ketidakhadiran;
                    
                    $a_date = _fyyyymmdd($row->tanggal);
                    $lastdate = substr(date("Y-m-t", strtotime($a_date)),-2,2);
                    if($lastdate == substr($row->tanggal,0,2)){

                        if(!empty($row->nik)){
                            //send rekap
                            $data_rekap = array(
                                'nik_pegawai'   => $row->nik,
                                'emp_name'      => $row->emp_name,
                                'unit_name'     => $row->unitName,
                                'bulan'         => $row->bulanx,
                                'tahun'         => $row->tahun,
                                'point_ketidakhadiran'  => $jml_tdk_hadir,
                                'persen_ketidakhadiran' => _potongan($jml_tdk_hadir,1),
                                'point_keterlambatan'   => $jml_psw_tl_tot,
                                'persen_keterlambatan'  => _potongan($tot_psw_tl,2),
                            );

                            $this->db->where("nik_pegawai", $row->nik);
                            $this->db->where("bulan", $row->bulanx);
                            $this->db->where("tahun", $row->tahun);
                            $Q = $this->db->get('rekap_ketidakhadiran');
                            if ($Q->num_rows() > 0) {
                                $datax = $Q->row();

                                $this->db->where("id", $datax->id);
                                $this->db->update("rekap_ketidakhadiran", $data_rekap); 
                            }else{
                                $this->db->insert("rekap_ketidakhadiran", $data_rekap); 
                            }
                            
                            //reset
                            $jml_tdk_hadir = 0;
                            $tot_psw_tl = 0;
                            $potongan_mangkir = 0;
                            $potongan_tl_psw  = 0;

                            echo $no.'. '.$row->nik.' # '.$row->emp_name.' # '.$row->unitName.' # %kehadiran: '.$data_rekap['persen_ketidakhadiran'].' # %keterlambatan: '.$data_rekap['persen_keterlambatan'].'<br>';
                            $no++;
                        }
                    }

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
                        if($row->jam_masuk == "00:00" && $row->jam_pulang = "00:00"){
                            if($row->id_abs_type != 0 && $row->id_abs_type != 7){
                                $jml_tdk_hadir += 1;
                                $point_jml_ketidakhadiran = 1;
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

                        // if($row->id_abs_type == 3 || $row->id_abs_type == 4 || $row->id_abs_type == 5 || $row->id_abs_type == 6 ||
                        // $row->id_abs_type == 7 || $row->id_abs_type == 9 || $row->id_abs_type == 10 || $row->id_abs_type == 0

                        // ){
                        //     $jam_masuk = $row->keterangan;
                        //     $jam_pulang = $row->keterangan;
                        //     $jdwl_masuk = $row->keterangan;
                        //     $jdwl_pulang = $row->keterangan;
                        //     $jml_jam_kerja = 0;
                        // }else if($row->id_abs_type == 0){
                        //     $jam_masuk = $row->ket_libur;
                        //     $jam_pulang = $row->ket_libur;
                        //     $jdwl_masuk = $row->ket_libur;
                        //     $jdwl_pulang = $row->ket_libur;
                        //     $jml_jam_kerja = 0;
                        // }else{
                        //     $jam_masuk = $row->jam_masuk;
                        //     $jam_pulang = $row->jam_pulang;
                        //     $jdwl_masuk = $row->jdwl_masuk;
                        //     $jdwl_pulang = $row->jdwl_pulang;
                        //     $jml_jam_kerja = $row->jml_jam_kerja;
                        // }
        
                        if($row->jml_jam_kurang > 0 || $row->jml_terlambat > 0){
                            $tot_psw_tl += 1;
                            $jml_psw_tl = 1;
                            $jml_psw_tl_tot += 1 ;
                        }
                    }

                    $point_jml_ketidakhadiran_ = ($row->ket_hitungan == 0) ? 0 : $point_jml_ketidakhadiran;
    
                    $a_date = _fyyyymmdd($row->tanggal);
                    $lastdate = substr(date("Y-m-t", strtotime($a_date)),-2,2);
                    if($lastdate == substr($row->tanggal,0,2)){

                        if(!empty($row->nik)){
                            //send rekap
                            $data_rekap = array(
                                'nik_pegawai'   => $row->nik,
                                'emp_name'      => $row->emp_name,
                                'unit_name'     => $row->unitName,
                                'bulan'         => $row->bulanx,
                                'tahun'         => $row->tahun,
                                'point_ketidakhadiran'  => $jml_tdk_hadir,
                                'persen_ketidakhadiran' => _potongan($jml_tdk_hadir,1),
                                'point_keterlambatan'   => $jml_psw_tl_tot,
                                'persen_keterlambatan'  => _potongan($tot_psw_tl,2),
                            );

                            $this->db->where("nik_pegawai", $row->nik);
                            $this->db->where("bulan", $row->bulanx);
                            $this->db->where("tahun", $row->tahun);
                            $Q = $this->db->get('rekap_ketidakhadiran');
                            if ($Q->num_rows() > 0) {
                                $datax = $Q->row();

                                $this->db->where("id", $datax->id);
                                $this->db->update("rekap_ketidakhadiran", $data_rekap); 
                            }else{
                                $this->db->insert("rekap_ketidakhadiran", $data_rekap); 
                            }
                            
                            //reset
                            $jml_tdk_hadir = 0;
                            $tot_psw_tl = 0;
                            $potongan_mangkir = 0;
                            $potongan_tl_psw  = 0;

                            echo $no.'. '.$row->nik.' # '.$row->emp_name.' # '.$row->unitName.' # %kehadiran: '.$data_rekap['persen_ketidakhadiran'].' # %keterlambatan: '.$data_rekap['persen_keterlambatan'].'<br>';
                            $no++;
                        }
                    }

                }
            ?>
            
            <?php 
            }  
            echo 'Berhasil.....';
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
