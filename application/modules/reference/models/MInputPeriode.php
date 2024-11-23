<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Mcompany
 */
class MInputPeriode extends Mst_model
{
    protected $_data = null;
    protected $table = null; // without prefix
    protected $primaryKey = 'periode_id';
    /**
     * Mcompany constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = config_item("table_periode");
    }

    function get_data($id = null, $offset = null, $limit = null, $order = null, $filters = null)
    {
        $query = $this->db->select("periode_id, periode_nama, start_date, end_date, active, created_by, created_date, updated_by, updated_date");
        $this->db->from($this->table);

       
        if ($id == null OR $id == "") {

            if (!empty($filters)) {
                if (is_array($filters) && count($filters) >= 1) {
                    $this->db->group_start();
                    $this->db->like('periode_nama', $filters[0]['value']);
                    $this->db->group_end();
                }
            }

            if (!empty($order)) {
                $this->db->order_by($order[0]['field'], $order[0]['dir'], TRUE);
            } else {
                $this->db->order_by('periode_id');
            }

            if (empty($offset)) $offset = 0;
            if (empty($limit)) $limit = 10;
            $this->db->limit($limit, $offset);

            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            // $this->db->where("COMPID", 1);

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
        if (!empty($filters)) {
            if (is_array($filters) && count($filters) >= 1) {
                $this->db->group_start();
                $this->db->like('periode_nama', $filters[0]['value']);
                // $this->db->or_like('COMP_NAME', $filters[0]['value']);
                $this->db->group_end();
            }
        }

        $Q = $this->db->get();
        $this->_data = $Q->row()->_cnt;
        $Q->free_result();
        return $this->_data;
    }

    public function insertPeriode($data){
        $this->db->trans_begin();
        $this->db->insert("z_periode", $data);
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $return=false;           
        }
        else
        {
            $this->db->trans_commit();           
            $return=true;          
        }
        return $return;
    }

    public function updatePeriode($per_id, $data) {
        $this->db->trans_start(); // Start a database transaction
        
        $this->db->where('periode_id', $per_id);
        $this->db->update('z_periode', $data); // Update data in the "z_periode" table
        
        $this->db->trans_complete(); // Complete the database transaction
        
        if ($this->db->trans_status() === FALSE) {
            return false;
        } else {
            return true;
        }
    }


    function getKonfigurasi($id = null)
    {
        $this->db->select("a.periode_id, a.periode_nama, a.start_date, a.end_date, a.active, a.created_by ");
        $this->db->from("z_periode a");
        $this->db->where("a.periode_id", $id);
        
        $Q = $this->db->get();
        $this->_data = $Q->row();
      
        $Q->free_result();
        return $this->_data;
    }

    public function deletePeriod($id){
        $this->db->trans_begin();
        $this->db->where('periode_id', $id);
        $this->db->delete('z_periode');
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $return=false;           
        }
        else
        {
            $this->db->trans_commit();           
            $return=true;          
        }
        return $return;
    }

}
