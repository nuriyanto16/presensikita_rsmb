<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mcommon extends CI_Model
{
    protected $_data = null;

    function setLog($userid, $modulalias, $transno, $activity, $description = "")
    {

        //$logdate = date("Y-m-d H:i:s");
        $ipaddress = $_SERVER['REMOTE_ADDR'];
        $httpagent = $_SERVER['HTTP_USER_AGENT'];
        $httphost = $_SERVER['HTTP_HOST'];
        $compname = gethostbyaddr($ipaddress);

        //$mac_string = shell_exec("arp -a $ipaddress");
        $mac_string = "";
        $mac = "";
        $mac_array = explode(" ", $mac_string);

        $cnt = count($mac_array);
        if ($cnt > 4) {
            $mac = $mac_array[30];
        }

        $sql = "INSERT INTO log_activity(logdate,ipaddress,compname,
            userid,modulalias,transno,activity,description,httpagent,httphost,mac_address) 
            VALUES(NOW(),?,?,?,?,?,?,?,?,?,?);";

        $this->db->trans_start();
        $this->db->query($sql, array($ipaddress, $compname, $userid,
            $modulalias, $transno, $activity, $description, $httpagent, $httphost, $mac));
        $this->db->trans_complete();
    }

    function getMenuByRoleID($roleid)
    {
        $this->db->select('module_id, module_name, module_alias, COALESCE(module_pid,0) AS module_pid'
            . ', module_url, mod_icon_cls, mod_seq, mod_group');
        $this->db->from('v_sec_role_priv p');
        $this->db->where("publish=1 AND allow_view=1 AND role_id=", $roleid);
        $this->db->order_by('module_pid, mod_seq, module_id');
        $query = $this->db->get();
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }

    function getImageUser($user_id)
    {
        $this->db->select('photo ', FALSE);
        $this->db->from(config_item("table_user"));
        $Q = $this->db->get();
        $photo = $Q->row()->photo;
        $Q->free_result();
        return $photo;
    }

    function checkMenuAccess($role_id, $menu_alias)
    {
        $isAllow = false;
        // unusual query runs here        
        $this->db->select('p.allow_view');
        $this->db->from('v_sec_role_priv p');
        $this->db->where('p.role_id', $role_id);
        $this->db->where('p.module_alias', $menu_alias);
        $Q = $this->db->get();
        if ($Q->num_rows() >= 1) {
            $isAllow = $Q->row()->allow_view;
        }
        $Q->free_result();
        return $isAllow;
    }

    function getMenuAccessCRUD($role_id, $menu_alias)
    {
        $data = null;
        $this->db->select('p.allow_view, p.allow_new, p.allow_edit, p.allow_delete, p.allow_print, p.allow_approve');
        $this->db->from('v_sec_role_priv p');
        $this->db->where('p.role_id', $role_id);
        $this->db->where('p.module_alias', $menu_alias);
        $Q = $this->db->get();

        if ($Q->num_rows() >= 1) {
            $data = $Q->row();
        }
        $Q->free_result();
        return $data;
    }

    function getUser($id)
    {
        $this->db->select('*');
        $this->db->from(config_item('table_user'));
        $this->db->where("id", $id);
        $Q = $this->db->get();

        $data = null;
        if ($Q->num_rows() > 0) {
            $data = $Q->row();
            $Q->free_result();
        }

        return $data;
    }

    function getActingAs($userid)
    {
        $this->db->select("a.*,COALESCE(b.full_name,'') AS userFullName");
        $this->db->from(config_item("table_unit_acting_as") . " a");
        $this->db->join(config_item("table_user") . " b", "a.actingUserId=b.id");
        $this->db->where("actingUserId", $userid);
        $this->db->where("NOW() BETWEEN startDate AND endDate");
        $Q = $this->db->get();

        $data = null;
        if ($Q->num_rows() > 0) {
            $data = $Q->row();
            $Q->free_result();
        }

        return $data;
    }

    function getCompany($id = null)
    {
        $this->db->select('*');
        $this->db->from(config_item('table_company'));
        $this->db->where("compId", $id);
        $this->db->where("active", 1);
        $this->db->order_by("compId", "asc");
        $Q = $this->db->get();

        $data = null;
        if ($Q->num_rows() > 0) {
            if ($id != null) {
                $data = $Q->row();
            } else {
                $data = $Q->result();
            }
            $Q->free_result();
        }

        return $data;
    }

    function getSite($id = null)
    {
        $this->db->select('*');
        $this->db->from(config_item('table_site'));
        $this->db->where("siteId", $id);
        $this->db->where("active", 1);
        $this->db->order_by("siteId", "asc");
        $Q = $this->db->get();

        $data = null;
        if ($Q->num_rows() > 0) {
            if ($id != null) {
                $data = $Q->row();
            } else {
                $data = $Q->result();
            }
            $Q->free_result();
        }

        return $data;
    }

    function getUnit($id = null)
    {
        $this->db->select('*');
        $this->db->from(config_item("table_unit"));
        $this->db->where("unitId", $id);
        $this->db->where("active", 1);
        $this->db->order_by("unitId", "asc");
        $Q = $this->db->get();

        $data = null;
        if ($Q->num_rows() > 0) {
            if ($id != null) {
                $data = $Q->row();
            } else {
                $data = $Q->result();
            }
            $Q->free_result();
        }

        return $data;
    }

    function getPosition($id = null)
    {
        $this->db->select('*');
        $this->db->from(config_item("table_position"));
        $this->db->where("positionId", $id);
        $this->db->where("active", 1);
        $this->db->order_by("positionId", "asc");
        $Q = $this->db->get();

        $data = null;
        if ($Q->num_rows() > 0) {
            if ($id != null) {
                $data = $Q->row();
            } else {
                $data = $Q->result();
            }
            $Q->free_result();
        }

        return $data;
    }
}
