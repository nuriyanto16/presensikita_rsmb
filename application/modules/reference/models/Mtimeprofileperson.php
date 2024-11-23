<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Memployee
 */
class Mtimeprofileperson extends Mst_model
{
    protected $_data = null;
    protected $table = null; // without prefix
    protected $primaryKey = 'tp_seq';

    /**
     * Munit constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = config_item("table_timeprofile_person");
    }

    function get($id = null, $offset = null, $limit = null, $order = null, $filters = null)
    {
        $this->db->select("a.tp_seq, a.id_tp, a.comp_code, a.nik"
                      . ", DATE_FORMAT(a.tp_start_date, '%d-%m-%Y') AS tp_start_date, DATE_FORMAT(a.tp_end_date, '%d-%m-%Y') AS tp_end_date,"
                      . ", c.deskripsi, c.kode, b.compid, b.comp_name, a.active, 
                           DATE_FORMAT(c.hari_1_jam_in, '%H:%i:%s') AS hari_1_jam_in, 
                           DATE_FORMAT(c.hari_1_jam_out, '%H:%i:%s') AS hari_1_jam_out");
        $this->db->from("{$this->table} a");
        $this->db->join(config_item('table_company') . " b", "b.compid = a.compid", "inner");
        $this->db->join(config_item('table_time_profile') . " c", "a.id_tp = c.id_tp", "inner");
        $this->db->where("a.active", "1"); // data tidak aktif tidak ditampilkan
        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            $this->db->where("a.compid", $this->session->userdata(sess_prefix()."compId"));
        }
        if ($id == null OR $id == "") {
            if (!empty($filters)) {
                if (is_array($filters) && count($filters) >= 1) {
                    if (empty($filters[0]['field'])) {
                        $this->db->group_start();
                        $this->db->or_like('comp_name', $filters[0]['value']);
                        $this->db->group_end();
                    } else {
                        $this->db->group_start();
                        foreach ($filters as $filter) {
                            if ($filter['field'] == 'unitName') {
                                $filter['field'] = "o." . $filter['field'];
                            }
                            $this->db->where($filter['field'], $filter['value'], true);
                        }
                        $this->db->group_end();
                    }
                }
            }

            if (!empty($order)) {
                //$this->db->order_by($order[0]['field'], $order[0]['dir'], TRUE);
                $this->db->order_by('a.tp_start_date','desc');
            } else {
                $this->db->order_by('a.tp_start_date','desc');
            }

            if (empty($offset)) $offset = 0;
            if (empty($limit)) $limit = 10;
            $this->db->limit($limit, $offset);

            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            $this->db->where("a.tp_seq", $id);

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
        $this->db->join(config_item('table_time_profile') . " c", "a.id_tp = c.id_tp", "inner");
        $this->db->where("a.active", "1"); // data tidak aktif tidak ditampilkan
        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            $this->db->where("a.compid", $this->session->userdata(sess_prefix()."compId"));
        }
        if (!empty($filters)) {
            if (is_array($filters) && count($filters) >= 1) {
                if (empty($filters[0]['field'])) {
                    $this->db->group_start();
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

    function delete_hist($nik,$compid){
        $this->db->trans_begin();
        $this->db->where("nik",$nik);
        $this->db->where("compid",$compid);
        $this->db->delete("z_tp_person");
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $return["success"]=false;   
            $return["msg"]="Data gagal dihapus !";
        }
        else
        {
            $this->db->trans_commit();           
            $return["success"]=true;   
            $return["msg"]="Data berhasil dihapus...";
        }
        return $return;
    }
}
