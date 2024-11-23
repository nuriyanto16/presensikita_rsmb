<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Mdashboard extends Mst_model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getJmlPengajuan($sts_aju=null, $comp_id = null, $nik = null, $start_date = null, $end_date = null) {
        $this->db->select(" 
        CASE a.jns_aju 
                        WHEN 'IZ' THEN 'Izin/Sakit'
                        WHEN 'CT' THEN 'Cuti'
                        WHEN 'PO' THEN 'Pengobatan'
                        WHEN 'LS' THEN 'Pengobatan'
                        WHEN 'FR' THEN 'Pengobatan'
                        WHEN 'PB' THEN 'Penggantian Biaya'
                        WHEN 'PD' THEN 'Dinas'
                        WHEN 'TR' THEN 'Pelatihan'
                        WHEN 'AB' THEN 'Absen diluar Jadwal'
        END AS jenis_pengajuan_nama,
        CASE a.jns_aju  
                        WHEN 'IZ' THEN 2
                        WHEN 'CT' THEN 3 
                        WHEN 'PO' THEN 4
                        WHEN 'LS' THEN 4
                        WHEN 'FR' THEN 4
                        WHEN 'PB' THEN 5
                        WHEN 'PD' THEN 6
                        WHEN 'TR' THEN 7
                        WHEN 'AB' THEN 1 
        END AS jenis_pengajuan_id,
        COUNT(a.id_aju) AS jml
        ");
        $this->db->from("z_head_aju a");
        $this->db->join("z_jns_aju b", "a.jns_aju=b.jns_aju", "inner");
        $this->db->join("z_karyawan c", "a.nik=c.nik AND a.comp_code=c.comp_code", "inner");
       
        if (!empty($sts_aju))  {
            $this->db->where("a.sts_aju",$sts_aju);
        }

        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            $this->db->where("c.compid", $this->session->userdata(sess_prefix()."compId"));
        }
        if (!empty($comp_id))  {
            $this->db->where("c.compid",$comp_id);
        }

        if (!empty($nik))  {
            $this->db->where("a.nik",$nik);
        }

        if (!empty($start_date)  &&  !empty($end_date)  )  {
            $this->db->where("a.tgl_aju >=",$this->_fyyyymmdd($start_date));
            $this->db->where("a.tgl_aju <=",$this->_fyyyymmdd($end_date));
        }
       
        $this->db->group_by("a.jns_aju");


        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    //UNTUK MENAMPILKAN LIST HISTORY ABSENSI KARYAWAN
    public function getAbsensiListDashboard($comp_id = null, $nik = null, $start_date = null, $end_date = null) // $id defaultnya adalah null
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
        if($id!=0){
            $this->db->where('A.NIK =', $id);
        }
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



    public function getdataMapAbsensi($comp_id = null, $nik = null, $start_date = null, $end_date = null) {
        $this->db->select(" 
            a.comp_code as comp_code, 
            CONCAT('POINT(',a.longitude,' ',a.latitude,')') AS geom_text,
            CONCAT( DATE_FORMAT(a.tgl_abs, '%Y'),'/' ,DATE_FORMAT(a.tgl_abs, '%Y%m%d')) AS path,
            a.lokasi, a.lokasi, 
            SPLIT_STRING(a.url_foto , '.png', 1) AS foto_masuk,
            SPLIT_STRING(a.url_foto_pulang , '.png', 1) AS foto_pulang,
            DATE_FORMAT(a.tgl_abs, '%d-%m-%Y') AS tgl_absen, 
            DATE_FORMAT(a.jam_in, '%m-%d-%Y %H:%i') jam_in,
            DATE_FORMAT(a.jam_out, '%m-%d-%Y %H:%i') jam_out,
            b.emp_name AS emp_name, 
            a.longitude, a.latitude, c.abs_type_desc
        ");
        $this->db->from("z_absensi a");
        $this->db->join("z_karyawan b", "a.nik=b.nik AND a.comp_code=b.comp_code", "inner");
        $this->db->join('z_absen_type c','a.id_abs_type=c.id_abs_type');


        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            $this->db->where("b.compid", $this->session->userdata(sess_prefix()."compId"));
        }
        if (!empty($comp_id))  {
            $this->db->where("b.compid",$comp_id);
        }

        if(isset($nik)){
            if(!empty($nik)){
                $this->db->where("a.nik",$nik);
            }
        }


        //if (!empty($start_date)  &&  !empty($end_date)  )  {
            $this->db->where("a.tgl_abs >=",$this->_fyyyymmdd($start_date));
            $this->db->where("a.tgl_abs <=",$this->_fyyyymmdd($end_date));
        //}

        $this->db->where("(a.longitude IS NOT NULL AND a.latitude IS NOT NULL)");
    
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }


    //16-12-2019
    public function _fyyyymmdd($date_str){
        $date ="";
        $dd=substr($date_str, 0, 2);
        $mm=substr($date_str, 3, 2);
        $yyyy=substr($date_str, 6, 4);
        $date = $yyyy."-".$mm."-".$dd;
        return $date;
    }

}



