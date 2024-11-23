<?php

class Pengobatan_model extends CI_Model
{
    private $_data = null;

    //UNTUK MENAMPILKAN LIST HISTORY CUTI KARYAWAN
    public function getPengobatanList($id = null, $comp_code = null, $period_awal=null, $period_akhir=null, $periode = null, $status=null) // $id defaultnya adalah null
    {
        $this->db->select("A.ID_AJU, DATE_FORMAT(A.TGL_AJU, '%d-%m-%Y') AS TGL_AJU, 
                            A.NIK, A.STS_AJU, 
                            CASE A.STS_AJU 
                                WHEN 0 THEN 'DIAJUKAN' 
                                WHEN 1 THEN 'DISETUJUI' 
                                WHEN 2 THEN 'DITOLAK' 
                            END AS STAT_PENGAJUAN,
                            A.JNS_AJU, B.DESC_AJU, 
                            C.NAMA_KUITANSI, C.TGL_KUITANSI, C.DIAGNOSA, C.NOM_KUITANSI, C.NILAI_DIGANTI");
        $this->db->from('z_head_aju A');
        $this->db->join('z_jns_aju B','A.JNS_AJU=B.JNS_AJU');
        $this->db->join('z_r_obat C','A.ID_AJU=C.ID_AJU');
        $this->db->where('A.NIK =', $id);
        //$this->db->where('A.STS_AJU =', 1);
        $this->db->where('A.ACTIVE =', 1);  
        $this->db->where("DATE_FORMAT(A.TGL_AJU, '%Y-%m-%d') >=", $period_awal );
        $this->db->where("DATE_FORMAT(A.TGL_AJU, '%Y-%m-%d')  <=", $period_akhir );
        $this->db->order_by("A.TGL_AJU","DESC");             
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    //UNTUK MENAMPILKAN EDIT VIEW IZIN
    public function getPengobatanEdit($pengajuan_id = null) // $id defaultnya adalah null
    {
        $this->db->select("A.ID_AJU, DATE_FORMAT(A.TGL_AJU,'%d-%m-%Y') AS TGL_AJU, 
                            A.NIK, A.STS_AJU, 
                            CASE A.STS_AJU 
                                WHEN 0 THEN 'DIAJUKAN' 
                                WHEN 1 THEN 'DISETUJUI' 
                                WHEN 2 THEN 'DITOLAK' 
                            END AS STAT_PENGAJUAN,
                            A.JNS_AJU, B.DESC_AJU, 
                            C.NAMA_KUITANSI, 
                            DATE_FORMAT(C.TGL_KUITANSI,'%d-%m-%Y') AS TGL_KUITANSI,  C.DIAGNOSA, C.NOM_KUITANSI, C.NILAI_DIGANTI");
        $this->db->from('z_head_aju A');
        $this->db->join('z_jns_aju B','A.JNS_AJU=B.JNS_AJU');
        $this->db->join('z_r_obat C','A.ID_AJU=C.ID_AJU');
        $this->db->where('A.ID_AJU =', $pengajuan_id);            
        $Q = $this->db->get();
        $this->_data = $Q->row();
        $Q->free_result();
        return $this->_data;
    }

    public function getAttachment($pengajuan_id = null) // $id defaultnya adalah null
    {
        $this->db->select("ID_AJU, SEQ_ATC, URL_ATC_OBAT");
        $this->db->from('z_r_obat_url A');
        $this->db->where('A.ID_AJU =', $pengajuan_id);            
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    //UNTUK MENAMPILKAN SISA PLAFOND
    public function getSisaPlafond($nik = null, $comp_code = null) 
    {
        $sql = "SELECT Z_F_SISA_CUTI(?,?)  AS JML FROM DUAL";
        $query = $this->db->query($sql,array($nik,$comp_code));
        $this->_data = $query->row();
        $query->free_result(); 
        return $this->_data; 
    }

    //UNTUK MENAMPILKAN PLAFOND YANG DIGUNAKAN
    public function getPlafondDigunakan($nik = null, $comp_code = null, $periode = null) 
    {
        $this->db->select("SUM(A.JML_CUTI) AS JML");
        $this->db->from('Z_CUTI_H A');
        $this->db->where('A.NIK = ', $nik);
        $this->db->where('A.COMP_CODE = ', $comp_code);
        $this->db->where('A.PERIODE = ', $periode);
        $Q = $this->db->get();
        $this->_data = $Q->row();
        $Q->free_result();                
        return $this->_data; 
    }

    public function getPengobatanDigunakan($nik = null, $comp_code = null, $periode = null) 
    {
        $this->db->select("COALESCE(SUM(B.NILAI_DIGANTI),0) AS JML");
        $this->db->from('z_head_aju A');
        $this->db->join('z_r_obat B','A.ID_AJU=B.ID_AJU');
        $this->db->where('A.NIK = ', $nik);
        $this->db->where("DATE_FORMAT(B.TGL_KUITANSI, '%Y') =", $periode );
        $this->db->where('A.STS_AJU = ', 1);
        $Q = $this->db->get();
        $this->_data = $Q->row();
        $Q->free_result();                
        return $this->_data; 
    }

    //UNTUK MENAMPILKAN DATA KELUARGA
    public function getKeluarga($id = null, $comp_code = null) 
    {
        $this->db->select("A.NIK, A.NAMA_KEL, A.RELASI_KEL, A.JNS_KELAMIN, A.MSH_HIDUP");
        $this->db->from('z_keluarga A');
        $this->db->where('A.NIK =', $id);
        $this->db->where('A.GANTI_OBAT >', 0);
        $this->db->order_by("A.NAMA_KEL","ASC");         
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    // INSERT/UPDATE KE TABLE PENGOBATAN
    public function InsUpdPengobatan($pengajuan_id = null, $nik= null, $comp_code= null, $periode= null, $jam= null, $pengobatan_id= null, $nama_kuitansi= null, $diagnosa= null, $nominal= null, $nilai_diganti= null, $cnt_file=null, $params_image_input=null) 
    {
        $sql = "CALL Z_P_SIMPAN_PENGOBATAN(?,?,?,?,?,?,?,?,?,?,?,?)";
        $res = $this->db->query($sql,array($pengajuan_id, $nik, $comp_code, $periode, $jam, $pengobatan_id, $nama_kuitansi, $diagnosa, $nominal, $nilai_diganti, $cnt_file, $params_image_input));
        $result = $res->result();
        @mysqli_next_result($this->db->conn_id);
        
        if ($res !== NULL) {
            return TRUE;
        }
        return FALSE;
    }

    function InsertAttachment($data){
        $this->db->trans_begin();
        $this->db->insert("z_r_obat_url", $data);    
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
