<?php

class Auth_model extends CI_Model
{
    private $_data = null;

    public function getAuth($hp1 = null, $imei1 = null, $email=null) // $id defaultnya adalah null
    {
        //CEK HP
        if($hp1!==null && $imei1===null && $email===null){
            $this->db->select("EMP_NAME AS NAMA, NIK, COMP_CODE, HP1, IMEI1, EMAIL_ADDR, URL_FOTO");
            $this->db->from('z_karyawan');
            $this->db->where('TERMINATION = ', NULL);
            $this->db->where('HP1 = ', $hp1);
            $this->db->limit(1, 0);
            $Q = $this->db->get();
            $this->_data = $Q->row();
            $Q->free_result();                
            return $this->_data; 
        }

        //CEK IMEI
        if($hp1!==null && $imei1 !== null && $email===null){
            $this->db->select("EMP_NAME AS NAMA, NIK, COMP_CODE, HP1, IMEI1, EMAIL_ADDR, URL_FOTO");
            $this->db->from('z_karyawan');
            $this->db->where('TERMINATION = ', NULL);
            $this->db->where('HP1 = ', $hp1);
            $this->db->where('IMEI1 = ', $imei1);
            $this->db->limit(1, 0);
            $Q = $this->db->get();
            $this->_data = $Q->row();
            $Q->free_result();                
            return $this->_data; 
        }

        //CEK EMAIL
        if($hp1!==null && $imei1 !== null && $email !== null){
            $this->db->select("EMP_NAME AS NAMA, NIK, COMP_CODE, HP1, IMEI1, EMAIL_ADDR, URL_FOTO");
            $this->db->from('z_karyawan');
            $this->db->where('TERMINATION = ', NULL);
            $this->db->where('HP1 = ', $hp1);
            $this->db->where('EMAIL_ADDR <> ', NULL);
            $this->db->limit(1, 0);
            $Q = $this->db->get();
            $this->_data = $Q->row();
            $Q->free_result();                
            return $this->_data;  
        }
 
    }

    public function getImeiKosong($hp1 = null) // $id defaultnya adalah null
    {
        //CEK IMEI KOSONG UNTUK PETANDA USER BELUM TERDAFTAR
        if($hp1!==null){
            $this->db->select("COUNT(NIK) AS JML");
            $this->db->from('z_karyawan');
            $this->db->where('TERMINATION = ', NULL);
            $this->db->where('IMEI1 = ', NULL);
            $this->db->where('HP1 = ', $hp1);
            $Q = $this->db->get();
            $this->_data = $Q->row();
            $Q->free_result();                
            return $this->_data; 
        }
    }

    public function getPengguna($nik = null) // $id defaultnya adalah null
    {
        //CEK PENGGUNA
        if($nik!==null){
            $this->db->select("COUNT(NIK) AS JML");
            $this->db->from('z_pengguna');
            $this->db->where('NIK',$nik);
            $Q = $this->db->get();
            $this->_data = $Q->row();
            $Q->free_result();                
            return $this->_data;  
        }
    }

    function InsertUser($data){
        $this->db->trans_begin();
        $this->db->insert("z_pengguna", $data);    
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

    public function UpdatePengguna($param,$data){
        $this->db->trans_begin();
        $this->db->where("KODE_AKTIF",$param);
        $this->db->update("z_pengguna", $data);
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

    public function UpdateKaryawan($param,$data){
        $this->db->trans_begin();
        $this->db->where("HP1",$param);
        $this->db->update("z_karyawan", $data);
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

    public function getBasicAuthCompany($comp_code = null) // comp_code defaultnya adalah null
    {
        $this->db->select("A.COMP_CODE, A.COMP_NAME, A.API_BRANCH, A.USER_AUTH, A.PASS_AUTH, A.KONCI_SEUNEU");
        $this->db->from('z_compcode A');
        $this->db->where('A.COMP_CODE =', $comp_code);           
        $Q = $this->db->get();
        $this->_data = $Q->row();
        $Q->free_result();
        return $this->_data;
    }

}
