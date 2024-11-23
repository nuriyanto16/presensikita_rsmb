<?php

class Padamel_model extends CI_Model
{
    public function getPadamel($comp_code = null, $nik = null) // $id defaultnya adalah null
    {
        if ($comp_code === null) {
            if ($nik === null) {

                //         $this->db->select("Nama as NAMA, Nik as NIK, Dept as DEPT, Bag as BAG, TglMasukGroup as TGL_MSK_TRISULA, TglMasuk as TGL_MSK_COMP, Npwp as NPWP, '' as URL_NPWP, Ktp as KTP, '' as URL_KTP, 
                // '' as SIM1, '' as URL_SIM1, '' as SIM2, '' as URL_SIM2, '' as KK, TelpHP as HP1, '' as IMEI1, '' as HP2, '' as IMEI2, '' as EMAIL_ADD, GolDarah as GOL_DARAH, '' as NO_BPJS_TK, '' as URL_BPJS_TK,
                // '' as NO_BPJS_KS, '' as URL_BPJS_KS, '' as NO_AIA, '' as URL_AIA, '' as NO_ASURANSI_KES_SWA, '' as URL_AKS");


                $this->db->select("NAMA,NIK, '' AS DEPT, '' AS BAG, ENTERPRISE_BEGIN AS TGL_MSK_TRISULA, COMPANY_BEGIN AS TGL_MSK_COMP, NPWP, '' AS URL_NPWP, KTP, '' AS URL_KTP, SIM1, '' as URL_SIM1, SIM2, '' as URL_SIM2, '' as KK, HP1, IMEI1, '' as HP2, '' as IMEI2, EMAIL_ADDR, GOL_DARAH, '' AS NO_BPJS_TK, '' AS URL_BPJS_TK, '' AS NO_BPJS_KS, '' AS URL_BPJS_KS, '' AS NO_AIA, '' AS URL_AIA, '' as NO_ASURANSI_KES_SWA, '' as URL_AKS");
                $this->db->from('z_karyawan');
                $this->db->where('TERMINATION = ', NULL);
                $this->db->order_by('NAMA', 'asc');
                $query = $this->db->get()->result_array();
                return $query;
            } else {
                $this->db->select("NAMA,NIK, '' AS DEPT, '' AS BAG, ENTERPRISE_BEGIN AS TGL_MSK_TRISULA, COMPANY_BEGIN AS TGL_MSK_COMP, NPWP, '' AS URL_NPWP, KTP, '' AS URL_KTP, SIM1, '' as URL_SIM1, SIM2, '' as URL_SIM2, '' as KK, HP1, IMEI1, '' as HP2, '' as IMEI2, EMAIL_ADDR, GOL_DARAH, '' AS NO_BPJS_TK, '' AS URL_BPJS_TK, '' AS NO_BPJS_KS, '' AS URL_BPJS_KS, '' AS NO_AIA, '' AS URL_AIA, '' as NO_ASURANSI_KES_SWA, '' as URL_AKS");
                $this->db->from('z_karyawan');
                $this->db->where('TERMINATION = ', NULL);
                $this->db->where('NIK = ', $nik);
                $this->db->order_by('NAMA', 'asc');
                $query = $this->db->get()->result_array();
                return $query;
            }
        } else {
            if ($nik === null) {
                $this->db->select("NAMA,NIK, '' AS DEPT, '' AS BAG, ENTERPRISE_BEGIN AS TGL_MSK_TRISULA, COMPANY_BEGIN AS TGL_MSK_COMP, NPWP, '' AS URL_NPWP, KTP, '' AS URL_KTP, SIM1, '' as URL_SIM1, SIM2, '' as URL_SIM2, '' as KK, HP1, IMEI1, '' as HP2, '' as IMEI2, EMAIL_ADDR, GOL_DARAH, '' AS NO_BPJS_TK, '' AS URL_BPJS_TK, '' AS NO_BPJS_KS, '' AS URL_BPJS_KS, '' AS NO_AIA, '' AS URL_AIA, '' as NO_ASURANSI_KES_SWA, '' as URL_AKS");
                $this->db->from('z_karyawan');
                $this->db->where('COMP_CODE =', $comp_code);
                $this->db->where('TERMINATION = ', NULL);
                $this->db->order_by('NAMA', 'asc');
                $query = $this->db->get()->result_array();
                return $query;
            } else {
                $this->db->select("NAMA,NIK, '' AS DEPT, '' AS BAG, ENTERPRISE_BEGIN AS TGL_MSK_TRISULA, COMPANY_BEGIN AS TGL_MSK_COMP, NPWP, '' AS URL_NPWP, KTP, '' AS URL_KTP, SIM1, '' as URL_SIM1, SIM2, '' as URL_SIM2, '' as KK, HP1, IMEI1, '' as HP2, '' as IMEI2, EMAIL_ADDR, GOL_DARAH, '' AS NO_BPJS_TK, '' AS URL_BPJS_TK, '' AS NO_BPJS_KS, '' AS URL_BPJS_KS, '' AS NO_AIA, '' AS URL_AIA, '' as NO_ASURANSI_KES_SWA, '' as URL_AKS");
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
}
