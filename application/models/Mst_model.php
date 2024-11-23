<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Mst_model
 *
 * @author MST
 *
 * @property CI_DB $db
 * @property CI_DB_forge $dbforge
 * @property CI_Benchmark $benchmark
 * @property CI_Calendar $calendar
 * @property CI_Cart $cart
 * @property CI_Controller $controller
 * @property CI_Email $email
 * @property CI_Encrypt $encrypt
 * @property CI_Exceptions $exceptions
 * @property CI_Form_validation $form_validation
 * @property CI_Ftp $ftp
 * @property CI_Hooks $hooks
 * @property CI_Image_lib $image_lib
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Log $log
 * @property CI_Model $model
 * @property CI_Output $output
 * @property CI_Pagination $pagination
 * @property CI_Profiler $profiler
 * @property CI_Router $router
 * @property CI_Session $session
 * @property CI_Table $table
 * @property CI_Trackback $trackback
 * @property CI_Typography $typography
 * @property CI_Unit_test $unit_test
 * @property CI_Upload $upload
 * @property CI_URI $uri
 * @property CI_User_agent $user_agent
 * @property CI_Form_Validation $validation
 * @property CI_Xmlrpc $xmlrpc
 * @property CI_Xmlrpcs $xmlrpcs
 * @property CI_Zip $zip
 * @property CI_Javascript $javascript
 * @property CI_Jquery $jquery
 * @property CI_Utf8 $utf8
 * @property CI_Security $security
 * @property CI_Migration $migration
 */
class Mst_model extends CI_Model
{
    //put your code here
    protected $_result = null;
    protected $error = null;
    protected $table = "";
    protected $primaryKey = "id";
    public $id;

    public function __construct()
    {
        parent::__construct();

        if (!empty($this->table) && substr($this->table, 0, 5) != $this->db->dbprefix) {
            $this->table = $this->db->dbprefix($this->table);
        }
    }

    public function get_table()
    {
        return $this->table;
    }

