<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mnotif extends Mst_model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = "z_notifikasi";
        $this->primaryKey = "notif_id";
    }

    function get_notif($id = null, $offset = null, $limit = null, $user_id = null, $search_string = null, $order = null)
    {

        $this->db->select("a.notif_id, a.tgl, a.id_aju as src_uid, d.emp_id, d.emp_name, c.desc_aju as notif_subj"
            . ", c.desc_aju as notif_msg, 
            case 
                when c.jns_aju = 'IZ' then 'presensi/izin/edit_form/'
                when c.jns_aju = 'CT' then 'presensi/cuti/edit_form/'
                when c.jns_aju = 'PO' then 'presensi/pengobatan/edit_form/'
                when c.jns_aju = 'LS' then 'presensi/pengobatan/edit_form/'
                when c.jns_aju = 'FR' then 'presensi/pengobatan/edit_form/'
                when c.jns_aju = 'PB' then 'presensi/gantibiaya/edit_form/'
                when c.jns_aju = 'PD' then 'presensi/dinas/edit_form/'
                when c.jns_aju = 'TR' then 'presensi/pelatihan/edit_form/'
                when c.jns_aju = 'AB' then 'presensi/absensi/edit_form/'
            else '#'
            end as notif_url, 
            a.is_read, a.tgl as tgl_read,
            d.comp_code, d.url_foto");
        $this->db->from($this->table . " a");
        $this->db->join('z_head_aju b','a.id_aju=b.id_aju');
        $this->db->join('z_jns_aju c','b.jns_aju=c.jns_aju');
        $this->db->join('z_karyawan d','b.nik=d.nik and b.comp_code=d.comp_code');

        if (empty($id)) {
            //if (!empty($user_id)) $this->db->where("d.emp_id", $user_id);
            if($this->session->userdata(sess_prefix()."roleid") != 1 ){
                $this->db->where("d.compid", $this->session->userdata(sess_prefix()."compId"));
                $this->db->where("b.nik", $this->session->userdata(sess_prefix()."nik"));
            }

            if (!empty($search_string)) {
                $this->db->group_start();
                $this->db->like('a.notif_subj', $search_string);
                $this->db->or_like('a.notif_msg', $search_string);
                $this->db->group_end();
            }

            if (!empty($order)) {
                $arr_col = array(
                    0 => 'a.tgl',
                    1 => 'a.desc_aju',
                    2 => 'a.desc_aju'
                );

                $this->db->order_by($arr_col[$order[0]['column']], $order[0]['dir']);
            } else {
                $this->db->order_by('a.tgl', 'desc');
            }

            if ($offset == null) $offset = 0;
            if ($limit == null) $offset = 10;
            $this->db->limit($limit, $offset);

            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            $this->db->where("a." . $this->primaryKey, $id);

            $Q = $this->db->get();
            $this->_data = $Q->row();
        }

        $Q->free_result();
        return $this->_data;
    }

    function get_notif_cnt($user_id = null, $search_string = null, $is_read = null)
    {
        $this->db->select("count(1) _cnt");
        $this->db->from($this->table . " a");
        $this->db->join('z_head_aju b','a.id_aju=b.id_aju');
        $this->db->join('z_jns_aju c','b.jns_aju=c.jns_aju');
        $this->db->join('z_karyawan d','b.nik=d.nik and b.comp_code=d.comp_code');

        //if (!empty($user_id)) $this->db->where("d.emp_id", $user_id);
        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            $this->db->where("d.compid", $this->session->userdata(sess_prefix()."compId"));
            $this->db->where("b.nik", $this->session->userdata(sess_prefix()."nik"));
        }

        if (!empty($search_string)) {
            $this->db->group_start();
            $this->db->like('a.notif_subj', $search_string);
            $this->db->or_like('a.notif_msg', $search_string);
            $this->db->group_end();
        }

        if ($is_read === true) {
            $this->db->where("is_read", "1");
        } else if ($is_read === false) {
            $this->db->where("is_read", "0");
        }

        $Q = $this->db->get();
        $this->_data = $Q->row()->_cnt;
        $Q->free_result();
        return $this->_data;
    }
}
