<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mrole_manage extends Mst_model
{
    protected $tables;
    protected $_data = null;
    protected $_id = "role_id";

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->config('ion_auth', TRUE);

        //initialize db tables data
        $this->tables = $this->config->item('tables', 'ion_auth');
    }

    function get_roles($id = null)
    {
//        $this->db->select("r.role_id, r.role_name, r.role_alias, r.active");
        $this->db->from($this->tables['groups'] . " r");
        if ($id == null OR $id == "") {
            if ($this->session->userdata(sess_prefix() . "rolealias") == "superadmin") {
                $this->db->where("r.role_id >=", 1);
            } else if ($this->session->userdata(sess_prefix() . "rolealias") == "admin") {
                $this->db->where("r.role_id >", 1);
            }

            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            $this->db->where("r." . $this->_id, $id);

            $Q = $this->db->get();
            $this->_data = $Q->row();
        }

        $Q->free_result();
        return $this->_data;
    }

    public function role_exists($rolename, $id = null)
    {
        if (empty($rolename)) {
            return FALSE;
        }

        $this->db->select("count(role_id) as _cnt");
        $this->db->from($this->tables['groups']);
        $this->db->where('role_alias', $rolename);
        if ($id != null) {
            $this->db->where('role_id', $id);
        }
        $Q = $this->db->get();
        $this->_data = $Q->row()->_cnt;
        $Q->free_result();
        if ($this->_data > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
