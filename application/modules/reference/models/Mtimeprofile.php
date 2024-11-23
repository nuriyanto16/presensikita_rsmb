<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Memployee
 */
class Mtimeprofile extends Mst_model
{
    protected $_data = null;
    protected $table = null; // without prefix
    protected $primaryKey = 'id_tp';

    /**
     * Munit constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->table = config_item("table_time_profile");
    }

    function get($id = null, $offset = null, $limit = null, $order = null, $filters = null, $listjadwal = null)
    {
        $listjadwal_ = explode(";",$listjadwal);
        $this->db->select("a.id_tp, a.deskripsi, a.kode "
                      ." ,CASE WHEN a.hari_1 = 1 THEN 'MASUK' ELSE '' END AS hari_1, DATE_FORMAT(a.hari_1_jam_in, '%H:%i:%s')  AS hari_1_jam_in, DATE_FORMAT(a.hari_1_jam_out, '%H:%i:%s')  AS hari_1_jam_out,  "
                      ." ,CASE WHEN a.hari_2 = 1 THEN 'MASUK' ELSE '' END AS hari_2, DATE_FORMAT(a.hari_2_jam_in, '%H:%i:%s')  AS hari_2_jam_in, DATE_FORMAT(a.hari_2_jam_out, '%H:%i:%s')  AS hari_2_jam_out,  "
                      ." ,CASE WHEN a.hari_3 = 1 THEN 'MASUK' ELSE '' END AS hari_3, DATE_FORMAT(a.hari_3_jam_in, '%H:%i:%s')  AS hari_3_jam_in, DATE_FORMAT(a.hari_3_jam_out, '%H:%i:%s')  AS hari_3_jam_out,  "
                      ." ,CASE WHEN a.hari_4 = 1 THEN 'MASUK' ELSE '' END AS hari_4, DATE_FORMAT(a.hari_4_jam_in, '%H:%i:%s')  AS hari_4_jam_in, DATE_FORMAT(a.hari_4_jam_out, '%H:%i:%s')  AS hari_4_jam_out,  "
                      ." ,CASE WHEN a.hari_5 = 1 THEN 'MASUK' ELSE '' END AS hari_5, DATE_FORMAT(a.hari_5_jam_in, '%H:%i:%s')  AS hari_5_jam_in, DATE_FORMAT(a.hari_5_jam_out, '%H:%i:%s')  AS hari_5_jam_out,  "
                      ." ,CASE WHEN a.hari_6 = 1 THEN 'MASUK' ELSE '' END AS hari_6, DATE_FORMAT(a.hari_6_jam_in, '%H:%i:%s')  AS hari_6_jam_in, DATE_FORMAT(a.hari_6_jam_out, '%H:%i:%s')  AS hari_6_jam_out,  "
                      ." ,CASE WHEN a.hari_7 = 1 THEN 'MASUK' ELSE '' END AS hari_7, DATE_FORMAT(a.hari_7_jam_in, '%H:%i:%s')  AS hari_7_jam_in, DATE_FORMAT(a.hari_7_jam_out, '%H:%i:%s')  AS hari_7_jam_out,  "
                      . ", b.compid, b.comp_name, a.active");
        $this->db->from("{$this->table} a");
        $this->db->join(config_item('table_company') . " b", "b.compid = a.compid", "inner");
        $this->db->where("a.active", "1"); // data tidak aktif tidak ditampilkan
        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            $this->db->where("a.compid", $this->session->userdata(sess_prefix()."compId"));
        }

        if ($listjadwal != null) {
            $this->db->where_in('a.id_tp', $listjadwal_);
        }

        if ($id == null OR $id == "") {
            if (!empty($filters)) {
                if (is_array($filters) && count($filters) >= 1) {
                    if (empty($filters[0]['field'])) {
                        $this->db->group_start();
                        $this->db->like('deskripsi', $filters[0]['value']);
                        $this->db->or_like('comp_name', $filters[0]['value']);
                        $this->db->group_end();
                    } else {
                        $this->db->group_start();
                        foreach ($filters as $filter) {
                            if ($filter['field'] == 'unitName') {
                                $filter['field'] = "o." . $filter['field'];
                            }
                            $this->db->where($filter['field'], $filter['value'], true);
                        }
                        $this->db->group_end();
                    }
                }
            }

            if (!empty($order)) {
                $this->db->order_by($order[0]['field'], $order[0]['dir'], TRUE);
            } else {
                $this->db->order_by('a.id_abs_type, a.id_tp');
            }

            if (empty($offset)) $offset = 0;
            if (empty($limit)) $limit = 10;
            $this->db->limit($limit, $offset);
            $this->db->or_where('a.jenis_pengajuan_id', 2);

            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            $this->db->where("a.id_tp", $id);

            $Q = $this->db->get();
            $this->_data = $Q->row();
        }

        $Q->free_result();
        return $this->_data;
    }

    function get_cnt($filters = null, $listjadwal = null)
    {
        $listjadwal_ = explode(";",$listjadwal);
        $this->db->select("count(1) _cnt");
        $this->db->from("{$this->table} a");
        $this->db->join(config_item('table_company') . " b", "b.compid = a.compid", "inner");
        $this->db->where("a.active", "1"); // data tidak aktif tidak ditampilkan
        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            $this->db->where("a.compid", $this->session->userdata(sess_prefix()."compId"));
        }

        if ($listjadwal != null) {
            $this->db->where_in('a.id_tp', $listjadwal_);
        }

        if (!empty($filters)) {
            if (is_array($filters) && count($filters) >= 1) {
                if (empty($filters[0]['field'])) {
                    $this->db->group_start();
                    $this->db->like('deskripsi', $filters[0]['value']);
                    $this->db->or_like('nik', $filters[0]['value']);
                    $this->db->group_end();
                } else {
                    $this->db->group_start();
                    foreach ($filters as $filter) {
                        if ($filter['field'] == 'unitName') {
                            $filter['field'] = "o." . $filter['field'];
                        }
                        $this->db->like($filter['field'], $filter['value'], true);
                    }
                    $this->db->group_end();
                }
            }
        }
        $this->db->or_where('a.jenis_pengajuan_id', 2);

        $Q = $this->db->get();
        $this->_data = $Q->row()->_cnt;
        $Q->free_result();
        return $this->_data;
    }


    function get_new_id()
    {
        $this->db->select("max(id_tp) id");
        $this->db->from("{$this->table} a");
        
        $Q = $this->db->get();
        $this->_data = $Q->row()->id + 1;
        $Q->free_result();
        return $this->_data;
    }
}
