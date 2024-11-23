<?php

class Karyawan_model extends CI_Model
{
    public function getKaryawan($comp_code = null, $nik = null) // $id defaultnya adalah null
    {
        if ($comp_code === null) {
            if ($nik === null) {
                $this->db->select("EMP_NAME AS NAMA, ,NIK, '' AS DEPT, '' AS BAG, ENTERPRISE_BEGIN AS TGL_MSK_TRISULA, COMPANY_BEGIN AS TGL_MSK_COMP,TGL_LAHIR, HP1, IMEI1, EMAIL_ADDR,");
                $this->db->from('z_karyawan');
                $this->db->where('TERMINATION = ', NULL);
                $this->db->order_by('EMP_NAME', 'asc');
                $query = $this->db->get()->result_array();
                return $query;
            } else {
                $this->db->select("EMP_NAME AS NAMA, ,NIK, '' AS DEPT, '' AS BAG, ENTERPRISE_BEGIN AS TGL_MSK_TRISULA, COMPANY_BEGIN AS TGL_MSK_COMP, NPWP, '' AS URL_NPWP, KTP, '' AS URL_KTP, SIM1, '' as URL_SIM1, SIM2, '' as URL_SIM2, '' as KK, HP1, IMEI1, '' as HP2, '' as IMEI2, EMAIL_ADDR, GOL_DARAH, '' AS NO_BPJS_TK, '' AS URL_BPJS_TK, '' AS NO_BPJS_KS, '' AS URL_BPJS_KS, '' AS NO_AIA, '' AS URL_AIA, '' as NO_ASURANSI_KES_SWA, '' as URL_AKS");
                $this->db->from('z_karyawan');
                $this->db->where('TERMINATION = ', NULL);
                $this->db->where('NIK = ', $nik);
                $this->db->order_by('EMP_NAME', 'asc');
                $query = $this->db->get()->result_array();
                return $query;
            }
        } else {
            if ($nik === null) {
                $this->db->select("EMP_NAME AS NAMA, NIK, '' AS DEPT, '' AS BAG, ENTERPRISE_BEGIN AS TGL_MSK_TRISULA, COMPANY_BEGIN AS TGL_MSK_COMP,TGL_LAHIR, HP1, IMEI1, EMAIL_ADDR,");
                $this->db->from('z_karyawan');
                $this->db->where('COMP_CODE =', $comp_code);
                $this->db->where('TERMINATION = ', NULL);
                $this->db->order_by('EMP_NAME', 'asc');
                $query = $this->db->get()->result_array();
                return $query;
            } else {
                $this->db->select("EMP_NAME AS NAMA, NIK, '' AS DEPT, '' AS BAG, ENTERPRISE_BEGIN AS TGL_MSK_TRISULA, COMPANY_BEGIN AS TGL_MSK_COMP, NPWP, '' AS URL_NPWP, KTP, '' AS URL_KTP, SIM1, '' as URL_SIM1, SIM2, '' as URL_SIM2, '' as KK, HP1, IMEI1, '' as HP2, '' as IMEI2, EMAIL_ADDR, GOL_DARAH, '' AS NO_BPJS_TK, '' AS URL_BPJS_TK, '' AS NO_BPJS_KS, '' AS URL_BPJS_KS, '' AS NO_AIA, '' AS URL_AIA, '' as NO_ASURANSI_KES_SWA, '' as URL_AKS");
                $this->db->from('z_karyawan');
                $this->db->where('COMP_CODE =', $comp_code);
                $this->db->where('NIK = ', $nik);
                $this->db->where('TERMINATION = ', NULL);
                $this->db->order_by('NAMA', 'asc');
                $query = $this->db->get()->result_array();
                return $query;
            }
        }
    }

    public function getKaryawanRow($comp_code = null, $nik = null) // $id defaultnya adalah null
    {
        $this->db->select("A.EMP_NAME AS NAMA,NIK, '' AS DEPT, '' AS BAG, A.ENTERPRISE_BEGIN AS TGL_MSK_TRISULA, A.COMPANY_BEGIN AS TGL_MSK_COMP, 
                           A.TGL_LAHIR, A.HP1, A.IMEI1, A.EMAIL_ADDR, A.URL_FOTO, B.COMP_NAME");
        $this->db->from('z_karyawan A');
        $this->db->join('z_compcode B','B.COMP_CODE=A.COMP_CODE');
        $this->db->where('A.COMP_CODE =', $comp_code);
        $this->db->where('A.NIK = ', $nik);
        $this->db->where('A.TERMINATION = ', NULL);     
        $Q = $this->db->get();
        $this->_data = $Q->row();
        $Q->free_result();
        return $this->_data;
    }
}
