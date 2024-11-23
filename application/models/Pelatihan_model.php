<?php

class Pelatihan_model extends CI_Model
{
    private $_data = null;

    //UNTUK MENAMPILKAN LIST HISTORY PELATIHAN KARYAWAN
    public function getPelatihanList($id = null, $comp_code = null, $date = null, $period_awal=null, $period_akhir=null, $periode = null, $stat=null) // $id defaultnya adalah null
    {
        $this->db->select("A.ID_AJU, DATE_FORMAT(A.TGL_AJU, '%d-%m-%Y') AS TGL_AJU, 
                            A.NIK, A.STS_AJU, 
                            CASE A.STS_AJU 
                                WHEN 0 THEN 'DIAJUKAN' 
                                WHEN 1 THEN 'DISETUJUI' 
                                WHEN 2 THEN 'DITOLAK' 
                            END AS STAT_PENGAJUAN,
                            A.JNS_AJU, B.DESC_AJU, 
                            C.NM_TRAINING, C.NM_LEMBAGA, C.TEMPAT_TR, 
                            DATE_FORMAT(C.TGL_START_TR, '%d-%m-%Y') AS TGL_START_TR,
                            DATE_FORMAT(C.TGL_END_TR, '%d-%m-%Y') AS TGL_END_TR,
                            C.CATATAN");
        $this->db->from('z_head_aju A');
        $this->db->join('z_jns_aju B','A.JNS_AJU=B.JNS_AJU');
        $this->db->join('z_r_training C','A.ID_AJU=C.ID_AJU');
        $this->db->where('A.NIK =', $id);
        //$this->db->where('A.STS_AJU =', 1);
        $this->db->where('A.ACTIVE =', 1);  
        if($stat==0){
            $this->db->where("DATE_FORMAT(C.TGL_START_TR, '%Y-%m-%d') >=", $date );
        }else{
            $this->db->where("DATE_FORMAT(C.TGL_START_TR, '%Y-%m-%d') <=", $date );
        }


        $this->db->order_by("A.TGL_AJU","DESC");             
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    //UNTUK MENAMPILKAN EDIT VIEW IZIN
    public function getPelatihanEdit($pengajuan_id = null) // $id defaultnya adalah null
    {
        $this->db->select("A.ID_AJU, DATE_FORMAT(A.TGL_AJU, '%Y-%m-%d') AS TGL_AJU, 
                            A.NIK, A.STS_AJU, 
                            CASE A.STS_AJU 
                                WHEN 0 THEN 'DIAJUKAN' 
                                WHEN 1 THEN 'DISETUJUI' 
                                WHEN 2 THEN 'DITOLAK' 
                            END AS STAT_PENGAJUAN,
                            A.JNS_AJU, B.DESC_AJU, 
                            C.NM_TRAINING, C.NM_LEMBAGA, C.TEMPAT_TR, 
                            DATE_FORMAT(C.TGL_START_TR, '%d-%m-%Y') AS TGL_START_TR,
                            DATE_FORMAT(C.TGL_END_TR, '%d-%m-%Y') AS TGL_END_TR,
                            C.CATATAN");
        $this->db->from('z_head_aju A');
        $this->db->join('z_jns_aju B','A.JNS_AJU=B.JNS_AJU');
        $this->db->join('z_r_training C','A.ID_AJU=C.ID_AJU');
        $this->db->where('A.ID_AJU =', $pengajuan_id);            
        $Q = $this->db->get();
        $this->_data = $Q->row();
        $Q->free_result();
        return $this->_data;
    }
    //NOTIF JUMLAH NEXT TRAINING
    public function getJmlNextTraining($nik = null, $comp_code = null, $periode = null, $date = null) 
    {
        $this->db->select("COALESCE(COUNT(A.NIK),0) AS JML");
        $this->db->from('z_head_aju A');
        $this->db->join('z_r_training B','A.ID_AJU=B.ID_AJU');
        $this->db->where('A.NIK = ', $nik);
        $this->db->where("DATE_FORMAT(B.TGL_START_TR, '%Y-%m-%d') >=", $date );
        $this->db->where('A.STS_AJU = ', 1);
        $Q = $this->db->get();
        $this->_data = $Q->row();
        $Q->free_result();                
        return $this->_data; 
    }

    public function getAttachment($pengajuan_id = null) // $id defaultnya adalah null
    {
        $this->db->select("ID_AJU, SEQ_ATC, URL_ATC_TRAINING");
        $this->db->from('z_r_training_url A');
        $this->db->where('A.ID_AJU =', $pengajuan_id);            
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    // INSERT/UPDATE KE TABLE PELATIHAN
    public function InsUpdPelatihan($pengajuan_id=null, $nik=null, $comp_code=null, $periode=null, $date=null, $nm_lembaga=null, $nm_training=null, $tempat_tr=null, $tgl_start_tr=null, $tgl_end_tr=null, $catatan=null, $cnt_file=null, $params_image_input=null) 
    {
        $sql = "CALL Z_P_SIMPAN_PELATIHAN(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $res = $this->db->query($sql,array($pengajuan_id, $nik, $comp_code, $periode, $date, $nm_lembaga, $nm_training, $tempat_tr, $tgl_start_tr, $tgl_end_tr, $catatan, $cnt_file, $params_image_input));
        $result = $res->result();
        @mysqli_next_result($this->db->conn_id);
        if ($res !== NULL) {
            return TRUE;
        }
        return FALSE;
    }

    function InsertAttachment($data){
        $this->db->trans_begin();
        $this->db->insert("z_r_gantib_url", $data);    
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
        $this->db->delete("z_r_training_url");   
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
