<?php

class Pengajuan_model extends CI_Model
{
    private $_data = null;
    
    //UNTUK MENAMPILKAN LIST DAFTAR PENGAJUAN
    public function getPengajuanList($id = null, $comp_code = null, $period_awal=null, $period_akhir=null, $periode = null, $status=null, $jns_aju=null) 
    {
        $this->db->select("*");
        $this->db->from('z_view_pengajuan A');
        
        if($status==-1){
            //$this->db->where('A.NIK =', $id);
            $this->db->where("DATE_FORMAT(A.TGL_AJU_PARAMS, '%Y-%m-%d') >=", $period_awal );
            $this->db->where("DATE_FORMAT(A.TGL_AJU_PARAMS, '%Y-%m-%d') <=", $period_akhir );
        }else{
            //$this->db->where('A.NIK =', $id);
            $this->db->where("DATE_FORMAT(A.TGL_AJU_PARAMS, '%Y-%m-%d') >=", $period_awal );
            $this->db->where("DATE_FORMAT(A.TGL_AJU_PARAMS, '%Y-%m-%d') <=", $period_akhir );
        }

        if($jns_aju!=""){
            $this->db->where('A.JNS_AJU', $jns_aju);
        }
        $this->db->where('A.COMP_CODE =', $comp_code);
        $this->db->where('A.STS_AJU =', 0);
        $this->db->where('A.NIK_ATASAN = ', $id);
        $this->db->or_where('A.NIK_HC', $id);

        $this->db->order_by("A.TGL_AJU_PARAMS","DESC");           
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    //UNTUK MENAMPILKAN LIST DAFTAR HISTORY PENGAJUAN
    public function getHistoryPengajuanList($id = null, $comp_code = null, $period_awal=null, $period_akhir=null, $periode = null, $status=null, $jns_aju=null) 
    {
        $this->db->select("*");
        $this->db->from('z_view_pengajuan_his A');

        if($status==-1){
            $this->db->where('A.NIK =', $id);
            $this->db->where("DATE_FORMAT(A.TGL_AJU_PARAMS, '%Y-%m-%d') >=", $period_awal );
            $this->db->where("DATE_FORMAT(A.TGL_AJU_PARAMS, '%Y-%m-%d') <=", $period_akhir );
        }else{
            $this->db->where('A.NIK =', $id);
            $this->db->where('A.STS_AJU =', $status);
            $this->db->where("DATE_FORMAT(A.TGL_AJU_PARAMS, '%Y-%m-%d') >=", $period_awal );
            $this->db->where("DATE_FORMAT(A.TGL_AJU_PARAMS, '%Y-%m-%d') <=", $period_akhir );
        }

        $this->db->where('A.COMP_CODE =', $comp_code);

        if($jns_aju!=""){
            $this->db->where('A.JNS_AJU', $jns_aju);
        }

        $this->db->order_by("A.TGL_AJU_PARAMS","DESC");           
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }


    //NOTIF JUMLAH NEXT TRAINING
    public function getJmlPengajuan($nik = null, $comp_code = null, $periode = null, $date = null) 
    {
        $this->db->select("COALESCE(COUNT(A.NIK),0) AS JML");
        $this->db->from('z_head_aju A');
        $this->db->join('z_personalize B','A.NIK=B.NIK_STAFF');
        $this->db->where('B.NIK_ATASAN = ', $nik);
        $this->db->where('A.STS_AJU = ', 0);
        $this->db->where('A.ACTIVE = ', 1);
        $Q = $this->db->get();
        $this->_data = $Q->row();
        $Q->free_result();                
        return $this->_data; 
    }

    //NOTIF JUMLAH PENDING
    public function getJmlPending($nik = null, $comp_code = null, $periode = null, $date = null) 
    {
        $this->db->select("COALESCE(COUNT(A.NIK),0) AS JML");
        $this->db->from('z_head_aju A');
        $this->db->where('A.NIK = ', $nik);
        $this->db->where('A.COMP_CODE = ', $comp_code);
        $this->db->where('A.STS_AJU = ', 0);
        $Q = $this->db->get();
        $this->_data = $Q->row();
        $Q->free_result();                
        return $this->_data; 
    }

    //UNTUK MENAMPILKAN TIPE PENGAJUAN
    public function getPengajuanType($id = null, $comp_code = null) // $id defaultnya adalah null
    {
        $this->db->select("A.JNS_AJU, A.DESC_AJU");
        $this->db->from('z_jns_aju A');
        $ignore = array('FR', 'LS', 'PO', 'TR');
        $this->db->where_not_in('A.JNS_AJU', $ignore);
        $this->db->order_by("A.JNS_AJU","ASC");         
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    //NOTIF JUMLAH NOTIFIKASI
    public function getJmlNotifikasi($nik = null, $comp_code = null, $periode = null, $date = null) 
    {
        $this->db->select("COALESCE(COUNT(A.NIK),0) AS JML");
        $this->db->from('z_notifikasi A');
        $this->db->where('A.NIK = ', $nik);
        $this->db->where('A.IS_READ = ', 0);
        $Q = $this->db->get();
        $this->_data = $Q->row();
        $Q->free_result();                
        return $this->_data; 
    }

    //UNTUK MENAMPILKAN PERIODE MENU
    public function getMenuPeriode($comp_code = null) 
    {
        $this->db->select("A.ID_MENU, A.COMP_CODE, 
            DATE_FORMAT(A.START_DATE,'%d-%m-%Y') AS START_DATE, 
            DATE_FORMAT(A.END_DATE,'%d-%m-%Y') AS END_DATE,
            A.REMARK");
        $this->db->from('z_setting_periode A');
        $this->db->where('A.COMP_CODE = ', $comp_code);
        $this->db->order_by("A.ID_MENU","ASC");           
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

}
