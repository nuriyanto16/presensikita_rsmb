<?php

class Notifikasi_model extends CI_Model
{
    private $_data = null;

    //UNTUK MENAMPILKAN LIST NOTIFIKASI
    public function getNotifikasiList($id = null, $comp_code = null, $period_awal=null, $period_akhir=null, $periode = null) 
    {
        $this->db->select("A.ID_AJU, DATE_FORMAT(A.TGL, '%d-%m-%Y') AS TGL, A.IS_READ, 
                            A.NIK AS NIK_NOTIFIKASI,
                            B.NIK, 
                            D.NAMA,
                            A.STS_AJU,
                            CASE A.STS_AJU 
                                            WHEN 0 THEN 'DIAJUKAN' 
                                            WHEN 1 THEN 'DISETUJUI' 
                                            WHEN 2 THEN 'DITOLAK' 
                            END AS STAT_PENGAJUAN,
                            CASE B.JNS_AJU 
                                            WHEN 'IZ' THEN 2
                                            WHEN 'CT' THEN 3 
                                            WHEN 'PO' THEN 4
                                            WHEN 'LS' THEN 4
                                            WHEN 'FR' THEN 4
                                            WHEN 'PB' THEN 5
                                            WHEN 'PD' THEN 6
                                            WHEN 'TR' THEN 7
                                            WHEN 'AB' THEN 1 
                            END AS MENU_ID,
                            C.DESC_AJU");
        $this->db->from('z_notifikasi A');
        $this->db->join('z_head_aju B','A.ID_AJU=B.ID_AJU');
        $this->db->join('z_jns_aju C','B.JNS_AJU=C.JNS_AJU');
        $this->db->join('z_karyawan D','B.NIK=D.NIK');
        $this->db->where('A.IS_READ =', 0);
        $this->db->where('A.NIK = ', $id);
        $this->db->where('B.ACTIVE = ', 1);
        $this->db->order_by("A.TGL","DESC");           
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }


    public function UpdateStatusNotifikasi($data, $pengajuan_id, $nik_notifikasi, $status_id){
        $this->db->trans_begin();
        $this->db->where("ID_AJU",$pengajuan_id);
        $this->db->where("NIK",$nik_notifikasi);
        $this->db->where("STS_AJU",$status_id);
        $this->db->update("z_notifikasi", $data);
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $return=false;           
        }
        else
        {
            $this->db->trans_commit();           
            $return=true;          
        }
        return $return;
    }
}
