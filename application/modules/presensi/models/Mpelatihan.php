<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Mpelatihan
 */
class Mpelatihan extends Mst_model
{
    protected $_data = null;
    protected $table = "z_head_aju"; // without prefix
    protected $primaryKey = 'id_aju';

    /**
     * Munit constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    function get($id = null, $offset = null, $limit = null, $order = null, $filters = null)
    {
        $this->db->select("a.id_aju, date_format(a.tgl_aju, '%d-%m-%Y') AS tgl_aju, 
                            e.compid, e.comp_code, e.comp_name, g.unitname as unit, 
                            a.nik, f.emp_name, a.sts_aju, 
                            case a.sts_aju 
                                when 0 then 'diajukan' 
                                when 1 then 'disetujui' 
                                when 2 then 'ditolak' 
                            end as stat_pengajuan,
                            a.jns_aju, b.desc_aju,
                            d.nm_training, d.nm_lembaga, d.tempat_tr, 
                            date_format(d.tgl_start_tr, '%d-%m-%Y') AS tgl_start_tr, 
                            date_format(d.tgl_end_tr, '%d-%m-%Y') AS tgl_end_tr,
                            DATEDIFF(d.tgl_end_tr, d.tgl_start_tr) + 1 AS jml,
                            a.app_nik, a.app_ket");
        $this->db->from("{$this->table} a");
        $this->db->join('z_jns_aju b','a.jns_aju=b.jns_aju');
        $this->db->join('z_r_training d','a.id_aju=d.id_aju');
        $this->db->join(config_item('table_employee') . " f", "f.nik = a.nik", "inner");
        $this->db->join(config_item('table_company') . " e", "e.compid = f.compid", "inner");
        $this->db->join(config_item('table_unit') . " g", "g.unitid = f.unitid", "inner");
        $this->db->where("a.active", "1"); // data tidak aktif tidak ditampilkan
        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            if($this->session->userdata(sess_prefix()."roleid") == 2 ){
                $this->db->where("e.compid", $this->session->userdata(sess_prefix()."compId"));
            }else if($this->session->userdata(sess_prefix()."roleid") == 3 ){
                $this->db->where("f.unitid", $this->session->userdata(sess_prefix()."unitId"));
            }else if($this->session->userdata(sess_prefix()."roleid") == 4 ){
                $this->db->where("f.emp_id", $this->session->userdata(sess_prefix()."empId"));
            }else{
                $this->db->where("e.compid", $this->session->userdata(sess_prefix()."compId"));
            }
        }
        if ($id == null OR $id == "") {
            if (!empty($filters)) {
                if (is_array($filters) && count($filters) >= 1) {
                    if (empty($filters[0]['field'])) {
                        $this->db->group_start();
                        $this->db->like('nik', $filters[0]['value']);
                        $this->db->or_like('comp_name', $filters[0]['value']);
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

            if (!empty($order)) {
                $this->db->order_by($order[0]['field'], $order[0]['dir'], TRUE);
            } else {
                $this->db->order_by('comp_name');
            }

            if (empty($offset)) $offset = 0;
            if (empty($limit)) $limit = 10;
            $this->db->limit($limit, $offset);

            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            $this->db->where("a.id_aju", $id);

            $Q = $this->db->get();
            $this->_data = $Q->row();
        }

        $Q->free_result();
        return $this->_data;
    }

    function get_cnt($filters = null)
    {
        $this->db->select("count(1) _cnt");
        $this->db->from("{$this->table} a");
        $this->db->join('z_r_training d','a.id_aju=d.id_aju');
        $this->db->join(config_item('table_employee') . " f", "f.nik = a.nik", "inner");
        $this->db->join(config_item('table_company') . " e", "e.compid = f.compid", "inner");
        $this->db->join(config_item('table_unit') . " g", "g.unitid = f.unitid", "inner");
        $this->db->where("a.active", "1"); // data tidak aktif tidak ditampilkan
        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            if($this->session->userdata(sess_prefix()."roleid") == 2 ){
                $this->db->where("e.compid", $this->session->userdata(sess_prefix()."compId"));
            }else if($this->session->userdata(sess_prefix()."roleid") == 3 ){
                $this->db->where("f.unitid", $this->session->userdata(sess_prefix()."unitId"));
            }else if($this->session->userdata(sess_prefix()."roleid") == 4 ){
                $this->db->where("f.emp_id", $this->session->userdata(sess_prefix()."empId"));
            }else{
                $this->db->where("e.compid", $this->session->userdata(sess_prefix()."compId"));
            }
        }
        if (!empty($filters)) {
            if (is_array($filters) && count($filters) >= 1) {
                if (empty($filters[0]['field'])) {
                    $this->db->group_start();
                    $this->db->like('nik', $filters[0]['value']);
                    $this->db->or_like('comp_name', $filters[0]['value']);
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

        $Q = $this->db->get();
        $this->_data = $Q->row()->_cnt;
        $Q->free_result();
        return $this->_data;
    }

    function getExport($start_date = null , $end_date = null)
    {
        $this->db->select("a.id_aju, date_format(a.tgl_aju, '%d-%m-%Y') AS tgl_aju, 
                            e.compid, e.comp_code, e.comp_name, g.unitname as unit, 
                            a.nik, f.nik_pegawai, f.emp_name, a.sts_aju, 
                            case a.sts_aju 
                                when 0 then 'diajukan' 
                                when 1 then 'disetujui' 
                                when 2 then 'ditolak' 
                            end as stat_pengajuan,
                            a.jns_aju, b.desc_aju,
                            d.nm_training, d.nm_lembaga, d.tempat_tr, 
                            date_format(d.tgl_start_tr, '%d-%m-%Y') AS tgl_start_tr, 
                            date_format(d.tgl_end_tr, '%d-%m-%Y') AS tgl_end_tr,
                            DATEDIFF(d.tgl_end_tr, d.tgl_start_tr) + 1 AS jml,
                            a.app_nik, a.app_ket");
        $this->db->from("{$this->table} a");
        $this->db->join('z_jns_aju b','a.jns_aju=b.jns_aju');
        $this->db->join('z_r_training d','a.id_aju=d.id_aju');
        $this->db->join(config_item('table_employee') . " f", "f.nik = a.nik", "inner");
        $this->db->join(config_item('table_company') . " e", "e.compid = f.compid", "inner");
        $this->db->join(config_item('table_unit') . " g", "g.unitid = f.unitid", "inner");
        $this->db->where("a.active", "1"); // data tidak aktif tidak ditampilkan
        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            if($this->session->userdata(sess_prefix()."roleid") == 2 ){
                $this->db->where("e.compid", $this->session->userdata(sess_prefix()."compId"));
            }else if($this->session->userdata(sess_prefix()."roleid") == 3 ){
                $this->db->where("f.unitid", $this->session->userdata(sess_prefix()."unitId"));
            }else if($this->session->userdata(sess_prefix()."roleid") == 4 ){
                $this->db->where("f.emp_id", $this->session->userdata(sess_prefix()."empId"));
            }else{
                $this->db->where("e.compid", $this->session->userdata(sess_prefix()."compId"));
            }
        }
       
        // Add date filtering if dates are provided
        if ($start_date && $end_date) {
            $this->db->group_start()
                ->group_start()
                    ->where("d.tgl_start_tr >= ", $start_date)
                    ->where("d.tgl_start_tr <= ", $end_date)
                    ->where("a.active", 1)
                ->group_end()
                ->or_group_start()
                    ->where("d.tgl_end_tr >= ", $start_date)
                    ->where("d.tgl_end_tr <= ", $end_date)
                    ->where("a.active", 1)
                ->group_end()
            ->group_end();
        }

        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

}
