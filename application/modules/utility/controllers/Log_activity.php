<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Role_manage
 * @property Mrole_manage $mrole_manage
 */
class Log_activity extends Mst_controller
{

    function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_LOG_ACTIVITY";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'language'));
        $this->load->model("Mlog_activity", "mod");
    }

    public function index()
    {
        
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin() && !$this->ion_auth->is_superadmin()) //remove this elseif if you want to enable this for non-admins
        {
            //redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to access this page.');
        } 
        
        $this->data['titlehead'] = "Log Activity";

        // custom load javascript, place at footer                
        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/utility/log_activity.js',
        );
        $this->data['loadfoot'] = $loadfoot;
        
        $this->_render_page('utility/vlog_activity_list', $this->data, false, 'tmpl/vwbacktmpl');
    }

    public function getLists(){  
        
        $by = null;
        $draw = intval( $this->input->post('draw') );
        
        $results  = $this->mod->getDataList(null,$by);
        $totaldata  = count($results);
            
        $totalfiltered =  $this->mod->getCountList($by);
    
        $build_array = array (
            "draw" => $draw,
            "recordsTotal" =>  $totaldata,
            "recordsFiltered" =>  $totalfiltered,
            "data"=>array()
        );
        $i=1;        
        foreach($results as $row) {
            
            $date=date_create($row->logdate);
            $logdate = date_format($date,"d/m/Y H:i:s");
                  
            array_push($build_array["data"],
                array(               
                    //$i,
                    $logdate,
                    $row->ipaddress,
                    $row->compname,                        
                    $row->username,
                    $row->modulalias,
                    $row->transno,
                    $row->activity,
                    $row->httpagent,
                    $row->httphost,
                    $row->mac_address
                )
            );   
            
            $i++;
        }      
                
        echo json_encode($build_array);
            
    }

    
}
