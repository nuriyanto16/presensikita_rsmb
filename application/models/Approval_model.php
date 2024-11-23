<?php

class Approval_model extends CI_Model
{
    private $_data = null;
    // APPROVAL PENGAJUAN
    public function ApprovePengajuan($pengajuan_id, $approval_id, $comp_code, $periode, $date, $menu_id, $status_id, $status_act_id, $keterangan) 
    {
        $sql = "CALL Z_P_APPROVE_PENGAJUAN(?,?,?,?,?,?,?,?,?)";
        $res = $this->db->query($sql,array($pengajuan_id, $approval_id, $comp_code, $periode, $date, $menu_id, $status_id, $status_act_id, $keterangan));

        $result = $res->result();
        @mysqli_next_result($this->db->conn_id);
        if ($res !== NULL) {
            return TRUE;
        }
        return FALSE;
    }

    // APPROVAL LEMBUR
    public function ApprovePengajuanLembur($pengajuan_id, $approval_id, $comp_code, $periode, $date, $menu_id, $status_id, $status_act_id, $keterangan) 
    {
        $sql = "CALL Z_P_APPROVE_LEMBUR(?,?,?,?,?,?,?,?,?)";
        $res = $this->db->query($sql,array($pengajuan_id, $approval_id, $comp_code, $periode, $date, $menu_id, $status_id, $status_act_id, $keterangan));
        $result = $res->result();
        @mysqli_next_result($this->db->conn_id);
        if ($res !== NULL) {
            return TRUE;
        }
        return FALSE;
    }

    // APPROVAL LEMBUR HO
    public function ApprovePengajuanLemburHo($pengajuan_id, $approval_id, $comp_code, $periode, $date, $menu_id, $status_id, $status_act_id, $keterangan) 
    {
        $sql = "CALL Z_P_APPROVE_LEMBUR_HO(?,?,?,?,?,?,?,?,?)";
        $res = $this->db->query($sql,array($pengajuan_id, $approval_id, $comp_code, $periode, $date, $menu_id, $status_id, $status_act_id, $keterangan));
        $result = $res->result();
        @mysqli_next_result($this->db->conn_id);
        if ($res !== NULL) {
            return TRUE;
        }
        return FALSE;
    }

    //UNTUK MENAMPILKAN DATA PENGAJUAN PER ROW
    public function getPengajuanRow($pengajuan_id = null) // $id defaultnya adalah null
    {
        $this->db->select(" ID_AJU,
                            NIK,
                            NAMA_KARYAWAN,
                            JABATAN,
                            TO_CHAR(TGL_AJU_PARAMS, 'dd-mm-YYYY') AS TGL_MULAI,
                            TO_CHAR(TGL_AJU_PARAMS_END, 'dd-mm-YYYY') AS TGL_AKHIR,
                            DESC_AJU AS DESC_AJU,
                            CASE WHEN TIPE_PENGAJUAN <> '' THEN  TRIM('('||TIPE_PENGAJUAN||')')  ELSE '' END AS JENIS_AJU,
                            STAT_PENGAJUAN,
                            JNS_AJU,
                            NIK_HC, 
                            NIK_OBAT,
                            NOTIF_HC, 
                            NOTIF_STAFF,
                            NOTIF_OBAT, 
                            STAT_ABSEN_MOBILE");
        $this->db->from('z_view_pengajuan_his');
        $this->db->where('ID_AJU =', $pengajuan_id);            
        $Q = $this->db->get();
        $this->_data = $Q->row();
        $Q->free_result();
        return $this->_data;
    }

    //UNTUK MENDAPATKAN SENDER EMAIL
    public function getMail($nik_HC = null) // $id defaultnya adalah null
    {
        $this->db->select("EMAIL_ADDR");
        $this->db->from('z_karyawan');
        $this->db->where('NIK =', $nik_HC);            
        $Q = $this->db->get();
        $this->_data = $Q->row();
        $Q->free_result();
        return $this->_data;
    }

    //STATUS APPROVAL
    public function getStatusApproval($nik_staff = null, $nik_atasan = null, $comp_code = null) 
    {
        $this->db->select("coalesce(count(a.nik_atasan),0) as cnt");
        $this->db->from('z_personalize a');
        $this->db->where('a.nik_atasan = ', $nik_atasan);
        $this->db->where('a.nik_staff = ', $nik_staff);
        $Q = $this->db->get();
        $this->_data = $Q->row();
        $Q->free_result();                
        return $this->_data; 
    }

    //STATUS APPROVAL HO
    function getStatusApprovalHo($nik_atasan = null, $comp_code = null)
    {
        $this->db->select("coalesce(count(a.nik_ho),0) as cnt");
        $this->db->from("z_compcode a");
        $this->db->join(config_item('table_employee') . " b", "b.nik = a.nik_ho AND a.comp_code = b.comp_code", "left");
        $this->db->where("a.comp_code", $comp_code);
        $this->db->where('a.nik_ho = ', $nik_atasan);
        
        $Q = $this->db->get();
        $this->_data = $Q->row();
      
        $Q->free_result();
        return $this->_data;
    }

    //UNTUK MENAMPILKAN TIPE PENGAJUAN
    public function getPengajuanType($id = null, $comp_code = null) // $id defaultnya adalah null
    {
        $this->db->select("a.jns_aju, a.desc_aju");
        $this->db->from('z_jns_aju a');
        $this->db->where_in("a.jns_aju",array('PO','LS','FR'));
        $this->db->order_by("a.jns_aju","ASC");         
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

}
