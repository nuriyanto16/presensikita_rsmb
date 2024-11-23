<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Mcostcenter
 */
class Mcostcenter extends Mst_model
{
    protected $_data = null;
    protected $table = null; // without prefix
    protected $primaryKey = 'costcenter_code';

    /**
     * Mcostcenter constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = config_item("table_costcenter");
    }

    function get_data($id = null, $offset = null, $limit = null, $order = null, $filters = null)
    {
        $this->db->select("costcenter_code, costcenter_desc, valid_from, valid_to, active");
        $this->db->from($this->table);

        if ($id == null OR $id == "") {
            $this->db->where("active", "1"); // data tidak aktif tidak ditampilkan

            if (!empty($filters)) {
                if (is_array($filters) && count($filters) >= 1) {
                    $this->db->group_start();
                    $this->db->like('costcenter_code', $filters[0]['value']);
                    $this->db->or_like('costcenter_desc', $filters[0]['value']);
                    $this->db->group_end();
                }
            }

            if (!empty($order)) {
                $this->db->order_by($order[0]['field'], $order[0]['dir'], TRUE);
            } else {
                $this->db->order_by('costcenter_code');
            }

            if (empty($offset)) $offset = 0;
            if (empty($limit)) $limit = 10;
            $this->db->limit($limit, $offset);

            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            $this->db->where("costcenter_code", $id);

            $Q = $this->db->get();
            $this->_data = $Q->row();
        }

        $Q->free_result();
        return $this->_data;
    }

    function get_data_cnt($filters = null)
    {
        $this->db->select("count(1) _cnt");
        $this->db->from($this->table);
        $this->db->where("active", "1"); // data tidak aktif tidak ditampilkan

        if (!empty($filters)) {
            if (is_array($filters) && count($filters) >= 1) {
                $this->db->group_start();
                $this->db->like('costcenter_code', $filters[0]['value']);
                $this->db->or_like('costcenter_desc', $filters[0]['value']);
                $this->db->group_end();
            }
        }

        $Q = $this->db->get();
        $this->_data = $Q->row()->_cnt;
        $Q->free_result();
        return $this->_data;
    }
}
