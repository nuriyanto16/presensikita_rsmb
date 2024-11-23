<?php

class Dinas_model extends CI_Model
{
    private $_data = null;

    //UNTUK MENAMPILKAN LIST HISTORY CUTI KARYAWAN
    public function getDinasList($id = null, $comp_code = null, $period_awal=null, $period_akhir=null, $periode = null, $status=null) 
    {
        $this->db->select("A.ID_AJU, DATE_FORMAT(A.TGL_AJU, '%d-%m-%Y') AS TGL_AJU, 
                            A.NIK, A.STS_AJU, 
                            CASE A.STS_AJU 
                                WHEN 0 THEN 'DIAJUKAN' 
                                WHEN 1 THEN 'DISETUJUI' 
                                WHEN 2 THEN 'DITOLAK' 
                            END AS STAT_PENGAJUAN,
                            A.JNS_AJU, B.DESC_AJU, 
                            C.NM_PEJABAT, C.JABATAN, C.TUJUAN, C.KEPERLUAN, 
                            DATE_FORMAT(C.TGL_BRKT, '%d-%m-%Y') AS TGL_BRKT, 
                            DATE_FORMAT(C.TGL_PLNG, '%d--%m-%Y') AS TGL_PLNG,
                            C.ALL_BDGJKT, C.ALL_LR_KOTA, C.ALL_LR_NEGERI, 
                            C.TR_K_PRIBADI, C.TR_K_DINAS, C.TR_KA, C.TR_PESAWAT, C.TR_TRAVEL,
                            C.TR_BUS, C.AK_HOTEL, C.AK_HOTEL_NOM, C.AK_HOTEL_KET, C.AK_TR_LOC,
                            C.AK_TR_LOC_NOM, C.AK_TR_LOC_KET, C.AK_SUSP, C.AK_SUSP_NOM, C.AK_SUSP_KET
                            ");
        $this->db->from('z_head_aju A');
        $this->db->join('z_jns_aju B','A.JNS_AJU=B.JNS_AJU');
        $this->db->join('z_r_jalandinas C','A.ID_AJU=C.ID_AJU');
        $this->db->where('A.NIK =', $id);   
        //$this->db->where('A.STS_AJU =', 1);
        $this->db->where('A.ACTIVE =', 1);   
        $this->db->where("DATE_FORMAT(C.TGL_BRKT, '%Y-%m-%d') >=", $period_awal );
        $this->db->where("DATE_FORMAT(C.TGL_BRKT, '%Y-%m-%d') <=", $period_akhir );
        $this->db->order_by("A.TGL_AJU","DESC");             
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    //UNTUK MENAMPILKAN EDIT VIEW DINAS
    public function getDinasEdit($pengajuan_id = null) // $id defaultnya adalah null
    {
        $this->db->select("A.ID_AJU, DATE_FORMAT(A.TGL_AJU, '%d-%m-%Y') AS TGL_AJU, 
                            A.NIK, A.STS_AJU, 
                            CASE A.STS_AJU 
                                WHEN 0 THEN 'DIAJUKAN' 
                                WHEN 1 THEN 'DISETUJUI' 
                                WHEN 2 THEN 'DITOLAK' 
                            END AS STAT_PENGAJUAN,
                            A.JNS_AJU, B.DESC_AJU, 
                            C.NM_PEJABAT, C.JABATAN, C.TUJUAN, C.KEPERLUAN, 
                            DATE_FORMAT(C.TGL_BRKT, '%d-%m-%Y') AS TGL_BRKT, 
                            DATE_FORMAT(C.TGL_PLNG, '%d-%m-%Y') AS TGL_PLNG,
                            C.ALL_BDGJKT, C.ALL_LR_KOTA, C.ALL_LR_NEGERI, 
                            C.TR_K_PRIBADI, C.TR_K_DINAS, C.TR_KA, C.TR_PESAWAT, C.TR_TRAVEL,
                            C.TR_BUS, C.AK_HOTEL, C.AK_HOTEL_NOM, C.AK_HOTEL_KET, C.AK_TR_LOC,
                            C.AK_TR_LOC_NOM, C.AK_TR_LOC_KET, C.AK_SUSP, C.AK_SUSP_NOM, C.AK_SUSP_KET
                            ");
        $this->db->from('z_head_aju A');
        $this->db->join('z_jns_aju B','A.JNS_AJU=B.JNS_AJU');
        $this->db->join('z_r_jalandinas C','A.ID_AJU=C.ID_AJU');
        $this->db->where('A.ID_AJU =', $pengajuan_id);            
        $Q = $this->db->get();
        $this->_data = $Q->row();
        $Q->free_result();
        return $this->_data;
    }

    public function getAttachment($pengajuan_id = null) // $id defaultnya adalah null
    {
        $this->db->select("ID_AJU, SEQ_ATC, URL_ATC_JALANDINAS");
        $this->db->from('z_r_jalandinas_url A');
        $this->db->where('A.ID_AJU =', $pengajuan_id);            
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    public function getPeserta($pengajuan_id = null) // $id defaultnya adalah null
    {
        $this->db->select("A.ID_AJU, A.NIK, B.NAMA, A.SEQ");
        $this->db->from('z_r_jalandinas_peserta A');
        $this->db->join('z_head_aju C','A.ID_AJU=C.ID_AJU');
        $this->db->join('z_karyawan B','A.NIK=B.NIK AND C.COMP_CODE=B.COMP_CODE');
        $this->db->where('A.ID_AJU =', $pengajuan_id);            
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    public function getListPeserta($id = null, $comp_code = null, $search_string = null) // $id defaultnya adalah null
    {
        $search_string_lower    = strtolower($search_string);
        $search_string_capital  = strtoupper($search_string);

        $sql = " SELECT  NIK, EMP_NAME AS NAMA, JABATAN
                    FROM z_karyawan WHERE COMP_CODE='$comp_code' AND  EMP_NAME LIKE '%$search_string_lower%'
                    ORDER BY EMP_NAME LIMIT 20 ";

        $Q = $this->db->query($sql);   
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }


    public function getListPejabat($id = null, $comp_code = null) // $id defaultnya adalah null
    {
        $sql = " SELECT A.NIK, A.EMP_NAME AS NAMA, C.POSITION_DESC AS JABATAN
                    FROM z_karyawan A
                    JOIN z_personalize B ON A.NIK=B.NIK_ATASAN AND A.COMP_CODE = B.COMP_CODE
                    LEFT JOIN z_position_employee C ON A.POSITION_CODE=C.POSITION_CODE AND C.COMPANY_CODE=A.COMP_CODE
                    WHERE B.NIK_STAFF=? AND B.COMP_CODE=? ORDER BY A.EMP_NAME LIMIT 5";
 
        $Q = $this->db->query($sql,array($id, $comp_code));
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    // INSERT/UPDATE KE TABLE CUTI
    public function InsUpdDinas($pengajuan_id=null, $nik=null, $comp_code=null, $periode=null, $date=null,
                                $nm_pejabat=null, $jabatan=null, $tujuan=null, $keperluan=null, 
                                $tgl_brkt=null, $tgl_plng=null, $all_bdgjkt=null, $all_lr_kota=null,
                                $all_lr_negeri=null, $tr_k_prbadi=null, $tr_k_dinas=null, $tr_ka=null,
                                $tr_pesawat=null, $tr_travel=null, $tr_bus=null, $ak_hotel=null, $ak_hotel_nom=null,
                                $ak_hotel_ket=null, $ak_tr_loc=null, $ak_tr_loc_nom=null, $ak_tr_loc_ket=null, $ak_susp=null,
                                $ak_susp_nom=null, $ak_susp_ket, $cnt_file=null, $params_image_input=null,
                                $cnt_peserta=null, $params_peserta_input=null) 
    {
        $sql = "CALL Z_P_SIMPAN_DINAS(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $res = $this->db->query($sql,array($pengajuan_id, $nik, $comp_code, $periode, $date,
                                                $nm_pejabat, $jabatan, $tujuan, $keperluan, 
                                                $tgl_brkt, $tgl_plng, $all_bdgjkt, $all_lr_kota,
                                                $all_lr_negeri, $tr_k_prbadi, $tr_k_dinas, $tr_ka,
                                                $tr_pesawat, $tr_travel, $tr_bus, $ak_hotel, $ak_hotel_nom,
                                                $ak_hotel_ket, $ak_tr_loc, $ak_tr_loc_nom, $ak_tr_loc_ket, $ak_susp,
                                                $ak_susp_nom, $ak_susp_ket, $cnt_file, $params_image_input, 
                                                $cnt_peserta, $params_peserta_input));

        $result = $res->result();
        @mysqli_next_result($this->db->conn_id);
        if ($result !== NULL) {
            return TRUE;
        }
        return FALSE;
    }

    function InsertAttachment($data){
        $this->db->trans_begin();
        $this->db->insert("z_r_jalandinas_url", $data);    
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

    function InsertPeserta($data){
        $this->db->trans_begin();
        $this->db->insert("z_r_jalandinas_peserta", $data);    
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
        $this->db->delete("z_r_jalandinas_url");   
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

    function DeleteAllPeserta($pengajuan_id){
        $this->db->trans_begin();
        $this->db->where("ID_AJU", $pengajuan_id);  
        $this->db->delete("z_r_jalandinas_peserta");   
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
