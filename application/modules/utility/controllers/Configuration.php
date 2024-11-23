<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuration extends Mst_controller
{

    function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_CONFIGURATION";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->helper(array('url', 'language'));
        $this->load->model("Mconfiguration", "configuration");
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
        
        $this->data['titlehead'] = "Configuration";

        // custom load javascript, place at footer                
        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/utility/configuration.js',
        );
        $this->data['loadfoot'] = $loadfoot;
        
        $this->_render_page('utility/vconfiguration_list', $this->data, false, 'tmpl/vwbacktmpl');
    }

    public function getLists(){  
        
        $by = null;
        $draw = intval( $this->input->post('draw') );
        
        $results  = $this->configuration->getDataList(null,$by);
        $totaldata  = count($results);
            
        $totalfiltered =  $this->configuration->getCountList($by);
    
        $build_array = array (
            "draw" => $draw,
            "recordsTotal" =>  $totaldata,
            "recordsFiltered" =>  $totalfiltered,
            "data"=>array()
        );
        $i=1;        
        foreach($results as $row) {

            $id = $this->qsecure->encrypt($row->settingId);

            if ($this->_edit) {
                $atr_edit['title'] = 'Edit';
                $atr_edit['url'] = 'utility/configuration/edit_form/';
                $atr_edit['class'] = '';
            }else{
                $atr_edit['title'] = 'Edit (Not Access)';
                $atr_edit['url'] = '#';
                $atr_edit['class'] = '';
            }
            $btnAction = btn_action_group($id, $atr_edit);
                  
            array_push($build_array["data"],
                array(               
                    // $i,
                    $btnAction,
                    $row->settingName,
                    $row->settingValue,                        
                    $row->settingDesc
                )
            );   
            
            $i++;
        }      
                
        echo json_encode($build_array);
    }

     public function edit_form()
    {
        $id = 0;
        $this->data['id'] = $this->uri->segment(4);
        if (trim($this->data['id']) != "") {
            $id = $this->qsecure->decrypt($this->data['id']);
            $this->data['titlehead'] = "Edit Configuration";
        } else {
            $this->data['titlehead'] = "Input Configuration";
        }

        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin() && !$this->ion_auth->is_superadmin()) //remove this elseif if you want to enable this for non-admins
        {
            //redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to access this page.');
        }

        $_tables = $this->config->item('tables', 'ion_auth');

        // //validate form input
        $this->form_validation->set_rules('settingName', 'Nama Pengaturan', 'required|trim|max_length[100]');

        $this->form_validation->set_message('required', '%s harus diisi !');
        //$this->form_validation->set_message('is_uniqueq', '%s sudah digunakan !');
        $this->form_validation->set_message('rolealias_check', '{field} sudah digunakan !');
        $this->form_validation->set_message('greater_than_equal_to', '{field} harus lebih besar atau sama dengan 1 !');

        if ($id > 0 AND !$this->input->post('id')) {
            // retrieve data for edit
            $config = $this->configuration->get_config($id);
            $this->data['config'] = $config;
        } else {
            $config = new stdClass();
            $config->settingName = '';
            $config->settingValue = '';
            $config->settingDesc = '';
        }
        
        if (isset($_POST) && !empty($_POST)) {
//            if ($this->_valid_sess_csrf() === FALSE AND $this->data['id'] != $this->input->post("id")) {
//                show_error($this->lang->line('error_csrf'));
//            }

            // POSTING VARIABLE
            $settingName = $this->input->post('settingName');
            $settingValue = str_crslug($this->input->post('settingValue'));
            $settingDesc = str_crslug($this->input->post('settingDesc'));

            $data = array(
                'settingName' => $settingName,
                'settingValue' => $settingValue,
                'settingDesc' => $settingDesc
            );
            
            
            //check to see if we are updating the user
            if ($id > 0 AND $this->input->post('id')) { // update
                    
                
                if ($this->form_validation->run($this) === TRUE AND $this->configuration->update_record("setting", $data, 'settingId', $id)) {
 
                    $this->mcommon->setLog($this->get_userid(),$this->MOD_ALIAS,$id,"Update Configuration");
                    $this->session->set_flashdata('message', "Update configuration berhasil..");
                    redirect("utility/configuration", 'refresh');

                } else {
                    //set the flash data error message if there is one
                    $this->data['errmsg'] = validation_errors();
                    $this->data['message'] = $this->session->flashdata('message');
                    $this->session->set_flashdata('err', $this->data['errmsg']);

                    $config = new stdClass();
                    $config->settingName = $settingName;
                    $config->settingValue = $settingValue;
                    $config->settingDesc = $settingDesc;
                }

            } else { // insert
                
               
                $data['active'] = 1;
                if ($this->form_validation->run($this) === TRUE) {
                    $id = $this->configuration->insert_record_getid("setting", $data);
                    $this->mcommon->setLog($this->get_userid(),$this->MOD_ALIAS,$id,"Tambah Configuration");
                    $this->session->set_flashdata('message', "Tambah configuration berhasil..");
                    redirect("utility/configuration", 'refresh');
                } else {
                    //set the flash data error message if there is one
                    $this->data['errmsg'] = validation_errors();
                    $this->data['message'] = $this->session->flashdata('message');
                    $this->session->set_flashdata('err', $this->data['errmsg']);

                    $config = new stdClass();
                    $config->settingName = $settingName;
                    $config->settingValue = $settingValue;
                    $config->settingDesc = $settingDesc;
                }
            }
                
        }//endif POST

        //display the create config form
        $this->data['settingName'] = array(
            'name' => 'settingName',
            'id' => 'settingName',
            'type' => 'text',
            'readonly' => 'true',
            'value' => $this->form_validation->set_value('settingName', $config->settingName),
            'class' => 'form-control',
            'placeholder' => 'Nama Pengaturan'
        );
        $this->data['settingName_edit'] = $config->settingName;

        $this->data['settingValue'] = array(
            'name' => 'settingValue',
            'id' => 'settingValue',
            'type' => 'text',
            'value' => $this->form_validation->set_value('settingValue', $config->settingValue),
            'class' => 'form-control',
            'placeholder' => 'Nilai Pengaturan'
        );
        $this->data['settingValue_edit'] = $config->settingValue;

        $this->data['settingDesc'] = array(
            'name' => 'settingDesc',
            'id' => 'settingDesc',
            'type' => 'text',
            'value' => $this->form_validation->set_value('settingDesc', $config->settingDesc),
            'class' => 'form-control',
            'placeholder' => 'Desc'
        );
        $this->data['settingDesc_edit'] = $config->settingDesc;

        $this->data['csrf'] = $this->_get_sess_csrf();

        $this->_render_page('utility/vconfiguration_form', $this->data, false, 'tmpl/vwbacktmpl');
    }
}
