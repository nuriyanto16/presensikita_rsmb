<?php

class Laporan_model extends CI_Model
{
    private $_data = null;

    //UNTUK MENAMPILKAN LIST HISTORY izin KARYAWAN
    public function getLaporanList($id = null, $nik_cari = null, $comp_code = null, $period_awal=null, $period_akhir=null, $periode = null, $status=null) // $id defaultnya adalah null
    {
        $this->db->select("A.ID_AJU, DATE_FORMAT(A.TGL_AJU, '%d-%m-%Y') AS TGL_AJU, 
                            A.NIK, A.STS_AJU, 
                            CASE A.STS_AJU 
                                WHEN 0 THEN 'DIAJUKAN' 
                                WHEN 1 THEN 'DISETUJUI' 
                                WHEN 2 THEN 'DITOLAK' 
                            END AS STAT_PENGAJUAN,
                            A.JNS_AJU, B.DESC_AJU,
                            C.JNS_STAT AS JNS_IZIN, 
                            C.DESC_STAT AS DESC_IZIN,
                            C.JNS_STAT AS ID_ABS_TYPE,
                            A.REMARK,  
                            DATE_FORMAT(A.TGL_AJU, '%d-%m-%Y') AS TGL_AWAL_IZIN, 
                            DATE_FORMAT(A.TGL_AJU, '%d-%m-%Y') AS TGL_AKHIR_IZIN");
        $this->db->from('z_head_laporan A');
        $this->db->join('z_jns_aju B','A.JNS_AJU=B.JNS_AJU');
        $this->db->join('z_jns_stat C','A.HEAD_TEXT1=C.JNS_STAT');

        if(!empty($nik_cari)){
            $this->db->where('A.NIK =', $nik_cari);
        }else{
            $this->db->where('A.NIK =', $id);
        }

        //$this->db->where('A.STS_AJU =', 1);
        $this->db->where("DATE_FORMAT(A.TGL_AJU, '%Y-%m-%d') >=", $period_awal );
        $this->db->where("DATE_FORMAT(A.TGL_AJU, '%Y-%m-%d') <=", $period_akhir );
        $this->db->order_by("A.TGL_AJU","DESC");             
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    //UNTUK MENAMPILKAN EDIT VIEW IZIN
    public function getLaporanEdit($pengajuan_id = null) // $id defaultnya adalah null
    {
        $this->db->select("A.ID_AJU, DATE_FORMAT(A.TGL_AJU, '%d-%m-%Y') AS TGL_AJU, 
                            A.NIK, E.COMP_CODE, A.STS_AJU, 
                            CASE A.STS_AJU 
                                WHEN 0 THEN 'DIAJUKAN' 
                                WHEN 1 THEN 'DISETUJUI' 
                                WHEN 2 THEN 'DITOLAK' 
                            END AS STAT_PENGAJUAN,
                            A.JNS_AJU, B.DESC_AJU,
                            C.JNS_STAT AS JNS_IZIN, 
                            C.DESC_STAT AS DESC_IZIN,
                            C.JNS_STAT AS ID_ABS_TYPE,
                            A.REMARK AS ALASAN_IZIN, 
                            DATE_FORMAT(A.TGL_AJU, '%d-%m-%Y') AS TGL_AWAL_IZIN, 
                            DATE_FORMAT(A.TGL_AJU, '%d-%m-%Y') AS TGL_AKHIR_IZIN, 
                            STR_TO_DATE(A.TGL_AJU, '%Y-%m-%d') -  STR_TO_DATE(A.TGL_AJU, '%Y-%m-%d') + 1 AS JML ");
        $this->db->from('z_head_laporan A');
        $this->db->join('z_jns_aju B','A.JNS_AJU=B.JNS_AJU');
        $this->db->join('z_jns_stat C','A.HEAD_TEXT1=C.JNS_STAT');
        $this->db->join('z_karyawan E','A.NIK=E.NIK');
        $this->db->where('A.ID_AJU =', $pengajuan_id);            
        $Q = $this->db->get();
        $this->_data = $Q->row();
        $Q->free_result();
        return $this->_data;
    }

    //UNTUK MENAMPILKAN EDIT VIEW IZIN
    public function getAttachment($pengajuan_id = null) // $id defaultnya adalah null
    {
        $this->db->select("ID_AJU, SEQ_ATC, URL_ATC_IZIN");
        $this->db->from('z_r_laporan_url A');
        $this->db->where('A.ID_AJU =', $pengajuan_id);            
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    //UNTUK MENAMPILKAN TIPE IZIN
    public function getLaporanType($id = null, $comp_code = null)
    {
        $this->db->select("A.JNS_STAT AS JNS_IZIN, A.DESC_STAT AS DESC_IZIN");
        $this->db->from('z_jns_stat A');
        //$this->db->order_by("A.ID_ABS_TYPE","ASC");         
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    // INSERT/UPDATE
    public function InsUpdLaporan($pengajuan_id = null, $nik = null, $comp_code = null, $id_abs_type = null, 
                               $remark = null, $periode=null, $date=null, $start_date = null, $end_date = null, $jml = null,
                               $cnt_file=null, $params_image_input=null) 
    {
        $sql = "CALL Z_P_SIMPAN_LAPORAN(?,?,?,?,?,?,?,?,?,?,?,?)";
        $res = $this->db->query($sql,array($pengajuan_id, $nik, $comp_code, $id_abs_type, $remark, $periode, $date, $start_date, $end_date, $jml, $cnt_file, $params_image_input));
        $result = $res->result();
        @mysqli_next_result($this->db->conn_id);
        if ($result !== NULL) {
            return TRUE;
        }
        return FALSE;
    }

    function InsertAttachment($data){
        $this->db->trans_begin();
        $this->db->insert("z_r_laporan_url", $data);    
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

    function DeleteAllAttachment($pengajuan_id){
        $this->db->trans_begin();
        $this->db->where("ID_AJU", $pengajuan_id);  
        $this->db->delete("z_r_izin_url");   
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
}
