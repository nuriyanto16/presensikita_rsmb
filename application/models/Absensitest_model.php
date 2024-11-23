<?php

class Absensitest_model extends CI_Model
{
    private $_data = null;

    //UNTUK MENAMPILKAN LIST HISTORY ABSENSI KARYAWAN
    public function getAbsensiList($id = null, $comp_code = null, $period_awal = null, $period_akhir = null) // $id defaultnya adalah null
    {
        $this->db->select(" A.NIK, A.TGL_ABS, A.LOKASI, C.EMP_NAME, 
                            CONCAT( DATE_FORMAT(A.TGL_ABS, '%Y'),'/' ,DATE_FORMAT(A.TGL_ABS, '%Y%m%d')) AS PATH,
                            A.URL_FOTO AS FOTO_MASUK, A.URL_FOTO_PULANG AS FOTO_PULANG,
                            DATE_FORMAT(A.TGL_ABS, '%d-%m-%Y') AS TGL, 
                            DATE_FORMAT(A.JAM_IN, '%H:%i:%s') AS JAM_IN,
                            DATE_FORMAT(A.JAM_OUT, '%H:%i:%s') AS JAM_OUT,
                            DATE_FORMAT(A.JAM_IN, '%d-%m-%Y %H:%i:%s') AS JAM_IN_V2, 
                            DATE_FORMAT(A.JAM_OUT, '%d-%m-%Y %H:%i:%s') AS JAM_OUT_V2, 
                            A.ID_ABS_TYPE, A.REMARK, 
                            B.ABS_TYPE_DESC AS ABS_TYPE_DESC
                            ");
        $this->db->from('z_absensi A');
        $this->db->join('z_absen_type B','A.ID_ABS_TYPE=B.ID_ABS_TYPE');
        $this->db->join('z_karyawan C','A.NIK=C.NIK');
        $this->db->join('z_absen_type E','A.ID_ABS_TYPE=E.ID_ABS_TYPE','LEFT');
        $this->db->where('A.TGL_ABS NOT IN (SELECT X1.TGL_ABS FROM z_lap_absensi_log AS X1 WHERE X1.NIK=A.NIK)', NULL, FALSE);

        // if($id !=0 || $id != NULL || $id != ''){
        //     $this->db->where('A.NIK =', $id);
        // }
        $this->db->where('A.NIK =', $id);
        $this->db->where('A.COMP_CODE =', $comp_code);
        $this->db->where("DATE_FORMAT(A.TGL_ABS, '%Y-%m-%d') >=", $period_awal );
        $this->db->where("DATE_FORMAT(A.TGL_ABS, '%Y-%m-%d') <=", $period_akhir );
        $this->db->order_by("A.TGL_ABS","DESC");  
        $this->db->order_by("A.JAM_IN","DESC");         
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }


        //UNTUK MENAMPILKAN LIST HISTORY ABSENSI KARYAWAN
    public function getAbsensiListReport($id = null, $comp_code = null, $period_awal = null, $period_akhir = null) // $id defaultnya adalah null
        {
            $this->db->select(" A.NIK, A.TGL_ABS, '' AS LOKASI, C.EMP_NAME, 
                                CONCAT( DATE_FORMAT(A.TGL_ABS, '%Y'),'/' ,DATE_FORMAT(A.TGL_ABS, '%Y%m%d')) AS PATH,
                                '' AS FOTO_MASUK, '' AS FOTO_PULANG,
                                DATE_FORMAT(A.TGL_ABS, '%d-%m-%Y') AS TGL, 
                                COALESCE(DATE_FORMAT(A.JAM_IN, '%H:%i:%s'), DATE_FORMAT(A.JAM_IN, '%H:%i:%s') ) AS JAM_IN,
                                COALESCE(DATE_FORMAT(A.JAM_OUT, '%H:%i:%s'), DATE_FORMAT(A.JAM_OUT, '%H:%i:%s') ) AS JAM_OUT,
                                DATE_FORMAT(A.JAM_IN, '%d-%m-%Y %H:%i:%s') AS JAM_IN_V2, 
                                DATE_FORMAT(A.JAM_OUT, '%d-%m-%Y %H:%i:%s') AS JAM_OUT_V2, 
                                A.ID_ABS_TYPE, A.REMARK, 
                                B.ABS_TYPE_DESC AS ABS_TYPE_DESC
                                ");
            $this->db->from('z_lap_absensi_log A');
            $this->db->join('z_absen_type B','A.ID_ABS_TYPE=B.ID_ABS_TYPE');
            $this->db->join('z_karyawan C','A.NIK=C.NIK');
            // if($id !=0 || $id != NULL || $id != ''){
            //     $this->db->where('A.NIK =', $id);
            // }
            $this->db->where('A.NIK =', $id);
            $this->db->where('A.COMP_CODE =', $comp_code);
            $this->db->where("DATE_FORMAT(A.TGL_ABS, '%Y-%m-%d') >=", $period_awal );
            $this->db->where("DATE_FORMAT(A.TGL_ABS, '%Y-%m-%d') <=", $period_akhir );
            $this->db->order_by("A.TGL_ABS","DESC");  
            $this->db->order_by("A.JAM_IN","DESC");         
            $Q = $this->db->get();
            $this->_data = $Q->result();
            $Q->free_result();
            return $this->_data;
        }

    //UNTUK MENAMPILKAN LIST HISTORY ABSENSI KARYAWAN
    public function getAbsensiListDashboard($id = null, $comp_code = null, $period_awal = null, $period_akhir = null) // $id defaultnya adalah null
    {
        $this->db->select(" A.NIK, A.TGL_ABS, A.LOKASI, C.EMP_NAME, A.LOKASI, 
                            A.URL_FOTO AS FOTO_MASUK, A.URL_FOTO_PULANG AS FOTO_PULANG,
                            DATE_FORMAT(A.TGL_ABS, '%d-%m-%Y') AS TGL, 
                            DATE_FORMAT(A.JAM_IN, '%m-%d-%Y %H:%i') JAM_IN,
                            DATE_FORMAT(A.JAM_OUT, '%m-%d-%Y %H:%i') JAM_OUT,
                            A.ID_ABS_TYPE, A.REMARK, B.ABS_TYPE_DESC, A.ID_ABS_TYPE");
        $this->db->from('z_absensi A');
        $this->db->join('z_absen_type B','A.ID_ABS_TYPE=B.ID_ABS_TYPE');
        $this->db->join('z_karyawan C','A.NIK=C.NIK');
        if($id!=0 && $id!=null ){
            $this->db->where('A.NIK =', $id);
        }
        //$this->db->where('A.NIK =', $id);
        $this->db->where("A.COMP_CODE =", $comp_code );
        $this->db->where("DATE_FORMAT(A.TGL_ABS, '%Y-%m-%d') >=", $period_awal );
        $this->db->where("DATE_FORMAT(A.TGL_ABS, '%Y-%m-%d') <=", $period_akhir );
        $this->db->where_in("A.ID_ABS_TYPE",array(1,2));
        $this->db->limit(5);
        $this->db->order_by("A.TGL_ABS","DESC");  
        $this->db->order_by("A.JAM_IN","DESC");         
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    //UNTUK MENAMPILKAN JUMLAH KEHADIRAN ABSENSI KARYAWAN PERJENIS ABSEN
    public function getJmlKehadiran($id = null, $comp_code = null, $period_awal = null, $period_akhir = null) // $id defaultnya adalah null
    {
        $sql = "SELECT COUNT(TB.JML) AS JML FROM (
            SELECT
                DISTINCT(TGL_ABS) AS JML
            FROM
            z_lap_absensi_log A
            JOIN z_absen_type B ON A.ID_ABS_TYPE = B.ID_ABS_TYPE
            WHERE
                A.NIK = ? 
            AND A.COMP_CODE= ? 
            AND DATE_FORMAT(A.TGL_ABS, '%Y-%m-%d') >= ? 
            AND DATE_FORMAT(A.TGL_ABS, '%Y-%m-%d') <= ? 
            AND A.ID_ABS_TYPE IN (1, 2) ) AS TB";
        $query = $this->db->query($sql,array($id,$comp_code,$period_awal,$period_akhir));
        $this->_data = $query->row();
        $query->free_result(); 
        return $this->_data; 
    }

    //UNTUK MENAMPILKAN JUMLAH TIDAK HADIR ABSENSI KARYAWAN PERJENIS ABSEN
    public function getJmlTidakhadir($id = null, $comp_code = null, $period_awal = null, $period_akhir = null) // $id defaultnya adalah null
    {
        $sql = "SELECT COUNT(TB.JML) AS JML FROM (
            SELECT
                DISTINCT(TGL_ABS) AS JML
            FROM
            z_lap_absensi_log A
            JOIN z_absen_type B ON A.ID_ABS_TYPE = B.ID_ABS_TYPE
            WHERE
                A.NIK = ? 
            AND A.COMP_CODE= ? 
            AND DATE_FORMAT(A.TGL_ABS, '%Y-%m-%d') >= ? 
            AND DATE_FORMAT(A.TGL_ABS, '%Y-%m-%d') <= ? 
            AND A.ID_ABS_TYPE IN (3,6,8) ) AS TB";
        $query = $this->db->query($sql,array($id,$comp_code,$period_awal,$period_akhir));
        $this->_data = $query->row();
        $query->free_result(); 
        return $this->_data; 
    }

    //UNTUK MENAMPILKAN SUMMARY REKAP ABSENSI KARYAWAN PERJENIS ABSEN
    public function getAbsensiSummary($id = null, $comp_code = null, $period_awal = null, $period_akhir = null) // $id defaultnya adalah null
    {
        //$period_awal = $this->getPeriodTgl($comp_code,1);
        //$period_akhir = $this->getPeriodTgl($comp_code,2);

        $this->db->select("A.ID_ABS_TYPE, B.ABS_TYPE_DESC , COUNT(A.ID_ABS_TYPE) AS JML");
        $this->db->from('z_lap_absensi_log A');
        $this->db->join('z_absen_type B','A.ID_ABS_TYPE=B.ID_ABS_TYPE');
        
        if (!empty($comp_code) || $comp_code != ''){
            $this->db->where('A.COMP_CODE =', $comp_code);
        }

        if (!empty($id) || $id != ''){
            $this->db->where('A.NIK =', $id);
        }
        
        if (!empty($start_date)  &&  !empty($end_date)  )  {
            $this->db->where("DATE_FORMAT(A.TGL_ABS, '%Y-%m-%d')  >=", $period_awal );
            $this->db->where("DATE_FORMAT(A.TGL_ABS, '%Y-%m-%d')  <=", $period_akhir );  
        }
 
        $this->db->group_by(array("A.ID_ABS_TYPE","B.ABS_TYPE_DESC"));        
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    //UNTUK MENAMPILKAN PERIODE GAJI
    public function getPeriodeGaji($comp_code = null) // $id defaultnya adalah null
    {
        $this->db->select("A.COMP_CODE, A.TGL_AWAL, A.TGL_AKHIR");
        $this->db->from('z_periode_gaji A');
        $this->db->where('A.COMP_CODE =', $comp_code);      
        $Q = $this->db->get();
        $this->_data = $Q->row();
        $Q->free_result();                
        return $this->_data; 
    }

    //UNTUK MENAMPILKAN PERIODE GAJI
    public function getPeriodTgl($comp_code=null,$type=null) // $id defaultnya adalah null
    {
      $current_date = date("Y-m-d");
      // Type 1=> Awal, Type 2 => Akhir, Type 3=> Awal - 30 hari
      if($type==1){
        $month = date("Y-m", strtotime("-1 months"));
        $res = $this->getPeriodeGaji($comp_code);
        $ret_date = $month.'-'.$res->TGL_AWAL;
      }else if($type==2){
        $month = date("Y-m");
        $res = $this->getPeriodeGaji($comp_code);
        $ret_date = $month.'-'.$res->TGL_AKHIR;
      }else if($type==3){
        $month = date("Y-m", strtotime("-2 months"));
        $res = $this->getPeriodeGaji($comp_code);
        $ret_date = $month.'-'.$res->TGL_AWAL;
      }
      return $ret_date;
    }

    //PENGECEKAN STATUS ABSEN
    public function getCekAbsensi($nik = null, $comp_code = null, $date = null, $type = null) // $id defaultnya adalah null
    {
        $sql    = "SELECT Z_F_CEK_ABSEN(?,?,?,?) AS RESULT FROM DUAL";
        $query  = $this->db->query($sql,array($nik,$comp_code,$date,$type));
        $this->_data = $query->row();
        $query->free_result(); 
        return $this->_data; 
    }

    // INSERT KE TABLE ABSENSI
    function InsertAbsen_($data,$date=null,$type=null){
        $current_time = date("Y-m-d h:i:s");
        $this->db->trans_begin();
        if($type==1){
            $this->db->set('JAM_IN',"to_date('$current_time ', 'YYYY-mm-dd hh24:mi:ss')",false);
        }else if($type==2){
            $this->db->set('JAM_OUT',"to_date('$current_time ', 'YYYY-mm-dd hh24:mi:ss')",false);
        }
        $this->db->set('TGL_ABS',"to_date('$date', 'YYYY-mm-dd')",false);
        $this->db->insert("z_absensi", $data);    
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return false;           
        }
        else
        {
            $this->db->trans_commit();           
            return true;          
        }
    }

    // INSERT/UPDATE KE TABLE ABSENSI
    public function InsertAbsen($type = null, $nik = null, $comp_code = null, $year = null, $tgl_abs = null, $jam = null, $id_abs_type = null, 
                                $longitude = null, $latitude = null, $lokasi = null, $url_foto = null, $device = null, $status_pengajuan = null, 
                                $id_tp = null, $jadwal_masuk = null, $jadwal_pulang = null, $type_jadwal = null) 
    {
        //JIKA TIPE JADWAL LEWAT HARI 
        if($type_jadwal == 2){
            $sql = "CALL Z_P_SIMPAN_ABSEN_LEWATHARI(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $result = $this->db->query($sql,array($type, $nik, $comp_code, $year,
                                                  $tgl_abs, $jam, $id_abs_type, 
                                                  $longitude, $latitude, $lokasi, 
                                                  $url_foto, $device, $status_pengajuan, 
                                                  $id_tp, $jadwal_masuk, $jadwal_pulang));
            $result->free_result();

        }else{
            $sql = "CALL Z_P_SIMPAN_ABSEN(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $result = $this->db->query($sql,array($type, $nik, $comp_code, $year,
                                                  $tgl_abs, $jam, $id_abs_type, 
                                                  $longitude, $latitude, $lokasi, 
                                                  $url_foto, $device, $status_pengajuan, 
                                                  $id_tp, $jadwal_masuk, $jadwal_pulang));
            $result->free_result();
            
        }


        if ($result !== NULL) {
            return TRUE;
        }
        return FALSE;
    }

    //UNTUK MENGECEK KARYAWAN BISA ABSEN MOBILE/TIDAK
    public function CekAbsenMobile($nik = null, $comp_code = null) // $nik defaultnya adalah null
    {
        $this->db->select("A.STAT_SALES AS STAT_SALES, A.STAT_ABSEN_MOBILE AS STAT_ABSEN_MOBILE, C.LONG, C.LAT, C.BATAS");
        $this->db->from('z_personalize A');
        $this->db->join('z_karyawan B','A.nik_staff = B.nik AND A.comp_code = B.comp_code');
        $this->db->join('z_kantor C','B.kantor_id = C.kantor_id');
        $this->db->where('A.NIK_STAFF =', $nik); 
        $this->db->where('A.COMP_CODE =', $comp_code);      
        $Q = $this->db->get();
        $this->_data = $Q->row();
        $Q->free_result();                
        return $this->_data; 
    }


    //UNTUK MENDAPATKAN PERIODE GAJI
    public function getPeriodeGaji_($comp_code = null)
    {
        $this->db->select("A.COMP_CODE, A.TGL_AWAL, A.TGL_AKHIR, A.STAT_BULAN");
        $this->db->from('z_periode_gaji A');
        $this->db->where('A.COMP_CODE =', $comp_code);
        $Q = $this->db->get();
        $row = $Q->row();
        $Q->free_result();
        $tgl_awal = $row->TGL_AWAL;
        $tgl_akhir = $row->TGL_AKHIR;

        $current_date = date("d");
        //JIKA PERIODE DALAM 1 BULAN
        if($row->STAT_BULAN == 1){
            if ($current_date >= $tgl_awal) {
                $start_date = $tgl_awal . '-' . date("m-Y");
                $start_date_cal = date("Y/m") . '/' . $tgl_awal;
                if (date("m")<12){
                    $bulan = str_pad((date("m")+1), 2, "0", STR_PAD_LEFT);
                    $end_date = $tgl_akhir . '-' . $bulan .'-'. date("Y") ;
                    $end_date_cal = date("Y").'/'. $bulan . '/' . $tgl_akhir;    
                }
                else{
                    $end_date = $tgl_akhir . '-01-' . (date("Y")+1) ;
                    $end_date_cal = (date("Y")+1).'//01//'. $tgl_akhir;    
                }
            } else { // jika $current_date < $tgl_awal
                if (date("m") == 1){
                    $start_date = $tgl_awal . '-12-' .(date("Y")-1);
                    $start_date_cal = (date("Y")-1). '//12//' . $tgl_awal;
                }
                else{
                    $bulan = str_pad((date("m")-1), 2, "0", STR_PAD_LEFT);
                    $start_date = $tgl_awal . '-' . $bulan .'-'.(date("Y"));
                    $start_date_cal = date("Y").'/' .$bulan.'/' . $tgl_awal;
                }
                $end_date = $tgl_akhir . '-' . date("m-Y");
                $end_date_cal = date("Y/m") . '/' . $tgl_akhir;
            }
        }else{
            $start_date = '0'.$tgl_awal . '-' . date("m-Y");
            $end_date = date("t-m-Y", strtotime($start_date));

            $start_date_cal = '';
            $end_date_cal   = '';

        }

        $datatgl = array(
            'start_date'      => $start_date,
            'start_date_cal'  => $start_date_cal,
            'end_date'        => $end_date,
            'end_date_cal'    => $end_date_cal
        );
        return $datatgl;
    }

}
