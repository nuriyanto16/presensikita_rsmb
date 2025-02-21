<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Mperlakuan_risiko
 */
class Mperlakuan_risiko extends Mst_model
{
    protected $_data = null;
    protected $table = "_perlakuan_risiko"; // without prefix
    protected $primaryKey = 'perlakuan_risiko_id';

    /**
     * Mjenis_risiko constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    function get($id = null, $offset = null, $limit = null, $order = null, $filters = null)
    {
        $this->db->select("perlakuan_risiko_id, perlakuan_risiko_nama"
            . ", active, created_by, created_date, updated_by, updated_date");
        $this->db->from($this->table);
        $this->db->where("active", "1"); // data tidak aktif tidak ditampilkan

        if ($id == null OR $id == "") {
            if (!empty($filters)) {
                if (is_array($filters) && count($filters) >= 1) {
                    if (empty($filters[0]['field'])) {
                        $this->db->group_start();
                        $this->db->like('perlakuan_risiko_nama', $filters[0]['value']);
                        $this->db->group_end();
                    } else {
                        $this->db->group_start();
                        foreach ($filters as $filter) {
                            $this->db->like($filter['field'], $filter['value'], true);
                        }
                        $this->db->group_end();
                    }
                }
            }

            if (!empty($order)) {
                $this->db->order_by($order[0]['field'], $order[0]['dir'], TRUE);
            } else {
                $this->db->order_by('perlakuan_risiko_id');
            }

            if (empty($offset)) $offset = 0;
            if (empty($limit)) $limit = 10;
            $this->db->limit($limit, $offset);

            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            $this->db->where("perlakuan_risiko_id", $id);

            $Q = $this->db->get();
            $this->_data = $Q->row();
        }

        $Q->free_result();
        return $this->_data;
    }

    function get_cnt($filters = null)
    {
        $this->db->select("count(1) _cnt");
        $this->db->from($this->table);
        $this->db->where("active", "1"); // data tidak aktif tidak ditampilkan

        if (!empty($filters)) {
            if (is_array($filters) && count($filters) >= 1) {
                if (empty($filters[0]['field'])) {
                    $this->db->group_start();
                    $this->db->like('perlakuan_risiko_nama', $filters[0]['value']);
                    $this->db->group_end();
                } else {
                    $this->db->like($filters[0]['field'], $filters[0]['value'], true);
                }
            }
        }

        $Q = $this->db->get();
        $this->_data = $Q->row()->_cnt;
        $Q->free_result();
        return $this->_data;
    }
}
