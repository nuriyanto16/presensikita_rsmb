<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Mconf_approval
 */
class Mconf_approval extends Mst_model
{
    protected $_data = null;
    protected $table = '_conf_approval'; // without prefix
    protected $primaryKey = 'conf_approval_id';

    /**
     * Mconf_approval constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    function get($id = null, $offset = null, $limit = null, $order = null, $filters = null)
    {
        $this->db->select("a.conf_approval_id, a.jenis_proses_id, a.comp_id, a.position_code"
            . ", a.unit_id, a.telusur_parent, a.telusur_level, a.urutan, a.group_app, a.active"
            . ", o.unitName, pe.position_desc");
        $this->db->from("{$this->table} a");
        $this->db->join(config_item('table_unit') . " o", "a.unit_id = o.unitId", "left");
        $this->db->join(config_item('table_position_employee') . " pe", "a.position_code = pe.position_code", "left");
        $this->db->where("a.active", "1"); // data tidak aktif tidak ditampilkan

        if ($id == null OR $id == "") {
            if (!empty($filters)) {
                if (is_array($filters) && count($filters) >= 1) {
                    if (empty($filters[0]['field'])) {
                        $this->db->group_start();
                        $this->db->like('a.position_code', $filters[0]['value']);
                        $this->db->or_like('o.unitName', $filters[0]['value']);
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
                $this->db->order_by('a.comp_id', 'asc');
                $this->db->order_by('a.urutan', 'asc');
            }

            if (empty($offset)) $offset = 0;
            if (empty($limit)) $limit = 10;
            $this->db->limit($limit, $offset);

            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            $this->db->where("a.conf_approval_id", $id);

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
        $this->db->join(config_item('table_unit') . " o", "a.unit_id = o.unitId", "left");
        $this->db->join(config_item('table_position_employee') . " pe", "a.position_code = pe.position_code", "left");
        $this->db->where("a.active", "1"); // data tidak aktif tidak ditampilkan

        if (!empty($filters)) {
            if (is_array($filters) && count($filters) >= 1) {
                if (empty($filters[0]['field'])) {
                    $this->db->group_start();
                    $this->db->like('a.position_code', $filters[0]['value']);
                    $this->db->or_like('o.unitName', $filters[0]['value']);
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
