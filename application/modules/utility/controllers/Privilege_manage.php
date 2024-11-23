<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privilege_manage extends Mst_controller
{

    function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_PRIVMANAGE";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'language'));
        $this->load->model("mmodule_manage", "mmodule");
        //$this->load->config('ion_auth', TRUE);
        //$this->lang->load('auth');
    }

    public function index()
    {
        $this->edit_privilege();
    }

    public function edit_privilege()
    {
        $this->data['titlehead'] = "Pengaturan Otorisasi";

        // custom load javascript, place at footer
        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/utility/privilege_manage_form_js.js',
        );
        $this->data['loadfoot'] = $loadfoot;

        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin() && !$this->ion_auth->is_superadmin()) //remove this elseif if you want to enable this for non-admins
        {
            //redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to access this page.');
        }

        //list option role
        $data_roles = $this->mmodule->get_roles();
        $list_roles [''] = '- Pilih Role -';
        foreach ($data_roles as $row) {
            $list_roles[$this->qsecure->encrypt($row->role_id)] = $row->role_name;
        }
        $this->data['list_roles'] = $list_roles;

        $this->data['csrf'] = $this->_get_sess_csrf();

        $this->_render_page('utility/vprivilege_form', $this->data, false, 'tmpl/vwbacktmpl');
    }

    public function save_privilege()
    {
        $this->data['titlehead'] = "Pengaturan Otorisasi";

        // custom load javascript, place at footer
        $loadfoot['javascript'] = array(
            HTTP_MOD_JS . 'modules/utility/privilege_manage_form_js.js',
        );
        $this->data['loadfoot'] = $loadfoot;

        //validate form input
        $this->form_validation->set_rules('role_id', 'Nama Role', 'required|trim');
        $this->form_validation->set_message('required', 'Silakan pilih dulu nama role !');

        if (isset($_POST) && !empty($_POST)) {
            
          
            $role_id = $this->input->post('role_id');
            if (trim($role_id) != "")
                $role_id = $this->qsecure->decrypt($role_id);

//            if ($this->_valid_sess_csrf() === FALSE) {
//                show_error($this->lang->line('error_csrf'));
//            }

            if ($this->form_validation->run($this) === TRUE) {
                if ($this->mmodule->update_privilege($role_id)) {
                    $this->mcommon->setLog($this->get_userid(),$this->MOD_ALIAS,$role_id,"Update Otorisasi");
                    $this->session->set_flashdata('message', "Update otorisasi berhasil..");
                } else {
                    $this->data['errmsg'] = "Update otorisasi gagal !";
                    $this->session->set_flashdata('err', $this->data['errmsg']);
                }
                redirect("utility/privilege_manage", 'refresh');
            } else {
                //set the flash data error message if there is one
                $this->data['errmsg'] = (validation_errors() ? validation_errors() : "Update otorisasi gagal !!");
                $this->data['message'] = $this->session->flashdata('message');
                $this->session->set_flashdata('err', $this->data['errmsg']);
            }
        }

        //list option role
        $data_roles = $this->mmodule->get_roles();
        $list_roles [''] = '- Pilih Role -';
        foreach ($data_roles as $row) {
            $list_roles[$this->qsecure->encrypt($row->role_id)] = $row->role_name;
        }
        $this->data['list_roles'] = $list_roles;

        $this->data['csrf'] = $this->_get_sess_csrf();

        $this->_render_page('utility/vprivilege_form', $this->data, false, 'tmpl/vwbacktmpl');
    }

    public function get_priv_by($role_id)
    {
        $build_array = array("data" => array());
        if (trim($role_id) != "")
            $role_id = $this->qsecure->decrypt($role_id);

        if ($role_id > 0) {
            $data = $this->mmodule->get_privilege($role_id);
            $dataSort = $this->mmodule->sort_parentchild($data);
           
            if (count($dataSort) > 0) {
                $i = 1;
                foreach ($dataSort as $row) {
                    $_checked = "";
                    if ($row->allow_view == 1)
                        $_checked = "CHECKED";

                    $Inp = sprintf("<input type='checkbox' value='%d' name='moduleid[]' id='moduleid-%d' %s />", $row->module_id, $row->module_id, $_checked);
                    
                    $_checked_new = "";
                    if ($row->allow_new == 1)
                        $_checked_new = "CHECKED";
                    
                    $InpNew = sprintf("<input type='checkbox' value='%d' name='auth_new[]' id='auth_new-%d' %s />", $row->module_id, $row->module_id, $_checked_new);
                    
                    $_checked_edit = "";
                    if ($row->allow_edit == 1)
                        $_checked_edit = "CHECKED";
                    
                    $InpEdit = sprintf("<input type='checkbox' value='%d' name='auth_edit[]' id='auth_edit-%d' %s />", $row->module_id, $row->module_id, $_checked_edit);
                    
                    $_checked_del = "";
                    if ($row->allow_delete == 1)
                        $_checked_del = "CHECKED";
                    
                    $InpDel = sprintf("<input type='checkbox' value='%d' name='auth_del[]' id='auth_del-%d' %s />", $row->module_id, $row->module_id, $_checked_del);
                    
                    $_checked_print = "";
                    if ($row->allow_print == 1)
                        $_checked_print = "CHECKED";
                    
                    $InpPrint = sprintf("<input type='checkbox' value='%d' name='auth_print[]' id='auth_print-%d' %s />", $row->module_id, $row->module_id, $_checked_print);
                    
                    $_checked_approve = "";
                    if ($row->allow_approve == 1)
                        $_checked_approve = "CHECKED";
                    
                    $InpApprove = sprintf("<input type='checkbox' value='%d' name='auth_approve[]' id='auth_approve-%d' %s />", $row->module_id, $row->module_id, $_checked_approve);
                    
                    array_push($build_array["data"],
                        array(
                            $Inp,
                            $row->treename,
                            $InpNew,
                            $InpEdit,
                            $InpDel,
                            $InpPrint,
                            $InpApprove
                        )
                    );
                    $i++;
                }
            }
        }
        echo json_encode($build_array);
    }

    public function edit_form()
    {
        $id = 0;
        $this->data['id'] = $this->uri->segment(4);
        if (trim($this->data['id']) != "") {
            $id = $this->qsecure->decrypt($this->data['id']);
            $this->data['titlehead'] = "Edit Modul";
        } else {
            $this->data['titlehead'] = "Input Modul";
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

        //validate form input
        $this->form_validation->set_rules('module_name', 'Nama Modul', 'required|trim');
        $this->form_validation->set_rules('module_url', 'URL', 'required|trim');
        $this->form_validation->set_rules('mod_icon_cls', 'Icon Class', 'trim');
        $this->form_validation->set_rules('mod_seq', 'Urutan', 'required|trim|numeric');
        $this->form_validation->set_rules('module_pid', 'Parent Modul', 'trim');
        $this->form_validation->set_rules('mod_group', 'Kelompok Modul', 'trim');

        if (trim($this->data['id']) == "") { // new mode
            $this->form_validation->set_rules('module_alias', 'Modul Alias', 'required|is_uniqueq[off_sec_module.module_alias]');
        }

        if ($this->input->post("module_alias_edit") AND trim($this->input->post("module_alias_edit")) != "" AND
            trim($this->input->post("module_alias")) != trim($this->input->post("module_alias_edit"))
        ) {
            $this->form_validation->set_rules('module_alias', 'Modul Alias', 'required|callback__modulealias_check');
        }

        $this->form_validation->set_message('required', '%s harus diisi !');
        $this->form_validation->set_message('is_uniqueq', '%s sudah digunakan !');
        $this->form_validation->set_message('_modulealias_check', '{field} sudah digunakan !');
        $this->form_validation->set_message('numeric', '{field} harus berisi angka !');

        if ($id > 0 AND !$this->input->post('id')) {
            // retrieve data for edit
            $module = $this->mmodule->get_modules($id);
            $this->data['module'] = $module;
        } else {
            $module = new stdClass();
            $module->module_name = '';
            $module->module_alias = '';
            $module->module_url = '';
            $module->mod_icon_cls = '';
            $module->mod_seq = '';
            $module->module_pid = '';
            $module->publish = '';
            $module->mod_group = '';
        }

        if (isset($_POST) && !empty($_POST)) {
//            if ($this->_valid_sess_csrf() === FALSE AND $this->data['id'] != $this->input->post("id")) {
//                show_error($this->lang->line('error_csrf'));
//            }
      
            // POSTING VARIABLE
            $module_name = $this->input->post('module_name');
            $module_alias = strtoupper($this->input->post('module_alias'));
            $module_url = $this->input->post('module_url');
            $mod_icon_cls = $this->input->post('mod_icon_cls');
            $mod_seq = $this->input->post('mod_seq');
            $module_pid = $this->input->post('module_pid');
            $mod_group = $this->input->post('mod_group');
            if (empty($mod_icon_cls)) $mod_icon_cls = "fa-circle-o";
            $data = array(
                'module_name' => $module_name,
                'module_alias' => $module_alias,
                'module_url' => $module_url,
                'mod_icon_cls' => $mod_icon_cls,
                'mod_seq' => $mod_seq,
                'module_pid' => $module_pid,
                'mod_group' => $mod_group
            );

            //check to see if we are updating the user
            if ($id > 0 AND $this->input->post('id')) { // update

                if ($this->form_validation->run($this) === TRUE AND $this->mmodule->update_record('off_sec_module', $data, 'module_id', $id)) {
                    $this->session->set_flashdata('message', "Update modul berhasil..");
                    redirect("utility/module_manage", 'refresh');

                } else {
                    //set the flash data error message if there is one
                    $this->data['errmsg'] = validation_errors();
                    $this->data['message'] = $this->session->flashdata('message');
                    $this->session->set_flashdata('err', $this->data['errmsg']);

                    $module = new stdClass();
                    $module->module_name = $this->input->post('module_name');
                    $module->module_alias = $this->input->post('module_alias');
                    $module->module_url = $this->input->post('module_url');
                    $module->mod_icon_cls = $this->input->post('mod_icon_cls');
                    $module->mod_seq = $this->input->post('mod_seq');
                    $module->module_pid = $this->input->post('module_pid');
                    $module->mod_group = $this->input->post('mod_group');
                    $this->data['module'] = $module;
                }


            } else { // insert
                $data['publish'] = 1;
                if ($this->form_validation->run($this) === TRUE AND $retid = $this->mmodule->insert_record('off_sec_module', $data)) {
                    $this->session->set_flashdata('message', "Tambah modul berhasil..");
                    redirect("utility/module_manage", 'refresh');
                } else {
                    //set the flash data error message if there is one
                    $this->data['errmsg'] = validation_errors();
                    $this->data['message'] = $this->session->flashdata('message');
                    $this->session->set_flashdata('err', $this->data['errmsg']);

                    $module = new stdClass();
                    $module->module_name = $this->input->post('module_name');
                    $module->module_alias = $this->input->post('module_alias');
                    $module->module_url = $this->input->post('module_url');
                    $module->mod_icon_cls = $this->input->post('mod_icon_cls');
                    $module->mod_seq = $this->input->post('mod_seq');
                    $module->module_pid = $this->input->post('module_pid');
                    $module->mod_group = $this->input->post('mod_group');
                    $this->data['module'] = $module;
                }
            }

        }//endif POST


        //display the create modul form                                              
        $this->data['module_name'] = array(
            'name' => 'module_name',
            'id' => 'module_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('module_name', $module->module_name),
            'class' => 'form-control',
            'placeholder' => 'nama modul'
        );

        $this->data['module_alias'] = array(
            'name' => 'module_alias',
            'id' => 'module_alias',
            'type' => 'text',
            'value' => $this->form_validation->set_value('module_alias', $module->module_alias),
            'class' => 'form-control',
            'placeholder' => 'alias'
        );
        $this->data['module_alias_edit'] = $module->module_alias;

        $this->data['module_url'] = array(
            'name' => 'module_url',
            'id' => 'module_url',
            'type' => 'text',
            'value' => $this->form_validation->set_value('module_url', $module->module_url),
            'class' => 'form-control',
            'placeholder' => 'url modul'
        );

        $this->data['mod_icon_cls'] = array(
            'name' => 'mod_icon_cls',
            'id' => 'mod_icon_cls',
            'type' => 'text',
            'value' => $this->form_validation->set_value('mod_icon_cls', $module->mod_icon_cls),
            'class' => 'form-control',
            'placeholder' => 'fa-circle-o'
        );

        $this->data['mod_seq'] = array(
            'name' => 'mod_seq',
            'id' => 'mod_seq',
            'type' => 'text',
            'value' => $this->form_validation->set_value('mod_seq', $module->mod_seq),
            'class' => 'form-control',
            'placeholder' => '[0-9]',
            'onblur' => 'checkNumber(this)',
            'onkeyup' => 'checkNumber(this)'
        );

        $this->data['mod_group'] = array(
            'name' => 'mod_group',
            'id' => 'mod_group',
            'type' => 'text',
            'value' => $this->form_validation->set_value('mod_group', $module->mod_group),
            'class' => 'form-control',
            'placeholder' => 'kelompok modul'
        );

        // option modules parent              
        $_by['m.publish'] = 1;
        $data_modules = $this->mmodule->get_modules(null, $_by);
        $modules_sort = $this->mmodule->sort_parentchild($data_modules);
        $list_pmod ['0'] = '- Root -';
        foreach ($modules_sort as $row) {
            $list_pmod[$row->module_id] = $row->treename;
        }
        $this->data['list_pmod'] = $list_pmod;

        // custom load javascript, place at footer                
        $tagjs1 = "$(document).ready(function() {                            
                        $('#module_pid').select2();                     
        });";
        $loadfoot['tagjs'] = array($tagjs1);
        $this->data['loadfoot'] = $loadfoot;

        $this->data['csrf'] = $this->_get_sess_csrf();

        $this->_render_page('utility/vmodule_form', $this->data, false, 'tmpl/vwbacktmpl');
    }
}
