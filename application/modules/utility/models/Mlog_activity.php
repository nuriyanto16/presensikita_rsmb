<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mlog_activity extends Mst_model
{
    var $_tables = "log_activity";

    public function __construct()
    {
        parent::__construct();
    }

    function getDataList($id = null, $by = null)
    {
        $offset = $this->input->post('start', 1);
        $limit = $this->input->post('length', 25);
        $search = $this->input->post('search');

        $order = $this->input->post('order');
        $arr_col = array(
            0 => 'logdate',
            1 => 'ipaddress',
            2 => 'compname',
            3 => 'username',
            4 => 'modulalias',
            5 => 'transno',
            6 => 'activity',
            7 => 'httpagent',
            8 => 'httphost',
            9 => 'mac_address'
        );

        $search_string = "";
        if (!empty($search['value'])) {
            $search_string = strtolower(trim($search['value']));
        }

        $this->db->select("a.*,b.username");
        $this->db->from($this->_tables . " a");
        $this->db->join(config_item("table_user") . " b", "a.userid=b.id");
        if ($id == null OR $id == "") {

            if ($by != null) {
                $whr = $this->_by($by);
                $this->db->where("($whr)");
            }

            if (!is_null($search_string) && $search_string != "") {
                $this->db->group_start();
                $this->db->like('username', $search_string, 'both');
                $this->db->or_like('modulalias', $search_string, 'both');
                $this->db->or_like('activity', $search_string, 'both');
                $this->db->group_end();
            }
            if ($offset != null && $limit != null)
                $this->db->limit($limit, $offset);

            if (!empty($order)) {
                foreach($order as $ord) {
                    $this->db->order_by($arr_col[$ord['column']], $ord['dir']);
                }
            } else {
                $this->db->order_by($arr_col[1], "ASC");
            }

            $Q = $this->db->get();
            $data = $Q->result();

        } else {
            $this->db->where($this->_id, $id);

            if ($by != null) $this->db->where($by);

            $Q = $this->db->get();
            $data = $Q->row();
        }

        $Q->free_result();
        return $data;
    }

    function getCountList($by = null)
    {
        $search = $this->input->post('search');

        $search_string = "";
        if (!empty($search['value'])) {
            $search_string = strtolower(trim($search['value']));
        }

        $this->db->select("COUNT(*) AS cnt");
        $this->db->from($this->_tables . " a");
        $this->db->join(config_item("table_user") . " b", "a.userid=b.id");

        if ($by != null) {
            $whr = $this->_by($by);
            $this->db->where("($whr)");
        }

        if (!is_null($search_string) && $search_string != "") {
            $this->db->group_start();
            $this->db->like('username', $search_string, 'both');
            $this->db->or_like('modulalias', $search_string, 'both');
            $this->db->or_like('activity', $search_string, 'both');
            $this->db->group_end();
        }

        $Q = $this->db->get();
        $data = $Q->row();

        $Q->free_result();
        return $data->cnt;
    }
}
