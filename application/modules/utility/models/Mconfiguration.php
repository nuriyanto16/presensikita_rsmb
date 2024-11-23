<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Mconfiguration extends Mst_model
{
    protected $_id = "settingId";
    var $_tables = "setting";

    function getDataList($id = null, $by = null)
   {
       
        $offset = $this->input->post('start', 1);
        $limit = $this->input->post('length', 25);
        $search = $this->input->post('search');
        
        $order = $this->input->post('order');                    
        $arr_col = array(
            1 => 'settingId',
            2 => 'settingName',
            3 => 'settingValue',            
            4 => 'settingDesc'
        );
        
        $search_string = "";
        if (!empty($search['value'])){
            $search_string = strtolower(trim($search['value']));          
        }

        $this->db->from($this->_tables);
        if ($id == null OR $id == "") {
             
            if ($by != null) {
                $whr = $this->_by($by);   
                $this->db->where("($whr)");
            }

            if (! is_null($search_string) && $search_string != ""){                
                $this->db->group_start();
                $this->db->like('settingName', $search_string,'both');
                $this->db->or_like('settingValue', $search_string,'both');               
                $this->db->or_like('settingDesc', $search_string,'both');               
                $this->db->group_end();
            }              
            if ($offset != null && $limit != null)
                $this->db->limit($limit,$offset);

            if (isset($order[1]['column']) AND $order[1]['column'] != "") {
                $this->db->order_by($arr_col[ $order[1]['column'] ], $order[1]['dir']);                 
            }else{
                $this->db->order_by($arr_col[1], "ASC");                 
            }

            $Q = $this->db->get();
            $data = $Q->result();
            
        } else {
            $this->db->where($this->_id, $id);

            if ($by != null)$this->db->where($by);

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
        if (!empty($search['value'])){
            $search_string = strtolower(trim($search['value']));          
        }
        
        $this->db->select("COUNT(*) AS cnt");
        $this->db->from($this->_tables);
        
        if ($by != null) {
            $whr = $this->_by($by);   
            $this->db->where("($whr)");
        }

        if (! is_null($search_string) && $search_string != ""){                
            $this->db->group_start();
            $this->db->like('settingName', $search_string,'both');
            $this->db->or_like('settingValue', $search_string,'both');               
            $this->db->or_like('settingDesc', $search_string,'both');               
            $this->db->group_end();
        }              
        

        $Q = $this->db->get();
        $data = $Q->row();
      
        $Q->free_result();
        return $data->cnt;
    }

    function get_config($id = null)
    {
//        $this->db->select("r.role_id, r.role_name, r.role_alias, r.active");
        $this->db->from($this->_tables . " c");
        if ($id == null OR $id == "") {

            $Q = $this->db->get();
            $this->_data = $Q->result();
        } else {
            $this->db->where("c." . $this->_id, $id);

            $Q = $this->db->get();
            $this->_data = $Q->row();
        }

        $Q->free_result();
        return $this->_data;
    }
}
