<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Mmodule_manage extends Mst_model
{
    var $_tables = "sec_modul";
    var $_data = null;
    var $_id = "module_id";
    protected $INST_TYPE_ID = 1;
    protected $_error;

    public function __construct()
    {
        $this->table = $this->_tables;
        $this->primaryKey = $this->_id;

        parent::__construct();
    }

    function get_modules($id = null, $by = null)
    {
        $this->db->select("m.module_id, m.module_name, m.module_alias, m.module_url, m.mod_icon_cls, m.mod_seq, m.module_pid, "
            . "m.publish, m.mod_group");
        $this->db->from($this->_tables . " m");
        if ($id == null OR $id == "") {

            if ($by != null)
                $this->db->where($by);

            $this->db->order_by("m.module_pid", "asc");
            $this->db->order_by("m.mod_seq", "asc");
            $this->db->order_by("m.module_id", "asc");

            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            $this->db->where("m." . $this->_id, $id);

            if ($by != null)
                $this->db->where($by);

            $Q = $this->db->get();
            $this->_data = $Q->row();
        }


        $Q->free_result();
        return $this->_data;
    }

    public function sort_parentchild($_modules)
    {
        return $this->buildTree($_modules, 0);
    }

    private function buildTree($elements, $parentId = 0)
    {
        $branch = array();
        foreach ($elements as $element) {

            if ($element->module_pid == $parentId) {
                $element->treename = $element->module_name;
                $branch[] = $element;
                $children = $this->buildTree($elements, $element->module_id);
                if ($children) {
                    //$element['children'] = $children;
                    foreach ($children as $chd) {
                        if (strlen($chd->treename) >= 14 && substr($chd->treename, 0, 14) == "&nbsp;|_&nbsp;") {
                            $chd->treename = "&nbsp;&nbsp;&nbsp;&nbsp;|_&nbsp;" . $chd->module_name;
                        } elseif (strlen($chd->treename) >= 32 && substr($chd->treename, 0, 32) == "&nbsp;&nbsp;&nbsp;&nbsp;|_&nbsp;") {
                            $chd->treename = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|_&nbsp;" . $chd->module_name;
                        } elseif (strlen($chd->treename) >= 32 && substr($chd->treename, 0, 50) == "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|_&nbsp;") {
                            $chd->treename = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|_&nbsp;" . $chd->module_name;
                        } elseif (strlen($chd->treename) >= 68 && substr($chd->treename, 0, 60) == "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;") {
                            $chd->treename = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.|_&nbsp;" . $chd->module_name;
                        } else {
                            $chd->treename = "&nbsp;|_&nbsp;" . $chd->module_name;
                        }
                        $branch[] = $chd;
                    }
                }
                //$branch[] = $element;
            }
        }
        return $branch;
    }


    public function alias_exists($alias, $id = null)
    {
        if (empty($alias)) {
            return FALSE;
        }

        $this->db->select("count(module_id) as _cnt");
        $this->db->from($this->_tables);
        $this->db->where('module_alias', $alias);
        if ($id != null) {
            $this->db->where('module_id!=', $id);
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

    public function insert_role_priv($module_id = null)
    {
        $roles = $this->get_roles();
        foreach ($roles as $role) {
            $this->db->select("count(role_id) as _cnt");
            $this->db->from("sec_role_priv");
            $this->db->where('role_id', $role->role_id);
            $this->db->where('module_id', $module_id);
            $exist = $this->db->get()->row()->_cnt;
            if ($exist == 0) {
                $datains = array(
                    'role_id' => $role->role_id, 
                    'module_id' => $module_id, 
                    'allow_view' => true,
                    'allow_new' => true,
                    'allow_edit' => true,
                    'allow_delete' => true,
                    'allow_print' => true,
                    'allow_approve' => true
                    );
                $this->db->insert('sec_role_priv', $datains);
            }
        }
    }

    public function get_roles($id = null, $by = null)
    {
        $this->db->select("role_id, role_alias, role_name");
        $this->db->from("sec_role");
        $this->db->where('active', 1);
        
        if ($this->session->userdata(sess_prefix() . "rolealias") == "superadmin") {
            $this->db->where("role_id >=", 1);
        } else if ($this->session->userdata(sess_prefix() . "rolealias") == "admin") {
            $this->db->where("role_id >", 2);
        }
            
        if ($id == null OR $id == "") {
            if ($by != null)
                $this->db->where($by);

            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            $this->db->where("role_id", $id);
            $Q = $this->db->get();
            $this->_data = $Q->row();
        }

        $Q->free_result();
        return $this->_data;
    }

    public function get_privilege($role_id)
    {
        $sql = "SELECT module_id, module_name, module_alias, COALESCE(module_pid,0) as module_pid, LTRIM(RTRIM(module_url)) as module_url, mod_seq, allow_view,
                    allow_new, allow_edit, allow_delete, allow_print,allow_approve FROM v_sec_role_priv
                    WHERE publish=1 AND allow_view=1 AND role_id= ?
                    UNION 
                    SELECT m.module_id, m.module_name, m.module_alias, COALESCE(m.module_pid,0) as module_pid, LTRIM(RTRIM(m.module_url)) as module_url, m.mod_seq, 0 as allow_view,
                    0 as allow_new, 0 as allow_edit, 0 as allow_delete, 0 as allow_print,0 as allow_approve
                    FROM sec_modul m WHERE m.publish=1 AND NOT EXISTS(
                        select 1 from sec_role_priv p where p.module_id = m.module_id AND p.allow_view = 1 AND p.role_id=?
                    ) ORDER BY module_pid, mod_seq, module_id";
        $Q = $this->db->query($sql, array($role_id, $role_id));
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    public function update_privilege($role_id)
    {
        $this->db->trans_begin();
        $_tblrole_priv = $this->db->dbprefix('sec_role_priv');

        // POSTING DETAIL PRIVILEGE
        $sql = sprintf("UPDATE %s SET allow_view=0,allow_new=0,allow_edit=0,allow_delete=0,allow_print=0,allow_approve=0 WHERE role_id =?", $_tblrole_priv);
        $this->db->query($sql, array($role_id));

        foreach ($_POST["moduleid"] as $val) :
            if ($val > 0) {
                $exists = $this->db->query(sprintf("SELECT COUNT(module_id) as _cnt FROM %s WHERE role_id=? AND module_id=?", $_tblrole_priv), array($role_id, $val))->row()->_cnt;
                if ($exists > 0) {
                    $sql = sprintf("UPDATE %s SET allow_view = 1 WHERE role_id=? AND module_id=?", $_tblrole_priv);
                } else {
                    $sql = sprintf("INSERT INTO %s (role_id, module_id, allow_view, allow_new, allow_edit, allow_delete)"
                        . "VALUES (?, ?, 1, 0, 0, 0)", $_tblrole_priv);
                }
                $this->db->query($sql, array($role_id, $val));
            }
        endforeach;
        
        foreach ($_POST["auth_new"] as $val) :
            if ($val > 0) {
                $exists = $this->db->query(sprintf("SELECT COUNT(module_id) as _cnt FROM %s WHERE role_id=? AND module_id=?", $_tblrole_priv), array($role_id, $val))->row()->_cnt;
                if ($exists > 0) {
                    $sql = sprintf("UPDATE %s SET allow_new = 1 WHERE role_id=? AND module_id=?", $_tblrole_priv);
                    $this->db->query($sql, array($role_id, $val)); 
                } 
                
            }
        endforeach;
        
        foreach ($_POST["auth_edit"] as $val) :
            if ($val > 0) {
                $exists = $this->db->query(sprintf("SELECT COUNT(module_id) as _cnt FROM %s WHERE role_id=? AND module_id=?", $_tblrole_priv), array($role_id, $val))->row()->_cnt;
                if ($exists > 0) {
                    $sql = sprintf("UPDATE %s SET allow_edit = 1 WHERE role_id=? AND module_id=?", $_tblrole_priv);
                    $this->db->query($sql, array($role_id, $val)); 
                } 
                
            }
        endforeach;
        
        foreach ($_POST["auth_del"] as $val) :
            if ($val > 0) {
                $exists = $this->db->query(sprintf("SELECT COUNT(module_id) as _cnt FROM %s WHERE role_id=? AND module_id=?", $_tblrole_priv), array($role_id, $val))->row()->_cnt;
                if ($exists > 0) {
                    $sql = sprintf("UPDATE %s SET allow_delete = 1 WHERE role_id=? AND module_id=?", $_tblrole_priv);
                    $this->db->query($sql, array($role_id, $val)); 
                } 
                
            }
        endforeach;
        
        foreach ($_POST["auth_print"] as $val) :
            if ($val > 0) {
                $exists = $this->db->query(sprintf("SELECT COUNT(module_id) as _cnt FROM %s WHERE role_id=? AND module_id=?", $_tblrole_priv), array($role_id, $val))->row()->_cnt;
                if ($exists > 0) {
                    $sql = sprintf("UPDATE %s SET allow_print = 1 WHERE role_id=? AND module_id=?", $_tblrole_priv);
                    $this->db->query($sql, array($role_id, $val)); 
                } 
                
            }
        endforeach;
        
        foreach ($_POST["auth_approve"] as $val) :
            if ($val > 0) {
                $exists = $this->db->query(sprintf("SELECT COUNT(module_id) as _cnt FROM %s WHERE role_id=? AND module_id=?", $_tblrole_priv), array($role_id, $val))->row()->_cnt;
                if ($exists > 0) {
                    $sql = sprintf("UPDATE %s SET allow_approve = 1 WHERE role_id=? AND module_id=?", $_tblrole_priv);
                    $this->db->query($sql, array($role_id, $val)); 
                } 
                
            }
        endforeach;

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $return["success"] = false;
            //throw new Exception('Update otorisasi gagal !!');
        } else {
            $this->db->trans_commit();
            $return["success"] = true;
        }

        return $return["success"];
    }
}
