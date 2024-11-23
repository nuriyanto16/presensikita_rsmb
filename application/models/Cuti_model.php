<?php

class Cuti_model extends CI_Model
{
    private $_data = null;

    //UNTUK MENAMPILKAN LIST HISTORY CUTI KARYAWAN
    public function getCutiList($id = null, $comp_code = null, $period_awal=null, $period_akhir=null, $periode = null, $status=null) // $id defaultnya adalah null
    {
        $this->db->select("A.ID_AJU, DATE_FORMAT(A.TGL_AJU, '%d-%m-%Y') AS TGL_AJU, 
                            A.NIK, A.STS_AJU, 
                            CASE A.STS_AJU 
                                WHEN 0 THEN 'DIAJUKAN' 
                                WHEN 1 THEN 'DISETUJUI' 
                                WHEN 2 THEN 'DITOLAK' 
                            END AS STAT_PENGAJUAN,
                            A.JNS_AJU, B.DESC_AJU,
                            C.CUTI_ID, C.CUTI_DESC,
                            D.CUTI_ID AS ID_ABS_TYPE,
                            D.ALASAN_CUTI, 
                            DATE_FORMAT(D.TGL_AWAL_CUTI, '%d-%m-%Y') TGL_AWAL_CUTI, 
                            DATE_FORMAT(D.TGL_AKHIR_CUTI, '%d-%m-%Y') TGL_AKHIR_CUTI,
                            DATEDIFF(D.TGL_AKHIR_CUTI, D.TGL_AWAL_CUTI) + 1 AS JML
                            ");
        $this->db->from('z_head_aju A');
        $this->db->join('z_jns_aju B','A.JNS_AJU=B.JNS_AJU');
        $this->db->join('z_cuti_m C','A.HEAD_TEXT1=C.CUTI_ID');
        $this->db->join('z_r_cuti D','A.ID_AJU=D.ID_AJU');
        $this->db->where('A.NIK =', $id);
        //$this->db->where('A.STS_AJU =', 1);
        $this->db->where('A.ACTIVE =', 1);  
        $this->db->where("DATE_FORMAT(D.TGL_AWAL_CUTI, '%Y-%m-%d') >=", $period_awal );
        $this->db->where("DATE_FORMAT(D.TGL_AWAL_CUTI, '%Y-%m-%d') <=", $period_akhir );
        $this->db->order_by("D.TGL_AWAL_CUTI","DESC");             
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    //UNTUK MENAMPILKAN EDIT VIEW CUTI
    public function getCutiEdit($pengajuan_id = null) // $id defaultnya adalah null
    {
        $this->db->select("A.ID_AJU, DATE_FORMAT(A.TGL_AJU, '%d-%m-%Y') AS TGL_AJU, 
                            A.NIK, E.COMP_CODE, A.STS_AJU, 
                            CASE A.STS_AJU 
                                WHEN 0 THEN 'DIAJUKAN' 
                                WHEN 1 THEN 'DISETUJUI' 
                                WHEN 2 THEN 'DITOLAK' 
                            END AS STAT_PENGAJUAN,
                            A.JNS_AJU, B.DESC_AJU,
                            C.CUTI_ID, C.CUTI_DESC,
                            D.CUTI_ID AS ID_ABS_TYPE,
                            D.ALASAN_CUTI, 
                            DATE_FORMAT(D.TGL_AWAL_CUTI, '%d-%m-%Y') AS TGL_AWAL_CUTI, 
                            DATE_FORMAT(D.TGL_AKHIR_CUTI, '%d-%m-%Y') AS TGL_AKHIR_CUTI, 
                            DATEDIFF(D.TGL_AKHIR_CUTI, D.TGL_AWAL_CUTI) + 1 AS JML"
                        );
        $this->db->from('z_head_aju A');
        $this->db->join('z_jns_aju B','A.JNS_AJU=B.JNS_AJU');
        $this->db->join('z_cuti_m C','A.HEAD_TEXT1=C.CUTI_ID');
        $this->db->join('z_r_cuti D','A.ID_AJU=D.ID_AJU');
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
        $this->db->select("ID_AJU, SEQ_ATC, URL_ATC_CUTI");
        $this->db->from('z_r_cuti_url A');
        $this->db->where('A.ID_AJU =', $pengajuan_id);            
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    //UNTUK MENAMPILKAN SISA CUTI
    public function getSisaCuti($nik = null, $comp_code = null, $periode = null) // $id defaultnya adalah null
    {
        $sql = "SELECT Z_F_SISA_CUTI(?,?,?)  AS JML FROM DUAL";
        $query = $this->db->query($sql,array($nik,$comp_code,$periode));
        $this->_data = $query->row();
        $query->free_result(); 
        return $this->_data; 
    }

    //UNTUK MENAMPILKAN SISA CUTI
    public function getCutiDigunakan($nik = null, $comp_code = null, $periode = null) // $id defaultnya adalah null
    {
        $this->db->select("COALESCE(SUM(A.JML_CUTI),0) AS JML");
        $this->db->from('z_cuti_h A');
        $this->db->where('A.NIK = ', $nik);
        $this->db->where('A.COMP_CODE = ', $comp_code);
        $this->db->where('A.PERIODE = ', $periode);
        $this->db->where('A.STATUS = ', 1);
        $this->db->where('A.CUTI_ID = ', 1);
        $Q = $this->db->get();
        $this->_data = $Q->row();
        $Q->free_result();                
        return $this->_data; 
    }

    //UNTUK MENAMPILKAN TIPE CUTI
    public function getCutiType($id = null, $comp_code = null) // $id defaultnya adalah null
    {
        $this->db->select("A.CUTI_ID, A.CUTI_DESC");
        $this->db->from('z_cuti_m A');
        $this->db->order_by("A.CUTI_ID","ASC");         
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    // INSERT/UPDATE
    public function InsUpdCuti($pengajuan_id = null, $nik = null, $comp_code = null, $id_abs_type = null, 
                              $remark = null, $periode=null, $date=null, $start_date = null, $end_date = null, $jml = null, $cnt_file=null, $params_image_input=null ) 
    {
        $sql = "CALL Z_P_SIMPAN_CUTI(?,?,?,?,?,?,?,?,?,?,?,?)";
        $res = $this->db->query($sql,array($pengajuan_id, $nik, $comp_code, $id_abs_type, $remark, $periode, $date, $start_date, $end_date, $jml, $cnt_file, $params_image_input));
        if ($res !== NULL) {
            return TRUE;
        }
        return FALSE;
    }

    function InsertAttachment($data){
        $this->db->trans_begin();
        $this->db->insert("z_r_cuti_url", $data);    
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
        $this->db->delete("z_r_obat_url");   
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
