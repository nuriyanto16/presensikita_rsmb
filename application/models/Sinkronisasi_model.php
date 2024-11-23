<?php

class Sinkronisasi_model extends CI_Model
{

    public function getKaryawan($id = null) // $id defaultnya adalah null
    {
        $this->db->select("emp_id, emp_name, nik, email, compid, unitid, positionid, position_code, kantor_id, enterprise_begin, active, email_addr,
        nama, comp_code, company_begin, company_last, nationality, religion_id, nationality_id, education, edu_name, tmp_lahir, tgl_lahir,
        p_alamat, p_kota, p_kodepos, p_propinsi, p_id_negara, sim1, hp1, imei1, sim2, hp2, imei2, ktp, gaji, status_nikah, jml_anak,
        url_foto, jns_kelamin, gol_darah, npwp, ptkp_status, termination, date_termination, created_by, created_date, modify_by, modify_date, jabatan, role_id
        ");
        $this->db->from('z_karyawan'); 
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    public function getUnit($id = null) // $id defaultnya adalah null
    {
        $this->db->select("unitid, unitcode, unitname, unitalias, parentunitid, defpositionid, siteid, active, unitcodedsm, compid, costcenter_code");
        $this->db->from('z_unit'); 
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    public function getPosition($id = null) // $id defaultnya adalah null
    {
        $this->db->select("position_code, position_desc, parent_position_code, company_code, org_code, is_structural, grade, grade_desc, valid_from, valid_to, active");
        $this->db->from('z_position_employee'); 
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    public function getPersonalize($id = null) // $id defaultnya adalah null
    {
        $this->db->select("comp_code, nik_atasan, nik_staff, nik_hc, notif_atasan, notif_hc, stat_absen_mobile, notif_staff, 
        mod_izin, mod_cuti, mod_obat, mod_reimburse, mod_dinas, mod_training, ganti_obat, nik_obat, notif_obat, stat_sales");
        $this->db->from('z_personalize'); 
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    public function getUsers($id = null) // $id defaultnya adalah null
    {
        $this->db->select("id, username, prefix, full_name, email, password, created_date, last_login, ip_address, current_login, salt,
        activation_code, forgotten_password_code, forgotten_password_time, remember_code, photo,
        phone, nik, empid, compid, unitid, positionid, positiondesc, positioncode, represent, representunitid,
        representpositionid, active, dt_superadmin, dt_admin, dt_user, lastnosuratreg");
        $this->db->from('pre_sec_user'); 
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }


}
