<?php

class Personalinfo_model extends CI_Model
{
    private $_data = null;

    public function getPersonalInfo($nik = null) // $id defaultnya adalah null
    {
        $this->db->select("A.EMP_NAME AS NAMA, A.NIK, B.COMP_CODE AS COMP_CODE, B.COMP_NAME AS COMP_NAME, 
                           A.UNITID AS UNITID, C.UNITNAME AS DEPT, D.POSITION_DESC AS BAG, 
                           COALESCE(DATE_FORMAT(A.COMPANY_LAST, '%d-%m-%Y'),'-') AS TGL_MSK_TRISULA,
                           DATE_FORMAT(A.COMPANY_BEGIN, '%d-%m-%Y') AS TGL_MSK_COMP,
                           SIM1, A.TMP_LAHIR AS TMP_LAHIR, 
                           DATE_FORMAT(A.TGL_LAHIR, '%d-%m-%Y') AS TGL_LAHIR,
                           A.JNS_KELAMIN AS JNS_KELAMIN, A.URL_FOTO AS URL_FOTO,
                           CASE A.STATUS_NIKAH 
                                WHEN 1 THEN 'Belum Menikah' 
                                WHEN 2 THEN 'Menikah' 
                                WHEN 3 THEN 'Duda/Janda' 
                            END AS STATUS_NIKAH, 
                            E.AGAMA AS AGAMA, A.GOL_DARAH AS GOL_DARAH, A.JML_ANAK,
                           '' as URL_SIM1, SIM2, '' as URL_SIM2, '' as KK, 
                           HP1, IMEI1, '' as HP2, '' as IMEI2, EMAIL_ADDR,  
                            '' AS URL_BPJS_TK, 
                           A.KTP, A.URL_KTP, 
                           A.URL_SIM, 
                           A.NPWP, A.URL_NPWP, 
                           A.P_ALAMAT AS ALAMAT,
                           '' AS NO_BPJS_TK, A.URL_BPJSTK,
                           '' AS NO_BPJS_KS, A.URL_BPJSKES, 
                           '' AS NO_AIA, A.URL_AIA, 
                           '' AS NO_ASURANSI_KES_SWA, A.URL_ASURANSI,
                           A.URL_FOTO AS URL_PROFILE "
                        );
        $this->db->from('z_karyawan A');
        $this->db->join('z_compcode B','A.COMP_CODE=B.COMP_CODE');
        $this->db->join('z_unit C','B.COMPID=C.COMPID AND A.UNITID=C.UNITID');
        $this->db->join('z_position_employee D','A.COMP_CODE=D.COMPANY_CODE AND A.POSITION_CODE=D.POSITION_CODE');              
        $this->db->join('z_religion E','A.RELIGION_ID=E.RELIGION_ID');
        $this->db->where('A.NIK = ', $nik);
        $this->db->where('A.TERMINATION = ', NULL);
        $Q = $this->db->get();
        $this->_data = $Q->row();
        $Q->free_result();
        return $this->_data;
    }

    public function UpdatePengguna($data,$id){
        $this->db->trans_begin();
        $this->db->where("NIK",$id);
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
}
