<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Mposition_emp
 */
class Mposition_emp extends Mst_model
{
    protected $_data = null;
    protected $table = null; // without prefix
    protected $primaryKey = 'position_code';

    /**
     * Munit constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->table = config_item("table_position_employee");
    }

    function get($id = null, $offset = null, $limit = null, $order = null, $filters = null)
    {
        $this->db->select("a.position_code, a.position_desc, a.parent_position_code, a.company_code"
            . ", a.org_code, a.is_structural, a.valid_from, a.valid_to"
            . ", o.unitName");
        $this->db->from("{$this->table} a");
        $this->db->join(config_item('table_unit') . " o", "a.org_code = o.unitCode", "left");
        $this->db->where("a.active", "1"); // data tidak aktif tidak ditampilkan
        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            $this->db->where("o.COMPID", $this->session->userdata(sess_prefix()."compId"));
        }
        if ($id == null OR $id == "") {
            if (!empty($filters)) {
                if (is_array($filters) && count($filters) >= 1) {
                    if (empty($filters[0]['field'])) {
                        $this->db->group_start();
                        $this->db->like('position_code', $filters[0]['value']);
                        $this->db->or_like('position_desc', $filters[0]['value']);
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
                $this->db->order_by('parent_position_code');
                $this->db->order_by('position_desc');
            }

            if (empty($offset)) $offset = 0;
            if (empty($limit)) $limit = 10;
            $this->db->limit($limit, $offset);

            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            $this->db->where("a.position_code", $id);

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
        $this->db->join(config_item('table_unit') . " o", "a.org_code = o.unitCode", "left");
        $this->db->where("a.active", "1"); // data tidak aktif tidak ditampilkan
        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            $this->db->where("o.COMPID", $this->session->userdata(sess_prefix()."compId"));
        }
        if (!empty($filters)) {
            if (is_array($filters) && count($filters) >= 1) {
                if (empty($filters[0]['field'])) {
                    $this->db->group_start();
                    $this->db->like('position_code', $filters[0]['value']);
                    $this->db->or_like('position_desc', $filters[0]['value']);
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

        $Q = $this->db->get();
        $this->_data = $Q->row()->_cnt;
        $Q->free_result();
        return $this->_data;
    }

    public function deleteAllJabatan() {
        // Check if there's data in the table
        $count = $this->db->count_all('z_position_employee'); // Get the count of records in the 'organisasi' table
        
        if ($count > 0) {
            // Delete all organizational data from the table
            $this->db->empty_table('z_position_employee'); // Assuming your table is named 'organisasi'
            return true; // Indicate that deletion was successful
        } else {
            return false; // Indicate that no deletion was performed
        }
    }

    public function insertJabatan($data) {
        // Insert data into the organizational table
        $this->db->insert('z_position_employee', $data); // Assuming your table is named 'organisasi'
    }
}
