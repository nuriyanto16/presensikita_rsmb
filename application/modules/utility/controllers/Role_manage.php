<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Role_manage
 * @property Mrole_manage $mrole_manage
 */
class Role_manage extends Mst_controller
{

    function __construct()
    {
        parent::__construct();

        $this->MOD_ALIAS = "MOD_ROLEMANAGE";
        $this->_checkAuthorization($this->MOD_ALIAS);
        $this->load->library('form_validation');
        $this->load->helper(array('url', 'language'));
        $this->load->model("mrole_manage", "mrole_manage");
        //$this->load->config('ion_auth', TRUE);
        //$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        //$this->lang->load('auth');
    }

    public function index()
    {
        $this->list_role();
    }

    /**
     * @return void
     */
    public function list_role()
    {
        $this->data['titlehead'] = "Group / Role";

        // custom load javascript, place at footer                
        $tagjs1 = "$(document).ready(function() {
                       $('#dt-listrole')
                            .DataTable({
                                responsive: true,
                                searching: true,
                                paging: true,
                                ordering: false,
                            });
                   });";
        $loadfoot['tagjs'] = array($tagjs1);
        $this->data['loadfoot'] = $loadfoot;

        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        } 
        elseif (!$this->ion_auth->is_admin() && !$this->ion_auth->is_superadmin()) //remove this elseif if you want to enable this for non-admins
        {
            //redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to access this page.');
        } else {
            //list the roles
            $this->data['roles'] = $this->mrole_manage->get_roles();
        }
        $this->_render_page('utility/vrole_list', $this->data, false, 'tmpl/vwbacktmpl');
    }

    /**
     * @return void
     */
    public function edit_form()
    {
        $id = 0;
        $this->data['id'] = $this->uri->segment(4);
        if (trim($this->data['id']) != "") {
            $id = $this->qsecure->decrypt($this->data['id']);
            $this->data['titlehead'] = "Edit Role";
        } else {
            $this->data['titlehead'] = "Input Role";
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
        $this->form_validation->set_rules('role_name', 'Nama Role', 'required|trim|max_length[100]');

        if (trim($this->data['id']) == "") { // new mode
            $this->form_validation->set_rules('role_alias', 'Role Alias', 'required|max_length[100]');
        }

        if ($id == 0) {
            $this->form_validation->set_rules('role_alias', 'Role Alias', 'required|max_length[100]|callback__rolealias_check');
        }

        $this->form_validation->set_message('required', '%s harus diisi !');
        //$this->form_validation->set_message('is_uniqueq', '%s sudah digunakan !');
        $this->form_validation->set_message('rolealias_check', '{field} sudah digunakan !');
        $this->form_validation->set_message('greater_than_equal_to', '{field} harus lebih besar atau sama dengan 1 !');

        if ($id > 0 AND !$this->input->post('id')) {
            // retrieve data for edit
            $role = $this->mrole_manage->get_roles($id);
            $this->data['role'] = $role;
        } else {
            $role = new stdClass();
            $role->role_name = '';
            $role->role_alias = '';
        }
        
        if (isset($_POST) && !empty($_POST)) {
//            if ($this->_valid_sess_csrf() === FALSE AND $this->data['id'] != $this->input->post("id")) {
//                show_error($this->lang->line('error_csrf'));
//            }

            // POSTING VARIABLE
            $role_name = $this->input->post('role_name');
            $role_alias = str_crslug($this->input->post('role_alias'));

            $data = array(
                'role_name' => $role_name,
                'role_alias' => $role_alias
            );
            
            
            //check to see if we are updating the user
            if ($id > 0 AND $this->input->post('id')) { // update
                
                if ($this->form_validation->run($this) === TRUE AND $this->mrole_manage->update_record($_tables['groups'], $data, 'role_id', $id)) {
 
                    $this->mcommon->setLog($this->get_userid(),$this->MOD_ALIAS,$id,"Update Role");
                    $this->session->set_flashdata('message', "Update role berhasil..");
                    redirect("utility/role_manage", 'refresh');

                } else {
                    //set the flash data error message if there is one
                    $this->data['errmsg'] = validation_errors();
                    $this->data['message'] = $this->session->flashdata('message');
                    $this->session->set_flashdata('err', $this->data['errmsg']);

                    $role = new stdClass();
                    $role->role_name = $role_name;
                    $role->role_alias = $role_alias;
                }

            } else { // insert
                
               
                $data['active'] = 1;
                if ($this->form_validation->run($this) === TRUE) {
                    $id = $this->mrole_manage->insert_record_getid($_tables['groups'], $data);
                    $this->mcommon->setLog($this->get_userid(),$this->MOD_ALIAS,$id,"Tambah Role");
                    $this->session->set_flashdata('message', "Tambah role berhasil..");
                    redirect("utility/role_manage", 'refresh');
                } else {
                    //set the flash data error message if there is one
                    $this->data['errmsg'] = validation_errors();
                    $this->data['message'] = $this->session->flashdata('message');
                    $this->session->set_flashdata('err', $this->data['errmsg']);

                    $role = new stdClass();
                    $role->role_name = $role_name;
                    $role->role_alias = $role_alias;
                }
            }
                
        }//endif POST

        //display the create role form
        $this->data['role_name'] = array(
            'name' => 'role_name',
            'id' => 'role_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('role_name', $role->role_name),
            'class' => 'form-control',
            'placeholder' => 'nama role'
        );

        $this->data['role_alias'] = array(
            'name' => 'role_alias',
            'id' => 'role_alias',
            'type' => 'text',
            'value' => $this->form_validation->set_value('role_alias', $role->role_alias),
            'class' => 'form-control',
            'placeholder' => 'alias role'
        );
        $this->data['role_alias_edit'] = $role->role_alias;

        $this->data['csrf'] = $this->_get_sess_csrf();

        $this->_render_page('utility/vrole_form', $this->data, false, 'tmpl/vwbacktmpl');
    }

    /**
     * activate the role
     *
     * @param $id
     * @return void
     */
    public function activate($id)
    {
        if (!$this->ion_auth->logged_in() OR (!$this->ion_auth->is_admin() && !$this->ion_auth->is_superadmin())) {
            return show_error('You must be an administrator to action this method.');
        }
        if ($id != null && $id != "") {
            $id = $this->qsecure->decrypt($id);
        }

        $_tables = $this->config->item('tables', 'ion_auth');
        $id = (int)$id;
        $data['active'] = 1;
        $activation = $this->mrole_manage->update_record($_tables['groups'], $data, 'role_id', $id);
        if ($activation) {
            $this->session->set_flashdata('message', "Role berhasil di aktifkan...");
            $this->mcommon->setLog($this->get_userid(),$this->MOD_ALIAS,$id,"Role Diaktifkan");
        } else {
            $this->session->set_flashdata('err', "Role gagal di aktifkan !");
        }
        redirect("utility/role_manage", 'refresh');
    }

    /**
     * deactivate the role
     *
     * @param null $id
     * @return void
     */
    public function deactivate($id = NULL)
    {
        if (!$this->ion_auth->logged_in() OR (!$this->ion_auth->is_admin() && !$this->ion_auth->is_superadmin())) {
            return show_error('You must be an administrator to action this method.');
        }

        if ($id != null && $id != "") {
            $id = $this->qsecure->decrypt($id);
        }
        $id = (int)$id;
        if ($id == 1) {
            redirect('utility/role_manage/list_role', 'refresh');
        }

        $_tables = $this->config->item('tables', 'ion_auth');
        $data['active'] = 0;
        $deactivate = $this->mrole_manage->update_record($_tables['groups'], $data, 'role_id', $id);
        if ($deactivate) {
            $this->mcommon->setLog($this->get_userid(),$this->MOD_ALIAS,$id,"Role Di Non aktifkan");
            $this->session->set_flashdata('message', "Role berhasil di non-aktifkan...");
        } else {
            $this->session->set_flashdata('err', "Role gagal di non-aktifkan !");
        }
        redirect("utility/role_manage", 'refresh');
    }

    /**
     * delete the role
     *
     * @param null $id
     * @return void
     */
    public function delete($id = NULL)
    {
        if (!$this->ion_auth->logged_in() OR (!$this->ion_auth->is_admin() && !$this->ion_auth->is_superadmin())) {
            return show_error('You must be an administrator to action this method.');
        }

        if ($id != null && $id != "") {
            $id = $this->qsecure->decrypt($id);
        }
        $id = (int)$id;
        if ($id == 1) {
            redirect('utility/role_manage', 'refresh');
        }

        $_tables = $this->config->item('tables', 'ion_auth');
        $res = $this->mrole_manage->delete_record($_tables['groups'], 'role_id', $id);
        if ($res) {
            $this->mcommon->setLog($this->get_userid(),$this->MOD_ALIAS,$id,"Role Di hapus");
            $this->session->set_flashdata('message', "Role berhasil dihapus...");
        } else {
            $this->session->set_flashdata('err', "Role gagal dihapus !");
        }
        //redirect them back to the auth page
        redirect('utility/role_manage', 'refresh');
    }

    /**
     * Check Role Alias
     *
     * @param $rolealias
     * @return bool
     */
    function _rolealias_check($rolealias)
    {
        
        if ($this->mrole_manage->role_exists($rolealias, $this->qsecure->decrypt($this->input->post("id")))) {
            $this->form_validation->set_message('_rolealias_check', '{field} sudah ada (duplikat) !');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
