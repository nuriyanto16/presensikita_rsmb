<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Msettingpresensi
 */
class Msettingpresensi extends Mst_model
{
    protected $_data = null;
    protected $table = null; // without prefix
    protected $primaryKey = 'id_menu';
    protected $primaryKey2 = 'compid';

    /**
     * Msettingpresensi constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->table = config_item("table_setting_periode");
    }

    function get($id = null, $offset = null, $limit = null, $order = null, $filters = null, $compid_ = null)
    {
        $this->db->select("a.id_menu, a.remark, DATE_FORMAT(a.start_date, '%d-%m-%Y') AS start_date, DATE_FORMAT(a.end_date, '%d-%m-%Y') AS end_date "
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
                        $this->db->like('deskripsi', $filters[0]['value']);
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
            $this->db->where("a.id_menu", $id);
            $this->db->where("a.compid", $compid_);
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

        $Q = $this->db->get();
        $this->_data = $Q->row()->_cnt;
        $Q->free_result();
        return $this->_data;
    }

    function update_presensi($id,$comp_id,$data){
        $this->db->trans_begin();
        $this->db->where("id_menu",$id);
        $this->db->where("compid",$comp_id);
        $this->db->update($this->table, $data);
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

    public function insert_presensi($data){
        $this->db->trans_begin();
        $this->db->insert($this->table, $data);
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
