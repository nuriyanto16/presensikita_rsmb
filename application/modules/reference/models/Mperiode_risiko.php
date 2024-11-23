<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Mperiode_risiko
 */
class Mperiode_risiko extends Mst_model
{
    protected $_data = null;
    protected $table = '_periode_risiko'; // without prefix
    protected $primaryKey = 'periode_risiko_id';

    /**
     * Mcompany constructor.
     */
    public function __construct()
    {
        parent::__construct();
      //   $this->table = config_item("table_company");
    }

    function get_data($id = null, $offset = null, $limit = null, $order = null, $filters = null)
    {
        $this->db->select("periode_risiko_id, periode_risiko_nama, start_date, end_date, active");
        $this->db->from($this->table);

        if ($id == null OR $id == "") {
            // data tidak aktif tidak ditampilkan
            $this->db->where("active", "1");

            if (!empty($filters)) {
                if (is_array($filters) && count($filters) >= 1) {
                    $this->db->group_start();
                    $this->db->like('periode_risiko_nama', $filters[0]['value']);
                  //   $this->db->or_like('compName', $filters[0]['value']);
                    $this->db->group_end();
                }
            }

            if (!empty($order)) {
                $this->db->order_by($order[0]['field'], $order[0]['dir'], TRUE);
            } else {
                $this->db->order_by('periode_risiko_id');
            }

            if (empty($offset)) $offset = 0;
            if (empty($limit)) $limit = 10;
            $this->db->limit($limit, $offset);

            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            $this->db->where($this->primaryKey, $id);

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
                  $this->db->like('periode_risiko_nama', $filters[0]['value']);
               //  $this->db->or_like('compName', $filters[0]['value']);
                $this->db->group_end();
            }
        }

        $Q = $this->db->get();
        $this->_data = $Q->row()->_cnt;
        $Q->free_result();
        return $this->_data;
    }
}
