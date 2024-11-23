<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Muser_manage extends Mst_model
{
    protected $tables;
    protected $_data = null;

    public $photo;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->config('ion_auth', TRUE);
        $this->lang->load('ion_auth');

        //initialize db tables data
        $this->tables = $this->config->item('tables', 'ion_auth');
    }

    // GET DATA LIST USER
    var $column_orderList = array(null, 'u.id',
                                        'u.username',
                                        'u.full_name',
                                        'u.email',
                                        'u.created_date',
                                        'u.last_login',
                                        'u.active',
                                        'u.nik',
                                        'u.photo', 
                                        'ur.role_id', 
                                        'r.role_name', 
                                        'u.phone',
                                        'u.positionId',
                                        'u.positionName', 
                                        'u.unitId',
                                        'u.unitName', 
                                null);
    var $column_searchList = array('u.id',
                                    'u.username',
                                    'u.full_name',
                                    'u.email',
                                    'u.created_date',
                                    'u.last_login',
                                    'u.active',
                                    'u.nik',
                                    'u.photo', 
                                    'ur.role_id', 
                                    'r.role_name', 
                                    'u.phone',
                                    'u.positionId',
                                    'u.positionName',
                                    'u.unitId',
                                    'u.unitName'    
        );
    var $orderList = array('u.username' => 'asc'); // default order

    private function _get_datatables_queryList()
    {
        $this->db->select("u.id, u.username, u.full_name, u.email, u.created_date, u.last_login, u.active, 
            u.nik,u.photo, ur.role_id, r.role_name, u.phone, COALESCE(u.positionId,0) AS positionId, 
            COALESCE(u.unitId,0) AS unitId, COALESCE(u.positionName,'') AS positionName, COALESCE(u.unitCode,'') AS unitCode, COALESCE(u.unitName,'') AS unitName");
        $this->db->from(config_item("view_user") . " u");
        $this->db->join($this->tables['users_groups'] . " ur", "ur.userid=u.id", "inner");
        $this->db->join($this->tables['groups'] . " r", "r.role_id=ur.role_id", "inner");
        if ($this->session->userdata(sess_prefix() . "rolealias") == "superadmin") {
            $this->db->where("r.role_id >=", 1);
        } else if ($this->session->userdata(sess_prefix() . "rolealias") == "admin") {
            $this->db->where("r.role_id >", 1);
        }
        $i = 0;
    
        foreach ($this->column_searchList as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_searchList) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_orderList[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->orderList))
        {
            $order = $this->orderList;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatablesList()
    {
        $this->_get_datatables_queryList();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        $result = $query->result();
        $query->free_result();
        
        return $result;
    }

    function count_filteredList()
    {
        $this->_get_datatables_queryList();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_allList()
    {
        $this->db->select("u.id");
        $this->db->from(config_item("view_user") . " u");
        $this->db->join($this->tables['users_groups'] . " ur", "ur.userid=u.id", "inner");
        $this->db->join($this->tables['groups'] . " r", "r.role_id=ur.role_id", "inner");
        if ($this->session->userdata(sess_prefix() . "rolealias") == "superadmin") {
            $this->db->where("r.role_id >=", 1);
        } else if ($this->session->userdata(sess_prefix() . "rolealias") == "admin") {
            $this->db->where("r.role_id >", 1);
        }
        return $this->db->count_all_results();
    }
    // END GET LIST DATA USER

    function get_users($id = null, $search_string = null, $positionId = null)
    {
        $this->db->select("u.id, u.empId, u.compId, u.compName, u.username, u.prefix,u.full_name, u.email, u.created_date, u.last_login, u.active, u.nik,u.photo, 
            ur.role_id, r.role_name, u.phone, COALESCE(u.positionId,0) AS positionId, COALESCE(u.unitId,0) AS unitId, 
            COALESCE(u.positionName,'') AS positionName, COALESCE(u.unitName,'') AS unitName, COALESCE(u.unitCode,'') AS unitCode, represent, 
            COALESCE(representPositionId,0) as representPositionId,COALESCE(representPositionName,'') as representPositionName, u.positionCode,
            COALESCE(u.dt_superadmin, 0) AS dt_superadmin, COALESCE(u.dt_admin, 0) AS dt_admin, COALESCE(u.dt_user, 0) AS dt_user,u.positionDesc ");
        $this->db->from(config_item("view_user") . " u");
        $this->db->join($this->tables['users_groups'] . " ur", "ur.userid=u.id", "inner");
        $this->db->join($this->tables['groups'] . " r", "r.role_id=ur.role_id", "inner");
        if ($id == null OR $id == "") {
            
            if ($this->session->userdata(sess_prefix() . "rolealias") == "superadmin") {
                $this->db->where("r.role_id >=", 1);
            } else if ($this->session->userdata(sess_prefix() . "rolealias") == "admin") {
                $this->db->where("r.role_id >", 1);
            }
            
            if(!empty($positionId)){
                $this->db->where("u.positionId", $positionId);
            }

            if (!empty($search_string)) {
                $this->db->group_start();
                $this->db->like("u.full_name", $search_string);
                $this->db->or_like("u.email", $search_string);
                $this->db->group_end();
            }

            $this->db->order_by("u.username", "asc");

            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            $this->db->where("u.id", $id);

            $Q = $this->db->get();
            $this->_data = $Q->row();
        }

        $Q->free_result();
        return $this->_data;
    }

    function get_users_by_position($position_code)
    {
        $this->db->select("u.id, u.username, u.full_name, u.email");
        $this->db->from(config_item("view_user") . " u");
        $this->db->where("u.positionCode", $position_code);
        $this->db->order_by("u.username", "asc");

        $Q = $this->db->get();
        $this->_data = $Q->result();

        $Q->free_result();
        return $this->_data;
    }

    function get_roles()
    {
        $this->db->select("role_id, role_name");
        $this->db->from($this->tables['groups']);
        $this->db->where("active", 1);
        if ($this->session->userdata(sess_prefix() . "rolealias") == "superadmin") {
            $this->db->where("role_id >=", 1);
        } else if ($this->session->userdata(sess_prefix() . "rolealias") == "admin") {
            $this->db->where("role_id >", 1);
        }
        $this->db->order_by("role_id", "asc");
        $Q = $this->db->get();
        $this->_data = $Q->result();
        $Q->free_result();
        return $this->_data;
    }

    public function username_exists($username, $id = null)
    {
        if (empty($username)) {
            return FALSE;
        }

        $this->db->select("count(id) as _cnt");
        $this->db->from($this->tables['users']);
        $this->db->where('username', $username);
        if ($id != null) {
            $this->db->where('id!=', $id);
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

    public function email_exists($email, $id = null)
    {
        if (empty($email)) {
            return FALSE;
        }

        $this->db->select("count(id) as _cnt");
        $this->db->from($this->tables['users']);
        $this->db->where('email', $email);
        if ($id != null) {
            $this->db->where('id!=', $id);
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

    // GET DATA JABATAN POP UP

    var $table = '';
    var $column_order = array(null, 'a.unitCode',
                                    'a.unitName',
                                    'a.parentUnitName', null);
    var $column_search = array('a.unitCode');
    var $order = array('unitId' => 'asc'); // default order

    private function _get_datatables_query()
    {
        $this->db->select("a.compid, a.comp_name, a.unitId, a.unitCode, a.unitName, a.parentUnitName, a.parentUnitId");
        $this->db->from(config_item('view_unit') . ' a');
        $this->db->order_by("a.parentUnitId", "asc");
        //$this->db->order_by("a.unitCode", "asc");
        $this->db->order_by("a.unitId", "asc");

        $i = 0;
    
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        $this->_get_custom_field();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $this->_get_custom_field();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function _get_custom_field()
    {
        if(isset($_POST['columns'][1]['search']['value']) and $_POST['columns'][1]['search']['value'] !=''){
            $this->db->where('a.siteId',$_POST['columns'][1]['search']['value']);
        }
    }

    public function count_all()
    {
        $this->db->select("a.unitId");
        $this->db->from(config_item('view_unit') . ' a');
        return $this->db->count_all_results();
    }
    
    function company(){

        if($this->session->userdata(sess_prefix()."roleid") != 1 ){
            $this->db->where('COMP_CODE',$this->session->userdata(sess_prefix()."compId"));
        }

        $this->db->order_by('COMP_NAME','ASC');
        $company = $this->db->get(config_item('table_company'));
        return $company->result_array();
    }

    function site($compId){
        $site="<option value=''>- Pilih -</pilih>";
        $this->db->order_by('siteName','ASC');
        $lok = $this->db->get_where(config_item('table_site'), array('compId'=>$compId));
        foreach ($lok->result_array() as $data ){
            $site.= "<option value='$data[siteId]'>$data[siteName]</option>";
        }
        return $site;
    }
    
    function jabatanWakil($positionId){
        $html="<option value='0'>Pilih Jabatan</pilih>";
        $this->db->order_by('positionId','ASC');
        $lok = $this->db->get_where(config_item('table_position'), array('active'=>1,'positionId <>'=>$positionId,'positionType'=>'pejabat'));
        foreach ($lok->result_array() as $data ){
            $html.= "<option value='$data[positionId]'>$data[positionName]</option>";
        }
        return $html;
    }
    
    public function buildTree($elements, $parentId = 0)
    {
       
        $site = array();
        foreach ($elements as $element) {
            if ($element->parentUnitId == $parentId) {
                $element->treename = $element->unitName;
                $site[] = $element;
                $children = $this->buildTree($elements, $element->unitId);
                if ($children) {
                    //$element['children'] = $children;
                    foreach ($children as $chd) {
                        if (strlen($chd->treename) >= 14 && substr($chd->treename, 0, 14) == "&nbsp;|_&nbsp;") {
                            $chd->treename = "&nbsp;&nbsp;&nbsp;&nbsp;|_&nbsp;" . $chd->unitName;
                        } elseif (strlen($chd->treename) >= 32 && substr($chd->treename, 0, 32) == "&nbsp;&nbsp;&nbsp;&nbsp;|_&nbsp;") {
                            $chd->treename = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|_&nbsp;" . $chd->unitName;
                        } elseif (strlen($chd->treename) >= 32 && substr($chd->treename, 0, 50) == "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|_&nbsp;") {
                            $chd->treename = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|_&nbsp;" . $chd->unitName;
                        } elseif (strlen($chd->treename) >= 68 && substr($chd->treename, 0, 60) == "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;") {
                            $chd->treename = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.|_&nbsp;" . $chd->unitName;
                        } else {
                            $chd->treename = "&nbsp;|_&nbsp;" . $chd->unitName;
                        }
                        $site[] = $chd;
                    }
                }
            }
        }
        return $site;
    }
}
