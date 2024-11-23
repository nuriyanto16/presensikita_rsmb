<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Mharilibur
 */
class Mharilibur extends Mst_model
{
    protected $_data = null;
    protected $table = null; // without prefix
    protected $primaryKey = 'libur_id';

    /**
     * Munit constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->table = config_item("table_setting_harilibur");
    }

    function get($id = null, $offset = null, $limit = null, $order = null, $filters = null)
    {
        $this->db->select("a.libur_id,  DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tanggal, a.keterangan, "
                      . ", b.compid, b.comp_name, a.active");
        $this->db->from("{$this->table} a");
        $this->db->join(config_item('table_company') . " b", "b.compid = a.compid", "inner");
        $this->db->where("a.active", "1"); // data tidak aktif tidak ditampilkan
        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            $this->db->where("a.compid", $this->session->userdata(sess_prefix()."compId"));
        }
        if ($id == null OR $id == "") {
            if (!empty($filters)) {
                if (is_array($filters) && count($filters) >= 1) {
                    if (empty($filters[0]['field'])) {
                        $this->db->group_start();
                        $this->db->like('keterangan', $filters[0]['value']);
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
            $this->db->where("a.libur_id", $id);

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
        $this->db->join(config_item('table_company') . " b", "b.compid = a.compid", "inner");
        $this->db->where("a.active", "1"); // data tidak aktif tidak ditampilkan
        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            $this->db->where("a.compid", $this->session->userdata(sess_prefix()."compId"));
        }
        if (!empty($filters)) {
            if (is_array($filters) && count($filters) >= 1) {
                if (empty($filters[0]['field'])) {
                    $this->db->group_start();
                    $this->db->like('keterangan', $filters[0]['value']);
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

        $Q = $this->db->get();
        $this->_data = $Q->row()->_cnt;
        $Q->free_result();
        return $this->_data;
    }
}
