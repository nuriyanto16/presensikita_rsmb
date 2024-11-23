<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Mcompany
 */
class Mcompany extends Mst_model
{
    protected $_data = null;
    protected $table = null; // without prefix
    protected $primaryKey = 'COMPID';

    /**
     * Mcompany constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = config_item("table_p_z_company");
    }

    function get_data($id = null, $offset = null, $limit = null, $order = null, $filters = null)
    {
        $this->db->select("COMPID, COMP_CODE, COMP_NAME, LOGOIMAGEE, ACTIVE, COMP_CODE_SAP");
        $this->db->from($this->table);
        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            $this->db->where("COMPID", $this->session->userdata(sess_prefix()."compId"));
        }
        if ($id == null OR $id == "") {
            // data tidak aktif tidak ditampilkan
            $this->db->where("ACTIVE", "1");

            if (!empty($filters)) {
                if (is_array($filters) && count($filters) >= 1) {
                    $this->db->group_start();
                    $this->db->like('COMP_CODE', $filters[0]['value']);
                    $this->db->or_like('COMP_NAME', $filters[0]['value']);
                    $this->db->group_end();
                }
            }

            if (!empty($order)) {
                $this->db->order_by($order[0]['field'], $order[0]['dir'], TRUE);
            } else {
                $this->db->order_by('COMP_CODE');
            }

            if (empty($offset)) $offset = 0;
            if (empty($limit)) $limit = 10;
            $this->db->limit($limit, $offset);

            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            $this->db->where("COMPID", $id);

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
        $this->db->where("ACTIVE", "1"); // data tidak aktif tidak ditampilkan
        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            $this->db->where("COMPID", $this->session->userdata(sess_prefix()."compId"));
        }
        if (!empty($filters)) {
            if (is_array($filters) && count($filters) >= 1) {
                $this->db->group_start();
                $this->db->like('COMP_CODE', $filters[0]['value']);
                $this->db->or_like('COMP_NAME', $filters[0]['value']);
                $this->db->group_end();
            }
        }

        $Q = $this->db->get();
        $this->_data = $Q->row()->_cnt;
        $Q->free_result();
        return $this->_data;
    }
}