    public function get_user_profile()
    {
        $user_id = (int)$this->session->userdata(sess_prefix() . 'userid');
        $this->db->select("a.id, a.full_name, a.email, a.created_date, a.siteId, a.unitId, a.positionId, a.photo, 
                        a.dt_superadmin, a.dt_admin, a.dt_user");
        $this->db->from(config_item('view_user') . " a");
        $this->db->where('a.id', $user_id);
        $Q = $this->db->get();
        $this->_result = $Q->row();
        $Q->free_result();
        return $this->_result;
    }
    
    public function get_user_byid($userid)
    {
        $query = $this->db->select('a.id, a.username, a.email, a.password, a.active, a.last_login, a.full_name, a.phone,
                                    a.created_date, b.role_id, c.role_name, c.role_alias, e.compId, e.siteId, a.unitId, a.positionId, a.photo,
                                    a.dt_superadmin, a.dt_admin, a.dt_user')
            ->from('sec_user a')
            ->join('sec_user_role b', 'a.id=b.userid', 'inner')
            ->join('sec_role c', 'b.role_id=c.role_id', 'inner')
            ->join('unit d', 'd.unitId=a.unitId', 'left')
            ->join('site e', 'e.siteId=d.siteId', 'left')
            ->where('a.id', $userid)
            ->limit(1)
            ->order_by('a.id', 'desc')
            ->get();
        
        $user = null;
        if ($query->num_rows() === 1) {
            $user = $query->row();
        }
        
        return $user;
    }

    protected function _by($by)
    {
        $par = '';
        $c = ' AND';
        $i = 0;
        $where = "";
        $cntrec = count($by);
        foreach ($by as $key => $value) {
            if ($i == $cntrec - 1) {
                $c = '';
            }

            $ex = explode(" ", $key);
            if (count($ex) > 1) {
                $key = $ex[0] . " " . $ex[1];
            } else {
                $key = $ex[0] . " =";
            }

            if (is_int($value)) {
                $value = $value;
            } else {
                $value = "'" . $value . "'";
            }

            $where .= " " . $key . " " . $value . "" . $c;
            $i++;
        }
        return $where;
    }

    public function _set_error($err)
    {
        $this->error = $err;
    }

    public function get_error()
    {
        return $this->error;
    }
    
    public function delete_table($table, $where)
    {

        $this->db->where($where);

        $return = $this->db->delete($table);

        return $return;
    }

    public function delete_record($table, $column, $id)
    {
//        if (substr($table, 0, 5) != $this->db->dbprefix) {
//            $table = $this->db->dbprefix($table);
//        }
        if (is_array($id)) {
            $this->db->where_in($column, $id);
        } else {
            $this->db->where($column, $id);
        }

        $return = $this->db->delete($table);

        return $return;
    }

    /**
     * This is delete function to delete record(s) on single table
     * $id can be passed as array to delete multiple rows
     *
     * @param int|string|array $id
     */
    public function delete($id)
    {
        if (is_array($id)) {
            $this->db->where_in($this->primaryKey, $id);
        } else {
            $this->db->where($this->primaryKey, $id);
        }

        $return = $this->db->delete($this->table);

        return $return;
    }

//    public function get_record($table, $column, $id)
//    {
//        if (substr($table, 0, 5) != $this->db->dbprefix) {
//            $table = $this->db->dbprefix($table);
//        }
//
//        $this->db->select('*');
//        $this->db->where($column, $id);
//        $query = $this->db->get($table);
//
//        $this->_result = $query->result();
//        $query->free_result();
//        return $this->_result;
//    }
    
    public function get_record($table, $where=null, $field=null, $order_by=null, $limit=null)
    {

        if($field!=null){
            $this->db->select($field);
        } else {
            $this->db->select("*");
        }
        
        if($where!=null) $this->db->where($where);
        
        if($order_by!=null) $this->db->order_by($order_by);
        if($limit!=null) $this->db->limit($limit);
        
        $query = $this->db->get($table);

        $this->_result = $query->row();
        $query->free_result();
        return $this->_result;
    }

    
    public function get_list($table, $where=null, $order=null)
    {

        $this->db->select('*');
        if ($where != null){
            $this->db->where($where);                                                                
        }
        
        if ($order != null){
            $this->db->order_by($order);                                                       
        }
        
        $query = $this->db->get($table);

        $this->_result = $query->result();
        $query->free_result();
        return $this->_result;
    }

    public function update_record($table, $data, $column, $id)
    {
//        if (substr($table, 0, 5) != $this->db->dbprefix) {
//            $table = $this->db->dbprefix($table);
//        }
        $exec = $this->db->update($table, $data, array($column => $id));
        return $exec;
    }
    
    public function update_data($table, $data, $where)
    {
        $exec = $this->db->update($table, $data, $where);
        return $exec;
    }

    public function update($id, $data)
    {
        $exec = $this->db->update($this->table, $data, array($this->primaryKey => $id));
        return $exec;
    }

    public function insert_record($table, $data)
    {
//        if (substr($table, 0, 5) != $this->db->dbprefix) {
//            $table = $this->db->dbprefix($table);
//        }
        //print_r($data);exit;
        $exec = $this->db->insert($table, $data);
        if ($exec) $this->id = $this->db->insert_id();
        return $exec;
    }

    public function insert($data)
    {
        $exec = $this->db->insert($this->table, $data);
        if ($exec) $this->id = $this->db->insert_id();
        return $exec;
    }

    public function insert_record_getid($table, $data)
    {
//        if (substr($table, 0, 5) != $this->db->dbprefix) {
//            $table = $this->db->dbprefix($table);
//        }
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function get_row($table, $column, $value)
    {
//        if (substr($table, 0, 5) != $this->db->dbprefix) {
//            $table = $this->db->dbprefix($table);
//        }

        $this->db->select('*');
        $this->db->where($column, $value);
        $query = $this->db->get($table);

        $this->_result = $query->row();
        $query->free_result();
        return $this->_result;
    }

    public function get_rowdata($table, $field, $where)
    {
//        if (substr($table, 0, 5) != $this->db->dbprefix) {
//            $table = $this->db->dbprefix($table);
//        }

        $this->db->select($field);
        $this->db->where($where);
        $query = $this->db->get($table);

        $this->_result = $query->row();
        $query->free_result();
        return $this->_result;
    }
    
    // belum tuntas, belum dipake
    public function buildTreeList($elements, $parentId = 0)
    {
        $branch = array();
        foreach ($elements as $element) {

            if ($element->pid == $parentId) {
                $element->treename = $element->name;
                $branch[] = $element;
                $children = $this->buildTreeList($elements, $element->id);
                if ($children) {
                    foreach ($children as $chd) {
                        $chd->treename = $chd->name;
                        if (strlen($chd->treename) >= 4 && substr($chd->treename, 0, 4) == str_repeat("&nbsp;", 4)) {
                            $chd->treename = str_repeat("&nbsp;", 6) . $chd->name;
                        } elseif (strlen($chd->treename) >= 6 && substr($chd->treename, 0, 6) == str_repeat("&nbsp;", 6)) {
                            $chd->treename = str_repeat("&nbsp;", 8) . $chd->name;
                        } elseif (strlen($chd->treename) >= 8 && substr($chd->treename, 0, 8) == str_repeat("&nbsp;", 8)) {
                            $chd->treename = str_repeat("&nbsp;", 10) . $chd->name;
                        } elseif (strlen($chd->treename) >= 12 && substr($chd->treename, 0, 12) == str_repeat("&nbsp;", 12)) {
                            $chd->treename = str_repeat("&nbsp; ", 14) . $chd->name;
                        } elseif (strlen($chd->treename) >= 14 && substr($chd->treename, 0, 14) == str_repeat("&nbsp;", 14)) {
                            $chd->treename = str_repeat("&nbsp;", 16) . $chd->name;
                        } else {
                            $chd->treename = str_repeat("&nbsp;", 2) . $chd->name;
                        }
                        $branch[] = $chd;
                    }
                }
            }
        }
        return $branch;
    }

    public function sortParentChildList($elements, $parentId = 0)
    {
        $branch = array();
        foreach ($elements as $element) {
            if ($element->pid == $parentId) {
                $element->treename = $element->name;
                $branch[] = $element;
                $children = $this->sortParentChildList($elements, $element->id);
                if ($children) {
                    foreach ($children as $chd) {
                        $chd->treename = $chd->name;
                        $branch[] = $chd;
                    }
                }
            }
        }
        return $branch;
    }

   
}
 
