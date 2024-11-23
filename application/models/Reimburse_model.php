<?php

class Reimburse_model extends CI_Model
{
    private $_data = null;

    //UNTUK MENAMPILKAN LIST HISTORY CUTI KARYAWAN
    public function getReimburseList($id = null, $comp_code = null, $period_awal=null, $period_akhir=null, $periode = null, $status=null) 
    {
        $this->db->select("A.ID_AJU, DATE_FORMAT(A.TGL_AJU, '%d-%m-%Y') AS TGL_AJU, 
                            A.NIK, A.STS_AJU, 
                            CASE A.STS_AJU 
                                WHEN 0 THEN 'DIAJUKAN' 
                                WHEN 1 THEN 'DISETUJUI' 
                                WHEN 2 THEN 'DITOLAK' 
                            END AS STAT_PENGAJUAN,
                            A.JNS_AJU, B.DESC_AJU, 
                            DATE_FORMAT(C.TGL_KUITANSI, '%d-%m-%Y') AS TGL_AJU,
                            C.NOM_KUITANSI, C.JNS_GANTIB, C.KET_GANTIB, D.DESC_GANTIB");
        $this->db->from('z_head_aju A');
        $this->db->join('z_jns_aju B','A.JNS_AJU=B.JNS_AJU');
        $this->db->join('z_r_gantib C','A.ID_AJU=C.ID_AJU');
        $this->db->join('z_jns_gantib D','C.JNS_GANTIB=D.JNS_GANTIB');
        $this->db->where('A.NIK =', $id);
        //$this->db->where('A.STS_AJU =', 1);
        $this->db->where('A.ACTIVE =', 1);  
        $this->db->where("DATE_FORMAT(A.TGL_AJU, '%Y-%m-%d') >=", $period_awal );
        $this->db->where("DATE_FORMAT(A.TGL_AJU, '%Y-%m-%d') <=", $period_akhir );
        $this->db->order_by("A.TGL_AJU","DESC");             
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    //UNTUK MENAMPILKAN EDIT VIEW PENGOBATAN
    public function getReimburseEdit($pengajuan_id = null) // $id defaultnya adalah null
    {
        $this->db->select("A.ID_AJU, DATE_FORMAT(A.TGL_AJU, '%d-%m-%Y') AS TGL_AJU, 
                            A.NIK, A.STS_AJU, 
                            CASE A.STS_AJU 
                                WHEN 0 THEN 'DIAJUKAN' 
                                WHEN 1 THEN 'DISETUJUI' 
                                WHEN 2 THEN 'DITOLAK' 
                            END AS STAT_PENGAJUAN,
                            A.JNS_AJU, B.DESC_AJU, 
                            DATE_FORMAT(C.TGL_KUITANSI, '%d-%m-%Y') AS TGL_AJU,
                            C.NOM_KUITANSI, C.JNS_GANTIB, C.KET_GANTIB, D.DESC_GANTIB");
        $this->db->from('z_head_aju A');
        $this->db->join('z_jns_aju B','A.JNS_AJU=B.JNS_AJU');
        $this->db->join('z_r_gantib C','A.ID_AJU=C.ID_AJU');
        $this->db->join('z_jns_gantib D','C.JNS_GANTIB=D.JNS_GANTIB');
        $this->db->where('A.ID_AJU =', $pengajuan_id);            
        $Q = $this->db->get();
        $this->_data = $Q->row();
        $Q->free_result();
        return $this->_data;
    }

    //UNTUK MENAMPILKAN DETAIL ATTACHMENT
    public function getAttachment($pengajuan_id = null) // $id defaultnya adalah null
    {
        $this->db->select("ID_AJU, SEQ_ATC, URL_ATC_GANTIB");
        $this->db->from('z_r_gantib_url A');
        $this->db->where('A.ID_AJU =', $pengajuan_id);            
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    //UNTUK MENAMPILKAN TIPE REIMBURSE
    public function getReimburseType($id = null, $comp_code = null) // $id defaultnya adalah null
    {
        $this->db->select("A.JNS_GANTIB, A.DESC_GANTIB");
        $this->db->from('z_jns_gantib A');
        $this->db->order_by("A.JNS_GANTIB");         
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    // INSERT/UPDATE KE TABLE GANTIB
    public function InsUpdReimburse($pengajuan_id = null, $nik = null, $comp_code = null, $periode = null, $date = null, 
                               $jenis_reimburse_id = null, $nominal = null, $keterangan =null, $cnt_file=null, $params_image_input=null ) 
    {
        $sql = "CALL Z_P_SIMPAN_GANTIB(?,?,?,?,?,?,?,?,?,?)";
        $res = $this->db->query($sql,array($pengajuan_id, $nik, $comp_code, $periode, $date, $jenis_reimburse_id, $nominal, $keterangan, $cnt_file, $params_image_input));
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
        $this->db->delete("z_r_gantib_url");   
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
